<template>
  <div>
    <div class="container-fluid d-flex justify-content-between align-items-center">
      <h1 class="display-6 mb-4">Lands on Sale</h1>
      <button class="btn btn-primary mb-4" @click="addLand">Add Land</button>
    </div>
    <section>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Title</th>
            <th>Location</th>
            <th>Description</th>
            <th>Active</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="land in lands.data" :key="land.id">
            <td data-label="Title">{{ land.title }}</td>
            <td data-label="Location">{{ land.location }}</td>
            <td data-label="Description">{{ land.description }}</td>
            <td data-label="Active">{{ land.is_active ? 'Yes' : 'No' }}</td>
            <td data-label="Actions">
              <button class="btn btn-success btn-sm" @click="viewLand(land.id)">View</button>
            </td>
          </tr>
        </tbody>
      </table>
      <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
          <li class="page-item" v-for="link in lands.links" :key="link" :class="{ 
            active: link.active,
            disabled: !link.url
           }">
            <button class="page-link" v-html="link.label" @click="fetchLands(link.url)"></button>
          </li>
        </ul>
      </nav>
    </section>
  </div>
  </template>
  <script>
  export default {
  name: 'LandsPage',

  props: [
    'baseUrl'
  ],

  data() {
    return {
      lands: []
    }
  },

  methods: {
    fetchLands(rawUrl) {
      const url = rawUrl || '/api/land/get'
      fetch(`${url}`)
        .then(response => response.json())
        .then(data => {
          this.lands = data;
          console.log(data)
        })
        .then(json => console.log(json))
    },

    viewLand(landId){
      window.location.href = `/land?land_id=${landId}`;
    },

    addLand(){
      window.location.href = `/add-land`;
    },
  },

  mounted () {
    this.fetchLands()
  }
}
</script>
<style type="text/css" scoped> 
@media (max-width: 767px) {
  table, thead, tbody, th, td, tr {
    display: block;
  }
  thead tr {
    position: absolute;
    top: -9999px;
    left: -9999px;
  }
  tr {
    border: 1px solid #ccc;
    margin-bottom: 10px;
  }
  td {
    border: none;
    border-bottom: 1px solid #eee;
    position: relative;
    padding-left: 50%;
  }
  td:before {
    position: absolute;
    top: 6px;
    left: 6px;
    width: 45%;
    padding-right: 10px;
    white-space: nowrap;
    content: attr(data-label);
    font-weight: bold;
  }
}
</style>