<template>
  <div>
    <div v-if="loading" class="columns">
      <div class="column is-half is-offset-one-quarter">
        <div class="card">
          <div class="card-content has-text-centered">
            <p class="title">Loading Posts...</p>
          </div>
        </div>
      </div>
    </div>
    <div v-else>
      <div columns>
        <div class="column is-6 is-offset-3">
          <Post :post="post" v-for="post in posts.data" :key="post.id" />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Post from "./Post";
export default {
  name: "Home",
  components: {
    Post,
  },
  data() {
    return {
      posts: null,
      loading: true,
    };
  },
  async mounted() {
    await this.axios.get("api/v1/posts").then((res) => {
      this.loading = false;
      this.posts = res.data;
    });
  },
};
</script>

<style>
</style>
