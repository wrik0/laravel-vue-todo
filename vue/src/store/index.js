import axios from "axios";
import { createStore } from "vuex";
import axiosClient from "../axios";



const store = createStore({
    state: {
        components: {},
        user: {
            data: {},
            token: sessionStorage.getItem("TOKEN"),
            toDos: []
        },
    },
    getters: {},
    actions: {
        register({ commit }, user) {
            return axiosClient.post("/register", user)
            .then((res) => {
                commit("setUser", res);
                return res; 
            });
        },
        login({ commit }, user) {
           return axiosClient.post("/login", user)
            .then((res) => {
                commit("setUser", res);
                return res; 
            });
        },
        logout({commit}){
            return axiosClient.post("/logout")
            .then(()=> {
                commit("logout");
                return res;
            });
        },
        deleteToDo({commit}, toDo){
            return axiosClient.delete(`/toDo/${toDo.id}`,toDo)
            .then((res)=>{
                commit("deleteToDo", res);
            });
        },
        getToDos({commit}){
            return axiosClient.get("/toDo")
            .then((res) =>{
                commit("getToDos", res.data);
                return res;
            });
        },
        newToDo({commit}, toDo){
            return axiosClient.post("/toDo", toDo)
            .then((res) => {
                commit("newToDo", res);
                return res;
            });
        },
        editToDo({commit}, toDo){
            console.log(toDo);
            return axiosClient.put(`/toDo/${toDo.id}`,toDo)
            .then((res)=> {
                commit("editToDo", res.data);
            });
        }
    },
    mutations: {
        logout: (state) => {
            state.user.token = null;
            state.user.data = {};
        },
        setUser: (state, userData) => {
            state.user.token = userData.data.token;
            state.user.data = userData.data.user;
            sessionStorage.setItem("TOKEN", userData.data.token);
        },
        deleteToDo: (state, toDo) => {
            state.user.toDos = state.user.toDos.filter((val, index, arr) => {
                return val.id !== toDo.data.id;
            });
        },
        getToDos:(state, toDoArray) => {
            state.user.toDos = [...toDoArray];
        },
        newToDo: (state, toDo) => {
            state.user.toDos.unshift(toDo.data);
        },
        editToDo:(state, toDo) => {
            state.user.toDos = state.user.toDos.map((entry)=>{
                if (entry.id !== toDo.id) return entry;
                entry.title = toDo.title;
                return entry;
            });
        }
    },
    modules: {},
});

export default store;
