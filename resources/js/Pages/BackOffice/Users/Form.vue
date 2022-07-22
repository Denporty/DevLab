<template>
    <Authenticated>
        <div class="wrapper__form">
            <Sidebar></Sidebar>
            <BurgerMenu></BurgerMenu>

            <div class="container__main">
                <div class="px-4 container__all">
                    <h1 class="title">Modifier l'utilisateur {{ this.user.name }}</h1>
                <Modal :show="showModal" type="danger">
                    <div class="font-bold text-xl leading-none">Êtes-vous sûr de vouloir supprimer cet item ?</div>
                    <div class="flex my-2 justify-center">
                        <button @click="showModal = false" class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mx-2">Non</button>
                        <button @click="confirmDelete" class="bg-red-600 hover:bg-red-500 text-white font-bold py-2 px-4 rounded mx-2">Oui</button>
                    </div>
                </Modal>
                <div class="lg:px-36 px-4 container__form mt-10">
                    <button onclick="window.history.back()" class="inline-block bg-gray-800 hover:bg-gray-700 active:bg-gray-900 text-white font-bold py-2 px-4 rounded my-2">
                        Retour
                    </button>
                    <div class="w-full px-4 py-6">
                        <div class="my-2" v-if="reservationCancel">
                            <p>Etes vous sur de vouloir annuler la participation à l'événement de l'utilisateur {{ this.user.name }} ?</p>
                            <br>
                            <select label="Animation" class="appearance-none block w-full capitalize bg-white text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="animation_id" val v-model="form.animation_id">
                                <option :value="form.animation_id">Non</option>
                                <option :value="null">Oui</option>
                            </select>
                        </div>
                        <div v-else>
                            <div class="my-2">
                                <Input label="Nom" name="name" v-model="form.name" :message="form.errors.name"/>
                            </div>
                            <div class="my-2">
                                <Select label="Départements" v-model="form.department" :options="department" :message="form.errors.department"/>
                            </div>
                            <div class="my-2">
                                <label>Organisateur</label>
                                <select class="appearance-none block w-full capitalize bg-white text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="admin" val v-model="form.admin">
                                    <option disabled selected :value="form.admin">{{ form.admin ? 'Oui' : 'Non' }}</option>
                                    <option :value="!form.admin ? admin.Oui : admin.Non">{{ !form.admin ? 'Oui' : 'Non' }}</option>
                                </select>
                            </div>
                            <div class="my-2">
                                <label>Super administrateur</label>
                                <select class="appearance-none block w-full capitalize bg-white text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="admin" val v-model="form.super_admin">
                                    <option disabled selected :value="form.super_admin">{{ form.super_admin ? 'Oui' : 'Non' }}</option>
                                    <option :value="!form.super_admin ? admin.Oui : admin.Non">{{ !form.super_admin ? 'Oui' : 'Non' }}</option>
                                </select>
                            </div>
                            <div class="my-2">
                                <Input label="Email" name="summary" v-model="form.email" :message="form.errors.email"/>
                            </div>
                        </div>
                        <div class="flex py-4">
                            <Button :disabled="form.processing" @click="submitForm" class="bg-blue-500 hover:bg-blue-700">
                                Sauvegarder
                            </Button>
                            <Button v-if="user?.id && !reservationCancel" @click="showModal = true" class="bg-red-500 hover:bg-red-700 ml-4">
                                Supprimer
                            </Button>
                        </div>
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
import BurgerMenu from '@/Components/BurgerMenu';

export default {
    name: 'UsersForm',
    components: {
        Datepicker,
        Authenticated,
        Input,
        Checkbox,
        Button,
        Select,
        Modal,
        InputError,
        Sidebar,
        BurgerMenu

    },
    props: {
        department: {
            type: Object,
            default: {}
        },
        user: {
            type: Object,
            default: {}
        },
        admin: {
            type: Object,
            default: function () {
                return { Oui: true, Non: false }
            }
        },
        reservationCancel: {
            type: Boolean,
            default: false
        },
    },
    data() {
        return {
            form: this.$inertia.form({
                name: this.user?.name ?? null,
                email: this.user?.email ?? null,
                department: this.user?.department ?? null,
                admin: this.user?.admin ?? null,
                super_admin: this.user?.super_admin ?? null,
                animation_id: this.user?.animation_id ?? null
            }),
            showModal: false,
            showAlert: false
        }
    },
    methods: {
        submitForm() {
            if(this.user?.id) this.form.post(route('admin.users.update', this.user.id))
            else this.form.post(route('admin.users.store'))
        },
        confirmDelete() {
            this.$inertia.delete(route('admin.users.delete', this.user?.id))
            this.showModal = false
        },
    },
}
</script>
<style lang="scss" scoped>
</style>
