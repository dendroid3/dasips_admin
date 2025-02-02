<template>
  <div>
    <div>
      <table class="table bordered thead-dark table-striped">
        <tr>
          <th>Key</th>
          <th>Value</th>
        </tr>
        <tr>
          <td>name</td>
          <td>{{ property.title }}</td>
        </tr>
        <tr>
          <td>description</td>
          <td>{{ property.description }}</td>
        </tr>
        <tr>
          <td>type</td>
          <td>{{ property.property_type }}</td>
        </tr>
        <tr>
          <td>location</td>
          <td>{{ property.location }}</td>
        </tr>
        <tr>
          <td>bedrooms</td>
          <td>{{ property.bedrooms }}</td>
        </tr>
        <tr>
          <td>bathrooms</td>
          <td>{{ property.bathrooms }}</td>
        </tr>
      </table>
      <h3>
        {{ "Primary Image" }}
      </h3>
      <img :src="property.image_url" alt="Primary Image" class="img-fluid">
      <h3>
        {{ "Secondary Images" }}
      </h3>
      <div class="row">
        <div class="col-md-4" v-for="image in property.property_images" :key="image.id">
          <img :src="image.image_url" alt="Secondary Image" class="img-fluid">
        </div>
      </div>
      <div class="mt-3"></div>
        <button @click="deleteProperty" class="btn btn-danger">Delete</button>
      </div>
  </div>
</template>
<script>
export default {
  name: 'PropertyPage',

  data() {
    return {
      property: {}
    }
  },

  methods: {
    fetchProperty() {
      const propertyId = new URLSearchParams(window.location.search).get('property_id');
      const url = `api/properties/view?property_id=${propertyId}`;
      fetch(`${url}`)
        .then(response => response.json())
        .then(data => {
          this.property = data;
          console.log(data)
        })
        .then(json => console.log(json))
    },

    deleteProperty() {
      const prompt = window.confirm('Are you sure you want to delete this property?');
      if (!prompt) {
        return;
      }
      const propertyId = new URLSearchParams(window.location.search).get('property_id');
      const url = `api/properties/delete?property_id=${propertyId}`;
      fetch(`${url}`, {
        method: 'DELETE',
      })
        .then(response => response.json())
        .then(data => {
          console.log(data)
          alert('Property deleted successfully');
          window.location.href = '/properties';
        })
        .then(json => console.log(json))
    },
  },

  mounted () {
    this.fetchProperty()
  }
}
</script>