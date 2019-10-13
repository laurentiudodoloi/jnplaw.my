<template>
  <div class="form-group">
    <div class="add-sections">
      <div>
        <button class="btn btn-outline-info btn-sm" @click.prevent="addNewEntity()">
          <i class="fa fa-plus mr-1"></i>
          Add text box
        </button>
      </div>
    </div>

    <div v-for="(item, boxIndex) in localValue" class="form-row mb-4">
      <div class="form-group col-md-7">
        <input
          v-model="item.header_text"
          :id="'box-header-text' + index"
          :name="'sections[' + index + '][boxes][' + boxIndex + '][header_text]'"
          type="text"
          class="form-control form-control-sm"
          placeholder="Header text"
          @input="onChange"
        >
      </div>

      <div class="form-group col-md-5">
        <input
          v-model="item.title"
          :id="'box-subtitle' + boxIndex"
          :name="'sections[' + index + '][boxes][' + boxIndex + '][title]'"
          type="text"
          class="form-control form-control-sm"
          placeholder="Title"
          @input="onChange"
        >
      </div>

      <div class="form-group col-md-12">
                  <textarea v-model="item.content" rows="6"
                            id="description"
                            :name="'sections[' + index + '][boxes][' + boxIndex + '][content]'"
                            placeholder="Content"
                            class="form-control form-control-sm"
                            @input="onChange"
                  ></textarea>
      </div>

      <div class="text-right">
        <button class="btn btn-sm btn-outline-danger" @click.prevent="remove(boxIndex)">
          Delete
        </button>
      </div>
    </div>
  </div>
</template>

<script>
  import VueLoading from "vue-loading-overlay/src/js/Component";
  import {cloneDeep} from 'lodash'

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
          this.localValue = cloneDeep(val)
        },
        immediate: true
      }
    },

    data() {
      return {
        localValue: {},
        loading: false,
        loadingFullScreen: true,
      }
    },

    methods: {
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

      onChange () {
        this.$emit('input', cloneDeep(this.localValue))
      }
    }
  }

</script>
