<template>
  <Header />
  <router-view></router-view>
</template>

<script>
import LoanScheduleGenerator from './components/LoanScheduleGenerator.vue';
import Header from './components/layouts/Header.vue';

export default {
  name: 'App',
  components: {
    Header,
  },
};
</script>
