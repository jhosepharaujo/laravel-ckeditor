<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Editor from "ckeditor5-custom-build";
import { useForm } from "@inertiajs/inertia-vue3";
import Button from "../Components/Button.vue";

const editor = Editor;

var csrf_token = document.head
    .querySelector('meta[name="csrf-token"]')
    .getAttribute("content");

const editorConfig = {
    ckfinder: {
        uploadUrl: route("upload-image.store", { _token: csrf_token }),
    },
};

const form = useForm({
    editorData: "",
});
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Editor
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white overflow-hidden shadow-xl sm:rounded-sm p-2"
                >
                    <form @submit.prevent="form.post(route('editor.store'))">
                        <ckeditor
                            :editor="editor"
                            v-model="form.editorData"
                            :config="editorConfig"
                        >
                        </ckeditor>
                        <div class="mt-4">
                            <Button :disabled="form.processing">Salvar</Button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style>
.ck-editor__editable_inline {
    min-height: 300px;
}
</style>
