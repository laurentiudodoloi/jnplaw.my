<template>
  <div>
    <vue-loading
      :active.sync="loading"
      :is-full-page="loadingFullScreen"
    />

    <div class="action-navbar">
      <h4>Landing Page Setup</h4>

      <button v-if="!editMode" class="btn btn-outline-light btn-sm font-weight-bold" @click.prevent="toggleEditMode">
        <i class="fa fa-plus"> </i>
        Add new
      </button>

      <button v-else class="btn btn-outline-danger btn-sm font-weight-bold" @click.prevent="toggleEditMode">
        <i class="fa fa-chevron-left"> </i>
        Back to table
      </button>
    </div>

    <p v-if="!rows.length && !editMode" class="py-2">There are no entities at the moment.</p>

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
              <input v-model="entity.title" type="text" name="title" class="form-control form-control-sm" id="title"
                     placeholder="Enter title"
              >
            </div>

            <div class="form-group">
              <label for="header-title" class=" font-weight-bold">Header title</label>
              <input
                v-model="entity.header_title"
                type="text"
                name="header_title"
                class="form-control form-control-sm"
                id="header-title"
                placeholder="Enter header title"
              >
            </div>

            <div class="form-group">
              <label for="description" class="font-weight-bold">Description</label>
              <textarea v-model="entity.description" rows="6" name="description" class="form-control form-control-sm"
                        id="description" placeholder="Enter description"
              ></textarea>
            </div>

            <file-uploader :value="entity" @input="onResourceChange"/>

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

  import DataTable from './DataTable'
  import { cloneDeep } from 'lodash'
  import axios from 'axios'
  import VueLoading from "vue-loading-overlay/src/js/Component";
  import FileUploader from "./util/FileUploader";

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
          header_title: '',
          description: '',
          resource_type: false,
          resource_url: false
        },
        image: false,
        editMode: false
      }
    },

    mounted() {
      //
    },

    created() {
      this.rows = cloneDeep(this.data.projects || [])
    },

    computed: {
      formAction () {
        if (this.entity.id) {
          return '/admin/project/store/' + this.entity.id
        }

        return '/admin/project/store'
      }
    },

    methods: {
      resetEntity () {
        this.entity = {
          title: '',
          header_title: '',
          description: '',
          resource_type: false,
          resource_url: ''
        }
      },

      headers () {
        return [
          'Project title',
          'Header title',
          'Description',
          'Media'
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

      // save () {
      //   console.log('SAVE')
      //   this.loading = true
      //
      //   let formData = new FormData()
      //   formData.append('test', 123)
      //   formData.append('file', this.image)
      //
      //   if (this.entity.id) {
      //     const index = this.rows.findIndex(i => this.entity.id === i.id)
      //
      //     axios
      //       .post('/admin/project/store/' + this.entity.id, {
      //         // ...this.entity,
      //         formData
      //       },
      //       {
      //         headers: {
      //           'Content-Type': 'multipart/form-data'
      //         }
      //       })
      //       .then(r => {
      //         this.rows.splice(index, 1, r.data)
      //
      //         this.loading = false
      //       })
      //       .catch(r => {
      //         console.log('Error occured.')
      //       })
      //   } else {
      //     console.log('Request.')
      //     axios
      //       .post('/admin/project/store', {
      //         // ...this.entity,
      //         formData
      //       },
      //       {
      //         headers: {
      //           'Content-Type': 'multipart/form-data charset=utf-8; boundary=' + Math.random().toString().substr(2)
      //         }
      //       })
      //       .then(r => {
      //         this.rows.push(r.data)
      //
      //         this.loading = false
      //       })
      //   }
      //
      //   this.editMode = false
      // },

      remove (index) {
        this.loading = true

        axios
          .post('/admin/project/destroy/' + this.rows[index].id)
          .then(r => {
            if (r.data) {
              this.rows.splice(index, 1)
            }

            this.loading = false
          })
      },

      fetchProjects () {
        this.loading = true

        axios
          .get('/admin/projects')
          .then(r => {
            this.rows = r.data

            this.loading = false
          })
      },

      onImageChange (e) {
        this.loading = true

        let files = e.target.files || e.dataTransfer.files
        if (!files.length)
          return;

        this.createImage(files[0])
      },

      createImage (file) {
        let reader = new FileReader();
        this.entity.resource_url = file.name

        let vm = this
        reader.onload = (e) => {
          vm.image = e.target.result;
        };

        reader.readAsDataURL(file);

        this.loading = false
      },

      switchResourceType (type) {
        this.image = false

        this.entity.resource_type = type
      },

      isChecked (type) {
        return this.entity.resource_type === type
      },

      resourceUrl () {
        if (this.entity.id && this.entity.resource_url) {
          this.image = this.localPath + this.entity.resource_url
        }

        return this.image
      },

      csrf () {
        return document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      },

      onResourceChange (resource) {
        this.entity.resource_url = resource.resource_url
      }
    }
  }

</script>
