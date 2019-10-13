<template>
  <div>
    <vue-loading
      :active.sync="loading"
      :is-full-page="loadingFullScreen"
    />

    <div class="action-navbar">
      <h4>Landing Page Setup</h4>

      <button v-if="!editMode" class="btn btn-outline-success btn-sm font-weight-bold" @click.prevent="toggleEditMode">
        <i class="fa fa-plus"> </i>
        Add new
      </button>

      <button v-else class="btn btn-outline-danger btn-sm font-weight-bold" @click.prevent="toggleEditMode">
        <i class="fa fa-chevron-left"> </i>
        Back to table
      </button>
    </div>

    <p v-if="!rows.length" class="py-2">There are no entities at the moment.</p>

    <data-table
      v-if="!editMode && rows.length"
      :headers="headers()"
      :rows="rows"
      @edit="edit"
      @remove="remove"
    />

    <div v-if="editMode" class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <form :action="formAction" class="form" method="post" enctype="multipart/form-data">
            <input :value="csrf()" type="hidden" name="_token">

            <div class="form-group">
              <label for="title" class=" font-weight-bold">Title</label>

              <input
                v-model="entity.title"
                type="text"
                name="title"
                class="form-control form-control-sm"
                id="title"
                placeholder="Enter title"
              >
            </div>

            <div class="form-group">
              <label for="subtitle" class="font-weight-bold">Subtitle</label>

              <input
                v-model="entity.subtitle"
                name="subtitle"
                class="form-control form-control-sm"
                id="subtitle"
                placeholder="Enter subtitle"
              >
            </div>

            <file-uploader :value="entity"/>

            <button
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

  import DataTable from '../../components/DataTable'
  import { cloneDeep } from 'lodash'
  import axios from 'axios'
  import VueLoading from "vue-loading-overlay/src/js/Component";
  import FileUploader from "../../../util/FileUploader";

  export default {
    components: {
      FileUploader,
      DataTable,
      VueLoading
    },

    props: {
      data: {
        type: Object,
        default: () => {}
      }
    },

    data () {
      return {
        localPath: 'uploads/',
        livePath: 'jnplaw.local.my/public/uploads/',
        loading: false,
        loadingFullScreen: true,
        rows: [],
        entity: {
          title: '',
          subtitle: '',
          resource_url: '',
          resource_type: false
        },
        image: false,
        editMode: false
      }
    },

    created() {
      this.rows = cloneDeep(this.data.slides || [])
    },

    computed: {
      formAction () {
        let path = '/admin/landing-page/slide/store'

        if (this.entity.id) {
          return path + '/' + this.entity.id
        }

        return path
      }
    },

    methods: {
      resetEntity () {
        this.entity = {
          title: '',
          subtitle: '',
          resource_url: '',
          resource_type: false
        }
      },

      headers () {
        return [
          'Title',
          'Subtitle',
          'Media resource'
        ]
      },

      toggleEditMode () {
        this.resetEntity()
        this.editMode = !this.editMode
      },

      edit (index) {
        this.entity = this.rows[index]

        this.editMode = true
      },

      remove (index) {
        this.loading = true

        axios
          .post('/admin/landing-page/slide/destroy', {
            id: this.rows[index].id
          })
          .then(r => {
            if (r.data) {
              this.rows.splice(index, 1)
            }

            this.loading = false
          })
      },

      csrf () {
        return document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      }
    }
  }

</script>
