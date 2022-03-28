<template>
    <div v-if="toDo.done == toDoStatus">
        <div class="border border-2 rounded hover:bg-slate-200">
            <div class="flex justify-between items-center">
                <div class="flex items-center px-3">
                    <input type="checkbox" v-model="toDo.done" @change="toggleCheck(toDo)"/>
                    <strong class="px-3" v-if="!this.edit">{{ toDo.title }}</strong>
                    <div class="px-3"></div>
                    <textarea type="text" v-if="this.edit" v-model="newTodo.title" />
                </div>
                <p>
                    <span v-if="!this.edit" @click="deleteToDo(toDo)"><button class="border p-1 border-2 rounded-1 text-white bg-red-400 hover:bg-red-600">DELETE</button></span>
                    <span v-if="!this.edit" @click="toggleEditToDo()"><button class="border p-1 border-2 rounded-1 text-white bg-yellow-400 hover:bg-yellow-600">EDIT</button></span>
                    <span v-if="this.edit" @click="submitToDo(toDo)"><button class="border p-1 border-2 rounded-1 text-white bg-green-600 hover:bg-green-800">CHANGE</button></span>
                    <span v-if="this.edit" @click="toggleEditToDo()"><button class="border p-1 border-2 rounded-1 text-white bg-red-400 hover:bg-red-600">CANCEL</button></span>
                </p>
            </div>
        </div>
    </div>
</template>

<script >
import { reactive, ref } from "@vue/reactivity"
import { computed } from "@vue/runtime-core";
import store from "../store";

export default {
    name: "Task",
    props: {
        toDo: Object,
        toDoStatus: Boolean
    },
    data() {
        return {
            edit: false,
            newTodo: { ...this.toDo }
        }
    },
    methods: {
        toggleEditToDo() {
            this.edit = !this.edit
        },
        submitToDo(toDo) {
            this.toDo.title = this.newTodo.title
            store.dispatch("editToDo", this.toDo)
            this.toggleEditToDo()
        },
        toggleCheck(toDo) {
            store.dispatch("editToDo", this.toDo)
        },
        deleteToDo(toDo) {
            store.dispatch("deleteToDo", toDo);
        }
    },
}
</script>

<style>
</style>