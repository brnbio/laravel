<script setup>

import Icon            from '@components/icon';
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

    <div class="form-group">
        <label class="form-label" :for="name">
            {{ label }}
        </label>
        <div class="input-group">
            <input v-model="form[name]"
                   :type="passwordVisible ? 'text':  'password'"
                   class="form-control border-end-0"
                   :class="{'is-invalid': form.errors[name]}"
                   :id="name"
                   :placeholder="label"
                   v-bind="$attrs" />
            <span class="input-group-text fs-5 bg-white text-muted" @click="toggle" style="cursor: pointer;">
                <Icon name="show" inline v-if="!passwordVisible" />
                <Icon name="hide" inline v-if="passwordVisible" />
            </span>
        </div>
        <div class="invalid-feedback" v-if="form.errors[name]">
            {{ form.errors[name] }}
        </div>
    </div>

</template>
