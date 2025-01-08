<script setup>
import Layout from '@/Layouts/Layout.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import Pagination from '@/Components/Pagination.vue'
import { Link, useForm } from '@inertiajs/vue3'
import SecondaryButton from '@/Components/SecondaryButton.vue'

const props = defineProps({
  users: Array,
})

const form = useForm({})

function deleteUser(id) {
  if (confirm('Tem certeza que deseja excluir este usuário?')) {
    form.delete(route('admin.destroy', id), {
      onSuccess: () => {
        setTimeout(() => {
          window.location.href = route('admin.user')
        }, 1000)
      },
    })
  }
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
        Colaboradores do projeto
      </h2>
    </template>
    <div class="container flex flex-col mx-auto items-center mt-8">
      <div
        class="w-full relative overflow-x-auto sm:rounded-lg flex justify-end mb-8"
      >
        <Link :href="route('admin.create')">
          <SecondaryButton>Criar</SecondaryButton></Link
        >
      </div>
      <div class="w-full relative overflow-x-auto shadow-md sm:rounded-lg">
        <table
          class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
        >
          <thead
            class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
          >
            <tr>
              <th scope="col" class="px-6 py-3">Nome</th>
              <th scope="col" class="px-6 py-3">Papel</th>
              <th scope="col" class="px-6 py-3"></th>
              <th scope="col" class="px-6 py-3"></th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="user in users.users.data"
              :key="user.id"
              class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
            >
              <th
                scope="row"
                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
              >
                {{ user.name }}
              </th>
              <td class="px-6 py-4">{{ user.role }}</td>
              <td class="px-6 py-4">
                <Link
                  :href="`${route('admin.edit', user.id)}`"
                  class="text-blue-600 dark:text-blue-400"
                >
                  Editar
                </Link>
              </td>
              <td class="px-6 py-4">
                <PrimaryButton
                  class="text-red-600"
                  @click="deleteUser(user.id)"
                >
                  Deletar
                </PrimaryButton>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <Pagination :pagination="users.users"> </Pagination>
  </Layout>
</template>
