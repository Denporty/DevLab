<template>
    <Authenticated>
        <div class="wrapper__events-list">
            <Sidebar></Sidebar>
            <div class="container__main">
                <Modal :show="showModal" type="danger">
                    <div class="font-bold text-xl leading-none">Êtes-vous sûr de vouloir supprimer cet item ?</div>
                    <div class="flex my-2 justify-center">
                        <button @click="showModal = false" class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mx-2">Non</button>
                        <button @click="confirmDelete" class="bg-red-600 hover:bg-red-500 text-white font-bold py-2 px-4 rounded mx-2">Oui</button>
                    </div>
                </Modal>
                <div class="lg:px-36 px-4">
                    <button onclick="window.history.back()" class="inline-block bg-gray-800 hover:bg-gray-700 active:bg-gray-900 text-white font-bold py-2 px-4 rounded my-2">
                        Retour
                    </button>
                    <div class="w-full px-4 py-6">
                        <div class="my-2">
                            <Input label="Nom" name="name" v-model="form.name" :message="form.errors.name"/>
                        </div>
                        <div class="flex py-4">
                            <Button :disabled="form.processing" @click="submitForm" class="bg-blue-500 hover:bg-blue-700">
                                Sauvegarder
                            </Button>
                            <Button v-if="department?.id" @click="showModal = true" class="bg-red-500 hover:bg-red-700 ml-4">
                                Supprimer
                            </Button>
                        </div>
                    </div>
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
import Sidebar from "@/Components/Sidebar";
export default {
    name: 'DepartmentsForm',
    components: {
        Datepicker,
        Authenticated,
        Input,
        Checkbox,
        Button,
        Select,
        Modal,
        InputError,
        Sidebar

    },
    props: {
        department: Object,
    },
    data() {
        return {
            form: this.$inertia.form({
                name: this.department?.name ?? null
            }),
            showModal: false,
        }
    },
    methods: {
        submitForm() {
            if(this.department?.id) this.form.post(route('admin.departments.update', this.department.id))
            else this.form.post(route('admin.departments.store'))
        },
        confirmDelete() {
            this.$inertia.delete(route('admin.departments.delete', this.department?.id))
            this.showModal = false
        }
    },
}
</script>
<style lang="scss" scoped>
</style>
