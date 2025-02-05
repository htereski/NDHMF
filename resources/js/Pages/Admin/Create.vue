<script setup>
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import SecondaryButton from '@/Components/SecondaryButton.vue'
import TextInput from '@/Components/TextInput.vue'
import Layout from '@/Layouts/Layout.vue'
import { Link, useForm } from '@inertiajs/vue3'
import toast from '@/Stores/toast'

const form = useForm({
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
  role: '',
})

const submit = () => {
  form.post(route('admin.store'), {
    onSuccess: response => {
      addToast('Usuário cadastrado com sucesso!', 'success')
    },
    onError: error => {
      addToast('Não foi possivel cadastrar o usuário', 'error')
    },
  })
}

function addToast(message, type) {
  toast.add({ message: message, type: type })
}
</script>

<template>
  <Layout
    title="Postagens"
    :isAuthenticated="$page.props.auth.user"
    :user="$page.props.auth.user"
  >
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Cadastrar Usuário
      </h2>
    </template>

    <div class="2xl:w-[1200px] 2xl:mx-auto my-8">
      <Link :href="route('admin.user')">
        <SecondaryButton>Voltar</SecondaryButton>
      </Link>
    </div>
    <div
      class="2xl:w-[1200px] 2xl:mx-auto bg-gray-200 shadow-md p-4 sm:p-6 place-items-center mb-10"
    >
      <form @submit.prevent="submit" class="w-full">
        <div>
          <InputLabel for="name" value="Nome" />
          <TextInput
            id="name"
            v-model="form.name"
            type="text"
            class="mt-1 block w-full"
            required
            autofocus
            autocomplete="name"
          />
          <InputError class="mt-2" :message="form.errors.name" />
        </div>

        <div class="mt-4">
          <InputLabel for="email" value="Email" />
          <TextInput
            id="email"
            v-model="form.email"
            type="email"
            class="mt-1 block w-full"
            required
            autocomplete="username"
          />
          <InputError class="mt-2" :message="form.errors.email" />
        </div>

        <div class="mt-4">
          <InputLabel for="password" value="Senha" />
          <TextInput
            id="password"
            v-model="form.password"
            type="password"
            class="mt-1 block w-full"
            required
            autocomplete="new-password"
          />
          <InputError class="mt-2" :message="form.errors.password" />
        </div>

        <div class="mt-4">
          <InputLabel
            for="password_confirmation"
            value="Confirmação de senha"
          />
          <TextInput
            id="password_confirmation"
            v-model="form.password_confirmation"
            type="password"
            class="mt-1 block w-full"
            required
            autocomplete="new-password"
          />
          <InputError
            class="mt-2"
            :message="form.errors.password_confirmation"
          />
        </div>

        <div class="mt-4">
          <InputLabel for="role" value="Papel" />
          <select
            name="role"
            id="role"
            v-model="form.role"
            class="mt-2 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
            required
          >
            <option value="" disabled selected>Selecione um papel</option>
            <option value="ADMIN">ADMIN</option>
            <option value="DEFENSOR_SOCIAL">DEFENSOR SOCIAL</option>
          </select>
          <InputError class="mt-2" :message="form.errors.role" />
        </div>

        <div class="flex items-center justify-end mt-4">
          <PrimaryButton
            class="ms-4"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
          >
            Cadastrar
          </PrimaryButton>
        </div>
      </form>
    </div>
  </Layout>
</template>
