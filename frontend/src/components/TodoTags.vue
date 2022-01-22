<template>

    <ul class="todo__tags" v-if="todo">
        <li class="todo__tag" v-for="tag of todo.tags" @click="this.setFilterTag(tag)">{{ tag }}</li>
        <li class="todo__tag todo__tag_add" @click="addTag">+</li>
    </ul>

</template>

<script>
    export default {
        name: "TodoTags",
        props: ['todo'],
        inject: ['tags', 'filters'],
        methods: {
            setFilterTag(tag) {
                if (this.filters.tag === tag) this.filters.tag = null;
                else this.filters.tag = tag;
            },
            addTag() {
                this.tags.add('unnamed');
                this.todo.tags.push('unnamed');
            }
        },
    }
</script>

<style scoped>

.todo__tags {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    gap: 10px;
}

.todo__tag {
    border-radius: 3px;
    padding: 0 5px;
    background: #CBE7FE;
    font-size: 16px;
    cursor: pointer;
    white-space: nowrap;
    max-width: 125px;
    overflow: hidden;
    text-overflow: ellipsis;

}

.todo__tag_add {
    border: 1px solid #8ACAFE;
    color: #8ACAFE;
    background-color: transparent;
}

.todo__tag_add:hover {
    background: #F4FAFE;
}

</style>