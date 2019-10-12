<template>
  <div>
    <vue-loading
      :active.sync="loading"
      :is-full-page="loadingFullScreen"
    />

    <notifications
      :duration="300"
      group="save"
      position="bottom right"
    />

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
        <form
          class="form admin-form"
          method="post"
          action="/admin/about-us-store-settings"
          enctype="multipart/form-data"
        >
          <input :value="csrf()" type="hidden" name="_token">

          <div class="form-row">
            <div class="form-group col-md-7">
              <input v-model="settings.title" type="text" name="title" class="form-control form-control-sm"
                     id="setting-title"
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
              <input
                name="header_image"
                type="file"
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

          <button
            type="submit"
            class="btn btn-sm btn-outline-success"
          >Save</button>
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

  import SectionList from "./components/SectionList";
  import axios from 'axios'
  import {cloneDeep} from 'lodash'
  import VueLoading from "vue-loading-overlay/src/js/Component";

  export default {
    components: {
      VueLoading,
      SectionList
    },

    props: {
      //
    },

    data () {
      return {
        localPath: 'uploads/',
        livePath: 'jnplaw/public/uploads/',
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
        sections: []
      }
    },

    created () {
      this.loading = true

      axios
        .get('/admin/about-us-content')
        .then(r => {
          this.settings = r.data.settings || this.settings
          this.sections = r.data.sections

          this.loading = false
        })
    },

    methods: {
      addSection (section) {
        this.sections.push(section)
      },

      onHeaderImageChange(e) {
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
          return this.livePath + this.settings.image_url
        }

        this.loading = false
        return this.headerImage
      },

      onChangeSections (value) {
        this.sections = value
      },

      save () {
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

            this.$notify({
              group: 'save',
              title: 'Saved !',
              text: 'Your changes have been saved.'
            })
          })
      },

      csrf () {
        return document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      },
    }
  }

</script>
