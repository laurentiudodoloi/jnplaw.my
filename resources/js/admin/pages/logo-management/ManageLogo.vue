<template>
  <div>
    <div class="action-navbar">
      <h4>Manage logo</h4>
    </div>

    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <form :action="formAction" class="form" method="post">
            <input :value="csrf()" type="hidden" name="_token">

            <div class="form-inline flex-row justify-content-between">
              <select v-model="currentSize" class="form-control form-control-sm">
                <option
                  v-for="(size, key) in sizes"
                  :disabled="layouts[key]"
                  :value="key"
                  :key="'o-' + key"
                >{{ size }}
                </option>
              </select>

              <button
                type="submit"
                class="btn btn-outline-primary btn-md"
                @click.prevent="addSize()"
              >Add size
              </button>
            </div>

            <hr style="background: #302579;">

            <div v-for="(layout, key, index) in layouts" :key="key">
              <input :value="key" :name="'layouts['+ index + '][fixed_width]'" type="hidden">
              <p class="text-uppercase"><b>{{ sizes[key] }} Layout</b> (<small>{{ layout.unit }}</small>)</p>

              <div class="form-group form-inline">
                <div class="mx-2">
                  <input v-model="layout.width" :name="'layouts['+ index + '][width]'" type="text" class="form-control form-control-sm"
                         placeholder="Width"
                  >
                </div>

                <div class="mx-2">
                  <input v-model="layout.height" :name="'layouts['+ index + '][height]'" type="text" class="form-control form-control-sm"
                         placeholder="Height"
                  >
                </div>
              </div>

              <hr>
              <div class="text-center">
                <img
                  :width="layout.width + layout.unit"
                  :height="layout.height + layout.unit"
                  :src="logoUrl"
                  :alt="logoUrl"
                />
              </div>
              <hr>
            </div>

            <button
              v-if="Object.keys(layouts).length"
              type="submit"
              class="btn btn-outline-primary btn-md"
            >Save
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import axios from 'axios'

  export default {
    data () {
      return {
        currentSize: 'gt_1200',
        sizes: {
          gt_1200: 'Greater than 1200',
          gt_992: 'Greater than 992',
          gt_768: 'Greater than 768',
          gt_576: 'Greater than 576',
          lt_576: 'Lower than 576'
        },
        layouts: {}
      }
    },

    computed: {
      formAction () {
        return '/admin/manage/logo/store'
      },

      logoUrl () {
        return window.location.origin + '/images/company_logo.png'
      }
    },

    async created () {
      this.layouts = await this.fetchLayouts()
    },

    methods: {
      async fetchLayouts () {
        let data = {}

        await axios
          .get('/admin/manage/logo')
          .then(r => {
            if (r.data) {
              r.data.forEach(layout => {
                data[layout.fixed_width] = {
                  width: layout.width,
                  height: layout.height,
                  unit: layout.unit,
                }
              })
            }
          })

        return data
      },

      csrf () {
        return document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      },

      addSize () {
        this.layouts[this.currentSize] = {
          width: 250,
          height: 50,
          unit: 'px',
        }

        this.layouts = { ...this.layouts }
      }
    }
  }

</script>
