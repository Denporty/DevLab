<template>
    <Authenticated>
        <div class="wrapper__events-list">
            <Sidebar></Sidebar>
            <div class="container__main">
                <div class="lg:px-36 px-4">
                    <button onclick="window.history.back()" class="inline-block bg-gray-800 hover:bg-gray-700 active:bg-gray-900 text-white font-bold py-2 px-4 rounded my-2">
                        Retour
                    </button>
                </div>
            </div>
        </div>
    </Authenticated>
</template>

<script>
import Authenticated from "@/Layouts/Authenticated";
import Sidebar from "@/Components/Sidebar";
export default {
    name: 'DepartmentsForm',
    components: {
        Authenticated,
        Sidebar

    },
    props: {
        department: Object,
    },
    data() {
        return {
            form: this.$inertia.form({
                name: this.department?.name ?? null,
            }),
            showModal: false,
        }
    },
    methods: {
    }
}
</script>
<style lang="scss" scoped>
</style>
