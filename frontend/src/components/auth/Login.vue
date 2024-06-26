<template>
  <guest-layout>
    <div class="container">
      <div class="login-container mx-auto">
        <h2 class="text-center mb-4">Login</h2>
        <div v-if="hasErrors">
          <ul v-for="err in this.errors" :key="err.id">
            <li class="text-danger">{{ err }}</li>
          </ul>
        </div>
        <form @submit.prevent="loginUser()">
          <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input
              type="email"
              class="form-control"
              id="email"
              placeholder="Enter your email"
              v-model="credentials.email"
            />
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input
              type="password"
              class="form-control"
              id="password"
              placeholder="Enter your password"
              autocomplete="off"
              v-model="credentials.password"
            />
          </div>
          <div class="text-center">
            <button type="submit" class="btn btn-primary w-100">Login</button>
            <router-link to="/register">Register page.</router-link>
          </div>
        </form>
      </div>
    </div>
  </guest-layout>
</template>

<script>
import axios from "axios";
import GuestLayout from "../layouts/GuestLayout.vue";
export default {
  components: { GuestLayout },
  computed: {
    hasErrors() {
      return this.errors.length > 0;
    },
  },
  data() {
    return {
      errors: [],
      credentials: {
        email: "",
        password: "",
      },
    };
  },
  methods: {
    async loginUser() {
      this.validate();
      if (!this.hasErrors) {
        try {
          const response = await axios.post(
            "http://localhost:8000/api/login",
            this.credentials,
            {
              headers: {
                "Content-Type": "application/json",
                Accept: "application/json",
              },
            }
          );
          if (response.data.invalid) {
            this.resetForm();
            this.errors.push(response.data.invalid);
          }
          if (response.data.success) {
            localStorage.setItem("auth_token", response.data.token);
            this.$router.push({ name: "Home" });
          }
        } catch (e) {
          console.error(e);
        }
      }
    },
    validate() {
      if (!this.credentials.email.trim()) {
        this.errors.push("Please enter a email");
      }
      if (!this.credentials.password.trim()) {
        this.errors.push("Please enter a password");
      }
    },
    resetForm() {
      this.credentials.email = "";
      this.credentials.password = "";
    },
  },
};
</script>

<style scoped>
.login-container {
  max-width: 460px;
  padding: 20px;
  background-color: #ffffff;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  border-radius: 8px;
}

.form-control:focus {
  box-shadow: none;
  border-color: #007bff;
}

.btn-primary {
  background-color: #007bff;
  border: none;
}

.btn-primary:hover {
  background-color: #0056b3;
}
</style>