<script setup lang="ts">

import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from "@headlessui/vue";
import { useModal } from "inertia-modal";

const { show, close, redirect } = useModal();

</script>

<template>
    <TransitionRoot appear as="template" :show="show">
        <Dialog as="div" class="modal fade show d-block" @close="close">
            <TransitionChild @after-leave="redirect" as="template">
                <div class="modal-backdrop z-0" />
            </TransitionChild>
            <div class="modal-dialog">
                <TransitionChild as="template">
                    <DialogPanel class="modal-content">
                        <div class="modal-header">
                            <DialogTitle as="h5" class="modal-title">
                                <slot name="modal-title" />
                            </DialogTitle>
                            <button type="button" class="btn-close" @click="close" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <slot />
                        </div>
                        <div class="modal-footer">
                            <slot name="modal-footer" />
                            <button type="button" class="btn btn-secondary" @click="close">Close</button>
                        </div>
                    </DialogPanel>
                </TransitionChild>
            </div>
        </Dialog>
    </TransitionRoot>
</template>
