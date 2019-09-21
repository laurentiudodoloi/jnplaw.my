<template>
  <div style="height: 100%;">
    <sidebar/>

    <div class="content-wrap">
      <div class="content" style="padding: 0 15px;">
        <router-view/>
      </div>
    </div>
  </div>
</template>

<script>

  import Sidebar from './Sidebar'
  import Navbar from './Navbar'

  export default {
    components: {
      Sidebar,
      Navbar
    },

    props: {
      //
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
      //
    },

    methods: {
      //
    }
  }

</script>
