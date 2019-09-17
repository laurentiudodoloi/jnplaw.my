<template>
  <div class="form-group">
    <div class="add-sections">
      <div class="custom-control custom-checkbox">
        <input :id="'hasTextBoxes' + index"
               :checked="checked" type="checkbox" class="custom-control-input"
               @change="onCheckedChange"
        >
        <label :for="'hasTextBoxes' + index" class="custom-control-label">
          Has text boxes
        </label>
      </div>

      <div v-if="checked">
        <button class="btn btn-outline-info btn-sm" @click.prevent="addNewEntity()">
          <i class="fa fa-plus mr-1"></i>
          Add text box
        </button>
      </div>
    </div>

    <div v-if="checked">
      <div v-for="(item, boxIndex) in localValue" class="form-row mb-4">
        <div class="form-group col-md-7">
          <input v-model="item.header_text" :id="'box-header-text' + index" type="text" name="title" class="form-control form-control-sm"
                 placeholder="Header text"
                 @input="onChange"
          >
        </div>

        <div class="form-group col-md-5">
          <input :id="'box-subtitle' + boxIndex"
                 v-model="item.title" type="text" name="subtitle" class="form-control form-control-sm"
                 placeholder="Title"
                 @input="onChange"
          >
        </div>

        <div class="form-group col-md-12">
                    <textarea v-model="item.content" rows="6" name="description" class="form-control form-control-sm"
                              id="description" placeholder="Description"
                              @input="onChange"
                    ></textarea>
        </div>

        <div class="text-right">
          <button class="btn btn-sm btn-outline-danger" @click.prevent="remove(index)">
            Delete
          </button>
        </div>
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
        this.$emit('checked', !!el.target.checked)
      },

      addNewEntity () {
        this.localValue.push({
          header_text: '',
          title: '',
          content: ''
        })

        this.onChange()
      },

      remove (index) {
        this.localValue.splice(index, 1)

        this.onChange()
      },

      onChange() {
        this.$emit('input', cloneDeep(this.localValue))
      }
    }
  }

</script>
