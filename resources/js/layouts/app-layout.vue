<script setup lang="ts">

import Navbar from "@/layouts/html/navbar.vue";
import { Modal } from 'inertia-modal'

</script>

<template>

    <Navbar />
    <main class="container-fluid">
        <slot />
    </main>
    <Modal />

</template>
