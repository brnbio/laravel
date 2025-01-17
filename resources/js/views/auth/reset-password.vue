<script setup>

import FormControl  from '@/components/forms/form-control.vue';
import FormPassword from '@/components/forms/form-password.vue';
import GuestLayout  from '@/layouts/guest-layout.vue';
import { useForm }  from '@inertiajs/vue3';
import { provide }  from 'vue';

const props = defineProps({
    token: {
        type: String,
        required: true,
    },
    email: {
        type: String,
        required: true,
    },
});

const form = useForm({
    email: props.email,
    password: '',
    password_confirmation: '',
    token: props.token,
});
provide('form', form);

function submit() {
    form.post(route('password.update'), {
        onFinish: () => form.reset(),
    });
}

</script>
<template>

    <GuestLayout>
        <div>
            <h1>Neues Passwort setzen</h1>
            <form @submit.prevent="submit">
                <FormControl name="email" label="E-Mail-Adresse" required autofocus type="email" />
                <FormPassword name="password" label="Passwort" required />
                <FormPassword name="password_confirmation" label="Passwort bestätigen" required />
                <button type="submit" :disabled="form.processing" class="btn btn-primary">
                    Passwort speichern
                </button>
            </form>
        </div>
    </GuestLayout>

</template>
