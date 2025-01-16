<script setup>

import FormControl     from '@/components/forms/form-control.vue';
import TableResponsive from '@/components/table-responsive.vue';
import { useForm }     from '@inertiajs/vue3';
import { provide }     from 'vue';

const form = useForm({
    email: 'Test',
    password: null,
    remember: false,
})
provide('form', form);

</script>

<template>
    <div class="container p-5">
        <form>
            <FormControl label="E-Mail" name="email" type="email" />
            <FormControl label="Passwort" name="password" type="password" />
        </form>
        <TableResponsive>
            <thead>
                <tr>
                    <th>Test</th>
                </tr>
            </thead>
        </TableResponsive>
    </div>
</template>
