<template>
    <div class="container">

        <div class="row">
            <h1 class="text-center col-12">{{this.tableData.title}}</h1>
        </div>

        <div class="row my-3">
                <input v-model="searchKey" @change="updateData" class="form-control ml-auto col-3" type="search" placeholder="Search"
                       aria-label="Search">
        </div>

        <div class="row">
            <table class="table col-12">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th v-for="row in tableData.rows">{{row}}</th>
                    <th scope="col" colspan="3" class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(item, index) in data">
                    <th scope="row">{{index + 1}}</th>
                    <td v-for="prop in tableData.names">{{ item[prop] }}</td>
                    <td class="text-center"><a :href=" actionUrl + '/edit/' + item.id"  target="_blank">Edit</a></td>
                    <td class="text-center"><a :href=" actionUrl + '/delete/' + item.id" target="_blank">Delete</a></td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="row justify-content-center mt-3">
            <pagination :source="pagination" @navigate="navigate"></pagination>
        </div>
    </div>
</template>

<script>
    import Pagination from "./pagination";


    export default {
        components: {Pagination},

        props: {
            prop_table_title: String,
            prop_table_rows: Array,
            prop_url: String,
            prop_table_names: Array,
            prop_action_url: String
        },

        data() {
            return {
                tableData: {},
                url: '',
                data: [],
                pagination: [],
                searchKey: '',
                actionUrl: ''
            }
        },
        mounted() {
            this.tableData = {
                title: this.prop_table_title,
                rows: this.prop_table_rows,
                names: this.prop_table_names
            };
            this.url = this.prop_url;
            this.actionUrl = this.prop_action_url;

            this.get(this.url);
        },

        watch: {
            prop_url: function(e){
                this.searchKey = '';
                this.url = e
            },

            url: function () {
                this.get(this.url);
            }
        },

        computed: {
            filteredData() {
                const search = this.searchKey.toLowerCase().trim();

                if (!search) {
                    return this.data
                }

                this.pagination = {last_page: 1};

                return this.data.filter(c => {
                    const items = [];
                    this.tableData.names.forEach(function (e) {
                        items.push(c[e].toString().toLowerCase());
                    });

                    return items.toString().indexOf(search) > -1;
                });
            },
        },

        methods: {
            navigate(page) {
                this.get(this.pagination.path + '?page=' + page);
            },
            get(url, callback = null) {
                this.$http.get(url).then((req) => {
                    if (callback) {
                        callback(req);
                        return;
                    }
                    this.data = req.data.data;
                    this.pagination = req.data;
                })
            },
            updateData(){
                if (this.searchKey){
                    if (this.url.indexOf('weekday') > 0) {
                        this.get(this.url + '/' + this.searchKey);
                        return
                    }
                    this.get(this.url + '/search/' + this.searchKey)
                } else {
                    this.get(this.url)
                }

            }
        },

        name: "vc_table"
    }
</script>

<style scoped>

</style>
