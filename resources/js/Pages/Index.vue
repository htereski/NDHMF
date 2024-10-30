<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";

defineProps({
  user: Boolean,
});
</script>

<template>
  <AppLayout title="Núcleo de Direitos Humanos Marielle Franco" :user="user">
    <div class="hero bg-white min-h-[70vh]">
      <div class="hero-content text-center">
        <div class="max-w-md">
          <h1 class="text-5xl font-bold text-black">
            Núcleo de Direitos Humanos Marielle Franco
          </h1>
          <p class="py-6 text-lg text-black">
            Por direitos iguais, Marielle vive em nós!
          </p>
        </div>
      </div>
    </div>

    <div
      class="w-full bg-green-400 min-h-[20vh] flex justify-center items-center"
    >
      <p class="text-white text-xl text-center p-10">
        O NDH foi criado para responder às demandas sociais presentes em
        Paranaguá, com foco em temáticas como violência doméstica, gênero e
        direito à moradia.
      </p>
    </div>

    <div
      class="hero min-h-screen"
      id="about"
    >
      <div class="hero-overlay bg-white"></div>
      <div class="hero-content text-neutral-content text-center">
        <div class="max-w-6xl text-black">
          <h1 class="mb-10 text-5xl font-semibold">Sobre</h1>

          <p class="m-5 text-justify indent-12 text-xl font-light">
            A criação do Núcleo Marielle Franco remonta ao curso de Defensores
            Populares, iniciado em 2017. Após a formação, as participantes
            buscaram apoio institucional, solicitando ao Instituto Federal
            suporte para atuarem em suas comunidades.
          </p>

          <p class="m-5 text-justify indent-12 text-xl font-light">
            Em 2018, o núcleo foi formalizado, e, naquele ano, o assassinato de
            Marielle Franco ainda repercutia fortemente. Seu nome já simbolizava
            a luta por justiça, o que motivou a escolha de seu nome para o
            núcleo, em homenagem a seu legado de defesa dos direitos das
            mulheres, da população LGBTQIA+, negra e periférica.
          </p>

          <p class="m-5 text-justify indent-12 text-xl font-light">
            Composto por defensoras populares de 2017 e 2018, o núcleo deu
            início a mutirões nas comunidades de Paranaguá, em parceria com a
            Defensoria Pública e o CRAS. Essa ação foi o marco da presença do
            núcleo nas periferias, consolidando sua atuação.
          </p>

          <p class="m-5 text-justify indent-12 text-xl font-light">
            A necessidade de dar continuidade aos atendimentos realizados nos
            mutirões levou à organização de acolhimentos e orientações no
            Instituto Federal. Contudo, no final de 2018, a Defensoria Pública
            deixou Paranaguá, e os mutirões passaram a ocorrer de forma
            independente.
          </p>

          <p class="m-5 text-justify indent-12 text-xl font-light">
            Em 2019, com a chegada da professora Valéria, surgiu a ideia de
            expandir o trabalho para as escolas, por meio de ações educativas.
            Com a pandemia, no entanto, as atividades presenciais foram
            interrompidas, e o núcleo direcionou seus esforços para formações
            online.
          </p>

          <p class="m-5 text-justify indent-12 text-xl font-light">
            Desde 2020, a professora Valéria Borges Ribeiro coordena o núcleo, e o professor
            Roberto Martins de Souza como vice-coordenador. Seguem com o
            compromisso de fortalecer as ações comunitárias e educativas,
            mantendo vivo o legado de resistência e apoio às comunidades.
          </p>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
