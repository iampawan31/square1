<template>
  <div class="columns">
    <div class="column is-6 is-offset-3">
      <h1 class="is-size-2 has-text-centered mb-3">New Post</h1>
      <div class="card">
        <div class="card-content">
          <div class="content">
            <div class="field">
              <label class="label">Title</label>
              <div class="control">
                <input
                  v-model="form.title"
                  class="input"
                  type="text"
                  placeholder="title goes here..."
                />
              </div>
            </div>

            <div class="field">
              <label class="label">Publication Date</label>
              <div class="control has-icons-left has-icons-right">
                <input
                  v-model="form.publication_date"
                  class="input"
                  type="date"
                  placeholder="Select Date"
                />
                <span class="icon is-small is-left">
                  <i class="fas fa-calendar"></i>
                </span>
              </div>
            </div>

            <div class="field">
              <label class="label">Description</label>
              <div class="control">
                <textarea
                  v-model="form.description"
                  class="textarea"
                  placeholder="content goes here..."
                ></textarea>
              </div>
            </div>

            <div class="field is-grouped">
              <div class="control">
                <button class="button is-warning" @click="savePost">
                  Save Post
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "CreatePost",
  data() {
    return {
      form: {
        title: null,
        description: null,
        publication_date: null,
      },
    };
  },
  methods: {
    async savePost() {
      try {
        await this.axios.post("/api/v1/posts", this.form).then((res) => {
          this.$router.push("/dashboard");
        });
      } catch (error) {
        console.log(error);
      }
    },
  },
};
</script>

<style>
</style>
