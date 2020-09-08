<template>
    <div>
        <div class="container">
            <div class="text-center pt-5 pb-5">
                <h1>Schedule</h1>
            </div>

            <div class="pt-2 pb-2">
                <a class="btn btn-outline-primary" href="schedules/new" target="_blank">+ Add New Schedule</a>
            </div>

            <div class="row">
                <ul class="nav nav-pills nav-fill col-12">
                    <li class="nav-item">
                        <a class="nav-link" :class="{active: tab === 'all'}" @click="setTab('all')" href="#">All</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" :class="{active: tab === 'monday'}" @click="setTab('monday')" href="#">Monday</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" :class="{active: tab === 'tuesday'}" @click="setTab('tuesday')" href="#">Tuesday</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" :class="{active: tab === 'wednesday'}" @click="setTab('wednesday')"
                           href="#">Wednesday</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" :class="{active: tab === 'thursday'}" @click="setTab('thursday')" href="#">Thursday</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" :class="{active: tab === 'friday'}" @click="setTab('friday')" href="#">Friday</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" :class="{active: tab === 'saturday'}" @click="setTab('saturday')" href="#">Saturday</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" :class="{active: tab === 'sunday'}" @click="setTab('sunday')" href="#">Sunday</a>
                    </li>
                </ul>
            </div>
        </div>
        <div>
            <vc_table
                :prop_table_title.sync="title"
                v-bind:prop_table_rows="['teacher', 'student', 'day', 'hour']"
                :prop_url="url"
                v-bind:prop_table_names="['teacherName', 'studentName', 'weekday', 'hour']"
                prop_action_url="schedule"
            ></vc_table>
        </div>
    </div>
</template>

<script>

    import vc_table from "./vc_table";

    export default {
        data() {
            return {
                title: '',
                url: 'api/schedule/weekday/monday',
                tab: 'monday',
            }
        },

        mounted() {

        },

        methods: {
            setTab(tab) {
                this.tab = tab;
                if (tab === 'all') {
                    this.url = 'api/schedule'
                } else {
                    this.url = 'api/schedule/weekday/' + this.tab
                }
            }
        },

        components: {vc_table},

        name: "vc-schedule"
    }
</script>

<style scoped>

</style>
