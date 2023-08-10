require('./bootstrap');

window.Vue = require('vue').default;

import VueRouter from 'vue-router'
Vue.use(VueRouter)

import {routes} from './routes';

import User from './helpers/User'

window.User = User;

import Notification from './helpers/Notification'

window.Notification = Notification;

window.Reload = new Vue();


const router = new VueRouter({
    mode: 'history',
    base: '/',
    routes
  })

const app = new Vue({
    el: '#app',
    router 
});
