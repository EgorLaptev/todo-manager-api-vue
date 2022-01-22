<template>

    <ul class="todos-list">
        <slot></slot>
    </ul>

</template>

<script>

    export default {
        name: "TodoList",
        props: ['todos'],
        inject: ['filters'],
    }

</script>

<style scoped>

    .todos-list {
        width: 90%;
        margin: 0;
        padding: 30px 0 0 0;
        list-style: none;
    }

</style>
