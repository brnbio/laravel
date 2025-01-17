<script setup>

import { computed, inject, ref } from 'vue';
import VueSelect                 from 'vue-select';

defineOptions({
    inheritAttrs: false
})

const props = defineProps({
    name: String,
    label: String,
    options: Array,
    required: {
        type: Boolean,
        default: false
    }
})

const form = inject("form")

let search = ref("")
let selectOptions = computed(() => {
    if (props.options.length < 100) {
        return props.options
    }
    if (search.value.length > 3) {
        return props.options.slice(0, 100)
    }
    if (form[props.name]) {
        return props.options.filter(item => item.id === form[props.name])
    }
    return props.options.slice(0, 100)
})

function filterOptions(query) {
    search.value = query
}

</script>
<template>

    <div class="mb-3">
        <label class="form-label" :for="name">
            {{ label }}
        </label>
        <VueSelect v-bind="$attrs"
                   v-model="form[name]"
                   label="text"
                   :reduce="model => model.id"
                   :clearable="!required"
                   :options="selectOptions"
                   :value="form[name]"
                   :id="name"
                   :class="{'is-invalid': form.errors[name]}"
                   :placeholder="label"
                   @search="filterOptions" />
        <div class="invalid-feedback" v-if="form.errors[name]">
            {{ form.errors[name] }}
        </div>
    </div>

</template>
