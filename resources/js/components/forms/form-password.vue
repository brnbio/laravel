<script setup>

import Icon            from '@/components/icon.vue';
import { inject, ref } from 'vue';

defineOptions({
    inheritAttrs: false
})

defineProps({
    name: String,
    label: String
})

const form = inject("form")
const passwordVisible = ref(false)

function toggle() {
    passwordVisible.value = !passwordVisible.value
}

</script>
<template>

    <div class="input-group mb-3">
        <div class="form-floating is-invalid">
            <input v-model="form[name]"
                   :type="passwordVisible ? 'text':  'password'"
                   class="form-control border-end-0"
                   :class="{'is-invalid': form.errors[name]}"
                   :id="name"
                   :placeholder="label"
                   v-bind="$attrs" />
            <label class="form-label" :for="name">
                {{ label }}
            </label>
        </div>
        <span class="input-group-text bg-white text-muted" @click="toggle" style="cursor: pointer;">
            <Icon name="visibility" v-if="!passwordVisible" />
            <Icon name="visibility_off" v-if="passwordVisible" />
        </span>
        <div class="invalid-feedback" v-if="form.errors[name]">
            {{ form.errors[name] }}
        </div>
    </div>

</template>
