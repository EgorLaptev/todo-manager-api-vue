<template>

    <section class="app__todo todo" id="appTodo" v-if="todo">

        <h3 class="todo__title">
            <input type="text" v-model.trim="todo.title" class="todo__title-input" placeholder="Title">
        </h3>

        <p class="todo__content">
            <textarea v-model="todo.description" class="todo__content-input" placeholder="Description"></textarea>
        </p>

        <TodoTags :todo="todo"></TodoTags>

    </section>

</template>

<script>

    import TodoTags from "./TodoTags.vue";

    export default {
        name: "EditTodo",
        props: ['todo'],
        components: {
            TodoTags
        }
    }

</script>

<style scoped>


    .app__todo {
        position: relative;
        padding: 25px;
    }

    .todo__title-input {
        border: none;
        background: transparent;
        font-size: 24px;
        outline: none;
        margin-bottom: 15px;
    }


    .todo__content-input {
        padding: 25px;
        position: absolute;
        inset: 0;
        top: 10%;
        width: 100%;
        margin-top: 50px;
        border: none;
        font-size: 18px;
        outline: none;
        resize: none;
        background: transparent;
    }

    .todo__title-input::placeholder,
    .todo__content-input::placeholder {
        color: #CECECE;
    }

</style>