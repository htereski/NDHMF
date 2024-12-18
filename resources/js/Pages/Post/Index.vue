<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import BoldIcon from 'vue-material-design-icons/FormatBold.vue'
import { Link } from '@inertiajs/vue3'

const props = defineProps({
  posts: Array,
  user: Object,
})
</script>
<template>
  <AppLayout
    title="Núcleo de Direitos Humanos Marielle Franco - Postagens"
    :isAuthenticated="user"
    :user="user"
  >
    <div class="container mx-auto my-8 bg-gray-200 shadow-lg rounded-lg p-6">
      <h2 class="text-2xl text-black mb-5">Postagens</h2>

      <template v-if="user">
        <Link v-if="user.role.name != 'vitima'" :href="route('post.create')">
          <PrimaryButton class="mb-4">Criar postagem</PrimaryButton>
        </Link>
      </template>

      <div class="flex flex-wrap justify-center gap-6">
        <template v-for="post in posts" :key="post.id">
          <Link :href="route('post.show', post)">
            <div class="card w-80 h-96 shadow-xl rounded-3xl bg-white">
              <figure class="h-2/3">
                <span
                  class="absolute inset-0 flex items-start justify-end pr-5 pt-2 text-black"
                >
                </span>
                <img
                  :src="post.imagem"
                  alt="foto"
                  class="w-full h-full object-cover"
                />
              </figure>
              <div class="card-body h-1/3">
                <h2 class="card-title h-full text-black mx-auto">
                  {{ post.titulo }}
                </h2>
              </div>
            </div>
          </Link>
        </template>
      </div>
    </div>
  </AppLayout>
</template>
