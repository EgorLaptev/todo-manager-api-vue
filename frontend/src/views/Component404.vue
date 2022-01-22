<template>
    <h1 class="error">
        404
    </h1>
</template>

<script>
    export default {
        name: "Component404"
    }
</script>

<style scoped>

    body {
        position: absolute;
        inset: 0;
    }

    .error {
        display: flex;
        justify-content: center;
        align-items: center;
        position: absolute;
        width: 100%;
        height: 100%;
        text-align: center;
        color: #6ABCFF;
        font-size: 108px;
        font-family: "Agency FB", sans-serif;
        white-space: nowrap;
        text-transform: uppercase;
    }

</style>
