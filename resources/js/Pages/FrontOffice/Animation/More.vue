<template>
    <FOLayout>
        <div class="flex flex-row justify-between w-full">
            <button onclick="window.history.back()" class="inline-block bg-blue-500 hover:bg-blue-700 text-white text-xl font-bold py-2 px-4 rounded my-2">
                Retour
            </button>
            <div v-if="$page.props.auth.user.admin" class="w-8 mr-2 transform hover:text-purple-500 hover:scale-110">
                <a :href="route('admin.animation.form', animation.id)">
                    <Icon class="text-blue-400" icon="pencil-blue"></Icon>
                </a>
            </div>
        </div>
        <div>
            <div class="flex lg:flex-row flex-col items-end lg:justify-between mb-16">
                <p class="inline-block bg-red-500 text-white w-fit font-bold py-2 px-4 rounded my-2">{{ findTagName(animation.tag) }}</p>
                <p class="inline-block bg-green-500 text-white w-fit font-bold py-2 px-4 rounded my-2">{{ findDepartmentName(animation.department) }}</p>
            </div>
            <h2 class="text-gray-800 text-5xl font-semibold capitalize">{{ animation.name }}</h2>
            <br>
            <div class="flex lg:flex-row flex-col justify-between">
                <p>
                    <span>Cet événement aura lieu du : </span>
                    <span class="font-semibold text-blue-500">{{ animation.start_date }}</span>
                    <span> au </span>
                    <span class="font-semibold text-blue-500">{{ animation.end_date }}</span>
                </p>
                <p>
                    <span>Nombre de places : </span>
                    <span class="font-bold">{{ animation.places }}</span>
                </p>
            </div>
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
            </div>
        </div>
        <div v-if="animation.map != null">
            <br>
            <hr class="w-36">
            <br>
            <h2 class="text-gray-800 text-2xl font-semibold">Carte de l'événement :</h2>
            <br>
        </div>
        <div v-html="animation.map" id="map" class="manage-size flex flex-col flex-grow items-center overflow-hidden pb-16"></div>
    </FOLayout>
</template>
<script>
import FOLayout from "@/Components/FOLayout";
import Icon from "@/Components/Icon";
export default {
    name: 'AnimationMore',
    components: {FOLayout, Icon},
    props: {
        animation: Object,
        tags: Object,
        departments: Object
    },
    methods: {
        findDepartmentName (id) {
            let name = "";
            this.departments?.forEach(department => {
                if (department.id === id) {
                    name = department.name
                }
            });
            return name;
        },
        findTagName (id) {
            let name = "";
            this.tags?.forEach(tag => {
                if (tag.id === id) {
                    name = tag.name
                }
            });
            return name;
        },
    }
}
</script>
