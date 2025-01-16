<script setup lang="ts">

defineOptions({
    inheritAttrs: false,
});

</script>
<template>

    <div class="table-responsive">
        <table class="table" v-bind="$attrs">
            <slot />
        </table>
    </div>

</template>
