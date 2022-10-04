
import {createRouter , createWebHistory} from 'vue-router'

import compsIndex from '../vue/camps/index.vue'
import createCamp from '../vue/camps/create.vue'
import editCamp from '../vue/camps/edit.vue'
import notFound from '../vue/notFound.vue'
const routes = [
    {
        path:'/',
        name:'index',
        component:compsIndex
    },
    {
        path:'/new',
        name:'newCamp',
        component:createCamp
    },
    {
        path:'/edit/:id',
        name:'editCamp',
        component:editCamp,
        props:true
    },
    {
        path:'/:pathMatch(.*)',
        component:notFound
    }
]

const router = createRouter({
    history:createWebHistory(import.meta.env.BASE_URl),
    routes
})

export default router
