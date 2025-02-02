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
          <td>{{ project.name }}</td>
        </tr>
        <tr>
          <td>description</td>
          <td>{{ project.description }}</td>
        </tr>
        <tr>
          <td>location</td>
          <td>{{ project.location }}</td>
        </tr>
        <tr>
          <td>type</td>
          <td>{{ project.type }}</td>
        </tr>
      </table>
      <h3>
        {{ "Primary Image" }}
      </h3>
      <img :src="project.image_url" alt="Primary Image" class="img-fluid">
      <div class="mt-3"></div>
        <button @click="deleteProject" class="btn btn-danger">Delete</button>
      </div>
  </div>
</template>
<script>
export default {
  name: 'ProjectPage',

  data() {
    return {
      project: {}
    }
  },

  methods: {
    fetchProject() {
      const projectId = new URLSearchParams(window.location.search).get('project_id');
      const url = `api/projects/view?project_id=${projectId}`;
      fetch(`${url}`)
        .then(response => response.json())
        .then(data => {
          this.project = data;
          console.log(data)
        })
        .then(json => console.log(json))
    },

    deleteProject() {
      const prompt = window.confirm('Are you sure you want to delete this project?');
      if (!prompt) {
        return;
      }
      const projectId = new URLSearchParams(window.location.search).get('project_id');
      const url = `api/projects/delete?project_id=${projectId}`;
      fetch(`${url}`, {
        method: 'DELETE',
      })
        .then(response => response.json())
        .then(data => {
          console.log(data)
          alert('Project deleted successfully');
          window.location.href = '/projects';
        })
        .then(json => console.log(json))
    },
  },

  mounted () {
    this.fetchProject()
  }
}
</script>