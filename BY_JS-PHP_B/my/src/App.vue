<template>
  <div id="app">

    <nav>
      <div class="wrapper">
        <span v-show="token">{{username}}</span>
        <router-link v-show="!token" to="/login">Login</router-link>
        <router-link v-show="token" to="/">Events</router-link>
        <router-link v-show="token" to="/my-events">My events</router-link>
        <router-link v-show="token" to="/logout">Logout</router-link>
      </div>
    </nav>
    <router-view id="content" :token="token" :events="events" :key="key" v-on:login="login"></router-view>
    <!--<img alt="Vue logo" src="./assets/logo.png">-->
    <!--<HelloWorld msg="Welcome to Your Vue.js App"/>-->
  </div>
</template>

<script type="text/ecmascript-6">
import HelloWorld from './components/HelloWorld.vue'

export default {
  name: 'app',
  components: {
    HelloWorld
  },
    data() {
      return {
        token:'',
        username:'',
          events:[],
          key:1
      }
    },
    mounted() {

      if(localStorage.getItem('token')) {
          this.token = localStorage.getItem('token');
          // console.log(localStorage.getItem('token'));
          this.username = localStorage.getItem('username');
          this.loadEvents();
      }

    },


    methods: {

      loadEvents() {
          // console.log(this.token);
          // console.log(localStorage.getItem('token'));

          fetch('http://server9.com/BY_JS-PHP_A/api/v1/events?token='+this.token,{
              method:'get',
              headers : new Headers({'content-type': 'application/json'}),
          }).then(res=> {
              res.json().then(data=> {
                  // console.log(data);
                  if(res.ok){
                      this.events = data;
                      // console.log(data);
                      // localStorage.setItem('token',data.token);
                      // localStorage.setItem('username',self.form.username);
                      // self.$emit('login');
                      // self.$router.push('/');
                      this.key++;
                  }
                  else {
                      // console.log(data.message);
                      self.message = 'User or password not correct';
                  }
              })
          });
      },

      login() {

          if(localStorage.getItem('token')) {
              this.token = localStorage.getItem('token');
              this.username = localStorage.getItem('username');
              this.loadEvents();
          }
          else {
              this.token = '';
              this.username = '';
          }
      }
    }
}
</script>

<style>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  color: #2c3e50;
  margin-top: 60px;
}

  nav {
  border-bottom: 3px solid #0c5460;
    padding: 10px 10px;
  }
  nav span {
    font-weight: bolder;
    text-decoration: underline black;
  }
  nav a {
    margin-left: 15px;
    text-decoration: none;
    color: #0c5460;
    font-weight: bolder;
  }

  .button {
    background: white;
    padding: 5px 10px;
    border: 2px solid #0c5460;
    color: #0c5460;
    font-weight: bolder;
    text-decoration: none;
    cursor: pointer;
    /*margin: 10px;*/
  }

  label {
    display: flex;
    flex-direction: row;
    width: 100%;
    /*margin: 5px;*/
    margin-bottom: 5px;
    align-items: center;
  }
label input {
  margin-left: 15px;
}

.labels {
  width: 400px;
}

  #app {
    margin: 0;
    padding: 0;
  }

  #content {
    max-width: 1280px;
    margin: 0 auto;
    padding: 0 10px;
  }

  body {
    margin: 0;
  }

  .wrapper {
    max-width: 1280px;
    margin: 0 auto;
    width: 100%;
    display: flex;
    flex-direction: row;
    justify-content: flex-end;
  }
</style>
