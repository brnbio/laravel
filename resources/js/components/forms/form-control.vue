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
    },
    info: {
        type: String,
        required: false
    }
})

const form = inject("form")

</script>
<template>

    <div class="mb-3">
        <label :class="{'mb-0': info}" class="form-label" :for="name">
            {{ label }}
        </label>
        <div class="form-text" v-if="info">
            {{ info }}
        </div>
        <input v-model="form[name]"
               class="form-control"
               :id="name"
               :class="{'is-invalid': form.errors[name]}"
               :placeholder="label"
               v-bind="$attrs" />
        <div class="invalid-feedback" v-if="form.errors[name]">
            {{ form.errors[name] }}
        </div>
    </div>

</template>
