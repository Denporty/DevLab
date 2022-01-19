<template>
    <FOLayout>
        <div>
            <div v-if="items != null" v-for="item in items" :key="item.id" class="p-8 space-y-3 border-2 border-blue-400 dark:border-blue-300 rounded-xl mb-8">
                <div class="flex flex-row justify-end items-center">
                    <p class="mr-4" v-html="checkDate(item.end_date, false) ? 'Terminé' : 'A venir'"></p>
                    <div class="rounded-full p-4 w-4" :class="checkDate(item.end_date, false) ? 'bg-red-600' : 'bg-green-600'"></div>
                </div>
                    <div class="flex lg:flex-row flex-col justify-between">
                        <p class="inline-block bg-red-500 w-fit text-white font-bold py-2 px-4 rounded my-2">{{ item.tag }}</p>
                        <p class="inline-block bg-green-500 w-fit text-white font-bold py-2 px-4 rounded my-2">{{ item.department }}</p>
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
                            <span class="font-bold">{{ item.places }}</span>
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
        datenow: Date
    },
    methods: {
        checkDate(date, element) {
            if(element) {
                if(!this.user.admin) {
                    if(this.datenow > date) {
                        return true
                    }
                    return false
                }
            } else {
                if(this.datenow > date) {
                    return true
                }
            }
        }
    }
}
</script>
