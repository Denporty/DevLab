<template>
    <FOLayout>
        <button onclick="window.history.back()" class="inline-block bg-blue-500 hover:bg-blue-700 text-white text-xl font-bold py-2 px-4 rounded my-2 eventDetail_button eventDetail_buttonReservation">
                Réserver ma place
            </button>
        <div class="flex flex-row justify-between w-full">
            <button onclick="window.history.back()" class="inline-block bg-blue-500 hover:bg-blue-700 text-white text-xl font-bold py-2 px-4 rounded my-2 eventDetail_button">
                Retour aux événements
            </button>
            <div v-if="$page.props.auth.user.admin" class="w-8 mr-2 transform hover:text-purple-500 hover:scale-110">
                <a :href="route('admin.animation.form', animation.id)">
                    <Icon class="text-blue-400" icon="pencil-blue"></Icon>
                </a>
            </div>
        </div>
        <div class="eventDetail">
            <div class="eventDetail_titles">
                <h1>{{ animation.name }}</h1>
                <h3>{{ animation.department }}</h3>
            </div>
            <div class="eventDetail_blocs">
                <div>
                    <div></div>
                    <p>{{ animation.localisation }}</p>
                </div>
                <div>
                    <div></div>
                    <p>{{ animation.start_date }} / {{ animation.end_date }}</p>
                </div>
                <div>
                    <div></div>
                    <p>{{ animation.places }}</p>
                </div>
            </div>
            <div class="eventDetail_background"></div>
            <div class="eventDetail_blocText">
                <h2>Description :</h2>
                <p>{{ animation.description }}</p>
            </div>
            <hr>
            <div class="eventDetail_blocText" v-if="animation.active_section">
                <h2>{{ animation.section_title }} :</h2>
                <p>{{ animation.description_section }}</p>
            </div>
            <hr  v-if="animation.active_section">
            <div class="eventDetail_blocText" v-if="animation.map != null">
                <h2>Me rendre à l’événement :</h2>
                <div v-html="animation.map" id="map"></div>
            </div>
        </div>
    </FOLayout>
</template>
<script>
import FOLayout from "@/Components/FOLayout";
import Icon from "@/Components/Icon";
export default {
    name: 'AnimationMore',
    components: {FOLayout, Icon},
    props: {
        animation: Object
    }
}
</script>
