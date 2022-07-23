<template>
    <Authenticated>

        <div class="wrapper__events-list">
            <BurgerMenu></BurgerMenu>
            <Sidebar></Sidebar>
            <div class="container__main">
                <div class="flex px-8 mt-10 items-center">
                    <div class="flex flex-col">
                        <h1 class="title__back">
                            Liste des utilisateurs de l'événement : {{ animation.name }}
                        </h1>
                        <div class="flex container__btns">
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

                <div class="p-8 container__list">
                    <Table
                        :filters="queryBuilderProps.filters"
                        :columns="queryBuilderProps.columns"
                        :on-update="setQueryBuilder"
                        :meta="users"
                    >
                        <template #head>
                            <tr>
                                <th>Nom</th>
                                <th>Email</th>
                                <th>Actions</th>
                            </tr>
                        </template>
                        <template #body>
                            <tr v-for="user in filteredArray" :key="user.id">
                                <td>{{ user.name }}</td>
                                <td>{{ user.email }}</td>
                                <td>
                                    <div class="flex item-center">
                                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                            <a :href="route('admin.users.reservationCancelForm', user.id)">
                                                <img src="/img/actions.svg" alt="">
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                        </template>
                    </Table>
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
    name: 'AnimationUsersList',
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
        users: {
            type: Object,
            default: {}
        }
    },
    data() {
      return {
          filteredArray: null,
      }
    },
    mounted() {
        this.filterData()
    },
    methods: {
        filterData() {
            this.filteredArray = []
            return this.users.data?.forEach(user => {
                if (user.animation_id === this.animation.id) {
                    this.filteredArray.push(user)
                }
            })
        },
    }
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
