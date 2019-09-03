<template>
    <div>
        <h1>Events at Kazan Expo</h1>

        <div class="filter">
            <label for="">
                Filter by date <input type="date" v-model="date">
            </label>
            <button v-on:click="filter" class="button">Filter</button>
        </div>

        <div class="events">
            <div class="event" v-for="event in filtered">
                <h2>{{event.title}}</h2>
                <p>{{event.description}}</p>
                <p>Sessions</p>
                <ul>
                    <li v-for="session in event.sessions">
                        {{session.title}} in {{session.room}} by {{session.speaker}}
                    </li>
                </ul>
                <p>On {{new Date(event.date).toLocaleDateString()}} from {{event.time}} for {{event.duration_days}} day(s)</p>
                <p>Meet at {{event.location}}</p>
                <p>Pay {{event.standard_price}}.-</p>
                <router-link class="button" :to="'/event/'+event.id">Go to registration</router-link>
            </div>
        </div>
    </div>
</template>

<script type="text/ecmascript-6">
    export default {
        name: "events",
        props:['events'],
        data() {
            return {
                filtered:this.events,
                date:''
            }
        },
        mounted() {

            // this.filtered = this.events;
        },
        methods: {
            filter() {
                this.filtered = [];
                this.events.forEach(event => {

                    var now = new Date();

                   if(event.date>=this.date && (new Date(event.date)) >= now) {
                       this.filtered.push(event);
                   }
                });
            }
        }
    }
</script>

<style scoped>
    .events {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
    }
    .event {
        width: 400px;
        border:1px solid black;
        padding: 15px;
        margin-right: 10px;
        margin-bottom: 10px;
    }

    .filter {
        margin-bottom: 10px;
    }

</style>