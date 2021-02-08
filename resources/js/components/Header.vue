<template>
  <nav class="navbar is-warning" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
      <a class="navbar-item" href="/">Blog</a>

      <a
        role="button"
        class="navbar-burger"
        aria-label="menu"
        aria-expanded="false"
        data-target="navbarBasicExample"
      >
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
      </a>
    </div>

    <div id="navbarBasicExample" class="navbar-menu">
      <div v-if="isLoggedIn" class="navbar-end">
        <a href="/posts/create" class="navbar-item"> Create Post </a>
        <a href="/dashboard" class="navbar-item"> Dashboard </a>
        <div class="navbar-item">
          <a @click="logout" class="button is-black">Logout</a>
        </div>
      </div>
      <div v-else class="navbar-end">
        <div class="navbar-item">
          <div class="buttons">
            <a href="/register" class="button is-black">
              <strong>Register</strong>
            </a>
            <a href="/login" class="button is-white"> Log in </a>
          </div>
        </div>
      </div>
    </div>
  </nav>
</template>

<script>
import { mapGetters } from "vuex";
export default {
  name: "Header",
  data: function () {
    return {};
  },
  computed: {
    ...mapGetters(["isLoggedIn"]),
  },
  methods: {
    async logout() {
      try {
        await this.axios("/logout").then((res) => {
          this.$store.dispatch("logoutUser");
        });
      } catch (error) {}
    },
  },
};
</script>

<style scopeddd>
.navbar {
  margin-bottom: 50px;
}
</style>
