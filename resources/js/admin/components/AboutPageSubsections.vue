<template>
  <div class="form-group">

    <div class="add-sections">
      <div class="custom-control custom-checkbox mb-2">
        <input
          :id="'hasSubsections' + index"
          :checked="checked"
          :name="'sections[' + index + '][has_subsections]'"
          type="checkbox"
          class="custom-control-input"
          @change="onCheckedChange"
        >

        <label :for="'hasSubsections' + index" class="custom-control-label">
          Has subsections
        </label>
      </div>

      <div v-if="checked">
        <button class="btn btn-outline-info btn-sm" @click.prevent="addSubsection">
          <i class="fa fa-plus mr-1"></i>
          Add subsection
        </button>
      </div>
    </div>

    <div v-for="(subsection, subIndex) in localValue" v-if="checked" :key="'subsection' + subIndex">
      <div class="mb-5">
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
          <textarea
            v-model="localValue[subIndex].content"
            :id="'subsection-content' + subIndex"
            :name="'sections[' + index + '][subsections][' + subIndex + '][content]'"
            rows="6"
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

  import {cloneDeep} from 'lodash'

  export default {
    props: {
      value: {
        type: Array,
        default: () => []
      },

      checked: {
        type: Boolean,
        default: false
      },

      index: {
        type: Number,
        required: true
      }
    },

    watch: {
      value: {
        handler(val) {
          this.localValue = cloneDeep(val)
        },
        immediate: true
      }
    },

    data() {
      return {
        localValue: {}
      }
    },

    methods: {
      onCheckedChange(el) {
        this.$emit('checked', el.target.checked)
      },

      addSubsection() {
        this.localValue.push({
          title: '',
          content: ''
        })

        this.update()
      },

      remove(index) {
        this.localValue.splice(index, 1)

        this.update()
      },

      update() {
        this.$emit('input', cloneDeep(this.localValue))
      }
    }
  }

</script>
