<script setup>

import FormControl       from '@/components/forms/form-control.vue';
import GuestLayout       from '@/layouts/guest-layout.vue';
import { Link, useForm } from '@inertiajs/vue3';
import { provide }       from 'vue';

const form = useForm({
    email: null,
});
provide('form', form);

function submit() {
    form.post(route('forgot-password'), {
        onFinish: () => form.reset('email'),
    });
}

</script>
<template>

    <GuestLayout>
        <div>
            <h1>Passwort vergessen</h1>
            <form @submit.prevent="submit">
                <FormControl name="email" label="E-Mail-Adresse" required autofocus type="email" />
                <button type="submit" :disabled="form.processing" class="btn btn-primary">
                    Passwort zurücksetzen
                </button>
                <Link href="/" class="btn btn-link">
                    Abbrechen
                </Link>
            </form>
        </div>
    </GuestLayout>

</template>
