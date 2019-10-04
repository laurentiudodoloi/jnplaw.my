<template>
  <div class="sidebar-wrap" style="border-right: 1px solid #f0f0f0;">
    <div class="our-brand">
      <img :src="logoUrl()" alt="Joseph & Partners logo" class="img-fluid">
    </div>

    <div class="sidebar-content">

      <div class="accordion" id="pagesAccordion">
        <div class="card">
          <div class="card-header" id="headingOne" data-toggle="collapse" data-target="#collapseOne"
               aria-expanded="false" aria-controls="collapseOne"
          >
            <div class="heading-text">
              <i class="fa fa-window-maximize"></i>
              Pages
            </div>
            <div class="icon">
              <i class="fa fa-chevron-down"></i>
            </div>
          </div>

          <div id="collapseOne" class="collapse accordion-list" aria-labelledby="headingOne"
               data-parent="#pagesAccordion"
          >
            <div class="text content">
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

        <div class="card">
          <div class="card-header" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo"
               aria-expanded="false" aria-controls="collapseOne"
          >
            <div class="heading-text">
              <i class="fa fa-window-maximize"></i>
              Manage
            </div>
            <div class="icon">
              <i class="fa fa-chevron-down"></i>
            </div>
          </div>

          <div id="collapseTwo" class="collapse accordion-list" aria-labelledby="headingTwo"
               data-parent="#pagesAccordion"
          >
            <div class="text content">
              <ul class="list-unstyled">
                <li :class="{ active: currentRoute() === '/manage/logo' }">
                  <router-link to="/manage/logo">Logo</router-link>
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
        return window.location.origin + '/images/company_logo_black.png'
      },

      currentRoute () {
        return this.$route.path
      }
    }
  }

</script>
