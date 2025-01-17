<script setup lang="ts">

import Navbar from "@/layouts/html/navbar.vue";
</script>

<template>

    <Navbar />
    <main class="container-fluid">
        <slot />
    </main>

</template>
