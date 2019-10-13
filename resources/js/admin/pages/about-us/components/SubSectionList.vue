<template>
  <div class="form-group">
    <div class="header-line">
      Subsections
      <hr>
    </div>

    <div class="add-sections">
      <button class="btn btn-outline-info btn-sm" @click.prevent="addSubsection">
        <i class="fa fa-plus mr-1"></i>
        Add subsection
      </button>
    </div>

    <div v-for="(subsection, subIndex) in localValue" :key="'subsection' + subIndex">
      <div class="mb-5">
        <span style="font-weight: 500;">Subsection {{ subIndex + 1 }}</span>
        <hr>

        <div class="form-group">
          <input
             v-model="localValue[subIndex].title"
             :id="'subsection-title' + subIndex"
             :name="'sections[' + index + '][subsections][' + subIndex + '][title]'"
             type="text"
             class="form-control form-control-sm"
             placeholder="Subsection title"
             @input="update"
          >
        </div>

        <div class="form-group">`
            <textarea :id="'subsection-content' + subIndex"
                      v-model="localValue[subIndex].content" rows="6"
                      :name="'sections[' + index + '][subsections][' + subIndex + '][description]'"
                      class="form-control form-control-sm"
                      placeholder="Subsection content"
                      @input="update"
            ></textarea>
        </div>

        <button class="btn btn-sm btn-outline-danger" @click.prevent="remove(subIndex)">Delete</button>
      </div>
    </div>
  </div>
</template>

<script>
  import { cloneDeep } from 'lodash'

  export default {
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
        handler (val) {
          this.localValue = cloneDeep(val)
        },
        immediate: true
      }
    },

    data () {
      return {
        localValue: {}
      }
    },
    methods: {
      addSubsection () {
        this.localValue.push({
          title: '',
          content: ''
        })

        this.update()
      },

      remove (index) {
        this.localValue.splice(index, 1)

        this.update()
      },

      update () {
        this.$emit('input', cloneDeep(this.localValue))
      }
    }
  }

</script>
