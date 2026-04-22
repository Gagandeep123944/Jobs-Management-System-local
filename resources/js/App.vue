<template>
  <div class="d-flex">
    
    <Sidebar />

    <div class="main-content w-100 p-4">
      <router-view />
    </div>

  </div>
</template>

<script>
import Sidebar from './components/Sidebar.vue';

export default {
  components: { Sidebar }
};
</script>

<style>
.main-content {
  margin-left: 250px;
}
</style>