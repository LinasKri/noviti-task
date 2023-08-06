<template>
  <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
    <div class="container">
      <router-link
        to="/"
        class="navbar-brand border border-2 rounded-circle p-2 ms-0"
        >LSG</router-link
      >
      <div class="">
        <router-link
          v-for="route in routes"
          :key="route.name"
          :to="route.path"
          class="navbar-brand"
          >{{ route.name }}</router-link
        >
      </div>
    </div>
  </nav>
</template>

<script>
import { ref } from 'vue';

export default {
  setup() {
    const routes = ref([
      {
        name: 'Loan generator',
        path: '/loan-schedule-generator',
      },
      {
        name: 'About',
        path: '/about',
      },
    ]);

    return {
      routes,
    };
  },
};
</script>
