<template>
  <div columns>
    <div class="column is-4 is-offset-4">
      <div class="card">
        <div class="card-content">
          <div class="content">
            <h1 class="is-size-3 has-text-centered">Login</h1>
            <div class="field">
              <p class="control has-icons-left has-icons-right">
                <input
                  v-model="form.email"
                  class="input"
                  type="email"
                  placeholder="Email"
                />
                <span class="icon is-small is-left">
                  <i class="fas fa-envelope"></i>
                </span>
              </p>
            </div>
            <div class="field">
              <p class="control has-icons-left">
                <input
                  v-model="form.password"
                  class="input"
                  type="password"
                  placeholder="Password"
                />
                <span class="icon is-small is-left">
                  <i class="fas fa-lock"></i>
                </span>
              </p>
            </div>
            <div class="field">
              <p class="control">
                <button @click="login" class="button is-success">Login</button>
              </p>
            </div>
            <div v-if="errorMessage" class="notification is-danger">
              <button @click="errorMessage = null" class="delete"></button>
              {{ errorMessage }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { logIn } from "../utils";
export default {
  name: "Login",
  data: function () {
    return {
      form: {
        email: null,
        password: null,
      },
      errorMessage: null,
    };
  },
  methods: {
    async login() {
      try {
        await this.axios.get("/sanctum/csrf-cookie");
        await this.axios
          .post("/login", {
            email: this.form.email,
            password: this.form.password,
          })
          .then((res) => {
            logIn();
            this.$store.dispatch("loadUser");
            this.$router.push("/");
          })
          .catch((err) => (this.errorMessage = err.response.data));
      } catch (error) {
        console.log(error);
      }
    },
  },
};
</script>

<style>
</style>
