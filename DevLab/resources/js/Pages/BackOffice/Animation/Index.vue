<template>
    <Authenticated>
        <div class="flex justify-between px-4">
            <h1 class="self-center">Gérer les événements</h1>
            <InertiaLink class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-2">
                Ajouter un événement
            </InertiaLink>
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
                        <th>Actions</th>
                    </tr>
                </template>
                <template #body>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </template>
            </Table>
            <p class="w-fit ml-auto">Nombre d'événements : x</p>
        </div>
    </Authenticated>
</template>
<script>
import Input from '@/Components/Input'
import Button from '@/Components/Button'
import Authenticated from "@/Layouts/Authenticated";
import { Tailwind2 } from '@protonemedia/inertiajs-tables-laravel-query-builder';
export default {
    name: 'AnimationsList',
    components: {
        Authenticated,
        Input,
        Button,
        Table: Tailwind2.Table,
    },
    props: {
        items: {
            type: Object,
            default: {}
        }
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
