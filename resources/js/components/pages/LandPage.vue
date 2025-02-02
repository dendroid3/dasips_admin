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
          <td>{{ land.title }}</td>
        </tr>
        <tr>
          <td>description</td>
          <td>{{ land.description }}</td>
        </tr>
        <tr>
          <td>location</td>
          <td>{{ land.location }}</td>
        </tr>
      </table>
      <h3>
        {{ "Primary Image" }}
      </h3>
      <img :src="land.image_url" alt="Primary Image" class="img-fluid">
      <h3>
        {{ "Secondary Images" }}
      </h3>
      <div class="row">
        <div class="col-md-4" v-for="image in land.land_images" :key="image.id">
          <img :src="image.image_url" alt="Secondary Image" class="img-fluid">
        </div>
      </div>
      <div class="mt-3"></div>
        <button @click="deleteLand" class="btn btn-danger">Delete</button>
      </div>
  </div>
</template>
<script>
export default {
  name: 'LandPage',

  data() {
    return {
      land: {}
    }
  },

  methods: {
    fetchLand() {
      const landId = new URLSearchParams(window.location.search).get('land_id');
      const url = `api/land/view?land_id=${landId}`;
      fetch(`${url}`)
        .then(response => response.json())
        .then(data => {
          this.land = data;
          console.log(data)
        })
        .then(json => console.log(json))
    },

    deleteLand() {
      const prompt = window.confirm('Are you sure you want to delete this land?');
      if (!prompt) {
        return;
      }
      const landId = new URLSearchParams(window.location.search).get('land_id');
      const url = `api/land/delete?land_id=${landId}`;
      fetch(`${url}`, {
        method: 'DELETE',
      })
        .then(response => response.json())
        .then(data => {
          console.log(data)
          alert('Land deleted successfully');
          window.location.href = '/lands';
        })
        .then(json => console.log(json))
    },
  },

  mounted () {
    this.fetchLand()
  }
}
</script>