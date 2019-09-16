<template>
  <div class="tab-pane" id="sections">
    <div class="float-right">
      <button class="btn btn-outline-info btn-sm" @click.prevent="addSection">
        <i class="fa fa-plus mr-1"></i>
        Add section
      </button>
    </div>

    <div v-if="sections.length" class="container-fluid">

      <div v-for="(section, index) in sections" :key="'sectionIndex' + index">
        <b>Section {{ index + 1 }}</b>

        <about-page-section :index="index" :value="section" @input="onChangeSection($event, index)"/>
      </div>

      <button v-if="sections.length" class="btn btn-danger btn-sm">Save</button>

      <hr style="border: 1px solid #000000;">
    </div>

  </div>
</template>

<script>

  import AboutPageSection from "./AboutPageSection";
  import { cloneDeep } from 'lodash'

  export default {
    components: {
      AboutPageSection
    },

    props: {
      value: {
        type: Array,
        default: () => []
      }
    },

    data () {
      return {
        sectionImages: [],
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

    watch: {
      value: {
        handler (val) {
          this.sections = cloneDeep(val)
        },
        immediate: true
      }
    },

    methods: {
      addSection () {
        this.$emit('add', this.section)
      },

      onChangeSection (value, index) {
        this.sections[index] = cloneDeep(value)

        this.onChange()
      },

      onChange () {
        this.$emit('input', cloneDeep(this.sections))
      }
    }
  }

</script>
