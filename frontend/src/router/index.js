import { createRouter, createWebHistory } from 'vue-router';
import Home from '../views/Home.vue';
import Auth from '../views/Auth.vue';
import Component404 from '../views/Component404.vue';

const routes = [
  { path: '/', component: Home, name: 'Home', alias: ['/home'] },
  { path: '/login', name: 'login', components: Auth },
  { path: '/:pathMatch(.*)', component: Component404 }
];

const router = createRouter({
  history: createWebHistory(), routes
})

export default router
