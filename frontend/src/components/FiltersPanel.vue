<template>

    <section class="app__filters">
        <StatusList></StatusList>
        <TagsList></TagsList>
    </section>

</template>

<script>

    import StatusList from "./StatusList.vue";
    import TagsList from "./TagsList.vue";

    export default {
        name: "FiltersPanel",
        components: {
            StatusList,
            TagsList
        }
    }

</script>

<style >

.app__filters {
    padding: 50px 15px;
    border-right: 1px solid #EEE;
}

.lists-list__add,
.tags-list__add {
    float: right;
    background: #F1F1F1;
    width: 25px;
    height: 25px;
    border: none;
    font-size: 18px;
    border-radius: 50%;
    color: #AAA;
    cursor: pointer;
}

.tags-list,
.lists-list {
    list-style: none;
    padding: 0;
    margin: 0 0 50px 0;
}

.tags-list__title,
.lists-list__title {
    display: inline-block;
    margin-bottom: 10px;
    font-weight: normal;
    color: #BBB;
}

.tags-list__item,
.lists-list__item {
    font-size: 17px;
    padding: 0 10px;
    cursor: pointer;
}

.tags-list__item:hover,
.lists-list__item:hover,
.activeTag {
    border-left: 3px solid #8ACAFE;
    background: #F4FAFE;
}

.todo-item__input,
.lists-list__input,
.tags-list__input {
    position: relative;
    background: transparent;
    border: none;
    font-size: 17px;
    outline: none;
    margin: 0;
    padding: 10px 0;
    width: 100%;
    height: 100%;
}

.todo-item__input::placeholder,
.tags-list__input::placeholder,
.lists-list__input::placeholder {
    color: #DDD;
}

</style>