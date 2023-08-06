import { createRouter, createWebHistory } from 'vue-router';
import LoanScheduleGenerator from '../views/LoanScheduleGenerator.vue';
import About from '../views/About.vue';
import Home from '../views/Home.vue';

const router = createRouter({
  history: createWebHistory(),
  routes: [
    {
      path: '/',
      name: 'home',
      component: Home,
    },
    {
      path: '/loan-schedule-generator',
      name: 'loan-generator',
      component: LoanScheduleGenerator,
    },
    {
      path: '/about',
      name: 'about',
      component: About,
    },
  ],
});

export default router;
