<template>
  <div class="slider-item" ref="item" @mouseover="onEnter()" @mouseleave="onLeave()">
    <div class="slider-item-inner">
      <img :src="tv.images" class="cover">

      <div class="zoom" ref="zoom">
        <div class="fake" ref="fake">
          <img :src="tv.images" class="cover">
        </div>

        <div class="video-info" ref="info">
<!--          <span class="title">{{ tv.name }}</span>-->
<!--          <span class="plot">{{ prettyString(tv.plot, 130) }}</span>-->
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import $ from "jquery"

  export default {
    name: "slider-item",

    props: ['tv'],

    data () {
      return {
        timer: null,
        playerOptions: {
          controls: false,
          muted: false,
          fluid: true,
          preload: 'none',
          autoplay: false,
          sources: [{
            type: "video/mp4",
            src: 'videos/landscape.mp4'
          }]
        }
      }
    },

    computed: {
      player () {
        return this.$refs.videoPlayer.player
      }
    },

    methods: {
      onEnter () {
        // this.$emit('mouseover')
        let item = this.$refs.item
        let zoom = this.$refs.zoom
        let fake = this.$refs.fake
        let info = this.$refs.info
        // let player = this.$refs.player
        // let videoPlayer = this.player

        let xright = $(window).width() - ($(item).offset().left + $(item).outerWidth()) < 70
        let xleft = $(item).offset().left < 70

        let dir
        // if (xright) {
        //   dir = "-25%"
        // } else if (xleft) {
        //   dir = "25%"
        // } else {
        //   dir = "0"
        // }

        this.timer = setTimeout(function () {
          // videoPlayer.play()
          //
          // $(player).css({
          //   'opacity': '1'
          // })

          $(info).css({
            'opacity': '1'
          })

          $(zoom).css({
            'transform': 'translate3d('+dir+', 0, 0) scale(.5)',
            'z-index': '10',
            'transition': 'all .2s ease'
          })
        }, 400)

        setTimeout(function () {
          $(info).css({
            'opacity': '0'
          })
        }, 2000)
      },

      onLeave () {
        clearTimeout(this.timer)
        // this.$emit('mouseleave');

        // let videoPlayer = this.player
        // videoPlayer.pause()

        let fake = this.$refs.fake
        let info = this.$refs.info
        // let player = this.$refs.player

        // $(player).css({
        //   'opacity': '0'
        // })

        $(info).css({
          'opacity': '0'
        })

        $(fake).css({
          'opacity': '1'
        })

        this.$refs.zoom.style.transform = 'translate3d(0, 0, 0) scale(.5)'
        this.$refs.zoom.style.zIndex = '0'
      }
    }
  }
</script>
