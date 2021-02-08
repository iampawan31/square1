<template>
  <div columns>
    <div class="column is-6 is-offset-3">
      <h1 class="has-text-centered is-size-2">My Posts</h1>
      <div v-if="posts">
        <Post :post="post" v-for="post in posts" :key="post.id" />
      </div>
      <div v-else>
        <h1>No Posts found...</h1>
      </div>
    </div>
  </div>
</template>

<script>
import Post from "./Post";
import { mapGetters } from "vuex";
export default {
  name: "Dashboard",
  components: {
    Post,
  },
  computed: {
    ...mapGetters({
      posts: "userPosts",
    }),
  },
  async mounted() {
    await this.axios
      .get("/api/v1/posts/user")
      .then((res) => {
        this.$store.dispatch("setUserPosts", res.data);
      })
      .catch((err) => {});
  },
};
</script>

<style>
</style>
