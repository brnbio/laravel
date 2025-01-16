<script setup>

import { inject } from 'vue';

defineOptions({
    inheritAttrs: false
})

defineProps({
    name: {
        type: String,
        required: true
    },
    label: {
        type: String,
        required: true
    }
})

const form = inject("form")

</script>
<template>

    <div class="form-check">
        <input v-model="form[name]"
               class="form-check-input"
               :class="{'is-invalid': form.errors[name]}"
               :id="name"
               v-bind="$attrs"
               type="checkbox" />
        <label class="form-check-label" :for="name">
            {{ label }}
        </label>
        <div class="invalid-feedback" v-if="form.errors[name]">
            {{ form.errors[name] }}
        </div>
    </div>

</template>
