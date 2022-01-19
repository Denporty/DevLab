<template>
    <Head title="ManageMyEvents"/>
    <header class="fixed w-screen">
        <div v-if="$page.props.auth.user != null">
            <div v-if="$page.props.auth.user.admin" class="bg-gray-300 w-full flex justify-end">
                <a :href="route('dashboard')" class="block mr-4 p-4">
                    Dashboard Admin
                </a>
            </div>
        </div>
        <nav class="flex justify-between w-full bg-blue-500 text-white px-4">
            <a :href="route('animation')" class="items-center flex py-4"><span class="font-semibold text-xl tracking-tight">ManageMyEvents</span></a>
            <div class="md:items-center md:w-auto flex">
                <div class="lg:flex hidden self-end">
                    <div v-if="$page.props.auth.user != null">
                        <BreezeNavLink :href="route('animation.online', $page.props.auth.user.id)" method="get" as="button" class="block md:text-white mr-4 p-4">
                            Liste des animations
                        </BreezeNavLink>
                        <BreezeNavLink :href="route('logout')" method="post" as="button" class="block md:text-white mr-4 p-4">
                            Déconnexion
                        </BreezeNavLink>
                    </div>

                    <div v-else>
                        <BreezeNavLink :href="route('register')" method="get" as="button" class="block md:text-white mr-4 p-4">
                            Inscription
                        </BreezeNavLink>
                        <BreezeNavLink :href="route('login')" method="get" as="button" class="block md:text-white mr-4 p-4">
                            Connexion
                        </BreezeNavLink>
                    </div>
                </div>
                <button id="nav" v-on:click="toggleBurger" class="text-gray-600 font-semibold px-1 text-2xl p-1 px-2 rounded bg-gray-20 flex lg:hidden items-center" type="button">
                    <Icon :icon="showBurger ? 'cross' : 'menuburger'"></Icon>
                </button>
            </div>
        </nav>
        <div v-if="showBurger" class="bg-blue-500 w-full lg:hidden">
            <div v-if="$page.props.auth.user != null">
                <BreezeDropdownLink :href="route('animation.online', $page.props.auth.user.id)" method="get" as="button" class="block md:text-white mr-4 p-4 hover:bg-blue-300">
                    Liste des animations
                </BreezeDropdownLink>
                <BreezeDropdownLink v-if="$page.props.auth.user != null" :href="route('logout')" method="post" as="button" class="block md:text-white mr-4 p-4 hover:bg-blue-300">
                    Déconnexion
                </BreezeDropdownLink>
            </div>
            <div v-else>
                <BreezeDropdownLink :href="route('register')" method="get" as="button" class="block md:text-white mr-4 p-4 hover:bg-blue-300">
                    Inscription
                </BreezeDropdownLink>
                <BreezeDropdownLink :href="route('login')" method="get" as="button" class="block md:text-white mr-4 p-4 hover:bg-blue-300">
                    Connexion
                </BreezeDropdownLink>
            </div>
        </div>
    </header>
    <body class="md:px-16 px-4 py-20" :class="$page.props.auth.user.admin ? 'py-32' : ''">
        <slot></slot>
    </body>
</template>
<script>
import {Head} from "@inertiajs/inertia-vue3";
import BreezeNavLink from '@/Components/NavLink.vue'
import Icon from "@/Components/Icon";
import BreezeDropdownLink from '@/Components/DropdownLink.vue';
export default {
    name: 'FOLayout',
    components: {
        Icon,
        Head,
        BreezeDropdownLink,
        BreezeNavLink
    },
    data() {
        return {
            showBurger: false
        }
    },
    methods: {
        toggleBurger() {
            this.showBurger ? this.showBurger = false : this.showBurger = true
        }
    }
}
</script>
