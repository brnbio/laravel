<script setup lang="ts">

import { Link, usePage } from "@inertiajs/vue3";
import { computed } from "vue";

const page = usePage();
const appName = computed(() => page.props.app.name);

</script>

<template>

    <nav class="navbar navbar-expand navbar-light fixed-top">
        <div class="container-fluid">
            <Link :href="route('dashboard')" class="navbar-brand">
                {{ appName }}
            </Link>
        </div>
    </nav>

    <main class="d-flex justify-content-center align-items-center min-vh-100">
        <slot />
    </main>

</template>
