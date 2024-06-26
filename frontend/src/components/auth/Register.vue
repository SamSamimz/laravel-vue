<template>
  <guest-layout>
    <div class="container">
      <div class="container">
        <div class="register-container mx-auto">
          <h2 class="text-center mb-4">Register now</h2>
          <div v-if="hasErrors">
            <ul v-for="err in this.errors" :key="err.id">
              <li class="text-danger">{{ err }}</li>
            </ul>
          </div>
          <form @submit.prevent="registerUser()">
            <div class="mb-3">
              <label for="name" class="form-label">Full name</label>
              <input
                type="text"
                class="form-control"
                id="name"
                placeholder="Enter your name"
                v-model="credentials.name"
              />
            </div>
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
                v-model="credentials.password"
                autocomplete="off"
              />
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-primary w-100">
                Register
              </button>
              <router-link to="/login">Login page.</router-link>
            </div>
          </form>
        </div>
      </div>
    </div>
  </guest-layout>
</template>

<script>
import GuestLayout from "../layouts/GuestLayout.vue";
import axios from "axios";
export default {
  data() {
    return {
      errors: [],
      credentials: {
        name: "",
        email: "",
        password: "",
      },
    };
  },
  methods: {
    async registerUser() {
      this.validateForm();
      if (!this.hasErrors) {
        try {
          const response = await axios.post(
            "http://localhost:8000/api/register",
            this.credentials,
            {
              headers: {
                "Content-Type": "application/json",
                Accept: "application/json",
              },
            }
          );
          this.clearInput();
          if (response.data.success) {
            console.log(response.data);
          }
        } catch (e) {
          console.error(e);
        }
      }
    },
    clearInput() {
      this.credentials.email = "";
      this.credentials.name = "";
      this.credentials.password = "";
    },
    validateForm() {
      this.errors = [];
      if (!this.credentials.name.trim()) {
        this.errors.push("Please enter a name");
      }
      if (!this.credentials.email.trim()) {
        this.errors.push("Please enter a email");
      }
      if (!this.credentials.password.trim()) {
        this.errors.push("Please enter a password");
      }
    },
  },
  computed: {
    hasErrors() {
      return this.errors.length > 0;
    },
  },
  components: { GuestLayout },
};
</script>

<style scoped>
.register-container {
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