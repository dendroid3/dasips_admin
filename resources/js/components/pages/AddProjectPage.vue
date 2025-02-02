<template>
  <div class="container">
    <form @submit.prevent="submitForm">
      <div>
        <label for="projectName">Project Name:</label> <br>
        <input type="text" id="projectName" class="form-control" v-model="projectName" required>
      </div>
      <div>
        <label for="projectType">Project Type:</label> <br>
        <input type="text" id="projectType" class="form-control" v-model="projectType" required>
      </div>
      <div>
        <label for="projectDescription">Project Description:</label> <br>
        <textarea id="projectDescription" class="form-control" v-model="projectDescription" required></textarea>
      </div>
      <div>
        <label for="projectLocation">Project Location:</label> <br>
        <input type="text" id="projectLocation" class="form-control" v-model="projectLocation" required>
      </div>
      <div>
        <label for="projectImage">Image:</label> <br>
        <input type="file" id="projectImage" class="form-control" @change="handleImageUpload" accept="image/*" required>
      </div>
      <button type="submit" class="btn btn-success mt-4">Add Project</button>
    </form>
  </div>
</template>
<script>
    export default {
      name: 'AddProjectPage',
      data() {
        return {
          formData: new FormData(),
          projectName: '',
          projectType: '',
          projectDescription: '',
          projectLocation: '',
        };
      },
      methods: {
        handleImageUpload(event) {
          // Handle primary image upload
          const file = event.target.files[0];
          if (file) {
            this.formData.append('primaryImage', file);
          }
        },
        submitForm() {
          // Handle form submission
          this.formData.append('name', this.projectName);
          this.formData.append('description', this.projectDescription);
          this.formData.append('location', this.projectLocation);
          this.formData.append('type', this.projectType);

          // You can now send this.formData to your server using an HTTP request, e.g., axios or fetch
          axios.post('/api/projects/create', this.formData)
            .then(response => {
              console.log('Project successfully added:', response.data);
              alert('Project successfully added!');
                window.location.reload();
            })
            .catch(error => {
              console.error('There was an error adding the project:', error);
            });
        }
      }
    }
    </script>