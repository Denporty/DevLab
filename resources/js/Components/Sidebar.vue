<template>
    <div class="container__sidebar">
        <img src="/img/logo_white.svg" alt="logo">

        <div class="container__menu">
            <ul>
                <li>Évènements</li>
                <li>Gestion des utilisateurs</li>
                <li>gestion des pôles</li>
            </ul>

            <a :href="route('admin.animation.form')">Créer un évènements</a>
        </div>

        <div class="container__logout">
            <BreezeDropdownLink :href="route('logout')" method="post" as="button">
                Log Out
            </BreezeDropdownLink>
        </div>
    </div>
</template>

<script>
export default {
    props: ['value']
}
</script>
