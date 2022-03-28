<template>
  <PageComponent>
    <template v-slot:header>
      <div class="flex justify-between items-center">
        <div class="font-bold">Todos</div>
        <div>&nbsp;</div>
      </div>
    </template>
    <div class="grid grid-cols-1">
      <div class="border border-2 rounded px-2 justify-between">
        <form class @submit="createNewToDo">
          <div class="flex justify-between px-3">
            <div>Create New ToDo</div>
            <div>
              <button class="border p-1 border-2 rounded-1 text-white bg-green-600 hover:bg-green-800 py-1">SUBMIT</button>
            </div>
          </div>

          <input type="hidden" name="remember" value="true" />
          <div class="rounded-md shadow-sm -space-y-px">
            <div>
              <label for="toDo-title" class="sr-only">Title</label>
              <input
                id="toDo-title"
                v-model="newToDo.title"
                name="title"
                type="text"
                autocomplete="text"
                required
                class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                placeholder="ToDo Title"
              />
            </div>
          </div>
        </form>
      </div>
      <div v-for="toDo in toDos" :key="toDo.id" :checked="toDo.id">
        <Task :toDo="toDo" :toDoStatus="false"/>
      </div>
      <div v-for="toDo in toDos" :key="toDo.id" :checked="toDo.id">
        <Task :toDo="toDo" :toDoStatus="true"/>
      </div>
      <!-- <div v-for="toDo in toDos" :key="toDo.id" :checked="toDo.id">
        <div v-if="toDo.done">
          <div
            class="border border-2 rounded hover:bg-slate-200"
            :class="['bg-auto bg-green-200 hover:bg-green-400'
            ]"
          >
            <div class="flex justify-between items-center">
              <div>
                <input type="checkbox" v-model="toDo.done" />
                <strong class="px-3">{{ toDo.title }}</strong>
              </div>
              <p>
                <span @click="deleteToDo(toDo)">delete</span>, edit
              </p>
            </div>
          </div>
        </div>
      </div> -->
    </div>
  </PageComponent>
</template>

<script setup>
import PageComponent from "../components/PageComponent.vue";
import Task from "./Task.vue";
import store from "../store";
import { computed, onMounted, reactive } from "vue";
import { PencilAltIcon } from "@heroicons/vue/outline";
import { TrashIcon } from "@heroicons/vue/outline";
import { PlusCircleIcon } from "@heroicons/vue/outline";

const toDos = computed(() => (store.state.user.toDos))
const newToDo = reactive({
  title: "",
})
onMounted:{
  loadPage()
}
function loadPage() {
  store.dispatch("getToDos")
}
function createNewToDo(e) {
  e.preventDefault()
  store.dispatch("newToDo", {
    done: false,
    title: newToDo.title,
    deadline: "2022-4-15 18:00:00",
    created_at: "2022-3-15 18:00:00",
  })
  newToDo.title = ""

}
function deleteToDo(toDo) {
  e.preventDefault()
  store.dispatch("deleteToDo", toDo);
}
function startEditToDo(toDo) {
  toDo.edit = reactive(true)
}
</script>

<style>
</style>