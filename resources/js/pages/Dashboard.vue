<template>
  <div>
    <h2>Dashboard</h2>
    <p>Welcome {{ user.name }}</p>
  </div>
</template>

<script>
export default {
  props: {
    user: Object
  }
};
</script>