<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import { Link } from '@inertiajs/vue3'

const props = defineProps({
  posts: Array,
  user: Object,
})
</script>

<template>
  <AppLayout title="Postagens" :isAuthenticated="user" :user="user">
    <div
      class="bg-green-400 min-w-full h-[200px] flex justify-center items-center text-center"
    >
      <h2 class="text-2xl text-white mb-5">
        Fique por dentro das últimas postagens
      </h2>
    </div>

    <div
      class="container mx-auto bg-gray-200 shadow-md p-6 flex flex-col items-start"
    >
      <template v-if="user">
        <Link v-if="user.role.name != 'vitima'" :href="route('post.create')">
          <PrimaryButton class="mb-4">Criar postagem</PrimaryButton>
        </Link>
      </template>

      <div class="flex flex-wrap justify-start gap-6">
        <template v-for="post in posts" :key="post.id">
          <Link :href="route('post.show', post)">
            <div class="card w-80 h-96 shadow-xl rounded-xl bg-green-400">
              <figure class="h-2/3 p-2">
                <span
                  class="absolute inset-0 flex items-start justify-end text-black"
                >
                </span>
                <img
                  :src="post.imagem"
                  alt="foto"
                  class="w-full h-full object-cover rounded bg-white"
                />
              </figure>
              <div class="card-body h-1/3">
                <h2 class="card-title text-black mx-auto">
                  {{ post.titulo }}
                </h2>
                <div
                  class="truncate prose text-black"
                  v-html="post.texto"
                ></div>
              </div>
            </div>
          </Link>
        </template>
      </div>
    </div>
  </AppLayout>
</template>
