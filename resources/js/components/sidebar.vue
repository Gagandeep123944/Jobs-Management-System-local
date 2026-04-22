<template>
  <div class="sidebar bg-dark text-white p-3">
    <h4 class="mb-4">POWER AI</h4>

    <ul class="nav flex-column">
      <li class="nav-item">
        <router-link class="nav-link text-white" to="/dashboard">Dashboard</router-link>
      </li>
      <li class="nav-item">
        <router-link class="nav-link text-white" to="/clients">Clients</router-link> 
      </li>
      <li class="nav-item">
        <a class="nav-link text-white">Jobs</a>
      </li>
    </ul>
  </div>
</template>

<style>
.sidebar {
  width: 250px;
  height: 100vh;
  position: fixed;
}
.nav-link:hover {
  background: #0d6efd;
  border-radius: 5px;
}
</style>