/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;




Vue.component('add-category', require('../js/admin/Category/category.vue').default);
Vue.component('add-post', require('../js/admin/Post/addpost.vue').default);
Vue.component('edit-post', require('../js/admin/Post/editpost.vue').default);
Vue.component('list-category', require('../js/admin/Category/category.vue').default);
Vue.component('edit-category', require('../js/admin/Category/editcategory.vue').default);
Vue.component('account', require('../js/admin/Account/account.vue').default);
Vue.component('content-blog', require('../js/components/ContentBlog.vue').default);
Vue.component('about-me', require('../js/components/AboutMe.vue').default);
Vue.component('pagination', require('laravel-vue-pagination'));



import Vuelidate from 'vuelidate';
import VueRouter from 'vue-router';
import routes from './routes';


Vue.use(Vuelidate)

import Swal from 'sweetalert2';
import Vue from 'vue';
window.Swal = Swal;
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
  });

window.Toast = Toast;

// use router
Vue.use(VueRouter);

// khai báo dùng router này
const router = new VueRouter({
    routes,
    mode: 'history'
});


const app = new Vue({
    el: '#app',
    router
});
