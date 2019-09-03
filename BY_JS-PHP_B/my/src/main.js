import Vue from 'vue'
import App from './App.vue'
import VueRouter from './../node_modules/vue-router'
import Events from './components/Events.vue'
import Login from './components/Login.vue'
import Logout from './components/Logout.vue'
import Register from './components/Register.vue'
import Event from './components/Event.vue'
import MyEvent from './components/MyEvent.vue'
import Test from './components/Test.vue'


Vue.use(VueRouter);

var router = new VueRouter({
    routes:[
        {path:'/',component:Events},
        {path:'/login',component:Login},
        {path:'/logout',component:Logout},
        {path:'/register',component:Register},
        {path:'/event/:id',component:Event},
        {path:'/my-events',component:MyEvent},
        {path:'/test',component:Test},
    ]
});
Vue.config.productionTip = false;

new Vue({
  render: h => h(App),
    router:router
}).$mount('#app')
