<template>
    <Authenticated>
        <InertiaLink :href="route('animation')" class="inline-block bg-gray-800 hover:bg-gray-700 active:bg-gray-900 text-white font-bold py-2 px-4 rounded my-2">
            Retour
        </InertiaLink>
        <div class="w-full px-4 py-6">
            <div class="my-2">
                <Input label="Titre de l'animation" name="name" v-model="form.name" :message="form.errors.name"/>
            </div>
            <div class="my-2">
                <Input label="Localisation" name="localisation" v-model="form.localisation" :message="form.errors.localisation"/>
            </div>
            <div class="my-2">
                <Input label='Catégorie' name="tag" v-model="form.tag" :message="form.errors.tag"/>
            </div>
            <div class="my-2">
                <Input label='Département concernés' name="department" v-model="form.department" :message="form.errors.department"/>
            </div>
            <div class="my-2">
                <Input label='Nombre de places' name="places" v-model="form.places" :message="form.errors.places"/>
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
            <div class="flex py-4">
                <Button :disabled="form.processing" @click="submitForm" class="bg-blue-500 hover:bg-blue-700">
                    Sauvegarder
                </Button>
                <Button v-if="animation?.id" @click="showModal = true" class="bg-red-500 hover:bg-red-700 ml-4">
                    Supprimer
                </Button>
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
export default {
    name: 'AnimationForm',
    components: {
        Datepicker,
        Authenticated,
        Input,
        Checkbox,
        Button,

    },
    props: {
        animation: Object
    },
    data() {
        return {
            form: this.$inertia.form({
                name: this.animation?.name ?? null,
                description: this.animation?.description ?? null,
                localisation: this.animation?.localisation ?? null,
                start_date: this.start_date?.image ?? null,
                end_date: this.animation?.end_date ?? null,
                tag: this.animation?.tag ?? null,
                places: this.animation?.places ?? 0,
            }),
            showModal: false
        }
    },
    methods: {
        submitForm() {
            if(this.animation?.id) this.form.post(route('animation.update', this.animation.id))
            else this.form.post(route('animation.store'))
        }
    }
}
</script>
<style lang="scss" scoped>
</style>
