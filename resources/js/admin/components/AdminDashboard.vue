<template>
  <div>
    <sidebar/>

    <div class="content-wrap">
      <navbar/>

      <div class="content">
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
