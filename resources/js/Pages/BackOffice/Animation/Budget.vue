<template>
    <Authenticated>

        <div class="wrapper__events-list">
            <BurgerMenu></BurgerMenu>
            <Sidebar></Sidebar>
            <div class="container__main">
                <div class="flex px-8 mt-10 items-center">
                    <div class="flex flex-col">
                        <h1 class="title__back">
                            Gestion du budget de l'événement {{ animation.name }}
                        </h1>
                        <div class="flex">
                            <a :href="route('admin.animation.form', animation.id)" class="add__event inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-2 mr-2">
                                Modifier l'événement
                            </a>
                            <a :href="route('admin.animation.usersList', animation.id)" class="add__event inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-2 mr-2">
                                Liste des participants
                            </a>
                            <a :href="route('admin.animation.budget', animation.id)" class="add__event inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-2">
                                Gestion du budget
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Authenticated>
</template>

<script>
import Authenticated from "@/Layouts/Authenticated";
import Sidebar from "@/Components/Sidebar";
import BurgerMenu from "@/Components/BurgerMenu";
import {InteractsWithQueryBuilder, Tailwind2} from "@protonemedia/inertiajs-tables-laravel-query-builder";
export default {
    name: 'AnimationBudget',
    mixins: [InteractsWithQueryBuilder],
    components: {
        Sidebar,
        Authenticated,
        BurgerMenu,
        Table: Tailwind2.Table
    },
    props: {
        animation: {
            type: Object,
            default: {}
        },
    },
    mounted() {
        console.log(this.animation)
    },
}
</script>

<style lang="scss" scoped>
.svg-icon {
    width: 1.225em;
    height: 1.225em;
}
.svg-icon path,
.svg-icon polygon,
.svg-icon rect {
    fill: #fff;
}
.svg-icon circle {
    stroke: #fff;
    stroke-width: 1;
}
</style>
