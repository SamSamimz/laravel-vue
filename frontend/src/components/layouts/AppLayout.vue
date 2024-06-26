<template>
  <slot></slot>
</template>

<script>
import { auth } from "../../guards/auth";

export default {
  name: "AppLayout",
  mounted() {
    auth(this.$router);
  },
};
</script>

<style>
</style>