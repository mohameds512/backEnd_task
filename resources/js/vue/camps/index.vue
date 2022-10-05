<template>

    <div class="container">


        <div class="products__list table  my-3">

        <div class="customers__titlebar dflex justify-content-between align-items-center">
            <div class="customers__titlebar--item">
                <h1 class="my-1">Campaigns</h1>
            </div>
            <div class="customers__titlebar--item">
                <button class="btn btn-secondary my-1" @click="newCamp()" >
                    new Campaign
                </button>
            </div>
        </div>

        <div class="table--heading mt-2" style="padding-top: 20px;background:#FFF">

            <p class="table--heading--col1">name</p>
            <p class="table--heading--col4">
                from / to
            </p>
            <p class="table--heading--col4">total</p>
            <p class="table--heading--col3">
                daily Budget
            </p>
            <p class="table--heading--col5">images</p>
            <p class="table--heading--col5">actions</p>
        </div>

        <!-- product 1 -->
        <div v-if="camps.length> 0 ">
            <div class="table--items " v-for="(camp , index) in camps" :key="index" >
            <div class="table--heading--col1">
                {{camp.name}}
            </div>
            <a  class="table--items--col4">
                {{camp.from}} / {{camp.to}}
            </a>
            <p class="table--items--col4">
                {{camp.total}}
            </p>
            <p class="table--items--col3">
                {{camp.daily_budget}}
            </p>
            <p class="table--items--col3">

                <button @click="isOpen = camp.id ">show Imgs</button>
                <pop-modal :open="isOpen === camp.id" @close="isOpen = false">

                    <div class="camp_img" v-for="(camp_img,index) in get_camp_img(camp.images) " :key="index">
                        <img :src="get_path(camp_img)" >
                    </div>
                </pop-modal>
            </p>
            <div>
                <button class="btn-icon btn-icon-success" @click="editCamp(camp.id)">
                    <font-awesome-icon
                        icon="fa-edit"
                    />
                </button>
                <button class="btn-icon btn-icon-danger" @click="delCamp(camp.id)" >
                    <font-awesome-icon
                        icon="fa-trash"
                    />
                </button>
            </div>
            </div>
        </div>
        <div v-else>
            <br>
            no Campaigns
        </div>


    </div>

    </div>
</template>

<script>
import { ref } from '@vue/reactivity';
import axios from 'axios';
import router from '../../router/index';
import popModal from './popModal.vue'

export default ({
    components: {
        popModal
    },
    data:function(){
        return {
            camps:[],
        }
    },
    methods:{
        newCamp() {
            router.push({name:"newCamp"})
        },
        editCamp(camp_id){
            router.push({name:"editCamp",params:{id:camp_id}})
        },
        delCamp(del_id){
            Swal.fire({
            title:'Are You sure',
            text:"can't go back",
            icon:'warning',
            showCancelButton:true,
            confirmButtonColor:'#3085d6',
            confirmButtonText:'Yes,delete it!',
            cancelButtonColor:'#d33',
            cancelButtonText:'No',
        })
        .then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                axios.delete('/api/campaigns/delete/'+ del_id)
                .then(()=>{
                    Swal.fire(
                        'Delete',
                        'deleted Successfully',
                        'success'
                    )
                    this.getCamps();
                })
                .catch(err=>{
                    Swal.fire("Failed","There Was Something Wrong. ","warning");
                })

            }
        })
        },
        getCamps(){
            axios.get('/api/campaigns')
            .then(response =>{
                this.camps = response.data
            })
            .catch(err=>{
                console.log(err);
            })
        },
        get_camp_img(camp_imgs){
            return JSON.parse(camp_imgs);
        },
        get_path(img){
            return '/upload/'+img ;
        }
    },
    created(){
        this.getCamps()
    },

    setup(){
        const isOpen = ref(false);
        return { isOpen };
    }
})
</script>

<style scoped>
.btn-icon-danger{
    color: brown;
}
.btn-icon-success{
    color: rgb(51, 128, 0);
}
</style>
d
