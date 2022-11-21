<script setup>
import { useEditor, EditorContent } from "@tiptap/vue-3";
import StarterKit from "@tiptap/starter-kit";
import CharacterCount from "@tiptap/extension-character-count";
import { mergeAttributes } from "@tiptap/core";
import Heading from "@tiptap/extension-heading";
import OrderedList from "@tiptap/extension-ordered-list";
import BulletList from "@tiptap/extension-bullet-list";
import Bold from "@/Components/forms/tiptap/Bold.vue";
import Italic from "@/Components/forms/tiptap/Italic.vue";
import Strike from "@/Components/forms/tiptap/Strike.vue";
import Heading1 from "@/Components/forms/tiptap/H1.vue";
import Heading2 from "@/Components/forms/tiptap/H2.vue";
import Heading3 from "@/Components/forms/tiptap/H3.vue";
import Paragraph from "@/Components/forms/tiptap/Paragraph.vue";
import BulletListIcon from "@/Components/forms/tiptap/BulletList.vue";
import OrderedListIcon from "@/Components/forms/tiptap/OrderedList.vue";
import HorizontalRule from "@/Components/forms/tiptap/HorizontalRule.vue";
import Undo from "@/Components/forms/tiptap/Undo.vue";
import Redo from "@/Components/forms/tiptap/Redo.vue";

const props = defineProps({
    content: String,
    model: String,
    maxChar: Number,
});
const maxCharacters = props.maxChar;

const emit = defineEmits(["content"]);

let editor = useEditor({
    content: props.content,
    extensions: [
        StarterKit.configure({
            heading: false,
            OrderedList: false,
            BulletList: false,
        }),
        CharacterCount.configure({
            limit: maxCharacters,
        }),
        Heading.configure({ levels: [1, 2, 3] }).extend({
            levels: [1, 2, 3],
            renderHTML({ node, HTMLAttributes }) {
                const level = this.options.levels.includes(node.attrs.level)
                    ? node.attrs.level
                    : this.options.levels[0];
                const classes = {
                    1: "text-3xl font-bold",
                    2: "text-2xl font-bold",
                    3: "text-xl font-bold",
                };
                return [
                    `h${level}`,
                    mergeAttributes(
                        this.options.HTMLAttributes,
                        HTMLAttributes,
                        {
                            class: `${classes[level]}`,
                        }
                    ),
                    0,
                ];
            },
        }),
        OrderedList.configure({
            HTMLAttributes: {
                class: "list-decimal ml-6",
            },
        }),
        BulletList.configure({
            HTMLAttributes: {
                class: "list-disc ml-6",
            },
        }),
    ],
    editorProps: {
        attributes: {
            class: "prose prose-sm sm:prose lg:prose-lg xl:prose-2xl m-2 focus:outline-none",
        },
    },
    onUpdate: ({ editor }) => {
        emit("content", editor.getHTML());
    },
});
</script>

<template>
    <div class="mb-4 rounded-md border border-gray-500 p-1">
        <div v-if="editor" class="mb-2 flex flex-row justify-around">
            <div class="flex flex-row space-x-2">
                <Bold
                    @click="editor.chain().focus().toggleBold().run()"
                    :active="editor.isActive('bold')"
                />

                <Italic
                    @click="editor.chain().focus().toggleItalic().run()"
                    :active="editor.isActive('italic')"
                />

                <Strike
                    @click="editor.chain().focus().toggleStrike().run()"
                    :active="editor.isActive('strike')"
                />
            </div>

            <div class="flex flex-row space-x-2">
                <Heading1
                    @click="
                        editor.chain().focus().toggleHeading({ level: 1 }).run()
                    "
                    :active="editor.isActive('heading', { level: 1 })"
                />

                <Heading2
                    @click="
                        editor.chain().focus().toggleHeading({ level: 2 }).run()
                    "
                    :active="editor.isActive('heading', { level: 2 })"
                />

                <Heading3
                    @click="
                        editor.chain().focus().toggleHeading({ level: 3 }).run()
                    "
                    :active="editor.isActive('heading', { level: 3 })"
                />

                <Paragraph
                    @click="editor.chain().focus().setParagraph().run()"
                    :active="editor.isActive('paragraph')"
                />
            </div>

            <div class="flex flex-row space-x-2">
                <BulletListIcon
                    @click="editor.chain().focus().toggleBulletList().run()"
                    :active="editor.isActive('bulletList')"
                />

                <OrderedListIcon
                    @click="editor.chain().focus().toggleOrderedList().run()"
                    :active="editor.isActive('orderedList')"
                />
            </div>
            <div class="flex flex-row space-x-2">
                <HorizontalRule
                    @click="editor.chain().focus().setHorizontalRule().run()"
                />
                <Undo
                    @click="editor.chain().focus().undo().run()"
                    :disabled="!editor.can().chain().focus().undo().run()"
                />
                <Redo
                    @click="editor.chain().focus().redo().run()"
                    :disabled="!editor.can().chain().focus().redo().run()"
                />
            </div>
        </div>
        <hr />
        <editor-content :editor="editor" :v-model="props.model" />
        <hr />
        <div class="mt-2 p-2 text-right text-xs text-gray-500" v-if="editor">
            {{ editor.storage.characterCount.characters() }} /
            {{ maxCharacters }} Zeichen,

            {{ editor.storage.characterCount.words() }} Wörter
        </div>
    </div>
</template>
