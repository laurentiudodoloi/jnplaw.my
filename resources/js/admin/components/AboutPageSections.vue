<template>
  <div class="tab-pane" id="sections">

    <div class="add-sections">
      <div class="custom-control custom-checkbox">
        <input v-model="hasSections" type="checkbox" class="custom-control-input" id="hasSections">
        <label class="custom-control-label" for="hasSections">
          Has sections
        </label>
      </div>

      <div v-if="hasSections">
        <button class="btn btn-outline-info btn-sm" @click.prevent="addSection">
          <i class="fa fa-plus mr-1"></i>
          Add section
        </button>
      </div>
    </div>

    <div v-if="hasSections" class="container-fluid">

      <div v-for="(section, index) in sections">
        <div class="row justify-content-center">
          <div class="col-md-10">
            <form class="form admin-form">

              <div class="form-row">
                <div class="form-group col-md-7">
                  <input v-model="sections[index].title" type="text" name="section-title" class="form-control form-control-sm" id="s-title"
                         placeholder="Section title"
                  >
                </div>

                <div class="form-group col-md-5">
                  <input v-model="sections[index].subtitle" type="text" name="section-subtitle" class="form-control form-control-sm" id="s-subtitle"
                         placeholder="Section subtitle"
                  >
                </div>
              </div>

              <div class="form-group">
                  <textarea v-model="sections[index].description" rows="6" name="section-description" class="form-control form-control-sm"
                            id="s-description" placeholder="Section description"
                  ></textarea>
              </div>

              <div class="form-group">
                <div class="custom-control custom-checkbox mb-2">
                  <input v-model="section.has_image" type="checkbox" class="custom-control-input" id="hasImage">
                  <label class="custom-control-label" for="hasImage">
                    Has image
                  </label>
                </div>

                <div v-if="section.has_image" class="custom-file">
                  <input type="file" class="custom-file-input" id="imageFile" @change="">
                  <label class="custom-file-label" for="imageFile">Choose image</label>
                </div>
              </div>

              <div class="form-group">
                <div class="custom-control custom-checkbox mb-2">
                  <input v-model="section.has_image_slider" type="checkbox" class="custom-control-input" id="hasImageSlider">
                  <label class="custom-control-label" for="hasImageSlider">
                    Has image slider
                  </label>
                </div>

                <div v-if="section.has_image_slider" class="custom-file">
                  <input type="file" class="custom-file-input" id="imageSliderFile" @change="">
                  <label class="custom-file-label" for="imageSliderFile">Choose image</label>
                </div>
              </div>

              <about-page-text-boxes :checked="section.has_text_boxes" @checked="onHasBoxesChange"/>
            </form>
          </div>

        </div>

        <hr>
      </div>

      <button v-if="sections.length" class="btn btn-danger btn-sm">Save</button>
    </div>

  </div>
</template>

<script>

  import AboutPageTextBoxes from "./AboutPageTextBoxes";

  export default {
    components: {
      AboutPageTextBoxes
    },

    props: {
      value: {
        type: Array,
        default: () => []
      }
    },

    data () {
      return {
        sections: [],
        hasSections: false,
        section: {
          title: '',
          subtitle: '',
          description: '',
          image_url: '',
          has_subsections: false,
          has_image: false,
          has_image_slider: false,
          has_text_boxes: false
        }
      }
    },

    mounted() {
      //
    },

    created() {
      //
    },

    methods: {
      addSection () {
        this.sections.push(this.section)
      },

      onHasBoxesChange (val) {
        this.section.has_text_boxes = val
      }
    }
  }

</script>
