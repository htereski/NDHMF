<script setup>
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import SecondaryButton from '@/Components/SecondaryButton.vue'
import TextInput from '@/Components/TextInput.vue'
import Layout from '@/Layouts/Layout.vue'
import { Link, useForm } from '@inertiajs/vue3'
import toast from '@/Stores/toast'

const props = defineProps({
  user: Object,
})

const form = useForm({
  name: props.user.name,
  email: props.user.email,
  role: props.user.role,
})

const submit = () => {
  form.put(route('admin.update', props.user.id), {
    onSuccess: () => {
      addToast('Usuário editado com sucesso!', 'success')
    },
    onError: () => {
      addToast('Não foi possivel editar o usuário', 'error')
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
        Editar Usuário
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
          <InputLabel for="role" value="Papel" />
          <select
            name="role"
            id="role"
            v-model="form.role"
            class="mt-2 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
            required
          >
            <option value="" disabled selected>Selecione um papel</option>
            <option value="ADMIN">Admin</option>
            <option value="DEFENSOR_SOCIAL">Defensor social</option>
          </select>
          <InputError class="mt-2" :message="form.errors.role" />
        </div>

        <div class="flex items-center justify-end mt-4">
          <PrimaryButton
            class="ms-4"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
          >
            Editar
          </PrimaryButton>
        </div>
      </form>
    </div>
  </Layout>
</template>
