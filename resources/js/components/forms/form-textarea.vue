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
});

const form = inject('form');

</script>
<template>

    <div class="form-floating">
        <textarea class="form-control"
                  v-model="form[name]"
                  :class="{'is-invalid': form.errors[name]}"
                  v-bind="$attrs"
                  :placeholder="label"></textarea>
        <label class="form-label">
            {{ label }}
        </label>
        <div class="invalid-feedback" v-if="form.errors[name]">
            {{ form.errors[name] }}
        </div>
    </div>

</template>
