<template>
  <div class="card">
    <div class="card-header">{{ title }}</div>
    <div class="card-body">
      <slot></slot>
      {{ "Hello" }}
    </div>
  </div>
</template>
<script>
export default {
  props: [
    'title',
    'link'
  ]
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
</style>
