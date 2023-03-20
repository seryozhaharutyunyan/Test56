<template>
    <div class="col-5 mt-5 m-auto">
        <select v-model="name" class="form-select m-3 mb-0  p-3">
            <option disabled value="">Method</option>
            <option value="database">
                Database
            </option>
            <option value="email">
                Email
            </option>
        </select>
        <div class="text-danger text-center">{{ error.name[0]}}</div>
        <input class="form-control m-3 p-3 " v-if="name==='database'" type="text" v-model="database"
               placeholder="Database name/Table name">
        <div class="text-danger text-center">{{ error.database[0]}}</div>
        <input class="form-control m-3 p-3 " v-if="name==='email'" type="email" v-model="email" placeholder="Email">
        <div class="text-danger text-center">{{ error.email[0]}}</div>
        <div class="m-auto">
            <button class="btn-info btn m-3 p-3" @click="send()">Send</button>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "SaveMethodView",

    data() {
        return {
            name: '',
            database: '',
            email: '',

            error: {
                name: [''],
                database: [''],
                email: [''],
            }
        }
    },

    computed: {
        url() {
            return this.$store.getters.getUrl;
        }
    },

    methods: {
        send() {
            this.error = {
                name: [''],
                database: [''],
                email: [''],
            };

            axios.post(`${this.url}/method/store`, {
                name: this.name,
                database: this.database,
                email: this.email,
            }).then(()=>{
                this.name='';
                this.database='';
                this.email='';
            }).catch(error=>{
                console.log(error);
                if(error.response.data.errors){
                    this.error=Object.assign(this.error, error.response.data.errors);
                }
            })
        }
    }
}
</script>

<style scoped>

</style>
