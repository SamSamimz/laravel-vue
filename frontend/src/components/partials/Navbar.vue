<template>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
      <router-link class="navbar-brand" to="/">Full-stack</router-link>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <router-link to="/" class="nav-link active">Home</router-link>
          </li>
          <li class="nav-item">
            <a class="nav-link">Categories</a>
          </li>
          <li class="nav-item">
            <a class="nav-link">Posts</a>
          </li>
          <li class="nav-item">
            <a class="nav-link">Users</a>
          </li>
        </ul>
        <div v-if="isGuest" class="d-flex gap-1">
          <router-link class="btn btn-primary" to="/login">Login</router-link>
          <router-link class="btn btn-warning" to="/register"
            >Register</router-link
          >
        </div>
        <div v-if="isAuth">
          <button class="btn btn-danger" @click="logout">Logout</button>
        </div>
      </div>
    </div>
  </nav>
</template>

<script>
import axios from "axios";
import { auth } from "../../guards/auth";
import { guest } from "../../guards/guest";

export default {
  name: "Navbar",
  data() {
    return {
      isAuth: false,
      isGuest: false,
    };
  },
  mounted() {
    this.isAuth = auth(this.$router);
    this.isGuest = guest(this.$router);
  },
  methods: {
    async logout() {
      try {
        const token = localStorage.getItem("auth_token");

        if (!token) {
          console.error("No auth token found in localStorage");
          return;
        }

        const response = await axios.post(
          "http://localhost:8000/api/logout",
          {},
          {
            headers: {
              Authorization: `Bearer ${token}`,
            },
          }
        );
        console.log(response.data.success);
        if (response.data.success) {
          localStorage.removeItem("auth_token");
          this.$router.push({ name: "Login" });
        }
      } catch (error) {
        console.error("Error logging out:", error);
      }
    },
  },
};
</script>

<style>
</style>