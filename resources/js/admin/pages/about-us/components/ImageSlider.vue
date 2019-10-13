<template>
  <div class="form-group">
    <div class="custom-file">
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

    <input
      v-if="deleteImages"
      :name="'sections[' + index + '][delete_slider_images]'"
      :value="deleteImages"
      type="hidden"
    >

    <div v-for="(image, imageIndex) in sliders" style="display: inline-block;"
         :key="'imageIndex' + imageIndex"
    >
      <div class="d-flex justify-content-center align-items-center flex-column">
        <img :src="image" class="img-fluid"
             style="max-width: 120px; max-height: 120px; padding: 12px 16px;"
        >
      </div>
    </div>

    <div v-if="sliders.length" class="d-flex justify-content-end my-2">
      <button class="btn btn-sm btn-outline-danger" @click.prevent="remove">
        Delete images
      </button>
    </div>
  </div>
</template>

<script>

  import {cloneDeep} from 'lodash'
  import VueLoading from "vue-loading-overlay/src/js/Component";

  export default {
    components: {VueLoading},
    props: {
      value: {
        type: Array,
        default: () => []
      },

      index: {
        type: Number,
        required: true
      }
    },

    watch: {
      value: {
        handler(val) {
          this.sliders = cloneDeep(val || [])
        },
        immediate: true
      }
    },

    data() {
      return {
        sliders: [],
        localValue: {},
        deleteImages: false,
        loading: false,
        loadingFullScreen: true
      }
    },

    methods: {
      remove (imageIndex) {
        this.deleteImages = true
        this.sliders = []

        this.onChange()
      },

      onChangeSliderInput (e) {
        this.deleteImages = false

        this.sliders = []

        let files = e.target.files || e.dataTransfer.files
        if (!files.length)
          return;

        Object.values(files).forEach(file => {
          this.createSliderImage(file)
        })
      },

      createSliderImage (file) {
        let reader = new FileReader()

        let vm = this
        reader.onload = (e) => {
          vm.sliders.push(e.target.result)
        };

        reader.readAsDataURL(file)

        this.onChange()
      },

      onChange() {
        this.$emit('input', cloneDeep(this.sliders))
      }
    }
  }

</script>
