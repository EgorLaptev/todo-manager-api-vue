<template>

    <h4 class="lists-list__title">Lists</h4>
    <ul class="lists-list">
        <li class="lists-list__item" v-for="list of lists" @click="setFilterList(list.id)" :class="{activeTag: isListActivated(list.id)}">
            <input type="text" v-model="list.name" class="lists-list__input" placeholder="Enter the title" disabled>
        </li>
    </ul>

</template>

<script>
    export default {
        name: "StatusList",
        inject: ['filters', 'lists'],
        methods: {
            isListActivated(id) {
                return this.filters.list === id;
            },
            setFilterList(id) {
                this.filters.list = id;
            }
        },
    }
</script>

<style scoped>

</style>