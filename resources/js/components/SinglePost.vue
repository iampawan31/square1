<template>
  <div class="px-4 py-6 sm:px-0">
    <div
      class="p-6 border-1 shadow border-solid bg-white border-gray-500 rounded-lg"
    >
      <a :href="post.slug" class="text-2xl">{{ post.title }}</a>
      <p>{{ post.description }}</p>
    </div>
  </div>
</template>

<script>
export default {
  name: "SinglePost",
};
</script>

<style>
</style>
