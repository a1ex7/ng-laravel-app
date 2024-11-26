<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import {useForm} from '@inertiajs/vue3';

const formGame = useForm({});
const formHistory = useForm({});

defineProps({
  game: {
    type: Object
  },
  games: {
    type: Object
  }
});

const startGame = () => {
  formGame.post(route('games.create'), {
    preserveScroll: true,
    onSuccess: () => {
      console.log(formGame.data())
    },
    onError: () => {
      console.log(formGame.errors)
    },
  });
};

const showHistory = () => {
  formHistory.get(route('games.index'), {
    preserveScroll: true,
    onSuccess: () => {
      console.log(formHistory.data())
    },
    onError: () => {
      console.log(formHistory.errors)
    },
  });
};
</script>

<template>
  <section>
    <header>
      <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
        Game
      </h2>

      <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
        Play using "Imfeelinglucky"" or get results of last 3 games by "History"
      </p>
    </header>

    <form @submit.prevent="startGame" class="mt-6 space-y-6">
      <div class="flex items-center gap-4">
        <PrimaryButton :disabled="formGame.processing">ImFeelingLucky</PrimaryButton>

        <Transition
            enter-active-class="transition ease-in-out"
            enter-from-class="opacity-0"
            leave-active-class="transition ease-in-out"
            leave-to-class="opacity-0"
        >
          <p
              v-if="formGame.recentlySuccessful"
              class="text-sm text-gray-600 dark:text-gray-400"
          >
            Saved.
          </p>
        </Transition>
      </div>
      <h3 v-if="game" class="text-xl font-semibold text-black dark:text-white">
        Chance: {{ game.lottery }},
        Result: {{ game.win ? 'Win' : 'Lose' }},
        Amount: {{ game.amount }}
      </h3>
    </form>

    <form @submit.prevent="showHistory" class="mt-6 space-y-6">
      <div class="flex items-center gap-4">
        <PrimaryButton :disabled="formHistory.processing">History</PrimaryButton>

        <Transition
            enter-active-class="transition ease-in-out"
            enter-from-class="opacity-0"
            leave-active-class="transition ease-in-out"
            leave-to-class="opacity-0"
        >
          <p
              v-if="formHistory.recentlySuccessful"
              class="text-sm text-gray-600 dark:text-gray-400"
          >
            Saved.
          </p>
        </Transition>
      </div>

      <div v-if="games" class="bg-white rounded-md shadow overflow-x-auto">
        <table class="w-full whitespace-nowrap">
          <thead>
          <tr class="text-left font-bold">
            <th class="pb-4 pt-6 px-6">Chance</th>
            <th class="pb-4 pt-6 px-6">Win</th>
            <th class="pb-4 pt-6 px-6" colspan="2">Amount</th>
          </tr>
          </thead>
          <tbody>
          <tr v-for="game in games.data" :key="game.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
            <td class="border-t">
              <p class="flex items-center px-6 py-4 focus:text-indigo-500">
                {{ game.lottery }}
              </p>
            </td>
            <td class="border-t">
              <p class="flex items-center px-6 py-4 focus:text-indigo-500">
                {{ game.win ? '🟢' : '🔴'}}
              </p>
            </td>
            <td class="border-t">
              <p class="flex items-center px-6 py-4 focus:text-indigo-500">
                {{ game.amount }}
              </p>
            </td>
          </tr>
          </tbody>
        </table>
      </div>

    </form>
  </section>
</template>
