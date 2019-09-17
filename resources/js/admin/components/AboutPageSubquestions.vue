<template>
  <div class="form-group">

    <div class="add-sections">
      <div class="custom-control custom-checkbox mb-2">
        <input :checked="checked" type="checkbox" class="custom-control-input"
               id="hasSubsections"
               @change="onCheckedChange"
        >
        <label class="custom-control-label" for="hasSubsections">
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
          <input :id="'subsection-title' + subIndex" v-model="localValue[subIndex].title" type="text" name="title"
                 class="form-control form-control-sm"
                 placeholder="Subsection title"
                 @input="update"
          >
        </div>

        <div class="form-group">`
                      <textarea :id="'subsection-content' + subIndex"
                                v-model="localValue[subIndex].content" rows="6" name="description"
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

      checked: {
        type: Boolean,
        default: false
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

    mounted() {
      //
    },

    created() {
      //
    },

    methods: {
      onCheckedChange (el) {
        this.$emit('checked', el.target.checked)
      },

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
