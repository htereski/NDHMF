<script setup>
import Layout from '@/Layouts/Layout.vue'
import formatDate from '@/Utils/FormatDate.js'
import { Link, useForm } from '@inertiajs/vue3'
import SecondaryButton from '@/Components/SecondaryButton.vue'
import Pencil from 'vue-material-design-icons/Pencil.vue'
import Delete from 'vue-material-design-icons/Delete.vue'
import toast from '@/Stores/toast'
import PrimaryButton from '@/Components/PrimaryButton.vue'

const props = defineProps({
  post: Object,
})

const form = useForm({})

function deletePost() {
  form.delete(route('post.destroy', props.post.id), {
    onSuccess: () => {
      addToast('Postagem excluida com sucesso!', 'success')
    },
    onError: () => {
      addToast('Erro ao excluir postagem.', 'error')
    },
  })
}

function openModal() {
  const modal = document.getElementById('my_modal_1')
  modal.showModal()
}

function addToast(message, type) {
  toast.add({ message: message, type: type })
}
</script>

<template>
  <Layout
    title="Núcleo de Direitos Humanos Marielle Franco - Postagens"
    :isAuthenticated="$page.props.auth.user"
    :user="$page.props.auth.user"
  >
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ post.titulo }}
      </h2>
    </template>

    <div class="container mx-auto max-w-4xl mt-8">
      <Link :href="route('post.index')">
        <SecondaryButton class="mb-4">Voltar</SecondaryButton>
      </Link>
    </div>

    <div class="container flex flex-col mx-auto items-center">
      <div
        v-if="$page.props.auth.user && $page.props.auth.user.role != 'VITIMA'"
        class="container mx-auto max-w-4xl flex justify-end"
      >
        <div
          class="mt-8 bg-white flex gap-3 rounded-tl-lg rounded-tr-lg p-4 w-fit h-fit"
        >
          <Link
            :href="route('post.edit', post)"
            class="text-blue-600 hover:text-blue-800"
          >
            <Pencil />
          </Link>
          <button class="text-red-600 hover:text-red-800" @click="openModal">
            <Delete />
          </button>
        </div>
      </div>
      <div
        class="container max-w-4xl bg-white shadow-lg rounded-s-lg rounded-br-lg p-6"
      >
        <div class="flex justify-center my-6">
          <img :src="post.imagem" alt="foto" />
        </div>
        <h2 class="text-5xl font-bold text-gray-800 mb-4 text-center">
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
              {{ formatDate(editors.created_at) }} por {{ editors.name }}
            </p>
          </template>
        </template>

        <div
          class="my-8 prose-lg text-justify text-black w-full indent-10 custom-html-content"
          v-html="post.texto"
        ></div>
      </div>
    </div>

    <dialog id="my_modal_1" class="modal">
      <div class="modal-box min-h-96 bg-slate-50 flex flex-col">
        <form method="dialog">
          <button
            class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2"
          >
            ✕
          </button>
        </form>
        <div
          class="flex flex-col grow items-center justify-center text-justify"
        >
          <p class="text-black text-xl">
            Deseja mesmo apagar a postagem {{ post.titulo }}?
          </p>
          <div class="flex gap-4 mt-8">
            <SecondaryButton @click="deletePost">Sim</SecondaryButton>
            <form method="dialog">
              <PrimaryButton type="submit">Não</PrimaryButton>
            </form>
          </div>
        </div>
      </div>
    </dialog>
  </Layout>
</template>
