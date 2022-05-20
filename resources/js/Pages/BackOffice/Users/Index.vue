<template>
    <Authenticated>
        <div class="wrapper__events-list">
            <Sidebar></Sidebar>
            <BurgerMenu></BurgerMenu>
            <div class="container__main">
                <div class="flex px-8 mt-10 items-center">
                    <h1 class="title__back">
                        Utilisateurs
                    </h1>
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
                                <th>Date d'inscription</th>
                                <th>Départements</th>
                                <th>Organisateur</th>
                                <th>Super Admin</th>
                                <th>Actions</th>
                            </tr>
                        </template>
                        <template #body>
                            <tr v-for="user in users.data" :key="user.id">
                                <td>{{ user.name }}</td>
                                <td>{{ user.created_at }}</td>
                                <td>{{ findDepartmentName(user.department) }}</td>
                                <td>{{ booleanToString(user.admin) }}</td>
                                <td>{{ booleanToString(user.super_admin) }}</td>
                                <td>
                                    <div class="flex item-center justify-center">
                                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                            <a :href="route('admin.users.form', user.id)">
                                                <img src="/img/actions.svg" alt="">
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </template>
                    </Table>
                    <p class="w-fit ml-auto">Nombre d'utilisateurs : {{ this.users.data.length }}</p>
                </div>
            </div>
        </div>
    </Authenticated>
</template>
<script>
import Input from '@/Components/Input'
import Icon from "@/Components/Icon";
import Sidebar from "@/Components/Sidebar";
import Button from '@/Components/Button';
import Authenticated from "@/Layouts/Authenticated";
import BurgerMenu from '@/Components/BurgerMenu';

import { InteractsWithQueryBuilder, Tailwind2 } from '@protonemedia/inertiajs-tables-laravel-query-builder';
export default {
    mixins: [InteractsWithQueryBuilder],
    name: 'UsersList',
    components: {
        Authenticated,
        Input,
        Button,
        Icon,
        Sidebar,
        BurgerMenu,
        Table: Tailwind2.Table,
    },
    props: {
        users: {
            type: Object,
            default: {}
        },
        departments: {
            type: Object,
            default: {}
        }
    },
    methods: {
        findDepartmentName (id) {
            let name = "";
            this.departments?.forEach(department => {
                if (department.id === id) {
                    name = department.name
                }
            });
            return name;
        },
        booleanToString (bool) {
            return bool ? 'Oui' : 'Non'
        }
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
