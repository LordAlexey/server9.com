<template>
    <div>
        <h1>Register for "{{event.title}}"</h1>
        <div class="labels">
            <label>
                Registration type <select name="" id="" v-on:change="calc_price" v-model="selected">
                <option value=""> - select type of ticket -</option>
                <option :value="option.value" v-for="option in options">{{option.text}}</option>
            </select>
            </label>
            <label for="">You pay <input type="text" disabled v-model="c_price"></label>
        </div>
        <button :disabled="disable" v-on:click="register">Register for event</button>
    </div>
</template>

<script type="text/ecmascript-6">
    export default {
        name: "event",
        props:['events','token'],
        data() {
            return {
                event:[],
                selected:'',
                c_price:'',
                disable:true,
                options:[
                    {text:'Early Bird (15% off of regular price)',value:'early_bird'},
                    {text:'Standard',value:'general'},
                    {text:'VIP (pay and get 20% more)',value:'vip'}
                ],
                message:''
            }
        },
        mounted() {
            this.events.forEach(event => {
                if(event.id == this.$route.params.id) this.event = event;
            });
        },
        methods:{
            calc_price() {
                // console.log(this.event.standard_price);
                this.disable = false;
                this.c_price = this.event.standard_price;
                if(this.selected=='early_bird')  this.c_price*=0.85;
                if(this.selected=='vip')  this.c_price*=1.2;
            },
            register() {
                this.message = '';
                fetch('http://server9.com/BY_JS-PHP_A/api/v1/registrations?token='+this.token,{
                    method:'post',
                    headers : new Headers({'content-type': 'application/json'}),
                    body:JSON.stringify({
                        'registration_type':this.selected+'',
                        'event_id':this.$route.params.id
                    })
                }).then(res=> {
                    res.json().then(data=> {
                        // console.log(data);
                        if(res.ok){
                            console.log(data);
                            this.message = 'Registration success';
                        }
                        // else {
                        //     // console.log(data.message);
                        //     self.message = 'User or password not correct';
                        // }
                    })
                });
            }
        }
    }
</script>

<style scoped>

    label {
        display: flex;
        justify-content: space-between;
    }
</style>