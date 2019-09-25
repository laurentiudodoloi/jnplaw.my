<template>
  <div>
    <div class="action-navbar">
      <h4>About Page Setup</h4>
    </div>

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

      <button v-if="hasChanges" class="btn btn-sm btn-outline-success" @click.prevent="save">Save</button>
    </div>

    <form
      :action="formAction"
      ref="aboutPageForm"
      class="form"
      method="post"
      enctype="multipart/form-data"
    >
      <input :value="csrf()" type="hidden" name="_token">

      <div id="my-tab-content" class="tab-content">

        <div class="tab-pane active" id="general">

          <div class="custom-control custom-checkbox">
            <input
              v-model="settings.show_add_comment_form"
              id="customCheck1"
              name="header[show_add_comment_form]"
              type="checkbox"
              class="custom-control-input"
              @change="somethingChanged"
            >
            <label class="custom-control-label" for="customCheck1">
              Show section
              <span class="font-weight-bold"><em>Post a comment</em></span>
            </label>
          </div>

        </div>

        <div class="tab-pane" id="header">

          <div class="form-row">
            <div class="form-group col-md-7">
              <input
                v-model="settings.title"
                id="setting-title"
                name="header[title]"
                type="text"
                class="form-control form-control-sm"
                placeholder="Title"
                @change="somethingChanged"
              >
            </div>

            <div class="form-group col-md-5">
              <input
                v-model="settings.subtitle"
                type="text"
                name="header[subtitle]"
                class="form-control form-control-sm"
                id="setting-subtitle"
                placeholder="Subtitle"
                @change="somethingChanged"
              >
            </div>
          </div>

          <div class="form-group">
            <textarea
              v-model="settings.description"
              rows="6"
              name="header[description]"
              class="form-control form-control-sm"
              id="setting-description" placeholder="Description"
              @change="somethingChanged"
            ></textarea>
          </div>

          <div class="form-group">
            <div class="custom-file">
              <input
                type="file"
                name="image"
                class="custom-file-input"
                id="setting-customFile"
                @change="onHeaderImageChange"
              >
              <label class="custom-file-label" for="setting-customFile">Choose image</label>
            </div>
          </div>

          Selected image:
          <div class="text-center">
            <img v-if="getHeaderImage()" :src="getHeaderImage()" class="img-fluid mt-1 mb-1" style="max-width: 60%"/>
          </div>
        </div>

        <about-page-sections
          :value="sections"
          @add="addSection"
          @input="onChangeSections"
        />

        <div class="tab-pane" id="setting-sections">

          <div class="add-sections">
            <div class="custom-control custom-checkbox">
              <input
                type="checkbox"
                class="custom-control-input"
                id="setting-hasSections"
              >
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
    </form>
  </div>
</template>

<script>

  import AboutPageSections from "./AboutPageSections";
  import axios from 'axios'
  import {cloneDeep} from 'lodash'
  import VueLoading from "vue-loading-overlay/src/js/Component";

  export default {
    components: {
      VueLoading,
      AboutPageSections
    },

    props: {
      data: {
        type: Object,
        default: () => {}
      }
    },

    data () {
      return {
        loading: false,
        loadingFullScreen: true,
        headerImage: false,
        settings: {
          show_add_comment_form: false,
          title: '',
          subtitle: '',
          description: '',
          image_url: '',
          image: false
        },
        sections: [],
        hasChanges: false
      }
    },

    created () {
      this.loading = true

      this.settings = cloneDeep(this.data.about.settings)
      this.sections = cloneDeep(this.data.about.sections)
    },

    computed: {
      formAction() {
        return '/admin/about-us-update-content'
      }
    },

    methods: {
      somethingChanged() {
        this.hasChanges = true
      },

      addSection(section) {
        this.hasChanges = true

        this.sections.push(section)
      },

      onHeaderImageChange(e) {
        this.hasChanges = true
        this.loading = true

        let files = e.target.files || e.dataTransfer.files
        if (!files.length)
          return;

        this.createImage(files[0])
      },

      createImage(file) {
        let reader = new FileReader()
        this.settings.image_url = file.name

        let vm = this
        reader.onload = (e) => {
          vm.headerImage = e.target.result
        };

        reader.readAsDataURL(file)
      },

      getHeaderImage() {
        if (!this.headerImage && this.settings.image_url && this.settings.image_url !== '') {
          return this.settings.image_url
        }

        this.loading = false
        return this.headerImage
      },

      onChangeSections(value) {
        this.hasChanges = true
        this.sections = value
      },

      save() {
        this.$refs.aboutPageForm.submit()
      },

      oldSave() {
        this.loading = true

        axios
          .post('/admin/about-us-update-content', {
            settings: {
              ...this.settings,
              image: this.headerImage
            },
            sections: this.sections
          })
          .then(r => {
            this.loading = false
            this.hasChanges = false

            this.$notify({
              group: 'save',
              title: 'Saved !',
              text: 'Your changes have been saved.'
            })
          })
      },

      csrf() {
        return document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      }
    }
  }

</script>
