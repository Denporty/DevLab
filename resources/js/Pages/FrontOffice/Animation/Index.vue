<template>
    <FOLayout>
        <div>
            <div v-if="items != null" v-for="item in items" :key="item.id" class="p-8 space-y-3 border-2 border-blue-400 dark:border-blue-300 rounded-xl mb-8 bg-white">
                <div class="flex md:flex-row flex-col justify-between">
                    <div class="flex flex-col justify-between">
                        <p class="inline-block bg-red-500 w-fit text-white font-bold py-2 px-4 rounded my-2">{{ findDataByName(tags ,item.tag) }}</p>
                        <p class="inline-block bg-green-500 w-fit text-white font-bold py-2 px-4 rounded my-2">{{ findDataByName(departments ,item.department) }}</p>
                    </div>
                    <div class="flex flex-row md:justify-end items-center">
                        <div class="rounded-full py-2 px-4 text-white"
                             :class="checkDate(item.end_date, false) ? 'bg-red-600' : 'bg-green-600'"
                             v-html="checkDate(item.end_date, false) ? 'Terminé' : 'A venir'"/>
                    </div>
                </div>

                <h1 class="text-2xl font-semibold text-blue-500 capitalize dark:text-blue-500">{{ item.name }}</h1>

                <p class="text-blue-400 dark:text-blue-400">
                    {{ item.summary }}
                </p>
                <p class="font-bold text-blue-500 text-xs">
                    {{ item.start_date }} / {{ item.end_date }}
                </p>
                <div class="flex lg:flex-row flex-col justify-between">
                    <a :href="route('animation.more', item.id)" class="inline-block bg-blue-500 w-fit hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-2" :class="checkDate(item.end_date, true) ? 'pointer-events-none bg-blue-200' : ''">
                        Plus d'infos
                    </a>
                    <p class="flex items-center">
                        <span>Nombre de places : </span>
                        <span class="font-bold">{{ lastPlaces(item) }}</span>
                    </p>
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
