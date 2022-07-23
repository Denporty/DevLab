<template>
    <Authenticated>
        <Modal :show="showModal" type="danger">
            <div class="font-bold text-xl leading-none">Êtes-vous sûr de vouloir supprimer cet item ?</div>
            <div class="flex my-2 justify-center">
                <button @click="showModal = false" class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mx-2">Non</button>
                <button @click="confirmDelete()" class="bg-red-600 hover:bg-red-500 text-white font-bold py-2 px-4 rounded mx-2">Oui</button>
            </div>
        </Modal>
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
                        <a :href="route('admin.animation.budget.form', animation.id)" class="add__event inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-2 ml-8">
                            Ajouter
                        </a>
                        <div class="p-8 container__list">
                            <Table>
                                <template #head>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Prix</th>
                                        <th>Quantité</th>
                                        <th>Cout total</th>
                                        <th>Actions</th>
                                    </tr>
                                </template>
                                <template #body>
                                    <tr v-for="budget in budgetFiltered" :key="budget.id">
                                        <td>{{ budget.name }}</td>
                                        <td>{{ budget.price }}</td>
                                        <td>{{ budget.quantity }}</td>
                                        <td>{{ budget.price * budget.quantity }}</td>
                                        <td>
                                            <div class="flex item-center">
                                                <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                    <div @click="deleteBudgetAction(budget.id)">
                                                        <img src="/img/trash.svg" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </template>
                            </Table>
                            <div class="mt-5">Budget restant : {{ lastBudget }} ({{ animation.budget }})</div>
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
import Modal from "@/Components/Modal";
export default {
    name: 'AnimationBudget',
    mixins: [InteractsWithQueryBuilder],
    components: {
        Modal,
        Sidebar,
        Authenticated,
        BurgerMenu,
        Table: Tailwind2.Table
    },
    data() {
      return {
          budgetFiltered: [],
          lastBudget: null,
          showModal: false,
          budgetToDelete: null
      }
    },
    props: {
        animation: {
            type: Object,
            default: {}
        },
        budgets: {
            type: Object,
            default: {}
        },
    },
    methods: {
      getBudgetOfAnimation() {
          let tmpLastBudget = this.animation.budget
          this.budgets.forEach(budget => {
              if (budget.animation_id === this.animation.id) {
                  this.budgetFiltered.push(budget)
                  tmpLastBudget = tmpLastBudget - (budget.price * budget.quantity)
              }
          })
          this.lastBudget = tmpLastBudget
      },
        confirmDelete() {
            this.$inertia.delete(route('admin.animation.budget.delete', this.budgetToDelete))
            this.showModal = false
            this.budgetToDelete = null
            location.reload()
        },
        deleteBudgetAction(budget) {
            this.showModal = true
            this.budgetToDelete = budget
        }
    },
    mounted() {
        this.getBudgetOfAnimation()
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
