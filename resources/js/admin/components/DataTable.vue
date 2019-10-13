<template>
  <table class="table table-striped custom-table table-sm">
    <thead class="thead-dark">
      <tr>
        <th scope="col"></th>
        <th v-for="header in headers" scope="col">{{ header }}</th>
        <th scope=""></th>
      </tr>
    </thead>

    <tbody>
      <tr v-for="(row, index) in rows">
        <th scope="row" class="text-center">{{ index + 1 }}</th>
        <td>{{ shortText(row.title) }}</td>
        <td>{{ shortText(row.subtitle) }}</td>
        <td>{{ shortText(row.resource_url) }}</td>

        <td class="text-center">
          <a href="#" @click.prevent="edit(index)">
            <i class="fa fa-pencil text-success mx-1"></i>
          </a>

          <a href="#" @click.prevent="remove(index)">
            <i class="fa fa-times text-danger mx-1"></i>
          </a>
        </td>
      </tr>
    </tbody>
  </table>
</template>

<script>

  export default {
    props: {
      headers: {
        type: Array,
        required: true
      },

      rows: {
        type: Array,
        required: true
      }
    },

    methods: {
      shortText (text) {
        if (!text) {
          return ''
        }

        if (text.length > 16) {
          return text + '..'
        }

        return text
      },

      edit (index) {
        this.$emit('edit', index)
      },

      remove (index) {
        this.$emit('remove', index)
      }
    }
  }

</script>
