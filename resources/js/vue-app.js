/**
 * Vue app
 */

import Vue from 'vue'

require('./components');

import VueVideoPlayer from 'vue-video-player'

Vue.use(VueVideoPlayer);

new Vue({
    el: '#vue-app'
});
