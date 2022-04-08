<template>
    <div class="container__sidebar">
        <a :href="route('dashboard')">
            <img src="/img/logo_white.svg" alt="logo">
        </a>

        <div class="container__menu">
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
                <li>gestion des pôles</li>
            </ul>

            <a class="btn__event" :href="route('admin.animation.form')">Créer un évènements</a>
        </div>

        <div class="container__logout">
            <NavLink :href="route('logout')" method="post" as="button">
                Deconnexion
            </NavLink>
        </div>
    </div>
</template>

<script>
import Button from "@/Components/Button";
import NavLink from "@/Components/NavLink";

export default {
    components: {
        Button,
        NavLink,
    },
    props: ['value']
}
</script>
