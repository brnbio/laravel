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

    <div class="form-floating mb-3">
        <input v-model="form[name]"
               :id="name"
               class="form-control"
               :class="{'is-invalid': form.errors[name]}"
               :placeholder="label"
               v-bind="$attrs" />
        <label :class="{'mb-0': info}" class="form-label" :for="name">
            {{ label }}
        </label>
        <div class="supporting-text" v-if="info">
            {{ info }}
        </div>
        <div class="invalid-feedback" v-if="form.errors[name]">
            {{ form.errors[name] }}
        </div>
    </div>

</template>
