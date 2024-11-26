<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DeleteLinkForm from './Partials/DeleteLinkForm.vue';
import GameForm from './Partials/GameForm.vue';
import UpdateLinkForm from './Partials/UpdateLinkForm.vue';
import {Head} from '@inertiajs/vue3';

defineProps({
  status: {
    type: String,
  },
  game: {
    type: Object
  },
  games: {
    type: Object
  }
});
</script>

<template>
  <Head title="Profile"/>

  <AuthenticatedLayout>
    <template #header>
      <h2
          class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
      >
        Page A
      </h2>
      <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
        {{ $page.props.auth.user.invite }}
      </p>
    </template>

    <div class="py-12">
      <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">

        <div
            class="bg-white p-4 shadow sm:rounded-lg sm:p-8 dark:bg-gray-800"
        >
          <GameForm class="max-w-xl" :game="game" :games="games"/>
        </div>

        <div
            class="bg-white p-4 shadow sm:rounded-lg sm:p-8 dark:bg-gray-800"
        >
          <UpdateLinkForm
              :status="status"
              class="max-w-xl"
          />
        </div>

        <div
            class="bg-white p-4 shadow sm:rounded-lg sm:p-8 dark:bg-gray-800"
        >
          <DeleteLinkForm class="max-w-xl"/>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
