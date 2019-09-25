<template>
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="form-row">
        <input
          v-if="section.id"
          :value="section.id"
          :name="'sections[' + index + '][id]'"
          type="hidden"
          class="form-control form-control-sm"
        >

        <div class="form-group col-md-7">
          <input
            v-model="section.title"
            :name="'sections[' + index + '][title]'"
            type="text"
            class="form-control form-control-sm"
            id="s-title"
            placeholder="Section title"
            @input="onChange"
          >
        </div>

        <div class="form-group col-md-5">
          <input
            v-model="section.subtitle"
            :name="'sections[' + index + '][subtitle]'"
            type="text"
            class="form-control form-control-sm"
            id="s-subtitle"
            placeholder="Section subtitle"
            @input="onChange"
          >
        </div>
      </div>

      <div class="form-group">
              <textarea
                v-model="section.description"
                :name="'sections[' + index + '][description]'"
                rows="6"
                class="form-control form-control-sm"
                id="s-description"
                placeholder="Section description"
                @input="onChange"
              >
              </textarea>
      </div>

      <div class="form-group">
        <div class="custom-control custom-checkbox mb-2">
          <input
            :id="'hasImage' + index"
            :name="'sections[' + index + '][has_image]'"
            :checked="!!section.has_image"
            type="checkbox"
            class="custom-control-input"
            @change="onChangeHasImage"
          >

          <label :for="'hasImage' + index" class="custom-control-label">
            Has image
          </label>
        </div>

        <div v-if="section.has_image" class="custom-file">
          <input
            :id="'imageFile' + index"
            :name="'sections[' + index + '][image]'"
            type="file"
            class="custom-file-input"
            @change="onSectionImageChange"
          >

          <label :for="'imageFile' + index" class="custom-file-label">Choose image</label>
        </div>

        <img
          v-if="section.has_image && sectionImage()"
          :src="sectionImage()"
          class="img-fluid mt-1 mb-1"
        >
      </div>

      <about-page-subsections
        :index="index"
        :value="section.subsections"
        :checked="!!section.has_subsections"
        @input="onChangeSubsections"
        @checked="onHasSubsectionsChecked"
      />

      <div class="form-group">
        <div class="custom-control custom-checkbox mb-2">
          <input
            v-model="section.has_image_slider"
            :id="'hasImageSlider' + index"
            :name="'sections[' + index + '][has_image_slider]'"
            type="checkbox"
            class="custom-control-input"
            @change="onChangeHasSlider"
          >
          <label :for="'hasImageSlider' + index" class="custom-control-label">
            Has image slider
          </label>
        </div>

        <div v-if="section.has_image_slider" class="custom-file">
          <input
            :id="'imageSliderFile' + index"
            :name="'sections[' + index + '][slider_images][]'"
            type="file"
            class="custom-file-input"
            multiple
            @change="onChangeSliderInput"
          >
          <label :for="'imageSliderFile' + index" class="custom-file-label">Choose image</label>
        </div>

        <div v-if="section.has_image_slider" v-for="(image, imageIndex) in sliders" style="display: inline-block;"
             :key="'imageIndex' + imageIndex"
        >
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
        :index="index"
        :value="section.text_boxes"
        :checked="!!section.has_text_boxes"
        @checked="onHasBoxesChange"
        @input="onChangeTextBoxes"
      />
    </div>
  </div>
</template>

<script>

  import AboutPageTextBoxes from "./AboutPageTextBoxes";
  import AboutPageSubsections from "./AboutPageSubsections";
  import {cloneDeep} from 'lodash'

  export default {
    components: {
      AboutPageSubsections,
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
        handler(val) {
          this.onChange()
        }
      },

      sliders: {
        handler(val) {
          this.onChange()
        }
      }
    },

    created () {
      if (this.value.images) {
        this.value.images.forEach(image => {
          this.sliders.push(image.image_url)
        })
      }
    },

    methods: {
      addSection() {
        this.$emit('add', this.section)
      },

      onHasBoxesChange(val) {
        this.section.has_text_boxes = val

        this.onChange()
      },

      onHasSubsectionsChecked(checked) {
        this.section.has_subsections = checked

        this.onChange()
      },

      onChangeSubsections(values) {
        this.section.subsections = values

        this.onChange()
      },

      onChangeHasSlider(el) {
        this.section.has_image_slider = el.target.checked

        if (!this.section.has_image_slider) {
          this.sliders = []
        }

        this.onChange()
      },

      onChangeHasImage(el) {
        this.section.has_image = el.target.checked

        if (!this.section.has_image) {
          this.section.image = false
          this.section.image_url = false
        }

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

      async createImage(file) {
        let reader = new FileReader()
        this.section.image_url = file.name

        let vm = this
        vm.image = false
        reader.onload = (e) => {
          vm.image = e.target.result
        };

        reader.readAsDataURL(file)
      },

      onChangeSliderInput(e) {
        let files = e.target.files || e.dataTransfer.files
        if (!files.length)
          return;

        Object.values(files).forEach(file => {
          this.createSliderImage(file)
        })
      },

      createSliderImage(file) {
        let reader = new FileReader()

        let vm = this
        reader.onload = (e) => {
          vm.sliders.push(e.target.result)
        };

        reader.readAsDataURL(file)
      },

      onChangeTextBoxes(val) {
        this.section.text_boxes = val

        this.onChange()
      },

      sectionImage() {
        const hasImage = this.section.has_image && (this.section.image, this.section.image_url && parseInt(this.section.image_url) !== 0)
        if (!hasImage) {
          return false
        }

        return this.section.image ? this.section.image : this.section.image_url
      },

      onChange() {
        this.$emit('input', {
          ...this.section,
          image: this.image,
          images: [...this.sliders]
        })
      }
    }
  }

</script>
