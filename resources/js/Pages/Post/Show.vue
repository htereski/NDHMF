<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import formatDate from '@/Utils/FormatDate.js'
import { Link, useForm } from '@inertiajs/vue3'
import SecondaryButton from '@/Components/SecondaryButton.vue'

const props = defineProps({
  post: Object,
  user: Object,
})

const form = useForm({})

function deletePost() {
  if (confirm('Tem certeza que deseja excluir este post?')) {
    form.delete(route('post.destroy', props.post.id))
  }
}
</script>

<template>
  <AppLayout
    title="Núcleo de Direitos Humanos Marielle Franco - Postagens"
    :isAuthenticated="user"
    :user="user"
  >
    <div class="container mx-auto max-w-4xl mt-8">
      <Link :href="route('post.index')">
        <SecondaryButton class="mb-4">Voltar</SecondaryButton>
      </Link>
    </div>

    <div class="container flex justify-center mx-auto">
      <div
        class="container max-w-4xl my-8 bg-white shadow-lg rounded-s-lg rounded-br-lg p-6"
      >
        <div class="flex justify-center my-6">
          <img :src="post.imagem" alt="foto" />
        </div>
        <h2 class="text-3xl font-bold text-gray-800 mb-4 text-center">
          {{ post.titulo }}
        </h2>

        <span class="text-black px-2 py-1 bg-slate-300 rounded">Criado:</span>
        <p class="prose-md mt-1 mb-3">
          {{ formatDate(post.created_at) }} por {{ post.user.name }}
        </p>

        <template v-if="post.editors && post.editors.length > 0">
          <span class="mt-3 text-black px-2 py-1 bg-slate-300 rounded"
            >Edições:</span
          >
          <template v-for="editors in post.editors" :key="editors.id">
            <p class="prose-md mt-1">
              {{ formatDate(editors.pivot.created_at) }} por {{ editors.name }}
            </p>
          </template>
        </template>

        <div
          class="my-8 prose-lg text-justify text-black w-full indent-10"
          v-html="post.texto"
        ></div>
      </div>
      <div
        class="my-8 bg-white flex flex-col gap-2 rounded-r-lg p-6 w-fit h-fit"
      >
        <Link :href="route('post.edit', post)">Editar</Link>
        <button
          class="text-red-600 hover:text-red-800 underline"
          @click="deletePost"
        >
          Excluir
        </button>
      </div>
    </div>
  </AppLayout>
</template>
