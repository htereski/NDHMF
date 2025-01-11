<script setup>
import Layout from '@/Layouts/Layout.vue'
import { Link } from '@inertiajs/vue3'
import Pagination from '@/Components/Pagination.vue'
import FileDocumentPlusOutline from 'vue-material-design-icons/FileDocumentPlusOutline.vue'
import SecondaryButton from '@/Components/SecondaryButton.vue'

const props = defineProps({
  paginate: Object,
  posts: Array,
})
</script>

<template>
  <Layout
    title="Postagens"
    :isAuthenticated="$page.props.auth.user"
    :user="$page.props.auth.user"
  >
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Postagens
      </h2>
    </template>

    <template v-if="$page.props.auth.user">
      <div class="2xl:w-[1200px] 2xl:mx-auto flex justify-end mt-8">
        <Link
          v-if="$page.props.auth.user.role != 'VITIMA'"
          :href="route('post.create')"
        >
          <SecondaryButton class="mb-4"
            ><FileDocumentPlusOutline
          /></SecondaryButton>
        </Link>
      </div>
    </template>

    <div
      class="2xl:w-[1200px] 2xl:mx-auto bg-white sm:rounded-lg shadow-md p-4 sm:p-6 place-items-center mt-4 mb-10"
    >
      <div
        class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6"
      >
        <template v-for="post in posts" :key="post.id">
          <Link :href="route('post.show', post)">
            <div
              class="card w-full max-w-xs h-96 shadow-md rounded-xl bg-green-300 transition-transform transform hover:scale-105 hover:shadow-lg"
            >
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
                  class="truncate prose text-black custom-post-index"
                  v-html="post.texto"
                ></div>
              </div>
            </div>
          </Link>
        </template>
      </div>
    </div>

    <Pagination :pagination="paginate"> </Pagination>
  </Layout>
</template>
