<template>

    <li class="todo-item">

        <input type="checkbox" @focus="openTodo(todo.id)" v-model="todo.completed" class="todo-item__completed">
        <input type="text" class="todo-item__input" v-model="todo.title" @focus="openTodo(todo.id)" placeholder="Enter the title">

        <TodoTags :todo="todo"></TodoTags>

        <button @click="toggleOptions" class="todo-item__more"><i class="fas fa-ellipsis-v"></i></button>

        <ul class="options-popup" v-show="showOptions">
            <li class="options-popup__item">
                <button @click="deleteTodo(todo.id)"><i class="fas fa-minus-square"></i></button>
            </li>
        </ul>

    </li>

</template>

<script>

    import TodoTags from "./TodoTags.vue";

    export default {
        name: "TodoItem",
        data() {
            return {
                showOptions: false
            }
        },
        props: {
            todo: Object
        },
        methods: {
            toggleOptions(e) { this.showOptions = !this.showOptions },
            openTodo(id) {
               this.$emit('updateOpenedTodo', id);
            },
            deleteTodo(id) {
                this.$emit('deleteTodo', id);
            }
        },
        components: {
            TodoTags
        }
    }
</script>

<style scoped>

.todo-item {
    position: relative;
    padding: 0 20px;
    border-left: 3px solid #8ACAFE;
    margin: 5px 0;
    background: #F4FAFE;
    display: flex;
    flex-direction: row;
    align-items: center;
}


.todo-item__input {
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

.todo-item__input::placeholder {
    color: #DDD;
}

.todo-item__completed {
    height: 15px;
    width: 15px;
    border: none;
    margin-right: 10px;
}

.todo-item__more {
    background: transparent;
    border: none;
    font-size: 15px;
    color: #444;
    margin-left: 20px;
    cursor: pointer;
}

.options-popup {
    display: block;
    position: absolute;
    left: 100%;
    top: 0;
    padding: 0;
    background: #CBE7FE;
    list-style: none;
    z-index: 10;
}

.options-popup__item button {
    height: 100%;
    background: transparent;
    border: none;
    border-radius: 0;
    cursor: pointer;
    font-size: 16px;
    padding: 10px;
    color: #F4FAFE;
}

.options-popup__item button:hover {
    background: #FEDDDE;
}

</style>
