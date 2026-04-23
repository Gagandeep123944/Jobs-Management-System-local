<template>
  <div>
    <h2>Clients</h2>

    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Mobile</th>
        </tr>
      </thead>

      <tbody>
        <tr v-for="client in clients.data" :key="client.id">
          <td>{{ client.id }}</td>
          <td>{{ client.name }}</td>
          <td>{{ client.mobile_no }}</td>
        </tr>
      </tbody>
    </table>

    <!-- Pagination -->
    <div class="pagination">
      <button
        v-for="link in clients.links"
        :key="link.label"
        v-html="link.label"
        :disabled="!link.url"
        @click="$inertia.visit(link.url)"
      />
    </div>

  </div>
</template>

<script>
import DashboardLayout from '../Layouts/DashboardLayout.vue';

export default {
  layout: DashboardLayout,
  props: {
    clients: Object
  }
};
</script>