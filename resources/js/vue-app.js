/**
 * Vue app
 */

import Vue from 'vue'

require('./components');

import VueVideoPlayer from 'vue-video-player'

Vue.use(Loading);

new Vue({
    el: '#vue-app'
});
