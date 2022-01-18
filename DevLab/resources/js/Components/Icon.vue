<template>
    <!--    Pencil     -->
    <svg v-if="icon === 'pencil'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
         stroke="currentColor" class="hover:text-blue-500 hover:scale-110">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
    </svg>

    <!--    Pencil Blue     -->
    <svg v-if="icon === 'pencil-blue'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
         stroke="currentColor" class="text-blue-500 hover:scale-110">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
    </svg>

    <!--    Trash     -->
    <svg v-if="icon === 'trash'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
         stroke="currentColor" class="hover:text-red-500 hover:scale-110">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
    </svg>

    <!--    Valid     -->
    <svg v-if="icon === 'valid'" version="1.1" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
         viewBox="0 0 32 32">
        <title>check</title>
        <path d="M12.104 20.856l12.856-12.856 1.707 1.707-14.563 14.563-6.771-6.769 1.707-1.707z"></path>
    </svg>

    <!--    Cross     -->
    <svg v-if="icon === 'cross'" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#FFFFFF" d="M24 20.188l-8.315-8.209 8.2-8.282-3.697-3.697-8.212 8.318-8.31-8.203-3.666 3.666 8.321 8.24-8.206 8.313 3.666 3.666 8.237-8.318 8.285 8.203z"/></svg>

    <!-- Menu Responsive -->
    <svg v-if="icon === 'menuburger'" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#FFFFFF" d="M24 6h-24v-4h24v4zm0 4h-24v4h24v-4zm0 8h-24v4h24v-4z"/></svg>


</template>

<script>
export default {
    name: 'Icon',
    props: {
        icon: String,
        validator: (val) => ['pencil', 'trash', 'valid', 'cross'].includes(val)
    }
}
</script>
