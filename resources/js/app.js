
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
// import Vue from "vue"
import Vue from 'vue';
require('./bootstrap');
require('admin-lte');
import LoadScript from 'vue-plugin-load-script';

Vue.use(LoadScript);
window.Vue = require('vue');
import moment from 'moment';
import {Form, HasError, AlertError} from 'vform';
import Gate from "./Gate.js";
Vue.prototype.$gate =new Gate(window.user);
window.Form=Form;
import Swal from 'sweetalert2';
window.Swal= Swal;
// Vue.component(HasError.name, HasError);
// Vue.component(AlertError.name, AlertError);
import VueProgressBar from  'vue-progressbar';
import VueRouter from 'vue-router';
Vue.use(VueProgressBar,{
color: 'rgb(143,255,199)',
failedColor: 'red',
height: '3px'

});
Vue.loadScript("./1.js")
    .then(() => {
      // Script is loaded, do something
    })
    .catch(() => {
      // Failed to fetch script
    });
    Vue.loadScript("./2.js")
    .then(() => {
      // Script is loaded, do something
    })
    .catch(() => {
      // Failed to fetch script
    });
    Vue.loadScript("./3.js")    .then(() => {    })   .catch(() => {  // Failed to fetch script
        });
        Vue.loadScript("./4.js")    .then(() => {    })   .catch(() => {  // Failed to fetch script
        });
        Vue.loadScript("./5.js")    .then(() => {    })   .catch(() => {  // Failed to fetch script
        });
        Vue.loadScript("./6.js")    .then(() => {    })   .catch(() => {  // Failed to fetch script
        });
        Vue.loadScript("./7.js")    .then(() => {    })   .catch(() => {  // Failed to fetch script
        });
        Vue.loadScript("./8.js")    .then(() => {    })   .catch(() => {  // Failed to fetch script
        });
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })
  window.Toast=Toast;

Vue.use(VueRouter)
let routes=[
    { path: '/dashboard',component:  require('./components/Dashboard.vue').default},
    { path: '/developer',component:  require('./components/Developer.vue').default},
    { path: '/profile',component:  require('./components/Profile.vue').default},
    { path: '/users',component:  require('./components/Users.vue').default},
    { path: '/shopify',component:  require('./components/Shopify.vue').default},
    { path: '*',component:  require('./components/NotFound.vue').default}

]
const router = new VueRouter({
    mode: 'history',
routes,

});
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
Vue.filter('uptext', function(text)
{
    // return text.toUpperCase();
    return text.charAt(0).toUpperCase() + text.slice(1);
}
);
Vue.filter('myDate', function(created)
{
    // return text.toUpperCase();
    return moment().format('MMMM Do YYYY');
}
);
// let Fire =new Vue();
// window.Fire =Fire;
Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue').default
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue').default
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue').default
);
window.Fire = new Vue ();
Vue.component('example-component', require('./components/ExampleComponent.vue').default);

Vue.component('not-found', require('./components/NotFound.vue').default);
Vue.component('category-component', require('./components/CategoryComponent.vue').default);
Vue.component('pagination', require('laravel-vue-pagination'));
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router,
    data: {
        search: ''
    },
    methods: {
        searchit:_.debounce(()=>
        {
            console.log(" searching ...");
            Fire.$emit('searching');
        },2000),
        printme() {
            window.print();
        }

    }
});
