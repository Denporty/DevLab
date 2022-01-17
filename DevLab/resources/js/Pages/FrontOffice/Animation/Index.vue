<template>
    <FOLayout>
        <div>
            <div v-for="item in items" :key="item.id" class="p-8 space-y-3 border-2 border-blue-400 dark:border-blue-300 rounded-xl mb-8">
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
                    <a :href="route('animation.more', item.id)" class="inline-block bg-blue-500 w-fit hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-2">
                        Plus d'infos
                    </a>
                    <p class="flex items-center">
                        <span>Nombre de places : </span>
                        <span class="font-bold">{{ item.places }}</span>
                    </p>
                </div>
            </div>
        </div>
    </FOLayout>
</template>
<script>
import FOLayout from "@/Components/FOLayout";
export default {
    name: 'AnimationIndex',
    components: { FOLayout },
    props: {
        items: Object
    },
    mounted() {
        console.log(this.items)
    }
}
</script>
