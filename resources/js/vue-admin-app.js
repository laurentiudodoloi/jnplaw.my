/**
 * Vue app
 */

import Vue from 'vue'
import VueRouter from 'vue-router'
import AdminDashboard from './admin/components/AdminDashboard'

Vue.component('admin-dashboard', AdminDashboard);

Vue.use(VueRouter)

require('./admin-components');

import { routes } from './admin-routes'

let router = new VueRouter({
    routes
})

new Vue({
    el: '#vue-app',
    router
});
