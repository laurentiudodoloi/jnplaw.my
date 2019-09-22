<template>
  <div class="form-group">
    <label class="form-check-label font-weight-bold">Upload image/video</label>

    <div class="my-2">
      <div class="custom-control custom-radio custom-control-inline">
        <input
          :checked="isChecked(IMAGE_RESOURCE)"
          type="radio" id="customRadioInline1" name="customRadioInline1" class="custom-control-input"
          @change="switchResourceType(IMAGE_RESOURCE)"
        >
        <label class="custom-control-label" for="customRadioInline1">Image</label>
      </div>

      <div class="custom-control custom-radio custom-control-inline">
        <input :checked="isChecked(VIDEO_RESOURCE)"
               type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input"
               @change="switchResourceType('video')"
        >

        <label class="custom-control-label" for="customRadioInline2">Video</label>
      </div>
    </div>

    <div v-if="resource.resource_type" class="form-group">
      <div class="custom-file">
        <input name="resource" type="file" class="custom-file-input" id="customFile" @change="onImageChange">

        <label class="custom-file-label" for="customFile">Choose file</label>
        <span v-if="resource.resource_url">Uploaded file: {{ resource.resource_url }}</span>
      </div>
    </div>

    <img v-if="isChecked(IMAGE_RESOURCE) && resource.id" :src="resource.resource_url" class="img-fluid">

    <video v-if="isChecked(VIDEO_RESOURCE) && resource.id" width="100%" height="100%" controls
           style="background: #007bff; padding: 2px;"
    >
      <source v-if="isChecked(VIDEO_RESOURCE) && resource" :src="resource.resource_url" type="video/mp4">
      Your browser does not support the video tag.
    </video>
  </div>
</template>

<script>

  import { cloneDeep } from 'lodash'
  // import { IMAGE_RESOURCE, VIDEO_RESOURCE} from './../../../resource-types'

  export default {
    props: {
      value: {
        type: Object,
        default: () => {}
      }
    },

    watch: {
      value: {
        handler (val) {
          this.resource = cloneDeep(val)
        },
        immediate: true
      }
    },

    data () {
      return {
        resource: {
          IMAGE_RESOURCE: 'image',
          VIDEO_RESOURCE: 'video',
          resource_type: false,
          resource_url: false
        }
      }
    },

    created () {
      this.IMAGE_RESOURCE = 'image'
      this.VIDEO_RESOURCE = 'video'
    },

    methods: {
      onImageChange (e) {
        let files = e.target.files || e.dataTransfer.files
        if (!files.length)
          return;

        this.resource.resource_url = files[0].name
      },

      isChecked (type) {
        return this.resource.resource_type === type
      },

      switchResourceType (type) {
        this.resource.resource_type = type
        this.resource.resource_url = false
      },

      resourceUrl () {
        return ''
      },

      emitInput () {
        this.$emit('input', this.resource)
      }
    }
  }

</script>
