<template>
    <Authenticated>

        <div class="wrapper__events-list">
            <BurgerMenu></BurgerMenu>
            <Sidebar></Sidebar>
            <div class="container__main">
                <div class="flex px-8 mt-10 items-center">
                    <div class="flex flex-col">
                        <h1 class="title__back">
                            Liste des événements du département {{ department.name }}
                        </h1>
                    </div>
                </div>

                <div class="p-8 container__list">
                    <a :href="route('admin.departments')" class="inline-block bg-gray-800 hover:bg-gray-700 active:bg-gray-900 text-white font-bold py-2 px-4 rounded my-2">
                        Retour
                    </a>
                    <Table>
                        <template #head>
                            <tr>
                                <th>Nom</th>
                                <th>Actions</th>
                            </tr>
                        </template>
                        <template #body>
                            <tr v-for="animation in filteredArray" :key="animation.id">
                                <td>{{ animation.name }}</td>
                                <td>
                                    <div class="flex item-center justify-center">
                                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                            <a :href="route('admin.animation.form', animation.id)">
                                                <img src="/img/actions.svg" alt="">
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </template>
                    </Table>
                    <p>Animations dans le département : {{ filteredArray?.length }}</p>
                </div>
            </div>
        </div>
    </Authenticated>
</template>
<script>
import Authenticated from "@/Layouts/Authenticated";
import Sidebar from "@/Components/Sidebar";
import BurgerMenu from "@/Components/BurgerMenu";
import {Tailwind2} from "@protonemedia/inertiajs-tables-laravel-query-builder";
export default {
    name: 'DepartmentUsersList',
    components: {
        Sidebar,
        Authenticated,
        BurgerMenu,
        Table: Tailwind2.Table
    },
    props: {
        department: {
            type: Object,
            default: {}
        },
        animations: {
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
        console.log(this.department.id)
        console.log(this.animations)
    },
    methods: {
        filterData() {
            this.filteredArray = []
            return this.animations?.forEach(animation => {
                if (animation.department === this.department.id) {
                    this.filteredArray.push(animation)
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
