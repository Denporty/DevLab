<template>
    <Authenticated>
        <Modal :show="showModal" type="danger">
            <div class="font-bold text-xl leading-none">Êtes-vous sûr de vouloir supprimer cet item ?</div>
            <div class="flex my-2 justify-center">
                <button @click="showModal = false" class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mx-2">Non</button>
                <button @click="confirmDelete" class="bg-red-600 hover:bg-red-500 text-white font-bold py-2 px-4 rounded mx-2">Oui</button>
            </div>
        </Modal>
        <div class="px-36">
            <a :href="route('admin.animation')" class="inline-block bg-gray-800 hover:bg-gray-700 active:bg-gray-900 text-white font-bold py-2 px-4 rounded my-2">
                Retour
            </a>
            <div class="w-full px-4 py-6">
                <div class="my-2">
                    <Input label="Titre de l'animation" name="name" v-model="form.name" :message="form.errors.name"/>
                </div>
                <div class="my-2">
                    <Input label="Localisation" name="localisation" v-model="form.localisation" :message="form.errors.localisation"/>
                </div>
                <div class="my-2">
                    <Select label="Catégorie" v-model="form.tag" :options="categories" :message="form.errors.tag"/>
                </div>
                <div class="my-2">
                    <Select label="Départements concernés" v-model="form.department" :options="department" :message="form.errors.department"/>
                </div>
                <div class="my-2">
                    <Input type="number" label='Nombre de places' name="places" v-model="form.places" :message="form.errors.places"/>
                </div>
                <div class="my-2">
                    <Input label="Description de l'événement" name="description" v-model="form.description" :message="form.errors.description"/>
                </div>
                <div class="my-2">
                    <Datepicker label="Date de début" name="start_date" v-model="form.start_date" :message="form.errors.start_date"/>
                </div>
                <div class="my-2">
                    <Datepicker label="Date de fin" name="end_date" v-model="form.end_date" :message="form.errors.end_date"/>
                </div>
                <hr class="my-4">
                <div>
                    <Checkbox label="Activer le service Click&Eat :" classname="ml-2" name="active-service" v-model:checked="form.active_section" :message="form.errors.active_section"/>
                    <InputError class="mt-1" :message="form.errors.active_section"/>
                </div>
                <div class="flex" v-if="form.active_section">
                    <div class="w-1/2 mr-2">
                        <Input label='Nom de la section' name="section_title" v-model="form.section_title" :message="form.errors.section_title"/>
                    </div>
                    <div class="w-1/2 ml-2">
                        <Input label='Description de la section' name="description_section" v-model="form.description_section" :message="form.errors.description_section"/>
                    </div>
                    <div class="w-1/2 ml-2">
                        <Input label='Carte' name="map" v-model="form.map" :message="form.errors.map"/>
                    </div>
                </div>
                <div class="flex py-4">
                    <Button :disabled="form.processing" @click="submitForm" class="bg-blue-500 hover:bg-blue-700">
                        Sauvegarder
                    </Button>
                    <Button v-if="animation?.id" @click="showModal = true" class="bg-red-500 hover:bg-red-700 ml-4">
                        Supprimer
                    </Button>
                </div>
            </div>
        </div>
    </Authenticated>
</template>

<script>
import Authenticated from "@/Layouts/Authenticated";
import Input from '@/Components/Input'
import Checkbox from '@/Components/Checkbox'
import Button from '@/Components/Button'
import Datepicker from "@/Components/DatePicker";
import Select from "@/Components/Select";
import Modal from "@/Components/Modal";
import InputError from "@/Components/InputError";
export default {
    name: 'AnimationForm',
    components: {
        Datepicker,
        Authenticated,
        Input,
        Checkbox,
        Button,
        Select,
        Modal,
        InputError

    },
    props: {
        animation: Object,
        categories: Object,
        department: Object
    },
    data() {
        return {
            form: this.$inertia.form({
                name: this.animation?.name ?? null,
                description: this.animation?.description ?? null,
                localisation: this.animation?.localisation ?? null,
                department: this.animation?.department ?? null,
                start_date: this.animation?.start_date ?? null,
                end_date: this.animation?.end_date ?? null,
                tag: this.animation?.tag ?? null,
                places: this.animation?.places ?? 0,
                description_section: this.animation?.description_section ?? null,
                section_title: this.animation?.section_title ?? null,
                map: this.animation?.map ?? null,
                active_section: this.animation?.active_section ?? false,
            }),
            showModal: false
        }
    },
    methods: {
        submitForm() {
            if(this.animation?.id) this.form.post(route('admin.animation.update', this.animation.id))
            else this.form.post(route('admin.animation.store'))
        },
        confirmDelete() {
            this.$inertia.delete(route('admin.animation.delete', this.animation?.id))
            this.showModal = false
        }
    }
}
</script>
<style lang="scss" scoped>
</style>
