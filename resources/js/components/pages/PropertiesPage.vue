<template>
  <div>
    <div class="container-fluid d-flex justify-content-between align-items-center">
      <h1 class="display-6 mb-4">Properties</h1>
      <button class="btn btn-primary mb-4" @click="addProperty">Add Property</button>
    </div>
    <section>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Title</th>
            <th>Property Type</th>
            <th>Location</th>
            <th>Price</th>
            <th>Bedrooms</th>
            <th>Bathrooms</th>
            <th>Description</th>
            <th>Active</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="property in properties.data" :key="property.id">
            <td data-label="Title">{{ property.title }}</td>
            <td data-label="Property Type">{{ property.property_type }}</td>
            <td data-label="Location">{{ property.location }}</td>
            <td data-label="Price">{{ property.price }}</td>
            <td data-label="Bedrooms">{{ property.bedrooms }}</td>
            <td data-label="Bathrooms">{{ property.bathrooms }}</td>
            <td data-label="Description">{{ property.description }}</td>
            <td data-label="Active">{{ property.is_active ? 'Yes' : 'No' }}</td>
            <td data-label="Actions">
              <button class="btn btn-success btn-sm" @click="viewProperty(property.id)">View</button>
            </td>
          </tr>
        </tbody>
      </table>
      <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
          <li class="page-item" v-for="link in properties.links" :key="link" :class="{ 
            active: link.active,
            disabled: !link.url
           }">
            <button class="page-link" v-html="link.label" @click="fetchProperties(link.url)"></button>
          </li>
        </ul>
      </nav>
    </section>
  </div>
  </template>
  <script>
  export default {
  name: 'PropertiesPage',

  props: [
    'baseUrl'
  ],

  data() {
    return {
      properties: []
    }
  },

  methods: {
    fetchProperties(rawUrl) {
      const url = rawUrl || '/api/properties/get'
      fetch(`${url}`)
        .then(response => response.json())
        .then(data => {
          this.properties = data;
          console.log(data)
        })
        .then(json => console.log(json))
    },

    viewProperty(propertyId){
      window.location.href = `/property?property_id=${propertyId}`;
    },

    addProperty(){
      window.location.href = `/add-property`;
    },
  },

  mounted () {
    this.fetchProperties()
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