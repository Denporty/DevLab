<template>
    <FOLayout>
        <button @click="showModal = true" class="inline-block bg-blue-500 hover:bg-blue-700 text-white text-xl font-bold py-2 px-4 rounded my-2 eventDetail_button eventDetail_buttonReservation">
            {{ $page.props.auth.user.animation_id === animation.id ? 'Annuler ma réservation' : 'Réserver' }}
            </button>
        <Modal :show="showModal">
            <p>Etes vous sur de vouloir {{ $page.props.auth.user.animation_id === animation.id ? 'annuler votre réservation' : 'réserver votre place' }} pour cet événement ?</p>
            <div class="flex justify-center">
                <button @click="showModal = false" class="inline-block bg-red-500 hover:bg-red-700 text-white text-xl font-bold py-2 px-4 rounded my-2 mr-4">
                    Non
                </button>
                <button @click="confirmReservation($page.props.auth.user.animation_id === animation.id)" class="inline-block bg-blue-500 hover:bg-blue-700 text-white text-xl font-bold py-2 px-4 rounded my-2">
                    Oui
                </button>
            </div>
        </Modal>
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
                <h3>{{ findDataByName(departments, animation.department) }}</h3>
            </div>
            <div class="eventDetail_blocs">
                <div class="p-4">
                    <img src="/img/pin.png" class="min-w-20">
                    <p class="mt-4 text-center">{{ animation.localisation }}</p>
                </div>
                <div class="p-4">
                    <img src="/img/calendar.png" class="min-w-20">
                    <p class="mt-4 text-center">Du {{ animation.start_date }} au {{ animation.end_date }}</p>
                </div>
                <div class="p-4">
                    <img src="/img/group.png" class="min-w-20">
                    <p class="mt-4 text-center">{{ lastPlaces(animation) }}</p>
                </div>
            </div>
            <div class="eventDetail_background bg-center bg-cover" :style="'background-image:url('+animation.image+')'">
            </div>
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
import Modal from "@/Components/Modal";
export default {
    name: 'AnimationMore',
    components: {Modal, FOLayout, Icon},
    props: {
        animation: Object,
        tags: Object,
        departments: Object,
        users: Object
    },
    data() {
        return {
            form: this.$inertia.form({
                animation_id: this.$page.props.auth.user?.animation_id ?? null,
            }),
            showModal: false
        }
    },
    methods: {
        findDataByName (data, id) {
            let name = "";
            data?.forEach(data => {
                if (data.id === id) {
                    name = data.name
                }
            });
            return name;
        },
        lastPlaces (animation) {
            let i = 0;
            this.users?.forEach(user => {
                if (user.animation_id === animation.id) {
                    i = i + 1;
                }
            });
            return animation.places - i;
        },
        confirmReservation(bool) {
            bool ? this.form.animation_id = null : this.form.animation_id = this.animation.id
            this.form.post(route('animation.reservation', this.$page.props.auth.user?.id))
            this.showModal = false
            location.reload()
        },
    },
}
</script>
