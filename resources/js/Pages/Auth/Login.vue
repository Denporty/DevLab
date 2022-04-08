<template>
    <Head title="Log in / ManageMyEvents" />

    <BreezeValidationErrors class="mb-4" />

    <div v-if="status" class="mb-4 font-medium text-sm">
        {{ status }}
    </div>

    <form @submit.prevent="submit">
        <div class="flex w-full">
            <div class="select-login">
                <div class="link">
                    <a :href="route('register')">
                        Inscription
                    </a>
                </div>
            </div>
            <div class="select-login">
                <div class="button">
                    <a :class="{ 'opacity-25': form.processing }" class="uppercase font-bold" :href="route('login')">
                        Connexion
                    </a>
                </div>
            </div>
        </div>
        <div class="px-16 pt-10 pb-6">
        <div>
            <BreezeLabel for="email" class="text-mme-blue uppercase" value="Email" />
            <Input id="email" type="email" :classname="'mt-1 block w-full bg-white'" v-model="form.email" autofocus autocomplete="username" />
        </div>

        <div class="mt-4">
            <BreezeLabel class="text-mme-blue uppercase" for="password" value="Password" />
            <BreezeInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="current-password" />
        </div>

        <div class="block mt-8 flex">
<!--            <label class="flex items-center">-->
<!--                <BreezeCheckbox name="remember" v-model:checked="form.remember" />-->
<!--                <span class="ml-2 text-sm">Remember me</span>-->
<!--            </label>-->
            <Button :class="{ 'opacity-25': form.processing }" class="uppercase font-bold m-auto bg-mme-blue hover:bg-blue-600" :disabled="form.processing">
                Se connecter
            </Button>
        </div>

        </div>
    </form>
</template>

<script>
import BreezeButton from '@/Components/Button.vue'
import BreezeCheckbox from '@/Components/Checkbox.vue'
import BreezeGuestLayout from '@/Layouts/Guest.vue'
import BreezeInput from '@/Components/Input.vue'
import BreezeLabel from '@/Components/Label.vue'
import BreezeValidationErrors from '@/Components/ValidationErrors.vue'
import Input from "@/Components/Input";
import { Head, Link } from '@inertiajs/inertia-vue3';
import Button from "@/Components/Button";

export default {
    layout: BreezeGuestLayout,

    components: {
        Button,
        BreezeButton,
        BreezeCheckbox,
        Input,
        BreezeInput,
        BreezeLabel,
        BreezeValidationErrors,
        Head,
        Link,
    },

    props: {
        canResetPassword: Boolean,
        status: String,
    },

    data() {
        return {
            form: this.$inertia.form({
                email: '',
                password: '',
                remember: false
            })
        }
    },

    methods: {
        submit() {
            this.form.post(this.route('login'), {
                onFinish: () => this.form.reset('password'),
            })
        }
    }
}
</script>
