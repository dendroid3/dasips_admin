<template>
  <div 
    class="card pointer"
    @click="navigate"
  >
    <div class="card-header">{{ title }}</div>
    <div class="card-body">
      <slot></slot>
      {{ count }}
    </div>
  </div>
</template>
<script>
export default {
  props: [
    'title',
    'link',
    'url'
  ],

  data() {
    return {
      count: 0
    }
  },

  methods: {
    navigate() {
      window.location.href = this.link;
    }
  },

  mounted() {
    fetch(`${this.url}`)
      .then(response => response.json())
      .then(data => {
        this.count = data;
      })
      .then(json => console.log(json))
    }
}
</script>
<style scoped>
.card {
  border: 1px solid #ccc;
  border-radius: 4px;
  margin-bottom: 1rem;
  cursor: pointer;
}
.card-header {
  background-color: #00B98E;
  border-bottom: 1px solid #ccc;
  padding: 0.75rem 1.25rem;
}
.card-body {
  padding: 1.25rem;
}
.pointer{
  cursor: pointer;
}
</style>
