<template>
  <div class="wrapper">
    <h2 v-if="head" class="slider-header">
      <a class="slider-header-title" href="#">
        {{ head }}
      </a>
    </h2>

    <div class="slider">
      <div :class="[{'moving': moving}, 'slider-mask']" ref="slider">
        <slider-item
          v-for="(slide, key) in sliderItems"
          :class="sizeClasses()"
          :key="key"
          :slide="slide"
          :ref="'item_'+key"
          @mouseover="onEnter(key)"
          @mouseleave="onLeave(key)"
        >
        </slider-item>
      </div>

      <div v-if="currentSet > 0" class="slider-arrow-block left-arrow" @click.prevent="leftArrowClicked()">
        <img
          class="slider-arrow slider-arrow-left"
          src="https://daks2k3a4ib2z.cloudfront.net/555f2ea71b40d3860bbb96ad/55761fe3c9f4c6a85c890ca5_arrow.svg"
        >
      </div>

      <div v-if="currentSet <= noOfSets" class="slider-arrow-block right-arrow" @click.prevent="rightArrowClicked">
        <img
          class="slider-arrow slider-arrow-right"
          src="https://daks2k3a4ib2z.cloudfront.net/555f2ea71b40d3860bbb96ad/55761fe3c9f4c6a85c890ca5_arrow.svg"
        >
      </div>
    </div>

    <div class="slider-controls" hidden>
      <div v-for="i in (1, showItems)" :class="{ active: i === activeIndex }" class="slider-dot"></div>
    </div>
  </div>
</template>

<script>
  import _ from 'lodash';
  import SliderItem from './SliderItem'
  import $ from "jquery"
  import 'lodash'

  export default {
    components: {
      SliderItem
    },

    name: 'Slider',

    props: {
      slides: {
        type: Array,
        default: () => []
      },

      noOfSlides: {
        type: Number,
        defalut: 3
      },

      head: {
        type: String | Boolean,
        default: false
      }
    },

    data () {
      return {
        slideItemsClasses: '',
        moving: false,
        click: false,
        mv: 0,
        startId: 0,
        showItems: 1,
        totalItems: 0,
        activeIndex: 0,
        sliderItems: [],
        leftItem: [],
        centerItem: [],
        rightItem: [],
        currentSet: 0,
        noOfSets: 0,
        timer: null
      }
    },

    mounted() {
      this.updateSliderState()

      window.addEventListener('resize', this.updateSliderState)

      window.addEventListener('resize', this)
    },

    created () {
      this.sliderItems = this.slides
      this.totalItems = this.slides.length
    },

    beforeDestroy () {
      window.removeEventListener('resize', this.updateSliderState)
    },

    methods: {
      leftArrowClicked () {
        this.currentSet--

        console.log('left arrow clicked')
        this.startId = this.leftItem[1]

        this.moving = true

        $(this.$refs.slider).css({
          'transform': 'translate3d(-' + this.mv + '%, 0, 0)'
        })

        setTimeout(() => {
          $(this.$refs.slider).css({
            'transform': 'translate3d(-1' + this.mv + '%, 0, 0)'
          })
        }, 750)

        setTimeout(() => {
          this.moving = false;
          this.updateSliderItems()
        }, 750)
      },

      rightArrowClicked () {
        this.currentSet++

        console.log('right arrow clicked')
        this.startId = this.rightItem[0] ? this.rightItem[0] : this.startId + this.showItems
        this.moving = true
        let click = this.click
        this.click = true

        if (!click) {
          $(this.$refs.slider).css({
            'transform': 'translate3d(-100%, 0, 0)'
          })

          setTimeout(() => {
            $(this.$refs.slider).css({
              'transform': 'translate3d(-1' + this.mv + '%, 0, 0)'
            })

            this.click = true
          }, 750)
        } else {
          $(this.$refs.slider).css({
            'transform': 'translate3d(-2' + this.mv + '%, 0, 0)'
          })

          setTimeout(() => {
            $(this.$refs.slider).css({
              'transform': 'translate3d(-1' + this.mv + '%, 0, 0)'
            })
          }, 750)
        }

        setTimeout(() => {
          this.moving = false
          $(this.$refs.slider).css({
            'transform': 'translate3d(-1' + this.mv + '%, 0, 0)'
          })

          this.updateSliderItems()
        }, 750)
      },

      onEnter (i) {
        const {showItems} = this.showItems
        let selectedItem = this.$refs['item_' + i][0].$el
        let rightItems = $(selectedItem).nextAll(':lt(' + this.showItems + ')')
        let leftItems = $(selectedItem).prevAll(':lt(' + this.showItems + ')')

        let xright = $(window).width() - ($(selectedItem).offset().left + $(selectedItem).outerWidth()) < 70
        let xleft = $(selectedItem).offset().left < 70

        this.timer = setTimeout(() => {
          $(selectedItem).css({
            'z-index': '10',
            'transform': 'translate3d(0, 0, 0)',
            'transition': 'all .4s cubic-bezier(0.5, 0, 0.1, 1)'
          })

          leftItems.css({
            'transform': 'translate3d(-50%, 0, 0)',
            'transition': 'all .4s cubic-bezier(0.5, 0, 0.1, 1)'
          })

          rightItems.css({
            'transform': 'translate3d(50%, 0, 0)',
            'transition': 'all .4s cubic-bezier(0.5, 0, 0.1, 1)'
          })

          if (xright) {
            leftItems.css({
              'transform': 'translate3d(-100%, 0, 0)',
              'transition': 'all .4s cubic-bezier(0.5, 0, 0.1, 1)'
            })

            rightItems.css({
              'transform': 'translate3d(0, 0, 0)',
              'transition': 'all .4s cubic-bezier(0.5, 0, 0.1, 1)'
            })
          }

          if (xleft) {
            leftItems.css({
              'transform': 'translate3d(0, 0, 0)',
              'transition': 'all .4s cubic-bezier(0.5, 0, 0.1, 1)'
            })

            rightItems.css({
              'transform': 'translate3d(100%, 0, 0)',
              'transition': 'all .4s cubic-bezier(0.5, 0, 0.1, 1)'
            })
          }
        }, 400)
      },

      onLeave (i) {
        clearTimeout(this.timer)

        for (let j = 0; j < this.sliderItems.length; j++) {
          this.$refs['item_' + j][0].$el.style.transform = 'translate3d(0, 0, 0)'
          this.$refs['item_' + j][0].$el.style.transition = 'all .4s cubic-bezier(0.5, 0, 0.1, 1)'
        }
      },

      updateSliderItems (baseShowItem = this.showItems) {
        let {totalItems, startId} = this
        // left + center + right
        // [1] + [4] + [4] + [1]
        // [5] + [4] + [5]
        let centerDataId = []
        let rightDataId = []
        let leftDataId = []
        let j = 0

        for (let i = 0; i < baseShowItem; i++) {
          let x = startId + i

          if (x < totalItems) {
            centerDataId.push(x)
          } else {
            centerDataId.push(j)
            j++
          }
        }

        j = 0
        for (let i = 0; i < baseShowItem + 1; i++) {
          let x = centerDataId[centerDataId.length - 1] + i + 1

          if (x < totalItems) {
            rightDataId.push(x)
          } else {
            rightDataId.push(j)
            j++
          }
        }

        j = 0
        for (let i = 0; i < baseShowItem + 1; i++) {
          let x = centerDataId[0] - i - 1

          if (x >= 0) {
            leftDataId.push(x)
          } else {
            leftDataId.push(totalItems - 1 - j)
            j++
          }
        }

        leftDataId.reverse()
        /*
        console.log('left', leftDataId)
        console.log('center', centerDataId)
        console.log('right', rightDataId)
        */
        let selectIds = [...leftDataId, ...centerDataId, ...rightDataId]
        let sliderItems = []

        if (this.slides.length) {
          selectIds.map((e) => {
            sliderItems.push(this.slides[e])
          })
        }

        this.centerItem = centerDataId
        this.rightItem = rightDataId
        this.leftItem = leftDataId
        this.sliderItems = sliderItems
        // console.log(sliderItems)
      },

      updateSliderState () {
        let windowWidth = window.innerWidth
        let showItems = 3

        let xl = 'xl-' + showItems
        let xm = 'xm-' + showItems
        let md = 'md-' + showItems
        let sm = 'sm-1'
        let xs = 'xs-1'

        console.log('SDFDS', this.noOfSlides)
        if (this.noOfSlides && windowWidth >= 980) {
          showItems = this.noOfSlides
          xl = 'xl-' + showItems
          xm = 'xm-' + showItems
          md = 'md-' + showItems
        } else if (windowWidth >= 1800) { // xl
          showItems = 5
          xl = 'xl-' + showItems
        } else if (windowWidth >= 1260) { // xm
          showItems = 3
          xm = 'xm-' + showItems
        } else if (windowWidth >= 980) { // md
          showItems = 3
          md = 'md-' + showItems
        } else if (windowWidth >= 768) { // sm
          showItems = 2
          sm = 'sm-' + showItems
        } else if (windowWidth >= 600) { // xs
          showItems = 1
          xs = 'xs-' + showItems
        }

        this.slideItemsClasses = xl + ' ' + xm + ' ' + md + ' ' + sm + ' ' + xs

        console.log('HERE', this.slideItemsClasses)

        let mv = 100 / showItems
        this.showItems = showItems
        this.mv = mv

        console.log('SHO', this.showItems)

        this.noOfSets = this.totalItems / showItems

        if (this.click) {
          $(this.$refs.slider).css({
            'transform': 'translate3d(-1' + this.mv + '%, 0, 0)'
          })
        }
      },

      sizeClasses () {
        return this.slideItemsClasses
      }
    }
  }
</script>
