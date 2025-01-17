<script setup>

import FormControl  from '@/components/forms/form-control.vue';
import FormPassword from '@/components/forms/form-password.vue';
import GuestLayout  from '@/layouts/guest-layout.vue';
import { useForm }  from '@inertiajs/vue3';
import { provide }  from 'vue';

const form = useForm({
    email: null,
    password: null,
    remember: true,
});
provide('form', form);

function login() {

    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
}

</script>
<template>

    <GuestLayout>
        <div>
            <h1>Willkommen!</h1>
            <p class="small text-muted">
                Melden Sie sich mit den Ihnen bekannten Zugangsdaten an.
            </p>
            <form @submit.prevent="login">
                <FormControl name="email" label="E-Mail-Adresse" required autofocus autocomplete="username" type="email" />
                <FormPassword name="password" label="Passwort" required autocomplete="current-password" />
                <div class="d-flex align-items-start justify-content-between">
                    <button type="submit" :disabled="form.processing" class="btn btn-primary">
                        Login
                    </button>
                    <!--                    <Link :href="route('forgot-password')" class="small text-muted">-->
                    <!--                        Passwort vergessen?-->
                    <!--                    </Link>-->
                </div>
            </form>
        </div>
    </GuestLayout>

</template>
