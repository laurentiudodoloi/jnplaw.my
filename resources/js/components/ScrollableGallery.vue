<template>
  <h3>Works</h3>
</template>

<script>

  import Gallery from './Gallery'

  export default {
    props: {
      slides: {
        type: Array,
        default: () => []
      },

      startAt: {
        type: Number,
        default: () => 0
      },

      style: {
        type: String,
        default: () => ''
      },

      width: {
        type: String,
        default: () => ''
      },

      height: {
        type: String,
        default: () => ''
      }
    },

    data () {
      return {
        //
      }
    },

    mounted() {
      //
    },

    created() {
      this.sliders = [];

      let domSliders = document.querySelectorAll('.video-slider');
      domSliders.forEach(s => {
        this.sliders.push(s.textContent);
      })
    },

    methods: {
      //
    }
  }

</script>
