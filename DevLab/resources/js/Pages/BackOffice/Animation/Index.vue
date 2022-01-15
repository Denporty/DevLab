<template>
    <Authenticated>
        <div class="flex justify-between px-4">
            <h1 class="self-center">Gérer les événements</h1>
            <a :href="route('admin.animation.form')" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-2">
                Ajouter un événement
            </a>
        </div>
        <div class="p-8">
            <Table
            >
                <template #head>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Localisation</th>
                        <th>Date de début</th>
                        <th>Date de fin</th>
                        <th>Nombre de participants</th>
                        <th>Type</th>
                        <th>Départements concernés</th>
                        <th>Actions</th>
                    </tr>
                </template>
                <template #body>
                    <tr v-for="animation in animations.data" :key="animation.id">
                        <td>{{ animation.id }}</td>
                        <td>{{ animation.name }}</td>
                        <td>{{ animation.localisation }}</td>
                        <td>{{ animation.start_date }}</td>
                        <td>{{ animation.end_date }}</td>
                        <td>{{ animation.places }}</td>
                        <td>{{ animation.tag }}</td>
                        <td>{{ animation.department }}</td>
                        <td>
                            <div class="flex item-center justify-center">
                                <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                    <a :href="route('admin.animation.form', animation.id)">
                                        <Icon icon="pencil"></Icon>
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                </template>
            </Table>
            <p class="w-fit ml-auto">Nombre d'événements : {{ this.animations.data.length }}</p>
        </div>
    </Authenticated>
</template>
<script>
import Input from '@/Components/Input'
import Icon from "@/Components/Icon";
import Button from '@/Components/Button'
import Authenticated from "@/Layouts/Authenticated";
import { Tailwind2 } from '@protonemedia/inertiajs-tables-laravel-query-builder';
export default {
    name: 'AnimationsList',
    components: {
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
    },
    mounted() {
        console.log(this.animations)
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
