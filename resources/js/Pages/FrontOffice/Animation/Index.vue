<template>
    <FOLayout>
        <div class="eventsList">
            <div v-if="items != null" v-for="item in items" :key="item.id" class="eventCard">
                <div class="eventCard_pic flex bg-center bg-cover" :style="'background-image:url('+item.image+')'"></div>
                <div class="eventCard_texts">
                    <div>
                        <p class="eventCard_status" v-html="checkDate(item.end_date, false) ? 'évenement terminé' : 'évenement à venir'"/>
                        <h2>{{ item.name }}</h2>
                        <p>
                            {{ item.summary }}
                        </p>
                        <div class="eventCard_infos">
                            <div>
                                <p>Catégorie :</p>
                                <p>{{ findDataByName(tags, item.tag) }}</p>
                            </div>
                            <div>
                                <p>Nombre de places :</p>
                                <p>{{ item.places }}</p>
                            </div>
                            <div>
                                <p>Lieu :</p>
                                <p>{{ item.localisation }}</p>
                            </div>
                            <div>
                                <p>Date :</p>
                                <p>{{ item.start_date }} / {{ item.end_date }}</p>
                            </div>
                        </div>
                        <a :href="route('animation.more', item.id)" class="inline-block bg-blue-500 w-fit hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-2 eventCard_button">
                            En savoir plus
                        </a>
                    </div>
                </div>
            </div>
            <div v-else-if="$page.props.auth.user != null">
                <h3>Bienvenue sur ManageMyEvents vous pouvez accéder à la liste des événements via la navigation.</h3>
            </div>
            <div v-else>
                <h3>Merci de créer un compte afin d'avoir accés à la liste des événements de l'entreprise.</h3>
            </div>
        </div>
    </FOLayout>
</template>
<script>
import FOLayout from "@/Components/FOLayout";
import Dashboard from "@/Pages/Dashboard";
export default {
    name: 'AnimationIndex',
    components: {Dashboard, FOLayout },
    props: {
        items: Object,
        user: Object,
        datenow: String,
        tags: Object,
        departments: Object,
        users: Object
    },
    methods: {
        checkDate(date, element) {
            if(element) {
                if(!this.user.admin) {
                    return this.datenow > date;

                }
            } else {
                if(this.datenow > date) {
                    return true
                }
            }
        },
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
        }
    }
}
</script>
