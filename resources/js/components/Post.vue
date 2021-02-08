<template>
  <div class="columns">
    <div class="column">
      <div class="card">
        <div class="card-content">
          <div class="content">
            <a :href="post.slug"
              ><h5 class="card-title">
                {{ post.title }}
              </h5></a
            >
            <span class="tag is-warning mb-3">
              Published {{ post.published_on }}
            </span>
            <br />
            {{ post.description }}
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["post"],
};
</script>

<style>
</style>
