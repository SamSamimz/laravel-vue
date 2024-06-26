<template>
  <app-layout>
    <Navbar />
    <div class="container">
      <h1 class="text-center py-3">Welcome to full-stack</h1>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "./layouts/AppLayout.vue";
import Navbar from "./partials/Navbar.vue";
export default {
  name: "Home",
  components: {
    AppLayout,
    Navbar,
  },
};
</script>