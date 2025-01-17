<script setup>
defineProps({
  description: {
    type: String,
    required: true,
  },
  items: {
    type: Array,
    required: true,
    default: () => [],
  },
})
</script>

<template>
  <div
    class="bg-[#abe58283] rounded-lg flex flex-col justify-center items-center text-justify p-10 text-black shadow-xl"
  >
    <p class="pb-10 text-center text-lg">{{ description }}</p>
    <ul class="w-full">
      <li v-for="(item, index) in items" :key="index" class="pt-2">
        <strong class="font-semibold">{{ item.title }}</strong>
        <em v-if="item.subtitle"> ({{ item.subtitle }})</em>:
        {{ item.address }}
      </li>
    </ul>
  </div>
</template>
