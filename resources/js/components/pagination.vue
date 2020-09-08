<template>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item" :class="{disabled: source.current_page === 1}">
                <a class="page-link" @click="navigate($event, source.current_page - 1)" href="#">Previous</a>
            </li>
            <li v-for="page in pages" class="page-item" :class="{active: source.current_page === page}">
                <a @click="navigate($event, page)" class="page-link" href="#">{{page}}</a>
            </li>
            <li class="page-item" :class="{disabled: source.current_page === source.last_page}">
                <a class="page-link" @click="navigate($event, source.current_page + 1)" href="#">Next</a>
            </li>
        </ul>
    </nav>
</template>

<script>
    export default {
        props: ['source'],

        data() {
            return {
                pages: []
            }
        },

        methods: {
            navigate(ev, page) {
                ev.preventDefault();
                this.$emit('navigate', page)
            }
        },

        watch: {
            source() {
                this.pages = [];
                for (let i = 1; i <= this.source.last_page; i++) {
                    this.pages.push(i)
                }
            }
        },

        name: "pagination"
    }
</script>

<style scoped>

</style>
