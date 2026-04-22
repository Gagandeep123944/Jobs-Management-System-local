import { createRouter, createWebHistory } from 'vue-router';
import Dashboard from '../pages/Dashboard.vue';
import Clients from '../pages/Clients.vue';

const routes = [
  { path: '/dashboard', component: Dashboard },
  { path: '/clients', component : Clients }
];

export default createRouter({
  history: createWebHistory(),
  routes,
});