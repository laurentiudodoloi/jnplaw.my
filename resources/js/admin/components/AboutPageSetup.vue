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
    </div>

    <div id="my-tab-content" class="tab-content">

      <div class="tab-pane active" id="general">

        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="customCheck1">
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
            <input type="text" name="title" class="form-control form-control-sm" id="title"
                   placeholder="Title"
            >
          </div>

          <div class="form-group col-md-5">
            <input type="text" name="subtitle" class="form-control form-control-sm" id="subtitle"
                   placeholder="Subtitle"
            >
          </div>
        </div>

        <div class="form-group">
            <textarea rows="6" name="description" class="form-control form-control-sm"
                      id="description" placeholder="Description"
            ></textarea>
        </div>

        <div class="form-group">
          <div class="custom-file">
            <input type="file" class="custom-file-input" id="customFile" @change="">
            <label class="custom-file-label" for="customFile">Choose image</label>
          </div>
        </div>
      </form>

      </div>

      <about-page-sections :value="sections"/>
      <div class="tab-pane" id="sections">

        <div class="add-sections">
          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="hasSections">
            <label class="custom-control-label" for="hasSections">
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

        <div class="container-fluid">

          <div class="row justify-content-center">
            <div class="col-md-10">
              <form class="form admin-form">

                <div class="form-group mb-5">
                  <div class="form-row">
                    <div class="form-group col-md-7">
                      <input type="text" name="section-title" class="form-control form-control-sm" id="s-title"
                             placeholder="Section title"
                      >
                    </div>

                    <div class="form-group col-md-5">
                      <input type="text" name="section-subtitle" class="form-control form-control-sm" id="s-subtitle"
                             placeholder="Section subtitle"
                      >
                    </div>
                  </div>

                  <div class="form-group">
                    <textarea rows="6" name="section-description" class="form-control form-control-sm"
                              id="s-description" placeholder="Section description"
                    ></textarea>
                  </div>
                </div>

                <div class="form-group">
                  <div class="add-sections">
                    <div class="custom-control custom-checkbox mb-2">
                      <input type="checkbox" class="custom-control-input" id="hasSubsections">
                      <label class="custom-control-label" for="hasSubsections">
                        Has subsections
                      </label>
                    </div>

                    <div>
                      <button class="btn btn-outline-info btn-sm">
                        <i class="fa fa-plus mr-1"></i>
                        Add subsection
                      </button>
                    </div>
                  </div>

                  <div class="mb-5">
                    <div class="form-group">
                      <input type="text" name="title" class="form-control form-control-sm" id="subsection-title"
                             placeholder="Subsection title"
                      >
                    </div>

                    <div class="form-group">
                      <textarea rows="6" name="description" class="form-control form-control-sm"
                                id="subsection-content" placeholder="Subsection content"
                      ></textarea>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="custom-control custom-checkbox mb-2">
                    <input type="checkbox" class="custom-control-input" id="hasImage">
                    <label class="custom-control-label" for="hasImage">
                      Has image
                    </label>
                  </div>

                  <div class="custom-file mb-5">
                    <input type="file" class="custom-file-input" id="imageFile" @change="">
                    <label class="custom-file-label" for="imageFile">Choose image</label>
                  </div>
                </div>

                <div class="form-group">
                  <div class="custom-control custom-checkbox mb-2">
                    <input type="checkbox" class="custom-control-input" id="hasImageSlider">
                    <label class="custom-control-label" for="hasImageSlider">
                      Has image slider
                    </label>
                  </div>

                  <div class="custom-file mb-5">
                    <input type="file" class="custom-file-input" id="imageSliderFile" @change="">
                    <label class="custom-file-label" for="imageSliderFile">Choose image</label>
                  </div>
                </div>

                <div class="form-group">
                  <div class="custom-control custom-checkbox mb-2">
                    <input type="checkbox" class="custom-control-input" id="hasTextBoxes">
                    <label class="custom-control-label" for="hasTextBoxes">
                      Has text boxes
                    </label>
                  </div>

                  <div class="mb-5">
                    <div class="form-row">
                      <div class="form-group col-md-7">
                        <input type="text" name="title" class="form-control form-control-sm" id="header-text"
                               placeholder="Header text"
                        >
                      </div>

                      <div class="form-group col-md-5">
                        <input type="text" name="title" class="form-control form-control-sm" id="title"
                               placeholder="Title"
                        >
                      </div>
                    </div>

                    <div class="form-group">
                      <textarea rows="6" name="description" class="form-control form-control-sm"
                                id="content" placeholder="Content"
                      ></textarea>
                    </div>
                  </div>
                </div>

                <button class="btn btn-danger btn-sm btn-block">Save</button>
              </form>
            </div>
          </div>

        </div>

      </div>
    </div>

  </div>
</template>

<script>

  import AboutPageSections from "./AboutPageSections";
  import axios from 'axios'

  export default {
    components: {
      AboutPageSections
    },

    props: {
      //
    },

    data () {
      return {
        general: {
          show_add_comment_form: true
        },
        header: {
          title: '',
          subtitle: '',
          description: '',
          image_url: '',
        },
        sections: []
      }
    },

    mounted() {
      //
    },

    created() {
      axios
        .get('/admin/')
    },

    methods: {
      //
    }
  }

</script>
