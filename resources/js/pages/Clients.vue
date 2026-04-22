<template>
  <div>
    <h4>Clients</h4>

    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Address</th>
          <th>Mobile</th>
        </tr>
      </thead>

      <tbody>
        <tr v-for="client in clients" :key="client.id">
          <td>{{ client.id }}</td>
          <td>{{ client.name }}</td>
          <td>{{ client.address }}</td>
          <td>{{ client.mobile_no }}</td> 
        </tr>
      </tbody>
    </table>

  </div>
</template>

<script>
export default {
  data() {
    return {
      clients: []
    };
  },

  mounted() {
    this.getClients();
  },

  methods: {
    async getClients() {
      const res = await fetch('/api/clients');
      this.clients = await res.json();
    }
  }
};
</script>