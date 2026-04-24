<template>
  <div class="layout">

    <!-- Sidebar -->
    <div class="sidebar">
      <h3 class="logo">JM System</h3>

      <ul>
        <li :class="{ active: $page.url === '/dashboard' }">
          <Link href="/dashboard">Dashboard</Link>
        </li>

        <li :class="{ active: $page.url.startsWith('/clients') }">
          <Link href="/clients">clients</Link>
        </li>

        <li :class="{ active: $page.url.startsWith('/jobs') }">
          <Link href="/jobs">Jobs</Link>
        </li>

        <li :class="{ active: $page.url === '/create_client' }">
          <Link href="/create_client">Create Client</Link>
        </li>

        <li :class="{ active: $page.url === '/profile' }">
          <Link href="/profile">Profile</Link>
        </li>

        <li :class="{ active: $page.url.startsWith('/technician') }">
          <Link href="/technician">Techs</Link>
        </li>
      </ul>
    </div>

    <!-- Main -->
    <div class="main">

      <!-- Topbar -->
      <div class="topbar">
        <input type="text" placeholder="Type here..." />
        <button>SEARCH</button>

        <div class="user">
          <a href="/logout" style="text-decoration:auto; color:black;"><span>Sign Out</span></a> 
        </div>
      </div>

      <!-- Page Content -->
      <div class="content">
        <slot />
      </div>

    </div>

  </div>
</template>

<script>
import { Link } from '@inertiajs/vue3';

export default {
  components: { Link }
};
</script>

<style>
/* Reset */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

/* Layout */
.layout {
  display: flex;
  min-height: 100vh;
  font-family: Arial, sans-serif;
}

/* Sidebar */
.sidebar {
  width: 240px;
  background: #111827;
  color: #fff;
  padding: 20px;
  position: relative;
  z-index: 10; /* keep above content */
}

.logo {
  font-size: 18px;
  font-weight: bold;
  margin-bottom: 30px;
}

/* Sidebar Menu */
.sidebar ul {
  list-style: none;
}

.sidebar li {
  margin-bottom: 10px;
}

.sidebar a {
  display: block;
  padding: 10px 12px;
  border-radius: 6px;
  color: #cbd5e1;
  text-decoration: none;
  transition: 0.3s;
}

/* Active + Hover */
.sidebar a:hover,
.sidebar .active a {
  background: linear-gradient(to right, #00c6ff, #0072ff);
  color: #fff;
}

/* Main Section */
.main {
  flex: 1;
  display: flex;
  flex-direction: column;
  background: #f1f5f9;
  position: relative;
  z-index: 1;
}

/* Topbar */
.topbar {
  display: flex;
  justify-content: flex-end;
  align-items: center;
  gap: 10px;
  padding: 15px 20px;
  background: #fff;
  border-bottom: 1px solid #e5e7eb;
}

.topbar input {
  padding: 8px 10px;
  border: 1px solid #ccc;
  border-radius: 6px;
  outline: none;
}

.topbar button {
  padding: 8px 12px;
  background: #111;
  color: #fff;
  border: none;
  border-radius: 6px;
  cursor: pointer;
}

.topbar button:hover {
  background: #333;
}

.user {
  margin-left: 15px;
  cursor: pointer;
}

/* Content Area */
.content {
  padding: 20px;
}

/* Dashboard Cards */
.cards {
  display: flex;
  gap: 20px;
  margin-top: 20px;
  flex-wrap: wrap;
}

.card {
  background: #fff;
  padding: 20px;
  border-radius: 12px;
  width: 220px;
  box-shadow: 0 4px 10px rgba(0,0,0,0.05);
  transition: 0.2s;
}

.card:hover {
  transform: translateY(-3px);
}

.card p {
  color: #6b7280;
  margin-bottom: 10px;
}

.card h3 {
  font-size: 22px;
  color: #111827;
}
</style>