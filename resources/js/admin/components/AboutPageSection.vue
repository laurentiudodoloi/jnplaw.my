<template>
  <div class="row justify-content-center">
    <div class="col-md-10">
      <form class="form admin-form">

        <div class="form-row">
          <div class="form-group col-md-7">
            <input v-model="section.title" type="text" name="section-title" class="form-control form-control-sm"
                   id="s-title"
                   placeholder="Section title"
                   @input="onChange"
            >
          </div>

          <div class="form-group col-md-5">
            <input v-model="section.subtitle" type="text" name="section-subtitle" class="form-control form-control-sm"
                   id="s-subtitle"
                   placeholder="Section subtitle"
                   @input="onChange"
            >
          </div>
        </div>

        <div class="form-group">
              <textarea v-model="section.description" rows="6" name="section-description"
                        class="form-control form-control-sm"
                        id="s-description" placeholder="Section description"
                        @input="onChange"
              ></textarea>
        </div>

        <div class="form-group">
          <div class="custom-control custom-checkbox mb-2">
            <input :id="'hasImage' + index" :checked="!!section.has_image" type="checkbox" class="custom-control-input"
                   @change="onChangeHasImage">
            <label :for="'hasImage' + index" class="custom-control-label">
              Has image
            </label>
          </div>

          <div v-if="section.has_image" class="custom-file">
            <input :id="'imageFile' + index" type="file" class="custom-file-input" @change="onSectionImageChange">
            <label :for="'imageFile' + index" class="custom-file-label">Choose image</label>
          </div>

          <img v-if="section.has_image"
               :src="section.image || 'uploads/' + section.image_url"
               class="img-fluid mt-1 mb-1">
        </div>

        <about-page-subquestions
          :value="section.subsections"
          :checked="!!section.has_subsections"
          @input="onChangeSubquestions"
          @checked="onHasSubsectionsChecked"
        />

        <div class="form-group">
          <div class="custom-control custom-checkbox mb-2">
            <input :id="'hasImageSlider' + index" v-model="section.has_image_slider" type="checkbox"
                   class="custom-control-input"
            >
            <label :for="'hasImageSlider' + index" class="custom-control-label">
              Has image slider
            </label>
          </div>

          <div v-if="section.has_image_slider" class="custom-file">
            <input :id="'imageSliderFile' + index" type="file" class="custom-file-input" @change="onChangeSliderInput">
            <label :for="'imageSliderFile' + index" class="custom-file-label">Choose image</label>
          </div>

          <div v-for="(image, imageIndex) in sliders" style="display: inline-block;" :key="'imageIndex' + imageIndex">
            <div class="d-flex justify-content-center align-items-center flex-column">
              <img :src="image" class="img-fluid"
                   style="max-width: 120px; max-height: 120px; padding: 12px 16px;"
              >

              <button class="btn btn-sm btn-outline-danger" @click.prevent="removeSliderImage(imageIndex)">
                Delete
              </button>
            </div>
          </div>
        </div>

        <about-page-text-boxes
          :value="section.text_boxes" :checked="!!section.has_text_boxes"
          @checked="onHasBoxesChange" @input="onChangeTextBoxes"
        />
      </form>
    </div>

  </div>
</template>

<script>

  import AboutPageTextBoxes from "./AboutPageTextBoxes";
  import AboutPageSubquestions from "./AboutPageSubquestions";
  import {cloneDeep} from 'lodash'

  export default {
    components: {
      AboutPageSubquestions,
      AboutPageTextBoxes
    },

    props: {
      value: {
        type: Object,
        required: true
      },

      index: {
        type: Number,
        required: true
      }
    },

    data () {
      return {
        sliders: [],
        section: {},
        image: false,
        sectionImages: [],
        hasSections: false
      }
    },

    watch: {
      value: {
        handler(val) {
          this.section = cloneDeep(val)
        },
        immediate: true
      },

      image: {
        handler (val) {
          this.onChange()
        }
      },

      sliders: {
        handler (val) {
          console.log('Sliders', val)
          this.onChange()
        }
      }
    },

    methods: {
      addSection() {
        this.$emit('add', this.section)
      },

      onHasBoxesChange (val) {
        this.section.has_text_boxes = val

        this.onChange()
      },

      onHasSubsectionsChecked (checked) {
        this.section.has_subsections = checked

        this.onChange()
      },

      onChangeSubquestions(values) {
        this.section.subsections = values

        this.onChange()
      },

      onChangeHasSlider(el) {
        this.section.has_image_slider = el.target.checked

        this.onChange()
      },

      onChangeHasImage(el) {
        this.section.has_image = el.target.checked

        this.onChange()
      },

      removeSliderImage(imageIndex) {
        this.sliders.splice(imageIndex, 1)

        this.section.images = this.sliders

        this.onChange()
      },

      onSectionImageChange(e) {
        let files = e.target.files || e.dataTransfer.files
        if (!files.length)
          return;

        this.image = false
        this.createImage(files[0])
      },

      async createImage (file) {
        let reader = new FileReader()
        this.section.image_url = file.name

        let vm = this
        vm.image = false
        reader.onload = (e) => {
          vm.image = e.target.result
        };

        reader.readAsDataURL(file)
      },

      onChangeSliderInput (e) {
        let files = e.target.files || e.dataTransfer.files
        if (!files.length)
          return;

        this.createSliderImage(files[0])
      },

      createSliderImage (file) {
        let reader = new FileReader()

        let vm = this
        reader.onload = (e) => {
          vm.sliders.push(e.target.result)
        };

        reader.readAsDataURL(file)
      },

      onChangeTextBoxes (val) {
        this.section.text_boxes = val

        this.onChange()
      },

      onChange () {
        this.$emit('input', { ...this.section, image: this.image, images: this.sliders })
      }
    }
  }

</script>
