<template>
    <div>
        <select name="" id="" v-model="selected" v-on:change="rate">
            <option value=""> - rate overall experience - </option>
            <option :value="option.value" v-for="option in options">{{option.text}}</option>
        </select>
        <b>{{message}}</b>
    </div>
</template>

<script type="text/ecmascript-6">
    export default {
        name: "myselect",
        props:['token','id'],
        data() {
            return {
                selected:'',
                options:[
                    {text:'Bad',value:0},
                    {text:'Good',value:1},
                    {text:'Excellence',value:2},
                ],
                message:''
            }
        },
        methods: {
            rate() {
                fetch('http://server9.com/BY_JS-PHP_A/api/v1/registrations/'+this.id+'?token='+this.token,{
                    method:'put',
                    headers : new Headers({'content-type': 'application/json'}),
                    body:JSON.stringify({
                        event_rating:this.selected+''
                    })
                }).then(res=> {
                    res.json().then(data=> {
                        // console.log(data);
                        if(res.ok){
                            // console.log(data.token)
                            console.log(data);
                            this.message = 'Rating success'
                            // localStorage.setItem('token',data.token);
                            // localStorage.setItem('username',self.form.username);
                            // self.$emit('login');
                            // self.$router.push('/');
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
    select {
        margin-left: 10px;
    }
</style>