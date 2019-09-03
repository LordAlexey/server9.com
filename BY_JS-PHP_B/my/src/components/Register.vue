<template>
    <div>
        <h1>Create profile at Kazan Expo</h1>

        <div v-show="errors.length||message" class="errors">
            <b>{{message}}</b>
            <ul v-show="errors">
                <li v-for="error in errors">{{error}}</li>
            </ul>
        </div>

        <div class="profile labels">
            <h3>Profile</h3>
            <label for="">
                Firstname*
                <input type="text" v-model="form.firstname">
            </label>
            <label for="">
                Lastname*
                <input type="text" v-model="form.lastname">
            </label>
            <label for="">
                Email*
                <input type="text" v-model="form.email">
            </label>
            <label for="">
                Linkedin-URL
                <input type="text" v-model="form.linkedin_url">
            </label>
            <label for="">
                Age
                <input type="number" v-model="form.age">
            </label>

            <label for="">
                Gender
                <select name="" id="" v-model="form.gender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="">Secret</option>
                </select>
            </label>
            <label for="">
                Photo
                <input type="file" v-on:change="file">
                <img :src="src" width="100" alt="">
            </label>
        </div>
        <div class="login labels">
            <h3>Login</h3>
            <label for="">Username*
                <input type="text" v-model="form.username">
            </label>
            <label for="">Password*
                <input type="password" v-model="form.password">
            </label>
        </div>
        <button v-on:click="register">Create profile</button>
    </div>
</template>

<script type="text/ecmascript-6">
    export default {
        name: "register",
        data() {
            return {
                form:{},
                src:'',
                errors:[],
                message:''
            }
        },
        methods:{
            file(ev) {
                var file = ev.target.files[0];
                var reader = new FileReader();
                var self = this;
                reader.readAsDataURL(file);
                reader.onload = function (ev2) {
                    self.form.photo = ev2.target.result;
                    self.src=ev2.target.result;
                }
            },

            register() {

                var self = this;

                fetch('http://server9.com/BY_JS-PHP_A/api/v1/profile',{
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
                            // console.log(data);

                            this.errors = [];
                            self.message='';
                            self.message = data.message;
                                for(var errAtt in data.errors) {
                                    data.errors[errAtt].forEach(err=> {
                                        self.errors.push(err);
                                    })
                                }
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
        max-width: 100%;
    }

    .profile,.login {
        padding: 15px;
        border: 1px solid black;
        margin-bottom: 10px;
    }
    .errors {
        background: #ffc8c1;
        border: 1px solid #ff9185;
        color: #e13138;
        margin-bottom: 15px;
        padding: 5px 10px;
    }
</style>