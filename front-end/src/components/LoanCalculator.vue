<template>
  <div>
    <h1>{{ message }}</h1>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      message: '',
    };
  },
  mounted() {
    this.fetchMessage();
  },
  methods: {
    async fetchMessage() {
      try {
        const response = await axios.get('/api/noviti', {
          headers: { Accept: 'application/json' },
        });
        this.message = response.data.message;
      } catch (error) {
        console.error(error);
      }
    },
  },
};
</script>
