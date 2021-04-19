require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)

import {routes} from './routes';

const router = new VueRouter({
    routes // short for `routes: routes`
  })


const app = new Vue({
    el: '#app',
});
