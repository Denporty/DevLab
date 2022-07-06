<template>
    <div>
        <Modal :show="showModal" type="info">
            <div class="font-bold text-xl leading-none mb-4">Redimensionner l'image</div>
            <vue-cropper
                ref="cropper"
                :minContainerWidth="500"
                :minContainerHeight="400"
                :aspectRatio="ratio ?? null"
                alt="Source Image"
                :src="preview">
            </vue-cropper>
            <div class="flex my-2 justify-center">
                <Button type="button" @click="showModal = false">Annuler</Button>
                <Button type="button" @click="cropImage" class="bg-green-600 hover:bg-green-500 ml-4">Redimmensioner</Button>
            </div>
        </Modal>

        <Label :for="label" :value="valueLabel ?? 'Image'"/>
        <input type="file" :id="label" ref="image"
               @input="$emit('update:modelValue', $event.target.files[0])"
               @change="updatePreview"/>
        <div v-show="preview" class="flex pt-4">
            <Button type="button" @click="showModal = true" class="bg-blue-600 mr-4">Redimmensioner</Button>
            <Button type="button" @click="clearImage">Retirer image</Button>
        </div>
        <progress class="mt-2" v-if="form.progress" :value="form.progress.percentage" max="100">
            {{ form.progress.percentage }}%
        </progress>
        <div v-show="preview">
            <img :src="preview" alt="prévisualisation" class="object-cover border block h-56 mt-4">
        </div>
        <InputError :message="form.errors[label]"></InputError>
    </div>
</template>

<script>
import Label from "@/Components/Label";
import Modal from "@/Components/Modal";
import InputError from "@/Components/InputError";
import Button from "@/Components/Button";
import VueCropper from 'vue-cropperjs';
import 'cropperjs/dist/cropper.css';

export default {
    props: ['form', 'label', 'valueLabel','ratio'],
    emits: ['update:modelValue'],
    components: {
        InputError,
        Button,
        Label,
        Modal,
        VueCropper
    },
    data(){
        return{
            preview: this.form[this.label] ?? null,
            cropImg: '',
            showModal: false
        }
    },
    methods: {
        updatePreview() {
            const reader = new FileReader();
            reader.onload = (e) => {
                this.preview = e.target.result;
                this.$refs.cropper.replace(this.preview)
            }
            reader.readAsDataURL(this.$refs.image.files[0]);
        },
        clearImage() {
            this.$emit('update:modelValue', null)
            this.preview = null
            this.$refs.image.files = null
            this.$refs.image.value = null
        },
        cropImage() {
            this.$refs.cropper.getCroppedCanvas().toBlob(blob => {
                const file = new File([blob], 'image')
                this.$emit('update:modelValue', file)
            })
            this.preview = this.$refs.cropper.getCroppedCanvas().toDataURL()
            this.$refs.cropper.replace(this.preview)
            this.showModal = false
        },
    }
}
</script>
