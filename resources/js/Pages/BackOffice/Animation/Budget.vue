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
                <a :href="route('admin.animation.budget.form', animation.id)" class="add__event inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-2 ml-8">
                    Ajouter
                </a>
                <div class="p-8 container__list">
                    <Table
                        :filters="queryBuilderProps.filters"
                        :columns="queryBuilderProps.columns"
                        :on-update="setQueryBuilder"
                        :meta="budgets"
                    >
                        <template #head>
                            <tr>
                                <th>Nom</th>
                                <th>Prix</th>
                                <th>Quantité</th>
                                <th>Action</th>
                            </tr>
                        </template>
                        <template #body>
                            <tr v-for="budget in budgets" :key="budget.id">
                                <td>{{ budget.name }}</td>
                                <td>{{ budget.price }} €</td>
                                <td>{{ budget.quantity }}</td>
                                <td>
                                    <div class="flex item-center justify-center">
                                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                            <a :href="route('admin.animation.budget.form', budget.id)">
                                                <img src="/img/actions.svg" alt="">
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </template>
                    </Table>
                    <p>Budget restant : {{ globalBudgetFormatted }}</p>
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
        globalBudget: {
            type: Object,
            default: {}
        },
        budgets: {
            type: Object,
            default: {}
        },
    },
    data() {
        return {
            globalBudgetFormatted: null
        }
    },
    methods: {
        lastBudget () {
            let i = 0;
            this.budgets?.forEach(budget => {
                i = i + (budget.price * budget.quantity)
            });
            this.globalBudgetFormatted = this.globalBudget.budget - i
        }
    },
    mounted() {
        console.log(this.animation)
        console.log(this.globalBudget)
        console.log(this.budgets)
        this.lastBudget()
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
