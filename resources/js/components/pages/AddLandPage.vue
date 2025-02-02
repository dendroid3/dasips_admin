<template>
  <div class="container">
    <form @submit.prevent="submitForm">
      <div>
        <label for="landName">Land Name:</label> <br>
        <input type="text" id="landName" class="form-control" v-model="landName" required>
      </div>
      <div>
        <label for="landDescription">Land Description:</label> <br>
        <textarea id="landDescription" class="form-control" v-model="landDescription" required></textarea>
      </div>
      <div>
        <label for="landLocation">Land Location:</label> <br>
        <input type="text" id="landLocation" class="form-control" v-model="landLocation" required>
      </div>
      <div>
        <label for="landPrice">Land Price:</label> <br>
        <input type="number" id="landPrice" class="form-control" v-model="landPrice" required>
      </div>
      <div>
        <label for="landImage">Primary Image:</label> <br>
        <input type="file" id="landImage" class="form-control" @change="handleImageUpload" accept="image/*" required>
      </div>
      <div>
        <label for="secondaryImages">Secondary Images:</label> <br>
        <input type="file" id="secondaryImages" class="form-control" @change="handleSecondaryImagesUpload" accept="image/*" multiple>
      </div>
      <button type="submit" class="btn btn-success mt-4">Add Land</button>
    </form>
  </div>
</template>
<script>
    export default {
      name: 'AddLandPage',
      data() {
        return {
          formData: new FormData(),
          landName: '',
          landDescription: '',
          landLocation: '',
          landPrice: null,
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
        handleSecondaryImagesUpload(event) {
          // Handle secondary images upload
          const files = event.target.files;
          if (files) {
            for (let i = 0; i < files.length; i++) {
              this.formData.append('secondaryImages[]', files[i]);
            }
          }
        },
        submitForm() {
          // Handle form submission
          
          this.formData.append('title', this.landName);
          this.formData.append('description', this.landDescription);
          this.formData.append('location', this.landLocation);
          this.formData.append('price', this.landPrice);

          // You can now send this.formData to your server using an HTTP request, e.g., axios or fetch
          axios.post('/api/land/create', this.formData)
            .then(response => {
              console.log('Land successfully added:', response.data);
              alert('Land successfully added!');
                window.location.reload();
            })
            .catch(error => {
              console.error('There was an error adding the land:', error);
            });
        }
      }
    }
    </script>