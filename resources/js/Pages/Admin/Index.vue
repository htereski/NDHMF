<script setup>
import Layout from '@/Layouts/Layout.vue'
import Pagination from '@/Components/Pagination.vue'
import { Link, useForm } from '@inertiajs/vue3'
import SecondaryButton from '@/Components/SecondaryButton.vue'
import Pencil from 'vue-material-design-icons/Pencil.vue'
import Delete from 'vue-material-design-icons/Delete.vue'
import AccountPlus from 'vue-material-design-icons/AccountPlus.vue'

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
    <div class="container flex flex-col mx-auto items-center mt-8 mb-10">
      <div
        class="w-full relative overflow-x-auto sm:rounded-lg flex justify-end mb-8"
      >
        <Link :href="route('admin.create')">
          <SecondaryButton><AccountPlus /></SecondaryButton
        ></Link>
      </div>
      <div class="w-full relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-black">
          <thead class="text-xs text-black uppercase bg-white">
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
              class="bg-white border-b hover:bg-gray-50 dark:hover:bg-gray-100"
            >
              <th
                scope="row"
                class="px-6 py-4 font-medium text-black whitespace-nowrap"
              >
                {{ user.name }}
              </th>
              <td class="px-6 py-4">{{ user.role }}</td>
              <td class="px-6 py-4">
                <Link :href="`${route('admin.edit', user.id)}`">
                  <Pencil class="text-blue-600 hover:text-blue-800" />
                </Link>
              </td>
              <td class="px-6 py-4">
                <Delete
                  class="text-red-600 hover:text-red-800 hover:cursor-pointer"
                  @click="deleteUser(user.id)"
                />
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <Pagination :pagination="users.users"> </Pagination>
  </Layout>
</template>
