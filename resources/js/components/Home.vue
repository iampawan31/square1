<template>
  <div>
    <div class="columns">
      <div class="column is-6 is-offset-3 has-text-right">
        <button
          :class="loading ? 'is-loading' : ''"
          @click="loadSortedPost"
          class="button is-black"
        >
          <span>Sort By Date</span>
          <span class="icon is-small">
            <i
              :class="
                sortByLatest ? 'fa-sort-amount-down' : 'fa-sort-amount-up'
              "
              class="fas"
            ></i>
          </span>
        </button>
      </div>
    </div>
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
          <Post :post="post" v-for="post in posts" :key="post.id" />
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
      sortByLatest: true,
      prevPage: null,
      nextPage: null,
    };
  },
  methods: {
    async loadSortedPost() {
      this.sortByLatest = !this.sortByLatest;
      this.loading = true;
      await this.axios
        .get(`api/v1/posts?sortByLatest=${this.sortByLatest}`)
        .then((res) => {
          this.loading = false;
          this.posts = res.data;
        });
    },
  },
  async mounted() {
    await this.axios
      .get(`api/v1/posts?sortByLatest=${this.sortByLatest}`)
      .then((res) => {
        console.log(res);
        this.loading = false;
        this.posts = res.data;
      });
  },
};
</script>

<style>
</style>
