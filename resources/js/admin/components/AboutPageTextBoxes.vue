<template>
  <div class="form-group">
    <div class="add-sections">
      <div class="custom-control custom-checkbox">
        <input :value="checked" type="checkbox" class="custom-control-input" id="hasTextBoxes"
               @change="onCheckedChange">
        <label class="custom-control-label" for="hasTextBoxes">
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
      <div v-for="item in localValue" class="form-row">
        <div class="form-group col-md-7">
          <input v-model="item.header_text" type="text" name="title" class="form-control form-control-sm"
                 id="header-text"
                 placeholder="Header text"
                 @input="onChange"
          >
        </div>

        <div class="form-group col-md-5">
          <input v-model="item.title" type="text" name="subtitle" class="form-control form-control-sm" id="subtitle"
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

      onChange() {
        this.$emit('input', cloneDeep(this.localValue))
      }
    }
  }

</script>
