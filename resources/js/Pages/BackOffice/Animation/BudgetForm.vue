<template>
    <Authenticated>
        <div class="wrapper__form">
            <Sidebar></Sidebar>
            <BurgerMenu></BurgerMenu>

            <div class="container__main">
                <div class="px-4 container__all">
                    <h1 class="title">{{ budget != null ? 'Modifier la catégorie ' + budget.name : 'Créer une catégorie' }}</h1>

                    <!--                    <Modal :show="showModal" type="danger">-->
                    <!--                        <div class="font-bold text-xl leading-none">Êtes-vous sûr de vouloir supprimer cett catégorie ?</div>-->
                    <!--                        <div class="flex my-2 justify-center">-->
                    <!--                            <button @click="showModal = false" class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mx-2">Non</button>-->
                    <!--                            <button @click="confirmDelete" class="bg-red-600 hover:bg-red-500 text-white font-bold py-2 px-4 rounded mx-2">Oui</button>-->
                    <!--                        </div>-->
                    <!--                    </Modal>-->

                    <div class="lg:px-36 px-4 container__form mt-10">
                        <button onclick="window.history.back()" class="inline-block bg-gray-800 hover:bg-gray-700 active:bg-gray-900 text-white font-bold py-2 px-4 rounded my-2">
                            Retour
                        </button>
                        <div class="w-full px-4 py-6 ">
                            <div class="my-2">
                                <Input label="Nom" name="name" v-model="form.name" :message="form.errors.name"/>
                            </div>
                            <div class="my-2">
                                <Input label="Prix" name="price" v-model="form.price" :message="form.errors.price"/>
                            </div>
                            <div class="my-2">
                                <Input label="Quantité" name="quantity" v-model="form.quantity" :message="form.errors.quantity"/>
                            </div>
                            <div class="flex py-4">
                                <Button :disabled="form.processing" @click="submitForm" class="btn__create">
                                    Sauvegarder
                                </Button>
                                <Button v-if="budget?.id" @click="showModal = true" class="btn__delete">
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
import BurgerMenu from "@/Components/BurgerMenu";
export default {
    name: 'BudgetsForm',
    components: {
        Authenticated,
        Input,
        Button,
        Modal,
        InputError,
        Sidebar,
        BurgerMenu
    },
    props: {
        budget: Object,
        animation: Object
    },
    data() {
        return {
            form: this.$inertia.form({
                name: this.budget?.name ?? null,
                price: this.budget?.price ?? null,
                quantity: this.budget?.quantity ?? null,
                animation_id: this.animation.id ?? null
            }),
            showModal: false,
        }
    },
    methods: {
        submitForm() {
            if(this.budget?.id) this.form.post(route('admin.animation.budget.update', this.budget.id))
            else this.form.post(route('admin.animation.budget.store', this.animation.id))
        },
        confirmDelete() {
            this.$inertia.delete(route('admin.animation.budget.delete', this.budget?.id))
            this.showModal = false
        }
    },
    mounted() {
        console.log(this.budget)
        console.log(this.form.animation_id)
        this.form.animation_id = this.animation.id
    }
}
</script>
<style lang="scss" scoped>
</style>
