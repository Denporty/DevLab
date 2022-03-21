<template>
    <div v-show="show" class="flex flex-col space-y-4 min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 justify-center items-center inset-0 z-50 outline-none focus:outline-none bg-gray-900 bg-opacity-60">
        <div :class="minPadding" class="flex flex-col bg-white shadow-md hover:shodow-lg rounded-2xl">
            <div class="flex items-center justify-between">
                <div class="flex">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-16 h-16 rounded-2xl p-3 border" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor" :class="classType">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div class="flex flex-col ml-3">
                        <slot></slot>
                    </div>
                    <div>Bonjour ceci est un try pour le nom</div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
    name: 'Modal',
    props: {
        show: {
            type: Boolean,
            default: false
        },
        type: {
            type: String,
            default: 'info'
        }
    },
    computed: {
        classType() {
            return {
                'border-green-100 text-green-400 bg-green-50': this.type === 'success',
                'border-blue-100 text-blue-400 bg-blue-50': this.type === 'info',
                'border-red-100 text-red-400 bg-red-50': this.type === 'danger',
                'hidden' : this.type === 'informative-modal'
            }
        },
        minPadding() {
            return this.type === 'informative-modal' ? 'p-4' :  'p-8';
        }
    }
    }
</script>

<style lang="scss" scoped>
</style>
