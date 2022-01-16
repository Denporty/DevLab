<template>
    <div v-for="item in items" :key="item.id">
        <div>
            <h2>{{ item.name }}</h2>
            <h2>{{ item.description }}</h2>
            <h2>{{ item.department }}</h2>
            <h2>{{ item.tag }}</h2>
            <a :href="route('animation.more', item.id)" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-2">
                Plus d'infos
            </a>
        </div>
        <br>
    </div>
</template>
<script>
export default {
    name: 'AnimationIndex',
    props: {
        items: Object
    },
    mounted() {
        console.log(this.items)
    }
}
</script>
