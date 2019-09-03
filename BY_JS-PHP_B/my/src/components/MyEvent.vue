<template>
    <div>
        <h1>My events</h1>
        <table>
            <tr>
                <td>Event</td>
                <td>Date</td>
                <td>Price</td>
                <td>Action</td>
            </tr>
            <tr v-for="event in myevents">
                <td>{{event.title}}</td>
                <td>{{event.date}}</td>
                <td>{{event.standard_price}}</td>
                <td class="action-row">
                    <a class="button" v-on:click.prevent="download(event)" href="">Ical</a>
                    <myselect :token="token" :id="event.id"></myselect>
                </td>
            </tr>
        </table>
    </div>
</template>

<script type="text/ecmascript-6">
    import myselect from'./myselect.vue'

    export default {
        name: "my-event",
        components:{myselect},
        props:['token','events'],
        data () {
            return {
                myevents:[]
            }
        },
        mounted() {
            fetch('http://server9.com/BY_JS-PHP_A/api/v1/registrations?token='+this.token,{
                method:'get',
                headers : new Headers({'content-type': 'application/json'}),
            }).then(res=> {
                res.json().then(data=> {
                    // console.log(data);
                    if(res.ok){
                        data.forEach(my=>{
                            this.events.forEach(event=>{
                                if(my.event_id==event.id) {
                                    this.myevents.push(event);
                                }
                            })
                        })
                    }
                })
            });
        },
        methods: {
            download(event) {

                var dateStart = new Date(event.date);

                var sY = dateStart.getFullYear();
                var sM = dateStart.getMonth()+1;
                var sD = dateStart.getDate();

                var dateEnd = new Date(dateStart.setDate(dateStart.getDate()+event.duration_days));



                var eY = dateEnd.getFullYear();
                var eM = dateEnd.getMonth()+1;
                var eD = dateEnd.getDate();

                if(sM<10) sM= '0'+sM;
                if(sD<10) sD= '0'+sD;

                if(eM<10) eM= '0'+eM;
                if(eD<10) eD= '0'+eD;


                var ical = 'BEGIN:VCALENDAR\n' +
                    'VERSION:2.0\n' +
                    'PRODID:-//ical.marudot.com//iCal Event Maker\n' +
                    'X-WR-CALNAME:'+event.title+'\n' +
                    'CALSCALE:GREGORIAN\n' +
                    'BEGIN:VTIMEZONE\n' +
                    'TZID:Europe/Moscow\n' +
                    'TZURL:http://tzurl.org/zoneinfo-outlook/Europe/Moscow\n' +
                    'X-LIC-LOCATION:Europe/Moscow\n' +
                    'BEGIN:STANDARD\n' +
                    'TZOFFSETFROM:+0300\n' +
                    'TZOFFSETTO:+0300\n' +
                    'TZNAME:MSK\n' +
                    'DTSTART:19700101T000000\n' +
                    'END:STANDARD\n' +
                    'END:VTIMEZONE\n' +
                    'BEGIN:VEVENT\n' +
                    'DTSTAMP:20190628T131353Z\n' +
                    'UID:20190628T131353Z-669183810@marudot.com\n' +
                    'DTSTART;VALUE=DATE:'+sY+sM+sD+'\n' +
                    'DTEND;VALUE=DATE:'+eY+eM+eD+'\n' +
                    'SUMMARY:'+event.title+'\n' +
                    'URL:https%3A%2F%2Fcstclub.ru\n' +
                    'DESCRIPTION:'+event.description+'\n' +
                    'LOCATION:'+event.location+'\n' +
                    'END:VEVENT\n' +
                    'END:VCALENDAR';

                var file = new Blob([ical]);
                var url = window.URL.createObjectURL(file);
                var link = document.createElement('a');
                link.setAttribute('href',url);
                link.setAttribute('download',event.title+'.ics');
                link.click();
                link.remove();
            }
        }
    }
</script>

<style scoped>
    table,td {
        border: 1px solid black;
        border-collapse: collapse;
    }
    td {
        padding: 7px;
    }

    .action-row {
        display: flex;
        flex-direction: row;
        align-items: center;
    }

</style>