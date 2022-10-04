<template>
    <div class="container">
        <div class="products__create ">

            <div class="products__create__titlebar dflex justify-content-between align-items-center">
                <div class="products__create__titlebar--item">

                    <h1 class="my-1">Add campaign</h1>
                </div>
                <div class="products__create__titlebar--item">

                    <button class="btn btn-secondary ml-1" @click="createCamp()" >
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
import axios from 'axios';
import router from '../../router/index';

export default ({
    data: function(){
        return {
            camp: {
                name:"",
                from:"",
                to:"",
                total:"",
                daily_budget:"",
                images:[],
            }
        }
    },
    methods:{
        createCamp () {
            // if (this.camp.name || this.camp.from ||this.camp.to || this.camp.total || this.camp.daily_budget || this.camp.images == '') {
            //     return;
            // }
            axios.post('/api/campaigns/store',{
                camp: this.camp
            })
            .then(response=>{
                if (response.status==201) {
                    this.camp.name="";
                    this.camp.from="";
                    this.camp.to="";
                    this.camp.total="";
                    this.camp.daily_budget="";
                    this.camp.images=[];
                    router.push({name:"index"})

                    toast.fire({
                        icon:"success",
                        title:"campaign Added Successfully"
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
    }
})
</script>


