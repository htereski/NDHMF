<script setup>
import { Link } from '@inertiajs/vue3'
import ApplicationMarkVue from './ApplicationMark.vue'
</script>

<template>
  <Link :href="'/'">
    <ApplicationMarkVue
      style="width: 100px; height: auto; border-radius: 50%"
    />
  </Link>
</template>
