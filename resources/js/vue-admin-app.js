/**
 * Vue app
 */

import Vue from 'vue'
import VueRouter from 'vue-router'
import AdminDashboard from './admin/components/AdminDashboard'

Vue.component('admin-dashboard', AdminDashboard);

Vue.use(VueRouter)

import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';
import Notifications from 'vue-notification'

Vue.use(Loading);
Vue.use(Notifications);

require('./admin-components');

import { routes } from './admin-routes'

let router = new VueRouter({
    routes
})

new Vue({
    el: '#vue-app',
    router
});
