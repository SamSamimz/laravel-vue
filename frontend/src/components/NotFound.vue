<template>
  <div class="full-layout">
    <h2 class="text-secondary">404 - Not Found</h2>
    <div>
      <router-link to="/"> Home </router-link>
    </div>
  </div>
</template>

  <script>
export default {
  name: "NotFount",
};
</script>

<style>
.full-layout {
  height: 100vh;
  width: 100vw;
  display: flex;
  align-items: center;
  justify-content: center;
}
</style>