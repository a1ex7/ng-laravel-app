<script setup>
import DangerButton from '@/Components/DangerButton.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import {useForm} from '@inertiajs/vue3';
import {ref} from 'vue';

const confirmingDeletion = ref(false);

const form = useForm({});

const confirmUserDeletion = () => {
  confirmingDeletion.value = true;
};

const deleteLink = () => {
  form.delete(route('links.destroy'), {
    preserveScroll: true,
    onSuccess: () => closeModal(),
    onError: () => {},
    onFinish: () => {},
  });
};

const closeModal = () => {
  confirmingDeletion.value = false;

  form.clearErrors();
  form.reset();
};
</script>

<template>
  <section class="space-y-6">
    <header>
      <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
        Delete Link
      </h2>

      <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
        Deactivate link. Once your link is deleted, you need to register again
      </p>
    </header>

    <DangerButton @click="confirmUserDeletion">Delete</DangerButton>

    <Modal :show="confirmingDeletion" @close="closeModal">
      <div class="p-6">
        <h2
            class="text-lg font-medium text-gray-900 dark:text-gray-100"
        >
          Are you sure you want to deactivate link?
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
          Once your link is deleted, you need to register again
        </p>

        <div class="mt-6 flex justify-end">
          <SecondaryButton @click="closeModal">
            Cancel
          </SecondaryButton>

          <DangerButton
              class="ms-3"
              :class="{ 'opacity-25': form.processing }"
              :disabled="form.processing"
              @click="deleteLink"
          >
            Delete
          </DangerButton>
        </div>
      </div>
    </Modal>
  </section>
</template>
