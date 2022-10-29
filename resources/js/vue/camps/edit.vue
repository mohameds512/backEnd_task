<template>
    <div class="container">
        <div class="products__create ">

            <div class="products__create__titlebar dflex justify-content-between align-items-center">
                <div class="products__create__titlebar--item">

                    <h1 class="my-1">Edit campaign</h1>
                </div>
                <div class="products__create__titlebar--item">

                    <button class="btn btn-secondary ml-1" @click="updateCamp()" >
                        Save
                    </button>
                </div>
            </div>

            <div class="products__create__cardWrapper mt-2">
                <div class="products__create__main">
                    <div class="products__create__main--addInfo card py-2 px-2 bg-white">
                        <p class="mb-1">Name</p>
                        <input type="text" v-model="camp.name" >

                        <p class="my-1">from</p>
                        <input type="date" v-model="camp.from">

                        <p class="my-1">to</p>
                        <input type="date" v-model="camp.to">

                        <div class="products__create__main--media--images mt-2">
                            <span class="required" >*</span><br>
                            <input type="file"  multiple @change="uploadImages"  placeholder="Upload Campaign"/>
                        </div>

                    </div>

                </div>
                <div class="products__create__sidebar">
                    <!-- Product Organization -->
                    <div class="card py-2 px-2 bg-white">

                        <div class="my-3">
                            <p>total</p>
                            <input type="text" class="input" v-model="camp.total" >
                        </div>
                        <div class="my-3">
                            <p>daily Budget</p>
                            <input type="text" class="input" v-model="camp.daily_budget">
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from "axios"
import router from '../../router'
export default ({
    data:function(){
        return {
            camp:[]
        }
    },
    methods:{
        updateCamp(){
            axios.put('/api/campaigns/update/'+this.camp.id,{
                camp: this.camp
            })
            .then(response=>{
                if (response.status == 200) {
                    this.camp.name="";
                    this.camp.from="";
                    this.camp.to="";
                    this.camp.total="";
                    this.camp.daily_budget="";
                    this.camp.images=[];

                    router.push({name:"index"})

                    toast.fire({
                        icon:"success",
                        title:"updated Successfully"
                    })

                }
            })
            .catch(err=>{
                console.log(err);
            })
        },
        uploadImages(e) {
            let a = [];
            for (let file of e.target.files) {
            try {
            let reader = new FileReader();
            reader.onloadend = (file) => {
                a.push(reader.result);
            };
            reader.readAsDataURL(file);
                this.camp.images = a;
                } catch {}
            }
        },
        getSelCamp(){
            axios.get('/api/campaigns/edit/'+this.$route.params.id)
            .then(response=>{
                this.camp = response.data
            })
            .catch(err=>{
                console.log(err);
            })
        }
    },
    created(){
        this.getSelCamp()
    }
})
</script>

<style scoped>
.required{
    color: rgb(202, 15, 15);
    font-size: 25px;
}
</style>

