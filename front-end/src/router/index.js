import { createRouter, createWebHistory } from 'vue-router';
import LoanScheduleGenerator from '../components/LoanScheduleGenerator.vue';
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
  ],
});

export default router;
