<script setup>

import { inject } from 'vue';

defineOptions({
    inheritAttrs: false
})

const props = defineProps({
    name: {
        type: String,
        required: true
    },
    label: {
        type: String,
        required: false
    }
});

const form = inject('form');

</script>
<template>

    <div class="form-group">
        <label class="form-label" v-if="label">
            {{ label }}
        </label>
        <input @input="form[name] = $event.target.files"
               type="file"
               class="form-control"
               :class="{'is-invalid': form.errors[name]}"
               v-bind="$attrs" />
        <div class="invalid-feedback" v-if="form.errors[name]">
            {{ form.errors[name] }}
        </div>
    </div>

</template>
