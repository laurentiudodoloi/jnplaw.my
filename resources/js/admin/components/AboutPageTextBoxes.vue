<template>
  <div class="form-group">
    <div class="add-sections">
      <div class="custom-control custom-checkbox">
        <input :value="checked" type="checkbox" class="custom-control-input" id="hasTextBoxes" @change="onCheckedChange">
        <label class="custom-control-label" for="hasTextBoxes">
          Has text boxes
        </label>
      </div>

      <button class="btn btn-outline-info btn-sm"><i class="fa fa-plus mr-1"></i>
        Add text box
      </button>
    </div>

    <div v-if="checked">
      <div class="form-row">
        <div class="form-group col-md-7">
          <input type="text" name="title" class="form-control form-control-sm" id="header-text"
                 placeholder="Title"
          >
        </div>

        <div class="form-group col-md-5">
          <input type="text" name="subtitle" class="form-control form-control-sm" id="subtitle"
                 placeholder="Subtitle"
          >
        </div>

        <div class="form-group col-md-12">
                    <textarea rows="6" name="description" class="form-control form-control-sm"
                              id="description" placeholder="Description"
                    ></textarea>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

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

    data () {
      return {
        textBoxes: []
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
      }
    }
  }

</script>
