<script setup>
import Layout from '@/Layouts/Layout.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import SecondaryButton from '@/Components/SecondaryButton.vue'
import Editor from '@/Components/Editor.vue'
import { useForm } from '@inertiajs/vue3'

const props = defineProps({
  user: Object,
  post: Object,
})

const form = useForm({
  titulo: props.post.titulo,
  texto: props.post.texto,
  imagem: null,
  previewImg: props.post.imagem,
})

function change(event) {
  form.imagem = event.target.files[0]
  form.previewImg = URL.createObjectURL(event.target.files[0])
}

function submitForm() {
  form.post(route('post.update', props.post.id))
}
</script>

<template>
  <Layout
    title="Núcleo de Direitos Humanos Marielle Franco - Postagens"
    :isAuthenticated="true"
    :user="props.user"
  >
    <div
      class="container mx-auto max-w-4xl my-8 bg-white shadow-lg rounded-lg p-6"
    >
      <h2 class="text-2xl text-black mb-5">Editar postagem</h2>
      <form @submit.prevent="submitForm">
        <div
          class="relative mx-auto max-w-[300px] sm:max-w-[400px] aspect-square overflow-hidden border border-slate-300"
        >
          <label
            for="imagem"
            class="absolute inset-0 grid content-end cursor-pointer"
          >
            <span class="bg-black/70 p-2 text-center text-white">
              Escolha a imagem
            </span>
          </label>

          <input
            class="my-2"
            id="imagem"
            type="file"
            accept=".png, .jpeg, .jpg"
            @input="change"
            hidden
          />

          <img
            class="w-full h-full object-cover border"
            :src="form.previewImg"
            alt="foto"
          />
        </div>
        <p class="text-red-500 mt-2">{{ form.errors.imagem }}</p>

        <label class="text-black">Título</label>
        <input
          type="text"
          class="w-full p-2 text-black"
          v-model="form.titulo"
        />
        <p class="text-red-500 mt-2">{{ form.errors.titulo }}</p>

        <label class="text-black">Texto</label>
        <Editor v-model="form.texto" v-model:resetEditor="resetEditor" />
        <p class="text-red-500 mt-2">{{ form.errors.texto }}</p>

        <div class="flex my-5">
          <a class="mx-auto" href="#" onclick="history.back()">
            <SecondaryButton class="bg-transparent"> Voltar </SecondaryButton>
          </a>
          <PrimaryButton class="mx-auto"> Editar postagem </PrimaryButton>
        </div>
      </form>
    </div>
  </Layout>
</template>
