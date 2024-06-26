<template>
  <slot></slot>
</template>

<script>
import { guest } from "../../guards/guest";
export default {
  name: "GuestLayout",
  mounted() {
    guest(this.$router);
  },
};
</script>

<style>
</style>