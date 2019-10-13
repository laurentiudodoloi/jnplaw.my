<template>
  <div class="tab-pane" id="sections">
    <div class="container-fluid">
      <div class="d-flex justify-content-end">
        <button class="btn btn-outline-info btn-sm float-right" @click.prevent="addSection">
          <i class="fa fa-plus mr-1"></i>
          Add section
        </button>
      </div>

      <form
        class="form admin-form"
        method="post"
        action="/admin/about-us/store-sections"
        enctype="multipart/form-data"
      >
        <input :value="csrf()" type="hidden" name="_token">

        <div class="d-flex mb-4">
          <button class="btn btn-outline-success btn-sm float-right" type="submit">
            <i class="fa fa-save mr-1"></i>
            Save changes
          </button>
        </div>

        <div v-for="(section, index) in sections" :key="'sectionIndex' + index">
          <div class="section-item-header mb-4">
            <b>Section {{ index + 1 }}</b>
          </div>

          <section-item :index="index" :value="section" @input="onChangeSection($event, index)"/>

          <div class="text-right">
            <button class="btn btn-sm btn-outline-danger" @click.prevent="removeSection(index)">
              Delete
            </button>
          </div>
        </div>

        <hr style="border: 1px solid #000000;">
      </form>
    </div>

  </div>
</template>

<script>
  import SectionItem from "./SectionItem";
  import { cloneDeep } from 'lodash'

  export default {
    components: {
      SectionItem
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
        section: {
          title: '',
          subtitle: '',
          description: '',
          image_url: '',
          image: false
        }
      }
    },

    watch: {
      value: {
        handler (val) {
          this.sections = cloneDeep(val)
          console.log('sections', this.sections)
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

      csrf () {
        return document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      },

      onChange () {
        this.$emit('input', cloneDeep(this.sections))
      }
    }
  }

</script>
