<template>
        <div>
            <h2>{{ animation.name }}</h2>
            <h2>{{ animation.description }}</h2>
            <h2>{{ animation.department }}</h2>
            <h2>{{ animation.tag }}</h2>
        </div>
</template>
<script>
export default {
    name: 'AnimationMore',
    props: {
        animation: Object
    },
    mounted() {
        console.log(this.animation)
    }
}
</script>
