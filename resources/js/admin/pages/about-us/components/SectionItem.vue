<template>
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="header-line">
        Details
        <hr>
      </div>

      <div class="form-row">
        <div class="form-group col-md-7">
          <input
            :value="section.id || 0"
            :name="'sections[' + index + '][id]'"
            type="hidden"
          >

          <input
            v-if="removeImage"
            :value="removeImage"
            :name="'sections[' + index + '][remove_image]'"
            type="hidden"
          >

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
        ></textarea>
      </div>

      <div class="form-group">
        <div class="header-line">
          Image
          <hr>
        </div>

        <div class="custom-file">
          <input
            :id="'imageFile' + index"
            :name="'sections[' + index + '][image]'"
            :default-value="section.image_url"
             type="file"
            class="custom-file-input"
            @change="onSectionImageChange"
          >
          <label :for="'imageFile' + index" class="custom-file-label">Choose image</label>
        </div>

        <img v-if="sectionImage()"
             :src="sectionImage()"
             class="img-fluid mt-1 mb-1"
        >

        <div v-if="sectionImage()" class="d-flex justify-content-end my-2">
          <button class="btn btn-sm btn-outline-danger" @click.prevent="removeSectionImage()">
            Remove image
          </button>
        </div>
      </div>

      <sub-section-list
        :index="index"
        :value="section.subsections"
        @input="onChangeSubsections"
      />

      <div class="header-line">
        Image slider
        <hr>
      </div>

      <image-slider
        :value="sliders"
        :index="index"
      />

      <div class="header-line">
        Text boxes
        <hr>
      </div>

      <text-box-list
        :index="index"
        :value="section.text_boxes"
        @input="onChangeTextBoxes"
      />
    </div>
  </div>
</template>

<script>
  import SubSectionList from "./SubSectionList";
  import TextBoxList from "./TextBoxList";
  import ImageSlider from "./ImageSlider";
  import {cloneDeep} from 'lodash'

  export default {
    components: {
      SubSectionList,
      TextBoxList,
      ImageSlider
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

    data() {
      return {
        removeImage: false,
        localPath: 'uploads/',
        path: 'storage/uploads/',
        sliders: [],
        section: {},
        image: false,
        sectionImages: []
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
          this.sliders.push(this.path + image.image_url)
        })
      }
    },

    methods: {
      addSection() {
        this.$emit('add', this.section)
      },

      onChangeSubsections(values) {
        this.section.subsections = values

        this.onChange()
      },

      onSectionImageChange (e) {
        this.removeImage = false

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

      onChangeTextBoxes(val) {
        this.section.text_boxes = val

        this.onChange()
      },

      sectionImage() {
        const image = (this.section.image, this.section.image_url && parseInt(this.section.image_url) !== 0)
        if (!image) {
          return false
        }

        return this.section.image ? this.section.image : this.path + this.section.image_url
      },

      removeSectionImage () {
        this.section.image = false
        this.section.image_url = false

        this.removeImage = true
      },

      onChange() {
        this.$emit('input', {...this.section, image: this.image, images: [...this.sliders]})
      }
    }
  }

</script>
