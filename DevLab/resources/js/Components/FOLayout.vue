<template>
    <Head title="ManageMyEvents"/>
    <header>
        <nav class="flex justify-between w-full bg-blue-500 text-white p-4">
            <a :href="route('animation')" class="items-center flex"><span class="font-semibold text-xl tracking-tight">ManageMyEvents</span></a>
            <div class="md:items-center md:w-auto flex">
                <div class="md:flex hidden">
                    <a class="block md:text-white mr-4 hidden lg:flex" :href="route('animation')">Liste des animations</a>
                </div>
                <button id="nav" v-on:click="toggleBurger" class="text-gray-600 font-semibold px-1 text-2xl p-1 px-2 rounded bg-gray-20 flex lg:hidden" type="button">
                    <Icon :icon="showBurger ? 'cross' : 'menuburger'"></Icon>
                </button>
            </div>
        </nav>
        <div v-if="showBurger" class="bg-blue-300 w-full">
            <a class="block md:text-white mr-4 p-4" :href="route('animation')">Liste des animations</a>
        </div>
    </header>
    <body class="lg:px-16 px-8 pt-16">
        <slot></slot>
    </body>
</template>
<script>
import {Head} from "@inertiajs/inertia-vue3";
import Icon from "@/Components/Icon";
export default {
    name: 'FOLayout',
    components: {
        Icon,
        Head
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
