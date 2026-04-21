<script setup>
import Navbar from '../components/Navbar.vue'
import Sidebar from '../components/Sidebar.vue'
import Dashboard from '../pages/Dashboard.vue'
</script>

<template>
  <div class="layout">
    <Sidebar />

    <div class="main">
      <Navbar />
      <Dashboard />
    </div>
  </div>
</template>

<style>
.layout {
  display: flex;
}

.main {
  flex: 1;
  padding: 20px;
}
</style>