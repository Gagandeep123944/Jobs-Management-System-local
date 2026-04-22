<template>
  <div>
    <h4 class="mb-4">Dashboard</h4>

    <div class="row">

      <div class="col-md-3" v-for="card in cards" :key="card.title">
        <div class="card shadow-sm mb-4">
          <div class="card-body d-flex justify-content-between align-items-center">
            
            <div>
              <p class="mb-1">{{ card.title }}</p>
              <h5>{{ card.value }}</h5>
            </div>

            <div class="icon-box">
              <i :class="card.icon"></i>
            </div>

          </div>
        </div>
      </div>

    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      cards: [
        { title: 'Flows', value: 9, icon: 'fa fa-table' },
        { title: 'Clients', value: 2141, icon: 'fa fa-user' },
        { title: 'Tech', value: 46, icon: 'fa fa-cog' },
        { title: 'Jobs', value: 158, icon: 'fa fa-briefcase' },
      ]
    }
  }
}
</script>

<style>
.icon-box {
  width: 40px;
  height: 40px;
  background: #0d6efd;
  color: white;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 8px;
}
</style>