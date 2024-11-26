<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';

defineProps({
    status: {
        type: String,
    },
});

const form = useForm({});
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
              Update unique link
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
              Generate new unique link
            </p>
        </header>

        <form
            @submit.prevent="form.post(route('links.update'))"
            class="mt-6 space-y-6"
        >
            <div v-if="status === 'link-updated'">
                <Link
                    :href="route('profile.edit', {'uuid': $page.props.auth.user.invite})"
                    class="mt-2 text-sm font-medium text-green-600 dark:text-green-400"
                >
                    A new link has been generated.
                </Link>
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Update</PrimaryButton>

                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p
                        v-if="form.recentlySuccessful"
                        class="text-sm text-gray-600 dark:text-gray-400"
                    >
                        Updated.
                    </p>
                </Transition>
            </div>
        </form>
    </section>
</template>
