<template>
    <!--    Pencil     -->
    <svg v-if="icon === 'pencil'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
         stroke="currentColor" class="hover:text-blue-500 hover:scale-110">
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
    <svg v-if="icon === 'cross'" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
         y="0px"
         width="20" height="20"
         viewBox="0 0 409.806 409.806" style="enable-background:new 0 0 409.806 409.806;" xml:space="preserve"><g><g>
		<path d="M228.929,205.01L404.596,29.343c6.78-6.548,6.968-17.352,0.42-24.132c-6.548-6.78-17.352-6.968-24.132-0.42
			c-0.142,0.137-0.282,0.277-0.42,0.42L204.796,180.878L29.129,5.21c-6.78-6.548-17.584-6.36-24.132,0.42
			c-6.388,6.614-6.388,17.099,0,23.713L180.664,205.01L4.997,380.677c-6.663,6.664-6.663,17.468,0,24.132
			c6.664,6.662,17.468,6.662,24.132,0l175.667-175.667l175.667,175.667c6.78,6.548,17.584,6.36,24.132-0.42
			c6.387-6.614,6.387-17.099,0-23.712L228.929,205.01z"/></g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>
    </svg>

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
