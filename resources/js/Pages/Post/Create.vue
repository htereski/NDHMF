<script setup>
import Layout from '@/Layouts/Layout.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import SecondaryButton from '@/Components/SecondaryButton.vue'
import Editor from '@/Components/Editor.vue'
import { useForm } from '@inertiajs/vue3'
import { Link } from '@inertiajs/vue3'
import toast from '@/Stores/toast'
import InputLabel from '@/Components/InputLabel.vue'
import TextInput from '@/Components/TextInput.vue'
import InputError from '@/Components/InputError.vue'

const form = useForm({
  titulo: null,
  texto: null,
  imagem: null,
  previewImg: null,
})

function change(event) {
  form.imagem = event.target.files[0]
  form.previewImg = URL.createObjectURL(event.target.files[0])
}

function submitForm() {
  form.post(route('post.store'), {
    onSuccess: () => {
      addToast('Postagem criada com sucesso!', 'success')
    },
    onError: () => {
      addToast('Erro ao criar postagem.', 'error')
    },
  })
}

function addToast(message, type) {
  toast.add({ message: message, type: type })
}
</script>

<template>
  <Layout
    title="Núcleo de Direitos Humanos Marielle Franco - Postagens"
    :isAuthenticated="true"
    :user="$page.props.auth.user"
  >
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Criar postagem
      </h2>
    </template>

    <div class="container mx-auto max-w-4xl mt-8">
      <Link :href="route('post.index')">
        <SecondaryButton class="mb-4">Voltar</SecondaryButton>
      </Link>
    </div>

    <div
      class="container mx-auto max-w-4xl my-8 bg-white shadow-lg rounded-lg p-6"
    >
      <form @submit.prevent="submitForm">
        <div
          class="relative mx-auto max-w-[300px] sm:max-w-[400px] aspect-square overflow-hidden border border-gray-300 rounded-md"
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
            class="w-full h-full object-cover"
            :src="form.previewImg ? form.previewImg : '/assets/img/post.png'"
            alt="foto"
          />
        </div>
        <InputError class="mt-2" :message="form.errors.imagem" />

        <div>
          <InputLabel for="titulo" value="Título" />
          <TextInput
            id="name"
            v-model="form.titulo"
            type="text"
            class="mt-1 block w-full"
            required
            autofocus
          />
          <InputError class="mt-2" :message="form.errors.titulo" />
        </div>

        <div class="mt-4">
          <InputLabel for="texto" value="Texto" />
          <Editor
            v-model="form.texto"
            v-model:resetEditor="resetEditor"
            styles="custom-html-content"
          />
          <InputError class="mt-2" :message="form.errors.texto" />
        </div>

        <div class="flex my-5">
          <PrimaryButton class="mx-auto"> Postar </PrimaryButton>
        </div>
      </form>
    </div>
  </Layout>
</template>
