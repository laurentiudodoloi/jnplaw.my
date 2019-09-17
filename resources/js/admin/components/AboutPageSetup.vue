<template>
  <div>
    <div class="nav-tabs-navigation">
      <div class="nav-tabs-wrapper">
        <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
          <li>
            <a href="#general" data-toggle="tab" aria-expanded="true" class="active">General</a>
          </li>
          <li>
            <a href="#header" data-toggle="tab" aria-expanded="false" class="">Header</a>
          </li>
          <li>
            <a href="#sections" data-toggle="tab" aria-expanded="false" class="">Sections</a>
          </li>
        </ul>
      </div>

      <button class="btn btn-sm btn-outline-success" @click.prevent="save">Save</button>
    </div>

    <div id="my-tab-content" class="tab-content">

      <div class="tab-pane active" id="general">

        <div class="custom-control custom-checkbox">
          <input v-model="settings.show_add_comment_form" type="checkbox" class="custom-control-input"
                 id="customCheck1"
          >
          <label class="custom-control-label" for="customCheck1">
            Show section
            <span class="font-weight-bold"><em>Post a comment</em></span>
          </label>
        </div>

      </div>

      <div class="tab-pane" id="header">

        <form class="form admin-form">

          <div class="form-row">
            <div class="form-group col-md-7">
              <input v-model="settings.title" type="text" name="title" class="form-control form-control-sm" id="setting-title"
                     placeholder="Title"
              >
            </div>

            <div class="form-group col-md-5">
              <input v-model="settings.subtitle" type="text" name="subtitle" class="form-control form-control-sm"
                     id="setting-subtitle"
                     placeholder="Subtitle"
              >
            </div>
          </div>

          <div class="form-group">
            <textarea v-model="settings.description" rows="6" name="description" class="form-control form-control-sm"
                      id="setting-description" placeholder="Description"
            ></textarea>
          </div>

          <div class="form-group">
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="setting-customFile" @change="onHeaderImageChange">
              <label class="custom-file-label" for="setting-customFile">Choose image</label>
            </div>
          </div>

          Selected image:
          <div class="text-center">
            <img v-if="getHeaderImage()" :src="getHeaderImage()" class="img-fluid mt-1 mb-1" style="max-width: 60%"/>
          </div>
        </form>

      </div>

      <about-page-sections :value="sections" @add="addSection" @input="onChangeSections"/>

      <div class="tab-pane" id="setting-sections">

        <div class="add-sections">
          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="setting-hasSections">
            <label class="custom-control-label" for="setting-hasSections">
              Has sections
            </label>
          </div>

          <div>
            <button class="btn btn-outline-info btn-sm">
              <i class="fa fa-plus mr-1"></i>
              Add section
            </button>
          </div>
        </div>

      </div>
    </div>

  </div>
</template>

<script>

  import AboutPageSections from "./AboutPageSections";
  import axios from 'axios'
  import { cloneDeep } from 'lodash'

  export default {
    components: {
      AboutPageSections
    },

    props: {
      //
    },

    data () {
      return {
        headerImage: false,
        settings: {},
        sections: []
      }
    },

    created() {
      axios
        .get('/admin/about-us-content')
        .then(r => {
          this.settings = r.data.settings
          this.sections = r.data.sections
        })
    },

    methods: {
      addSection(section) {
        this.sections.push(section)
      },

      onHeaderImageChange (e) {
        let files = e.target.files || e.dataTransfer.files
        if (!files.length)
          return;

        this.createImage(files[0])
      },

      createImage (file) {
        let reader = new FileReader()
        this.settings.image_url = file.name

        let vm = this
        reader.onload = (e) => {
          vm.headerImage = e.target.result
        };

        reader.readAsDataURL(file)
      },

      getHeaderImage () {
        console.log('HERE', this.headerImage, this.settings.image_url)

        if (!this.headerImage && this.settings.image_url && this.settings.image_url !== '') {
          return 'uploads/' + this.settings.image_url
        }

        return this.headerImage
      },

      onChangeSections (value) {
        this.sections = value
      },

      save () {
        axios
          .post('/admin/about-us-update-content', {
            settings: {
              ...this.settings,
              image: this.headerImage
            },
            sections: this.sections
          })
          .then(r => {
            console.log('result', r.data)
          })
      }
    }
  }

</script>
