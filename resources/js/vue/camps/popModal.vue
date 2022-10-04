<template>
    <transition name="fade">
        <div class="vue-modal" v-show="open">
            <div class="vue-modal-inner">
                <div class="vue-modal-content">
                    <slot />
                    <button class="close_btn" type="button" @click="$emit('close')">
                        <font-awesome-icon
                        icon="fa-circle-xmark"
                    />
                    </button>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
export default ({
    props:{
        open:{
            type:Boolean,
            required:true
        }
    }
})
</script>

<style scoped>
::before,
::after{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
.vue-modal{
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow-x: hidden;
    overflow-y: auto;
    background-color: rgba(0, 0, 0, 0.4);
    z-index: 1;
}
.vue-modal-inner{
    max-width: 80%;
    margin: 2rem auto;
}
.vue-modal-content{
    position: relative;
    background-color: #ffffff;
    background-clip: padding-box;
    border-radius: 0.3rem;
    border: 1px solid rgba(0, 0, 0, 0.3);
    padding: 1rem;
}
.fade-enter-active,
.fade-leave-active{
    transition: opacity 0.1s;
}
.fade-enter,
.fade-leave-to{
    opacity: 0 ;
}
.close_btn{
    position: relative;
    color: rgba(0, 0, 0, 1);
    font-size: 18px;
    border: none;
    margin-left: 96%;
}



</style>
