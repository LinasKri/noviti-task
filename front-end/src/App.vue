<template>
  <Header />
  <LoanScheduleGenerator />
</template>

<script>
import LoanScheduleGenerator from './components/LoanScheduleGenerator.vue';
import Header from './components/layouts/Header.vue';

export default {
  name: 'App',
  components: {
    LoanScheduleGenerator,
    Header,
  },
};
</script>
