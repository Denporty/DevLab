<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 background-base">
        <div>
            <Link href="/">
                <BreezeApplicationLogo/>
            </Link>
        </div>

        <div class="w-full sm:max-w-md mt-6 pb-4 bg-white shadow-md overflow-hidden sm:rounded-lg bg-gray-200">
            <slot />
        </div>
    </div>
</template>

<script>
import BreezeApplicationLogo from '@/Components/ApplicationLogo.vue'
import { Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
        BreezeApplicationLogo,
        Link,
    }
}
</script>
