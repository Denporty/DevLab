<template>
    <Head title="ManageMyEvents"/>
    <header class="w-screen">
        <div v-if="$page.props.auth.user != null">
            <div v-if="$page.props.auth.user.department === 'ADMIN'" class="bg-gray-300 w-full flex justify-end">
                <a :href="route('dashboard')" class="block mr-4 p-4">
                    Dashboard Admin
                </a>
            </div>
        </div>
        <nav class="flex justify-between w-full bg-white text-black px-4">
            <a :href="route('animation')" class="items-center flex py-4"><span class="font-semibold text-xl tracking-tight">ManageMyEvents</span></a>
            <div class="md:items-center md:w-auto flex my-auto">
                <div class="lg:flex hidden self-end">
                    <div v-if="$page.props.auth.user != null" class="flex self-center">
                        <a :href="route('animation.online', $page.props.auth.user.id)" class="block mr-4 my-auto py-1 px-4 text-center bg-mme-blue rounded uppercase text-white">
                            Liste des événements
                        </a>
                        <NavLink method="post" as="button" :href="route('logout')" :base_style="false" class="block py-1 px-4 my-auto text-center bg-mme-blue rounded uppercase text-white">
                            Déconnexion
                        </NavLink>
                    </div>

                    <div v-else class="flex self-center">
                        <a :href="route('register')" class="block py-1 px-4 mr-4 my-auto text-center bg-mme-blue rounded uppercase text-white">
                            Inscription
                        </a>
                        <a :href="route('login')" class="block py-1 px-4 my-auto text-center bg-mme-blue rounded uppercase text-white">
                            Connexion
                        </a>
                    </div>
                </div>
                <button id="nav" v-on:click="toggleBurger" class="text-gray-600 font-semibold px-1 text-2xl p-1 px-2 rounded bg-gray-20 flex lg:hidden items-center" type="button">
                    <Icon :icon="showBurger ? 'cross' : 'menuburger'"></Icon>
                </button>
            </div>
        </nav>
        <div v-if="showBurger" class="bg-white w-full lg:hidden absolute">
            <div v-if="$page.props.auth.user != null">
                <a :href="route('animation.online', $page.props.auth.user.id)" class="block text-mme-blue p-4 hover:bg-blue-300 hover:text-white duration-300">
                    Liste des événements
                </a>
                <a v-if="$page.props.auth.user != null" :href="route('logout')" class="block text-mme-blue p-4 hover:bg-blue-300 hover:text-white duration-300">
                    Déconnexion
                </a>
            </div>
            <div v-else>
                <a :href="route('register')" class="block text-mme-blue p-4 hover:bg-blue-300 hover:text-white duration-300">
                    Inscription
                </a>
                <a :href="route('login')" class="block text-mme-blue p-4 hover:bg-blue-300 hover:text-white duration-300">
                    Connexion
                </a>
            </div>
        </div>
    </header>
    <body class="md:px-16 px-4 py-32 background-index">
        <slot></slot>
    </body>
</template>
<script>
import {Head} from "@inertiajs/inertia-vue3";
import BreezeNavLink from '@/Components/NavLink.vue'
import Icon from "@/Components/Icon";
import BreezeDropdownLink from '@/Components/DropdownLink.vue';
import Button from "@/Components/Button";
import NavLink from "@/Components/NavLink";
export default {
    name: 'FOLayout',
    components: {
        NavLink,
        Button,
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
