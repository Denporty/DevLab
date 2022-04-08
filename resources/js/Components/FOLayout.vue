<template>
    <Head title="ManageMyEvents"/>
    <header class="w-screen">
        <div v-if="$page.props.auth.user != null">
            <div v-if="$page.props.auth.user.admin" class="bg-gray-300 w-full flex justify-end">
                <a :href="route('admin.animation')" class="block mr-4 p-4">
                    Dashboard Admin
                </a>
            </div>
        </div>
        <nav class="flex justify-between w-full text-black px-4">
            <a :href="route('animation')" class="items-center flex">
                <img src="/img/logo-mme.png">
            </a>
            <div class="md:items-center md:w-auto flex my-auto">
                <div class="lg:flex hidden self-end">
                    <div v-if="$page.props.auth.user != null" class="flex self-center">
                        <a :href="route('animation.online', $page.props.auth.user.id)" class="block mr-4 my-auto py-1 px-4 text-center bg-mme-blue rounded uppercase text-white hover:bg-blue-600">
                            Liste des événements
                        </a>
                        <NavLink method="post" as="button" :href="route('logout')" :base_style="false" class="block py-1 px-4 my-auto text-center bg-mme-blue rounded uppercase text-white hover:bg-blue-600">
                            Déconnexion
                        </NavLink>
                    </div>

                    <div v-else class="flex self-center">
                        <a :href="route('register')" class="block py-1 px-4 mr-4 my-auto text-center bg-mme-blue rounded uppercase text-white hover:bg-blue-600">
                            Inscription
                        </a>
                        <a :href="route('login')" class="block py-1 px-4 my-auto text-center bg-mme-blue rounded uppercase text-white hover:bg-blue-600">
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
                <NavLink method="post" as="button" :href="route('logout')" :base_style="false" class="block text-mme-blue p-4 hover:bg-blue-300 hover:text-white duration-300">
                    Déconnexion
                </NavLink>
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
    <body class="md:px-16 px-4 py-8 background-index">
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
