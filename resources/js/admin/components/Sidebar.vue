<template>
  <div class="sidebar-wrap">
    <div class="brand">
      <img :src="logoUrl()" alt="Joseph & Partners logo" class="img-fluid">
    </div>

    <div class="sidebar-content">

      <div class="accordion" id="pagesAccordion">
        <div class="card">
          <div class="card-header" id="headingOne" data-toggle="collapse" data-target="#collapseOne"
               aria-expanded="true" aria-controls="collapseOne"
          >
            <div>
              <i class="fa fa-window-maximize"></i>
              Pages
            </div>
            <div class="icon">
              <i class="fa fa-chevron-down"></i>
            </div>
          </div>

          <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#pagesAccordion">
            <div class="card-body text">
              <ul class="list-unstyled">
                <li :class="{ active: currentRoute() === '/landing-page-setup' }">
                  <router-link to="/landing-page-setup">Landing page</router-link>
                </li>

                <li :class="{ active: currentRoute() === '/about-us-setup' }">
                  <router-link to="/about-us-setup">About us</router-link>
                </li>

                <li :class="{ active: currentRoute() === '/our-people-setup' }">
                  <router-link to="/our-people-setup">Our people</router-link>
                </li>

                <li :class="{ active: currentRoute() === '/our-knowledge-setup' }">
                  <router-link to="/our-knowledge-setup">Our knowledge</router-link>
                </li>

                <li :class="{ active: currentRoute() === '/news-setup' }">
                  <router-link to="/news-setup">News</router-link>
                </li>

                <li :class="{ active: currentRoute() === '/events-setup' }">
                  <router-link to="/events-setup">Events</router-link>
                </li>

                <li :class="{ active: currentRoute() === '/contact-us-setup' }">
                  <router-link to="/contact-us-setup">Contact us</router-link>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

  export default {
    props: {
      //
    },

    data () {
      return {
        //
      }
    },

    // watch: {
    //   '$route': {
    //     handler (val) {
    //       console.log('val', val)
    //     },
    //     immediate: true
    //   }
    // },

    mounted() {
      //
    },

    created() {
      //
    },

    methods: {
      logoUrl () {
        return window.location.origin + '/images/company_logo.png'
      },

      currentRoute () {
        return this.$route.path
      }
    }
  }

</script>
