<template>
    <h1>Ceci est la partie vue</h1>
</template>
<script>
export default {
    name: "IndexTest",
    data() {
        return {
            testTry: "Ceci est ma data"
        }
    },
    mounted() {
        console.log(this.testTry)
    }
}
</script>
