<template>
    <div>
        <h1>Login</h1>
        <form action="" v-on:submit.prevent="login" class="labels">
            <label for="">
                Username*<input type="text" v-model="form.username">
            </label>
            <label for="">
                Password*<input type="password" v-model="form.password">
            </label>

            <label for="">
                <button>Login</button>
                <router-link to="/register">Register</router-link>
            </label>
            <b v-show="message">{{message}}</b>
        </form>
    </div>
</template>

<script type="text/ecmascript-6">

    export default {
        name: "login",
        data() {
            return {
                form:{},
                message:''
            }
        },
        methods: {
            login() {
                var self = this;
                this.message = '';
                fetch('http://server9.com/BY_JS-PHP_A/api/v1/login',{
                    method:'post',
                    headers : new Headers({'content-type': 'application/json'}),
                    body:JSON.stringify(this.form)
                }).then(res=> {
                    res.json().then(data=> {
                        // console.log(data);
                        if(res.ok){
                            // console.log(data.token)
                            localStorage.setItem('token',data.token);
                            localStorage.setItem('username',self.form.username);
                            self.$emit('login');
                            self.$router.push('/');
                        }
                        else {
                            // console.log(data.message);
                            self.message = 'User or password not correct';
                        }
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