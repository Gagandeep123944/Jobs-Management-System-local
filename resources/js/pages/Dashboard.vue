<script>
import DashboardLayout from '../Layouts/DashboardLayout.vue';

export default {
  layout: DashboardLayout
};
</script>

<template>
  <div>
    <h2>Dashboard</h2>

    <!-- Cards -->
    <div class="cards">

      <div class="card">
        <p>Flows</p>
        <h3>9</h3>
      </div>

      <div class="card">
        <p>Clients</p>
        <h3>2151</h3>
      </div>

      <div class="card">
        <p>Tech</p>
        <h3>46</h3>
      </div>

      <div class="card">
        <p>Jobs</p>
        <h3>159</h3>
      </div>

    </div>
  </div>
</template>

<style>
.cards {
  display: flex;
  gap: 20px;
  margin-top: 20px;
}

.card {
  background: white;
  padding: 20px;
  border-radius: 10px;
  width: 200px;
  box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}
</style>