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

        <section :index="index" :value="section" @input="onChangeSection($event, index)"/>

        <div class="text-right">
          <button class="btn btn-sm btn-outline-danger" @click.prevent="removeSection(index)">
            Delete
          </button>
        </div>
      </div>
      <hr style="border: 1px solid #000000;">
    </div>

  </div>
</template>

<script>
  import Section from "./Section";
  import { cloneDeep } from 'lodash'

  export default {
    components: {
      Section
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
          has_text_boxes: false,
          image: false
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

      removeSection (index) {
        this.sections.splice(index, 1)

        this.onChange()
      },

      onChange () {
        this.$emit('input', cloneDeep(this.sections))
      }
    }
  }

</script>
