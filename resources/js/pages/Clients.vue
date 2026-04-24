<template>
  <div>

    <!-- Header -->
    <div class="header">
      <h2>Clients</h2>

      <div class="actions">
        <input
          v-model="search"
          @keyup.enter="searchClients"
          type="text"
          placeholder="Search client..."
        />

        <button class="search-btn" @click="searchClients">
          Search
        </button>

        <button class="import-btn" @click="showModal = true">
          Import Client
        </button>

        <!-- Modal -->
        <div v-if="showModal" class="modal">
          <div class="modal-content">
            <h3>Import Clients</h3>

            <input type="file" @change="handleFile" />

            <div class="modal-actions">
              <button @click="uploadFile">Upload</button>
              <button @click="showModal = false">Cancel</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Table -->
    <div class="table-container">
      <table class="custom-table">
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
    </div>

    <!-- Pagination -->
    <div class="pagination">
      <button
        v-for="(link, index) in clients.links"
        :key="index"
        v-html="link.label"
        :disabled="!link.url"
        @click="$inertia.visit(link.url)"
        :class="{ active: link.active }"
      />
    </div>

  </div>
</template>

<script>
import DashboardLayout from '../Layouts/DashboardLayout.vue';
import debounce from 'lodash/debounce';

export default {
  layout: DashboardLayout,

  props: {
    clients: Object,
    filters: Object
  },

  data() {
    return {
      search: this.filters?.search || '',
      showModal: false,
      file: null
    };
  },

  watch: {
    search: debounce(function (value) {
      this.$inertia.get('/clients', {
        search: value
      }, {
        preserveState: true,
        replace: true
      });
    }, 400) // waits 400ms after typing stops
  }, 
  
  methods: {
    handleFile(e) {
      this.file = e.target.files[0];
    },

    uploadFile() {
      if (!this.file) {
        alert('Please select a file');
        return;
      }

      const formData = new FormData();
      formData.append('file', this.file);

      this.$inertia.post('/clients/import', formData, {
        forceFormData: true,
        onSuccess: () => {
          this.showModal = false;
          this.file = null;
        }
      });
    }
  }
};
</script>

<style scoped>

/* Header */
.header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
}

.header h2 {
  font-size: 22px;
  font-weight: 600;
}

/* Actions */
.actions {
  display: flex;
  gap: 10px;
}

.actions input {
  padding: 8px 10px;
  border: 1px solid #ccc;
  border-radius: 6px;
  outline: none;
}

.search-btn {
  background: #111;
  color: white;
  padding: 8px 12px;
  border: none;
  border-radius: 6px;
  cursor: pointer;
}

.search-btn:hover {
  background: #333;
}

.import-btn {
  background: #2563eb;
  color: white;
  padding: 8px 12px;
  border: none;
  border-radius: 6px;
  cursor: pointer;
}

.import-btn:hover {
  background: #1e40af;
}

/* Table */
.table-container {
  background: #fff;
  padding: 15px;
  border-radius: 12px;
  box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.custom-table {
  width: 100%;
  border-collapse: collapse;
}

.custom-table thead {
  background: #f8fafc;
}

.custom-table th {
  text-align: left;
  padding: 12px;
  font-size: 14px;
  color: #555;
}

.custom-table td {
  padding: 12px;
  border-top: 1px solid #eee;
}

.custom-table tbody tr:hover {
  background: #f9fafb;
}

/* Pagination */
.pagination {
  margin-top: 20px;
  display: flex;
  gap: 8px;
  flex-wrap: wrap;
}

.pagination button {
  padding: 6px 10px;
  border: none;
  background: #e5e7eb;
  border-radius: 6px;
  cursor: pointer;
}

.pagination button:hover {
  background: #d1d5db;
}

.pagination button.active {
  background: #111827;
  color: #fff;
}

.pagination button:disabled {
  opacity: 0.5;
  cursor: not-allowed;
}


/** Model Css */

.modal {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0,0,0,0.5);
  display: flex;
  align-items: center;
  justify-content: center;
}

.modal-content {
  background: white;
  padding: 20px;
  border-radius: 10px;
  width: 300px;
}

</style>