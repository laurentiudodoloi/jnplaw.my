<template>
  <div>
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
          <form class="form">
            <div class="form-group">
              <label for="title" class=" font-weight-bold">Title</label>
              <input v-model="entity.title" type="text" name="title" class="form-control form-control-sm" id="title"
                     placeholder="Enter title"
              >
            </div>

            <div class="form-group">
              <label for="description" class="font-weight-bold">Description</label>
              <textarea v-model="entity.description" rows="6" name="description" class="form-control form-control-sm"
                        id="description" placeholder="Enter description"
              ></textarea>
            </div>

            <div class="form-group">
              <label class="form-check-label font-weight-bold">Upload image/video</label>

              <div>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" id="customRadioInline1" name="customRadioInline1" class="custom-control-input">
                  <label class="custom-control-label" for="customRadioInline1">Image</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input">
                  <label class="custom-control-label" for="customRadioInline2">Video</label>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="customFile">
                <label class="custom-file-label" for="customFile">Choose file</label>
              </div>
            </div>

            <button
              type="submit"
              name="landing"
              class="btn btn-outline-primary btn-md"
              @click.prevent="save"
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

  export default {
    components: {
      DataTable
    },

    props: {
      //
    },

    data () {
      return {
        rows: [],
        entity: {
          title: '',
          description: '',
          resource_url: '',
          resource_type: ''
        },
        editMode: false
      }
    },

    mounted() {
      //
    },

    created() {
      this.fetchProjects()
    },

    methods: {
      resetEntity () {
        this.entity = {
          title: '',
          description: ''
        }
      },

      headers () {
        return [
          'Project title',
          'Description',
          'Media'
        ]
      },

      toggleEditMode () {
        this.editMode = !this.editMode

        if (this.editMode) {
          this.resetEntity()
        }
      },

      edit (index) {
        this.entity = this.rows[index]

        this.editMode = true
      },

      save () {
        if (this.entity.id) {
          const index = this.rows.findIndex(i => this.entity.id === i.id)

          axios
            .post('/admin/project/store/' + this.entity.id, {
              ...this.entity
            })
            .then(r => {
              this.rows.splice(index, 1, r.data)
            })
        } else {
          axios
            .post('/admin/project/store', {
              ...this.entity
            })
            .then(r => {
              this.rows.push(r.data)
            })
        }

        this.editMode = false
      },

      remove (index) {
        axios
          .post('/admin/project/destroy/' + this.rows[index].id)
          .then(r => {
            if (r.data) {
              this.rows.splice(index, 1)
            }
          })
      },

      fetchProjects () {
        axios
          .get('/admin/projects')
          .then(r => {
            this.rows = r.data
          })
      }
    }
  }

</script>
