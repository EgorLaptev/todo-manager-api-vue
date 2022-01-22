<template>

    <aside class="app__aside">

        <ul class="aside__list">
            <li class="aside__item">
                <img class="user-avatar" src="../assets/img/avatar.jpg"/>
            </li>
            <li class="aside__item aside__item_active">
                <i class="fas fa-check-square"></i>
            </li>
            <li class="aside__item">
                <i class="fas fa-search"></i>
            </li>
            <li class="aside__item">
                <i class="fas fa-cog"></i>
            </li>
            <li class="aside__item">
                <router-link :to="{ name: 'login' }">
                    <i class="fas fa-sign-out-alt"></i>
                </router-link>
            </li>
        </ul>

    </aside>

</template>

<script>
    export default {
        name: "OptionsPanel",
    }
</script>

<style scoped>

    .app__aside {
        position: relative;
        padding: 10px 0;
        border-right: 1px solid #EEE;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-direction: column;
    }

    .aside__list {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        list-style: none;
        gap: 10px;
    }


    .aside__item {
        width: 40px;
        height: 40px;
        display: flex;
        justify-content: center;
        align-items: center;
        color: #333;
        cursor: pointer;
    }

    .aside__item_active,
    .aside__item:hover {
        color: #8ACAFE;
    }

    .aside__item:first-of-type {
        margin-bottom: 10px;
    }

    .user-avatar {
        background: #DDD;
        border-radius: 5px;
        width: 100%;
        height: 100%;

    }

</style>
