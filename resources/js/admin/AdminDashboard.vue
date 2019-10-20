<template>
  <div style="height: 100%;">
    <sidebar/>

    <div class="content-wrap">
      <div class="content" style="padding: 0 15px;">
        <router-view :data="data"/>
      </div>
    </div>
  </div>
</template>

<script>
  import Sidebar from './components/Sidebar'

  export default {
    components: {
      Sidebar
    },

    props: {
      data: {
        type: Object,
        default: () => {
        }
      }
    }
  }

</script>
