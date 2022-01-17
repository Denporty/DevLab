<template>
    <header>
        <nav class="flex justify-between w-full bg-blue-500 text-white p-4">
            <a :href="route('animation')"><span class="font-semibold text-xl tracking-tight">ManageMyEvents</span></a>
            <div class="md:items-center md:w-auto flex">
                <div class="md:flex hidden">
                    <a class="block md:text-white mr-4" :href="route('animation')">Liste des animations</a>
                </div>
            </div>
        </nav>
    </header>
    <body class="lg:p-16 px-8 py-16">
        <slot></slot>
    </body>
</template>
<script>
export default {
    name: 'FOLayout'
}
</script>
