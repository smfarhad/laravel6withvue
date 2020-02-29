/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('admin-lte');



import VueRouter from 'vue-router';

import { Form, HasError, AlertError } from 'vform';

import moment from 'moment';

import VueProgressBar from 'vue-progressbar';

import Swal from 'sweetalert2';

import Gate from './Gate.js';


window.Vue = require('vue');

window.Form = Form;

window.moment = require('moment');

 

Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);

Vue.use(VueProgressBar, {
  color: 'rgb(0,100,0)',
  failedColor: 'red',
  height: '3px'
});


Vue.prototype.$gate = new Gate(window.user);


Vue.use(VueRouter);
const routes = [
    { path: '/admin/dashboard', component: require('./components/Dashboard.vue').default },
    { path: '/admin/developer', component: require('./components/Developer.vue').default },
    { path: '/admin/users', component: require('./components/Users.vue').default },
    { path: '/admin/profile', component: require('./components/Profile.vue').default },
  ];



  
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

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

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
const router = new VueRouter({
  mode: 'history',
  routes // short for `routes: routes`
});

// Filters

Vue.filter('momentDate', function(created){
  return moment(created).format('LL'); 
});
const userTypes = [
  {id:1, name:'Admin'},
  {id:2, name:'Standered User'},
  {id:3, name:'Author'}
];
window.userTypes = userTypes;
// sweet alert 2 init 
window.Swal = Swal;

const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  onOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
});

window.Toast = Toast;

// let fire 
window.Fire =  new Vue();


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router
  
});