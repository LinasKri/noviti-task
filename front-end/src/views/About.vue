<template>
  <header class="masthead text-center text-white min-vh-100">
    <div class="masthead-content">
      <div class="container px-5">
        <h1 class="masthead-heading mb-0">Comming soon...</h1>
      </div>
    </div>
    <div v-for="i in 4" :key="i" :class="['bg-circle-' + i, 'bg-circle']"></div>
  </header>
</template>
