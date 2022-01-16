<template>
    <FOLayout>
        <a :href="route('animation')" class="inline-block bg-blue-500 hover:bg-blue-700 text-white text-xl font-bold py-2 px-4 rounded my-2">
            Retour
        </a>
        <div>
            <div class="flex flex-row justify-between mb-16">
                <p class="inline-block bg-red-500 text-white font-bold py-2 px-4 rounded my-2">{{ animation.tag }}</p>
                <p class="inline-block bg-green-500 text-white font-bold py-2 px-4 rounded my-2">{{ animation.department }}</p>
            </div>
            <h2 class="text-gray-800 text-5xl font-semibold capitalize">{{ animation.name }}</h2>
            <br>
            <p>
                <span>Cet événement aura lieu du : </span>
                <span class="font-semibold text-blue-500">{{ animation.start_date }}</span>
                <span> au </span>
                <span class="font-semibold text-blue-500">{{ animation.end_date }}</span>
            </p>
            <br>
            <hr class="w-36">
            <br>
            <h2 class="text-gray-800 text-2xl font-semibold">Description de l'événement :</h2>
            <br>
            <p>{{ animation.description }}</p>
            <div v-if="animation.active_section">
                <br>
                <hr class="w-36">
                <br>
                <h2 class="text-gray-800 text-2xl font-semibold capitalize">{{ animation.section_title }}</h2>
                <br>
                <p>{{ animation.description_section }}</p>
                <div v-if="animation.map != null">
                    <br>
                    <hr class="w-36">
                    <br>
                    <h2 class="text-gray-800 text-2xl font-semibold">Carte de l'événement :</h2>
                    <br>
                    <div v-html="animation.map" id="map" class="manage-size flex flex-col flex-grow">
                    </div>
                </div>
            </div>
        </div>
    </FOLayout>
</template>
<script>
import FOLayout from "@/Components/FOLayout";
export default {
    name: 'AnimationMore',
    components: {FOLayout},
    props: {
        animation: Object
    },
    mounted() {
        console.log(this.animation)
    }
}
</script>
