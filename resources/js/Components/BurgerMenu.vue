<template>
    <header class="burger__menu">
        <nav class="nav__mobile">
            <img id="open" src="/img/burger.svg" alt="open" class="open__menu" @click="openMenu">
            <img src="/img/logo-mme.png" alt="logo" class="logo">
        </nav>

        <div  id="menu" class="container__menu">
            <img id="close" src="/img/close_menu.svg" alt="" @click="closeMenu">

            <ul>
                <li>
                    <a :href="route('admin.animation')">
                        Évènements
                    </a>
                </li>
                <li v-if="$page.props.auth.user.super_admin">
                    <a :href="route('admin.users')">
                        Gestion des utilisateurs
                    </a>
                </li>
                <li v-if="$page.props.auth.user.super_admin">
                    <a :href="route('admin.departments')">
                        Gestion des départements
                    </a>
                </li>
                <li v-if="$page.props.auth.user.super_admin">
                    <a :href="route('admin.categories')">
                        Gestion des catégories
                    </a>
                </li>
            </ul>
        </div>
    </header>
</template>

<script>
export default {
    name: 'BurgerMenu',
    methods: {
        openMenu() {
            let menu = document.getElementById('menu');
            let body = document.querySelector('body');

            menu.classList.add('menuAppears');
            body.style.overflowY = 'hidden';
        },
        closeMenu() {
            let menu = document.getElementById('menu');
            let body = document.querySelector('body');

            menu.classList.remove('menuAppears');
            body.style.overflowY = 'visible';
        },
    },
}
</script>
