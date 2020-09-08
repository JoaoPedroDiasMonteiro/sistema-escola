<template>
    <div class="container">

        <div class="row">
            <h1 class="text-center col-12">Schedule</h1>
        </div>

        <div class="row">
            <form class="form-inline my-2 ml-auto">
                <input v-model="searchKey" class="form-control mr-sm-2" type="search" placeholder="Search"
                       aria-label="Search">
            </form>
        </div>

        <div class="row">
            <table class="table col-12">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Teacher</th>
                    <th scope="col">Student</th>
                    <th scope="col">Day</th>
                    <th scope="col">Hour</th>
                    <th scope="col" colspan="3" class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(item, index) in filteredData">
                    <th scope="row">{{index + 1}}</th>
                    <td>{{item.teacher.name}}</td>
                    <td>{{item.student.name}}</td>
                    <td>{{item.weekday}}</td>
                    <td>{{item.hour}}</td>
                    <td class="text-center"><a href="">Edit</a></td>
                    <td class="text-center"><a href="">Delete</a></td>
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

        props: ['list'],

        data() {
            return {
                data: [],
                fullData: [],
                pagination: [],
                searchKey: '',
            }
        },
        methods: {
            navigate(page) {
                this.get('api/schedule?page=' + page);
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
        },

        computed: {
            filteredData() {
                const search = this.searchKey.toLowerCase().trim();

                if (!search) {
                    return this.data
                }

                this.pagination = {last_page: 0};

                return this.fullData.filter(c => {
                    const items = [
                        c.teacher.name.toLowerCase(),
                        c.student.name.toLowerCase(),
                        c.weekday.toLowerCase(),
                        c.hour.toLowerCase()
                    ];

                    return items[0].indexOf(search) > -1 || items[1].indexOf(search) > -1 || items[2].indexOf(search) > -1
                        || items[3].indexOf(search) > -1;
                });
            },
        },

        mounted() {
            const t = this;
            //this.data = JSON.parse(this.list);
            this.get('api/schedule');
            this.get('api/schedule/all', function (req) {
                t.fullData = req.data;
            });
        },

        name: "schedule"
    }
</script>

<style scoped>

</style>
