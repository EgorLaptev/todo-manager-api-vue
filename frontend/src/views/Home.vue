<template>

    <PureLoader v-if="dataIsLoading"></PureLoader>

    <OptionsPanel></OptionsPanel>

    <FiltersPanel></FiltersPanel>

    <main class="app__body">
        <input type="text" placeholder="Write title for new todo #tags" class="app_add-todo" v-model.trim="todo.title" @keydown.enter="addTodo">
        <TodoList>
            <TodoItem v-for="todo of filteredTodos" :todo="todo" @updateOpenedTodo="openTodo" @deleteTodo="deleteTodo"></TodoItem>
        </TodoList>
    </main>

    <EditTodo :todo="openedTodo"></EditTodo>

</template>

<script>

    import * as _ from "lodash";
    import { computed, ref } from "vue";

    // Vue components
    import OptionsPanel from "../components/OptionsPanel.vue";
    import FiltersPanel from "../components/FiltersPanel.vue";
    import PureLoader from "../components/PureLoader.vue";
    import EditTodo from "../components/EditTodo.vue";
    import TodoList from "../components/TodoList.vue";
    import TodoItem from "../components/TodoItem.vue";

    window.baseUrl = 'http://api.todos.gq';
    window.bearerToken = 'Bearer a5bef7e392e140f7d68106310e3435db3b1902e0d44d0c8768ee6090af7e97ddcf9a61'

    export default {
        name: 'app',
        data() {
            return {
                todo: { id: null, title: '', description: '', completed: false, tags: [] },
                todos: [],
                tags: new Set(),
                openedTodo: null,
                dataIsLoading: true,
                filters: { tag: null, list: 0 },
                lists: [
                    { id: 0, name: 'All' },
                    { id: 1, name: 'Completed' },
                    { id: 2, name: 'Uncompleted' }
                ],
            }
        },
        components: {
            TodoItem,
            OptionsPanel,
            FiltersPanel,
            PureLoader,
            EditTodo,
            TodoList
        },
        methods: {
            addTodo() {

                // Devide query string for title & tag name
                const [title, tag] = this.todo.title.split('#');

                // Add tag
                if (tag && tag.trim()) {

                    let tagExists = false,
                        tagObj    = null;

                    for (const tagItem of this.tags) if (tagItem.name == tag.trim().toLowerCase()) {
                        tagExists = true;
                        tagObj = tagItem;
                    }

                    if (!tagExists) this.tags.add(tag.trim().toLowerCase());
                    this.todo.tags.push(tag.trim().toLowerCase());

                }

                // Store new todo
                if (title.trim()) {

                    const body = JSON.stringify({
                        title, tags: JSON.stringify(this.todo.tags)
                    })

                    fetch(`${baseUrl}/api/todos`, {
                        method: 'POST', body,
                        headers: {
                            'Content-Type': 'application/json;charset=utf-8',
                            Authorization: bearerToken
                        }
                    })  .then( resp => resp.json() )
                        .then( todo => {
                            this.todos[this.todos.length-1]['id'] = todo.id;
                        });

                    this.todo.title = title;
                    this.todos.push(this.todo);

                }

                this.todo = { id: this.todo.id , title: '', description: '', tags: [] }

            },
            openTodo(id) {
                this.openedTodo = this.todos.find( item => item.id === id );
            },
            syncTodos() {
                fetch(`${baseUrl}/api/todos`, {
                    method: 'GET',
                    headers: { Authorization: bearerToken }
                })
                    .then( resp => resp.json() )
                    .then( todos => {
                        todos.filter( todo => {
                            todo.tags = JSON.parse(todo.tags)
                            todo.tags.forEach( tag => this.tags.add(tag) );
                        }) // Parse todo tags
                        this.todos = todos;
                        localStorage.setItem('todos', JSON.stringify(todos));
                        this.dataIsLoading = false;
                    });
            },
            deleteTodo(id) {
                const todo = this.todos.find( item => item.id === id );
                this.todos.splice(this.todos.indexOf(todo), 1);

                fetch(`${baseUrl}/api/todos/${id}`, {
                    headers: { Authorization: bearerToken },
                    method: 'DELETE'
                });
            }
        },
        watch: {
            openedTodo: {
                handler: _.debounce( todo => {

                    if (!todo.id) return false;


                    const body = JSON.stringify({
                        tags: JSON.stringify(todo.tags),
                        title: todo.title,
                        completed: todo.completed,
                        description: todo.description,
                    });

                    fetch(`${baseUrl}/api/todos/${todo.id}`, {
                        headers: {
                            'Content-Type': 'application/json',
                            Authorization: bearerToken,
                        },
                        method: 'PUT', body
                    });

                },1000),
                deep: true
            }
        },
        computed: {
            filteredTodos() {
                return this.todos.filter( todo => {
                    if ( ( todo.completed && [0,1].includes(this.filters.list) ) || ( !todo.completed && [0,2].includes(this.filters.list) ) )  // Lists
                        if ( todo.tags.find( tag => tag === this.filters.tag ) || !this.filters.tag ) return true;
                })
            }
        },
        provide() {
            return {
                filters: this.filters,
                lists:   this.lists,
                tags:    this.tags,
            }
        },
        mounted() {
            this.syncTodos()
        }
    }

</script>

<style>

:root {
    font-size: 1px;
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    user-select: none;
}

body {
    height: 100vh;
    font-size: 18rem;
    font-family: sans-serif;
    color: #111;
    background: #FFF;
}

a {
   color: inherit;
    text-decoration: none;
}

.app {
    height: 100%;
    width: 100%;
    display: grid;
    grid-template-columns: 50px minmax(100px, 3fr) 10fr minmax(250px, 5fr);
}


.app__body {
    padding: 25px;
    display: flex;
    flex-direction: column;
    align-items: center;
    overflow-y: scroll;
    border-right: 1px solid #EEE;
}

.app__body::-webkit-scrollbar {
    background: transparent;
}

.app_add-todo {
    border-radius: 3px;
    border: none;
    padding: 10px 25px;
    font-size: 17px;
    outline: none;
    background: #F5f5f5;
    width: 90%;
}

.app_add-todo::placeholder {
    color: #DDD;
}

</style>
