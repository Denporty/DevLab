<template>
    <Authenticated>

        <div class="wrapper__events-list">
            <Sidebar></Sidebar>

            <div class="container__main">
                <div class="flex px-8 mt-10 items-center">
                    <h1 class="title__back">
                        Évènements
                    </h1>
                    <a :href="route('admin.animation.form')" class="add__event inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-2">
                        AJouter
                    </a>
                </div>

                <div class="p-8 container__list">
                    <Table
                        :filters="queryBuilderProps.filters"
                        :columns="queryBuilderProps.columns"
                        :on-update="setQueryBuilder"
                        :meta="animations"
                    >
                        <template #head>
                            <tr>
                                <th>Titre</th>
                                <th>Pôles concernés</th>
                                <th>Date de fin</th>
                                <th>Actions</th>
                            </tr>
                        </template>
                        <template #body>
                            <tr v-for="animation in animations.data" :key="animation.id">
                                <td>{{ animation.name }}</td>
                                <td>{{ animation.department }}</td>
                                <td>{{ animation.end_date }}</td>
                                <td>
                                    <div class="flex item-center ">
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
                    <p class="w-fit ml-auto">Events : {{ this.animations.data.length }}</p>
                </div>
            </div>
        </div>
    </Authenticated>
</template>
<script>
import Input from '@/Components/Input'
import Icon from "@/Components/Icon";
import Button from '@/Components/Button'
import Authenticated from "@/Layouts/Authenticated";
import Sidebar from "@/Components/Sidebar";
import { InteractsWithQueryBuilder, Tailwind2 } from '@protonemedia/inertiajs-tables-laravel-query-builder';
export default {
    mixins: [InteractsWithQueryBuilder],
    name: 'AnimationsList',
    components: {
        Sidebar,
        Authenticated,
        Input,
        Button,
        Icon,
        Table: Tailwind2.Table,
    },
    props: {
        animations: {
            type: Object,
            default: {}
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
