<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Editor from "ckeditor5-custom-build";
import { useForm } from "@inertiajs/inertia-vue3";
import Button from "@/Components/Button.vue";
import JetInput from "@/Components/Input.vue";
import JetInputError from "@/Components/InputError.vue";
import JetLabel from "@/Components/Label.vue";

const editor = Editor;

var csrf_token = document.head
    .querySelector('meta[name="csrf-token"]')
    .getAttribute("content");

const editorConfig = {
    ckfinder: {
        uploadUrl: route("upload-image.store", { _token: csrf_token }),
    },
    list: {
        properties: {
            styles: true,
            startIndex: true,
            reversed: true,
        },
    },
};

const form = useForm({
    title: "",
    slug: "",
    description: "",
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
                    <form @submit.prevent="form.post(route('post.store'))">
                        <div class="mb-4">
                            <JetLabel for="title" value="Título" />
                            <JetInput
                                id="name"
                                v-model="form.title"
                                type="text"
                                class="mt-1 block w-full"
                                autocomplete="name"
                            />
                            <JetInputError
                                :message="form.errors.title"
                                class="mt-2"
                            />
                        </div>
                        <ckeditor
                            :editor="editor"
                            v-model="form.description"
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
.ck-editor__editable_inline > ul {
    @apply list-disc pl-10 m-0;
}

.ck-editor__editable_inline > h2 {
    @apply text-4xl;
}
.ck-editor__editable_inline > h3 {
    @apply text-3xl;
}
.ck-editor__editable_inline > h4 {
    @apply text-2xl;
}
.ck-editor__editable_inline > ol {
    @apply list-decimal pl-10 text-base;
}

.ck-editor__editable_inline .text-big {
    @apply text-2xl;
}
.ck-editor__editable_inline .text-huge {
    @apply text-4xl;
}

.ck-editor__editable_inline {
    min-height: 300px;
}
</style>
