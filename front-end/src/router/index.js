import { createRouter, createWebHistory } from 'vue-router';
import App from '../App.vue';
import LoanScheduleGenerator from '../components/LoanScheduleGenerator.vue';

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: LoanScheduleGenerator,
    },
    // {
    //   path: '/about',
    //   name: 'about',
    // },
  ],
});

export default router;
