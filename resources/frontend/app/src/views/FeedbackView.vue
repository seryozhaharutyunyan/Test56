<template>
    <div class="col-5 mt-3 m-auto">
        <input class="form-control p-3 m-3 " type="text" placeholder="Name" v-model="name">
        <div class="text-center text-danger">{{ error.name[0] }}</div>
        <input class="form-control p-3 m-3 " type="text" placeholder="Pone(+75155265669)" v-model="pone">
        <div class="text-center text-danger">{{ error.pone[0] }}</div>
        <textarea class="form-control p-3 m-3 " type="text" placeholder="Appeal" v-model="appeal"></textarea>
        <div class="text-center text-danger">{{ error.appeal[0] }}</div>
        <button class="btn-info btn" @click="send()">Send</button>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "FeedbackView",

    data() {
        return {
            name: '',
            pone: '',
            appeal: '',

            error: {
                name: [''],
                pone: [''],
                appeal: [''],
            }
        }
    },

    methods: {
        send() {
            this.error = {
                name: [''],
                pone: [''],
                appeal: [''],
            }

            axios.post('http://localhost/api/store', {
                name: this.name,
                pone: this.pone,
                appeal: this.appeal,
            }).then((r)=>{
               //this.name='';
               //this.pone='';
               //this.appeal='';
                console.log(r);
            }).catch(error=>{
                if(error.response.data.errors){
                    this.error=Object.assign(this.error, error.response.data.errors)
                }
            })
        }
    }
}
</script>

<style scoped>

</style>
