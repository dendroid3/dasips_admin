<template>
  <div>
    <div class="container-fluid d-flex justify-content-between align-items-center">
      <h1 class="display-6 mb-4">Projects</h1>
      <button class="btn btn-primary mb-4" @click="addProject">Add Project</button>
    </div>
    <section>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Name</th>
            <th>Type</th>
            <th>Location</th>
            <th>Description</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="project in projects.data" :key="project.id">
            <td data-label="Name">{{ project.name }}</td>
            <td data-label="Type">{{ project.type }}</td>
            <td data-label="Location">{{ project.location }}</td>
            <td data-label="Description">{{ project.description }}</td>
            <td data-label="Actions">
              <button class="btn btn-success btn-sm" @click="viewProject(project.id)">View</button>
            </td>
          </tr>
        </tbody>
      </table>
      <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
          <li class="page-item" v-for="link in projects.links" :key="link" :class="{ 
            active: link.active,
            disabled: !link.url
           }">
            <button class="page-link" v-html="link.label" @click="fetchProjects(link.url)"></button>
          </li>
        </ul>
      </nav>
    </section>
  </div>
  </template>
  <script>
  export default {
  name: 'ProjectsPage',

  props: [
    'baseUrl'
  ],

  data() {
    return {
      projects: []
    }
  },

  methods: {
    fetchProjects(rawUrl) {
      const url = rawUrl || '/api/projects/get'
      fetch(`${url}`)
        .then(response => response.json())
        .then(data => {
          this.projects = data;
          console.log(data)
        })
        .then(json => console.log(json))
    },

    viewProject(projectId){
      window.location.href = `/project?project_id=${projectId}`;
    },

    addProject(){
      window.location.href = `/add-project`;
    },
  },

  mounted () {
    this.fetchProjects()
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