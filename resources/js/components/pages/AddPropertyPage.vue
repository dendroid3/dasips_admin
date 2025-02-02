<template>
  <div class="container">
    <form @submit.prevent="submitForm">
      <div>
        <label for="propertyName">Property Name:</label> <br>
        <input type="text" id="propertyName" class="form-control" v-model="propertyName" required>
      </div>
      <div>
        <label for="propertyDescription">Property Description:</label> <br>
        <textarea id="propertyDescription" class="form-control" v-model="propertyDescription" required></textarea>
      </div>
      <div>
        <label for="propertyType">Property Type:</label> <br>
        <input type="text" id="propertyType" class="form-control" v-model="propertyType" required>
      </div>
      <div>
        <label for="propertyLocation">Property Location:</label> <br>
        <input type="text" id="propertyLocation" class="form-control" v-model="propertyLocation" required>
      </div>
      <div>
        <label for="propertyPrice">Property Price:</label> <br>
        <input type="number" id="propertyPrice" class="form-control" v-model="propertyPrice" required>
      </div>
      <div>
        <label for="bedrooms">Bedrooms:</label> <br>
        <input type="number" id="bedrooms" class="form-control" v-model="bedrooms" required>
      </div>
      <div>
        <label for="bathrooms">Bathrooms:</label> <br>
        <input type="number" id="bathrooms" class="form-control" v-model="bathrooms" required>
      </div>
      <div>
        <label for="propertyImage">Primary Image:</label> <br>
        <input type="file" id="propertyImage" class="form-control" @change="handleImageUpload" accept="image/*" required>
      </div>
      <div>
        <label for="secondaryImages">Secondary Images:</label> <br>
        <input type="file" id="secondaryImages" class="form-control" @change="handleSecondaryImagesUpload" accept="image/*" multiple>
      </div>
      <button type="submit" class="btn btn-success mt-4">Add Property</button>
    </form>
  </div>
</template>
<script>
    export default {
      name: 'AddPropertyPage',
      data() {
        return {
          formData: new FormData(),
          propertyName: '',
          propertyDescription: '',
          propertyType: '',
          propertyLocation: '',
          propertyPrice: null,
          bedrooms: null,
          bathrooms: null
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
          console.log('Property added:', {
            name: this.propertyName,
            type: this.propertyType,
            location: this.propertyLocation,
            price: this.propertyPrice,
            bathrooms: this.bathrooms
          });
          this.formData.append('title', this.propertyName);
          this.formData.append('description', this.propertyDescription);
          this.formData.append('property_type', this.propertyType);
          this.formData.append('location', this.propertyLocation);
          this.formData.append('price', this.propertyPrice);
          this.formData.append('bedrooms', this.bedrooms);
          this.formData.append('bathrooms', this.bathrooms);

          // You can now send this.formData to your server using an HTTP request, e.g., axios or fetch
          axios.post('/api/properties/create', this.formData)
            .then(response => {
              console.log('Property successfully added:', response.data);
              alert('Property successfully added!');
                window.location.reload();
            })
            .catch(error => {
              console.error('There was an error adding the property:', error);
            });
        }
      }
    }
    </script>