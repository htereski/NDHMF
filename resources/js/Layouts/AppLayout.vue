<script setup>
import { ref } from "vue";
import { Head, Link, router } from "@inertiajs/vue3";
import ApplicationMark from "@/Components/ApplicationMark.vue";
import Banner from "@/Components/Banner.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import NavLink from "@/Components/NavLink.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";

defineProps({
  title: String,
  user: Boolean,
});

const showingNavigationDropdown = ref(false);

const switchToTeam = (team) => {
  router.put(
    route("current-team.update"),
    {
      team_id: team.id,
    },
    {
      preserveState: false,
    }
  );
};

const logout = () => {
  router.post(route("logout"));
};
</script>

<template>
  <div>
    <Head :title="title" />

    <Banner />

    <div class="min-h-screen bg-gray-100">
      <nav class="bg-white border-b border-gray-100">
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div class="flex justify-between lg:justify-center h-[9.9vh]">
            <div class="flex">
              <!-- Logo -->
              <div class="shrink-0 flex items-center">
                <Link :href="route('index')">
                  <ApplicationMark class="block h-9 w-auto" />
                </Link>
              </div>

              <!-- Navigation Links -->
              <div class="hidden space-x-8 sm:-my-px sm:ms-10 lg:flex">
                <NavLink
                  :href="route('index')"
                  :active="route().current('index')"
                >
                  Início
                </NavLink>

                <NavLink
                  href="#about"
                >
                  Sobre
                </NavLink>

                <NavLink
                  :href="route('index')"
                  :active="route().current('dashboard')"
                >
                  Ações
                </NavLink>

                <NavLink
                  :href="route('index')"
                  :active="route().current('dashboard')"
                >
                  Postagens
                </NavLink>

                <NavLink
                  :href="route('index')"
                  :active="route().current('dashboard')"
                >
                  Chamados
                </NavLink>
              </div>

              <template v-if="!user">
                <div class="hidden space-x-8 sm:-my-px lg:ms-80 lg:flex">
                  <NavLink
                    :href="route('login')"
                    :active="route().current('dashboard')"
                  >
                    Entrar
                  </NavLink>

                  <NavLink
                    :href="route('register')"
                    :active="route().current('dashboard')"
                  >
                    Registrar-se
                  </NavLink>
                </div>
              </template>
            </div>

            <template v-if="user">
              <div
                class="hidden lg:items-center space-x-8 sm:-my-px lg:ms-80 lg:flex"
              >
                <template v-if="user">
                  <div class="ms-3 relative">
                    <Dropdown align="right" width="48">
                      <template #trigger>
                        <button
                          v-if="$page.props.jetstream.managesProfilePhotos"
                          class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition"
                        >
                          <img
                            class="h-8 w-8 rounded-full object-cover"
                            :src="$page.props.auth.user.profile_photo_url"
                            :alt="$page.props.auth.user.name"
                          />
                        </button>
                        <span v-else class="inline-flex rounded-md">
                          <button
                            type="button"
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150"
                          >
                            {{ $page.props.auth.user.name }}
                            <svg
                              class="ms-2 -me-0.5 h-4 w-4"
                              xmlns="http://www.w3.org/2000/svg"
                              fill="none"
                              viewBox="0 0 24 24"
                              stroke-width="1.5"
                              stroke="currentColor"
                            >
                              <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M19.5 8.25l-7.5 7.5-7.5-7.5"
                              />
                            </svg>
                          </button>
                        </span>
                      </template>
                      <template #content>
                        <div class="block px-4 py-2 text-xs text-gray-400">
                          Gerenciar conta
                        </div>

                        <DropdownLink :href="route('profile.show')">
                          Perfil
                        </DropdownLink>

                        <DropdownLink
                          v-if="$page.props.jetstream.hasApiFeatures"
                          :href="route('api-tokens.index')"
                        >
                          API Tokens
                        </DropdownLink>

                        <div class="border-t border-gray-200" />
                        <form @submit.prevent="logout">
                          <DropdownLink as="button"> Sair </DropdownLink>
                        </form>
                      </template>
                    </Dropdown>
                  </div>
                </template>
              </div>
            </template>

            <template v-if="!user">
              <div class="hidden sm:flex sm:items-center sm:ms-6">
                <template v-if="user">
                  <div class="ms-3 relative">
                    <Dropdown align="right" width="48">
                      <template #trigger>
                        <button
                          v-if="$page.props.jetstream.managesProfilePhotos"
                          class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition"
                        >
                          <img
                            class="h-8 w-8 rounded-full object-cover"
                            :src="$page.props.auth.user.profile_photo_url"
                            :alt="$page.props.auth.user.name"
                          />
                        </button>
                        <span v-else class="inline-flex rounded-md">
                          <button
                            type="button"
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150"
                          >
                            {{ $page.props.auth.user.name }}
                            <svg
                              class="ms-2 -me-0.5 h-4 w-4"
                              xmlns="http://www.w3.org/2000/svg"
                              fill="none"
                              viewBox="0 0 24 24"
                              stroke-width="1.5"
                              stroke="currentColor"
                            >
                              <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M19.5 8.25l-7.5 7.5-7.5-7.5"
                              />
                            </svg>
                          </button>
                        </span>
                      </template>
                      <template #content>
                        <div class="block px-4 py-2 text-xs text-gray-400">
                          Gerenciar conta
                        </div>

                        <DropdownLink :href="route('profile.show')">
                          Perfil
                        </DropdownLink>

                        <DropdownLink
                          v-if="$page.props.jetstream.hasApiFeatures"
                          :href="route('api-tokens.index')"
                        >
                          API Tokens
                        </DropdownLink>

                        <div class="border-t border-gray-200" />
                        <form @submit.prevent="logout">
                          <DropdownLink as="button"> Sair </DropdownLink>
                        </form>
                      </template>
                    </Dropdown>
                  </div>
                </template>
              </div>
            </template>

            <div class="-me-2 flex items-center lg:hidden">
              <button
                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
                @click="showingNavigationDropdown = !showingNavigationDropdown"
              >
                <svg
                  class="h-6 w-6"
                  stroke="currentColor"
                  fill="none"
                  viewBox="0 0 24 24"
                >
                  <path
                    :class="{
                      hidden: showingNavigationDropdown,
                      'inline-flex': !showingNavigationDropdown,
                    }"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16"
                  />
                  <path
                    :class="{
                      hidden: !showingNavigationDropdown,
                      'inline-flex': showingNavigationDropdown,
                    }"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M6 18L18 6M6 6l12 12"
                  />
                </svg>
              </button>
            </div>
          </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div
          :class="{
            block: showingNavigationDropdown,
            hidden: !showingNavigationDropdown,
          }"
          class="lg:hidden"
        >
          <div class="pt-2 pb-3 space-y-1">
            <template v-if="!user">
              <ResponsiveNavLink
                :href="route('login')"
                :active="route().current('dashboard')"
              >
                Entrar
              </ResponsiveNavLink>

              <ResponsiveNavLink
                :href="route('register')"
                :active="route().current('dashboard')"
              >
                Registrar-se
              </ResponsiveNavLink>
              <hr />
            </template>

            <ResponsiveNavLink
              :href="route('dashboard')"
              :active="route().current('dashboard')"
            >
              Início
            </ResponsiveNavLink>

            <ResponsiveNavLink
              :href="route('dashboard')"
              :active="route().current('dashboard')"
            >
              Sobre
            </ResponsiveNavLink>

            <ResponsiveNavLink
              :href="route('dashboard')"
              :active="route().current('dashboard')"
            >
              Ações
            </ResponsiveNavLink>

            <ResponsiveNavLink
              :href="route('dashboard')"
              :active="route().current('dashboard')"
            >
              Postagens
            </ResponsiveNavLink>

            <ResponsiveNavLink
              :href="route('dashboard')"
              :active="route().current('dashboard')"
            >
              Chamados
            </ResponsiveNavLink>
          </div>

          <!-- Responsive Settings Options -->

          <template v-if="user">
            <div class="pt-4 pb-1 border-t border-gray-200">
              <div class="flex items-center px-4">
                <div
                  v-if="$page.props.jetstream.managesProfilePhotos"
                  class="shrink-0 me-3"
                >
                  <img
                    class="h-10 w-10 rounded-full object-cover"
                    :src="$page.props.auth.user.profile_photo_url"
                    :alt="$page.props.auth.user.name"
                  />
                </div>

                <div>
                  <div class="font-medium text-base text-gray-800">
                    {{ $page.props.auth.user.name }}
                  </div>
                  <div class="font-medium text-sm text-gray-500">
                    {{ $page.props.auth.user.email }}
                  </div>
                </div>
              </div>
              <div class="mt-3 space-y-1">
                <ResponsiveNavLink
                  :href="route('profile.show')"
                  :active="route().current('profile.show')"
                >
                  Perfil
                </ResponsiveNavLink>

                <ResponsiveNavLink
                  v-if="$page.props.jetstream.hasApiFeatures"
                  :href="route('api-tokens.index')"
                  :active="route().current('api-tokens.index')"
                >
                  API Tokens
                </ResponsiveNavLink>

                <!-- Authentication -->
                <form method="POST" @submit.prevent="logout">
                  <ResponsiveNavLink as="button"> Sair </ResponsiveNavLink>
                </form>
              </div>
            </div>
          </template>
        </div>
      </nav>

      <!-- Page Heading -->
      <header v-if="$slots.header" class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
          <slot name="header" />
        </div>
      </header>

      <!-- Page Content -->
      <main>
        <slot />
      </main>
    </div>
  </div>
</template>
