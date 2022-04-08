<template>
    <Authenticated>

        <div class="wrapper__events-list">
            <Sidebar></Sidebar>

            <div class="container__main">

                <a :href="route('admin.departments.form')" class="add__event inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-2">
                    AJouter
                </a>
                <div class="p-8">
                    <Table
                        :filters="queryBuilderProps.filters"
                        :search="queryBuilderProps.search"
                        :columns="queryBuilderProps.columns"
                        :on-update="setQueryBuilder"
                        :meta="departments"
                    >
                        <template #head>
                            <tr>
                                <th>Nom</th>
                                <th>Actions</th>
                            </tr>
                        </template>
                        <template #body>
                            <tr v-for="department in departments.data" :key="department.id">
                                <td>{{ department.name }}</td>
                                <td>
                                    <div class="flex item-center justify-center">
                                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                            <a :href="route('admin.departments.form', department.id)">
                                                <Icon icon="pencil"></Icon>
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </template>
                    </Table>
                    <p class="w-fit ml-auto">Nombre de départements : {{ this.departments.data.length }}</p>
                </div>
            </div>
        </div>
    </Authenticated>
</template>
<script>
import Authenticated from "@/Layouts/Authenticated";
import Sidebar from "@/Components/Sidebar";
import { InteractsWithQueryBuilder, Tailwind2 } from '@protonemedia/inertiajs-tables-laravel-query-builder';
import Input from "@/Components/Input";
import Button from "@/Components/Button";
import Icon from "@/Components/Icon";
export default {
    mixins: [InteractsWithQueryBuilder],
    name: 'DepartmentList',
    components: {
        Authenticated,
        Input,
        Button,
        Icon,
        Sidebar,
        Table: Tailwind2.Table,
    },
    props: {
        departments: {
            type: Object,
            default: {}
        }
    },
    mounted() {
        console.log(this.departments.data)
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
