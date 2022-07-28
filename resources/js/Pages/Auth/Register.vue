<template>
    <Head title="Register / ManageMyEvents" />

    <BreezeValidationErrors class="mb-4" />

    <form @submit.prevent="submit">
        <div class="flex w-full justify-center	">

            <div class="select-login container__btn__register" style="background-color: #60A5FA">
                <div class="link">
                    <a :href="route('register')" class="uppercase font-bold" style="color: white">
                        Inscription
                    </a>
                </div>
            </div>

            <div class="select-login container__btn__login" style="background-color: white">
                <div class="link">
                    <a :class="{ 'opacity-25': form.processing }" class="uppercase font-bold" :href="route('login')" style="color: #60A5FA">
                        Connexion
                    </a>
                </div>
            </div>
        </div>

        <div class="px-16 pt-10 pb-6">

        <div>
            <BreezeLabel for="name" class="text-mme-blue uppercase" value="Nom" />
            <BreezeInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus autocomplete="name" />
        </div>

        <div class="mt-4">
            <BreezeLabel for="email" class="text-mme-blue uppercase" value="Email" />
            <BreezeInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autocomplete="username" />
        </div>

        <div class="mt-4">
            <BreezeLabel for="password" class="text-mme-blue uppercase" value="Mot de passe" />
            <BreezeInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="new-password" />
        </div>

        <div class="mt-4">
            <BreezeLabel for="password_confirmation" class="text-mme-blue uppercase" value="Confirmer le mot de passe" />
            <BreezeInput id="password_confirmation" type="password" class="mt-1 block w-full" v-model="form.password_confirmation" required autocomplete="new-password" />
        </div>
        <div class="mt-4">
            <Label value="Choisissez votre département" class="text-mme-blue uppercase"></Label>
            <Select class="text-mme-blue uppercase bg-white" v-model="form.department" :options="filteredArray" :message="form.errors.department"/>
        </div>
        </div>

        <div class="block flex">
            <Button :class="{ 'opacity-25': form.processing }" class="uppercase font-bold m-auto bg-mme-blue hover:bg-blue-600" :disabled="form.processing">
                S'inscrire
            </Button>
        </div>
    </form>
</template>

<script>
import BreezeButton from '@/Components/Button.vue'
import BreezeGuestLayout from '@/Layouts/Guest.vue'
import BreezeInput from '@/Components/Input.vue'
import BreezeLabel from '@/Components/Label.vue'
import Select from "@/Components/Select";
import BreezeValidationErrors from '@/Components/ValidationErrors.vue'
import Button from "@/Components/Button";
import { Head, Link } from '@inertiajs/inertia-vue3';
import Label from "@/Components/Label";

export default {
    layout: BreezeGuestLayout,

    components: {
        Label,
        BreezeButton,
        BreezeInput,
        BreezeLabel,
        Button,
        BreezeValidationErrors,
        Head,
        Link,
        Select
    },
    props: {
        department: Object
    },
    data() {
        return {
            form: this.$inertia.form({
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
                department: '',
                terms: false,
                animation_id: null
            })
        }
    },
    methods: {
        submit() {
            this.form.post(this.route('register'), {
                onFinish: () => this.form.reset('password', 'password_confirmation'),
            })
        }
    }
}
</script>
