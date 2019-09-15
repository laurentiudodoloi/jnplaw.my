<template>
  <div>
    <div class="action-navbar">
      <h4>Landing Page Setup</h4>

      <button v-if="!editMode" class="btn btn-outline-success btn-sm font-weight-bold" @click.prevent="toggleEditMode">
        <i class="fa fa-plus"> </i>
        Add new
      </button>

      <button v-else class="btn btn-outline-danger btn-sm font-weight-bold" @click.prevent="toggleEditMode">
        <i class="fa fa-plus"> </i>
        Back to table
      </button>
    </div>

    <data-table
      v-if="!editMode"
      :headers="headers()"
      :rows="tableRows()"
      @edit="edit"
      @delete="remove"
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
              <label for="category" class=" font-weight-bold">Category</label>
              <input v-model="entity.category" type="text" name="category" class="form-control form-control-sm"
                     id="category" placeholder="Enter category"
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
            <button type="submit" name="landing" class="btn btn-primary btn-sm">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

  import DataTable from './DataTable'

  export default {
    components: {
      DataTable
    },

    props: {
      //
    },

    data () {
      return {
        entity: {
          title: '',
          category: '',
          description: ''
        },
        editMode: false
      }
    },

    mounted() {
      //
    },

    created() {
      //
    },

    methods: {
      headers () {
        return [
          'Project title',
          'Category',
          'Description',
          'Media'
        ]
      },

      tableRows () {
        return [
          {
            title: 'Project 1',
            category: 'Category 1',
            description: 'Project 1 in category 1',
            media: 'Media 1'
          },
          {
            title: 'Project 2',
            category: 'Category 2',
            description: 'Project 2 in category 2',
            media: 'Media 2'
          },
          {
            title: 'Project 3',
            category: 'Category 3',
            description: 'Project 3 in category 3',
            media: 'Media 3'
          }
        ]
      },

      toggleEditMode () {
        this.editMode = !this.editMode
      },

      edit (index) {
        console.log('edit', index)
      },

      remove (index) {
        console.log('remove', index)
      },

    }
  }

</script>
