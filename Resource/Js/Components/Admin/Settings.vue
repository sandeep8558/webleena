<template>
    <div class="container">

        <div class="m-15 shadow-4 rounded-8 p-15">

            {{ fields.brand }}

            <div v-for="val in fields" :key="val" class="mb-10">
                <div class="mb-5 capitalize">{{ val }}</div>

                <!-- <formelement v-if="fields[key] == 'text'" type="text" :label="'Label'" :key="'name'" :val="val" class="mb-5"></formelement> -->

                <!-- <input v-if="fields[key] == 'text'" type="text" :value="val" @change="update($event, key)" class="d-block w-100 p-4">

                <input v-if="fields[key] == 'email'" type="email" :value="val" @change="update($event, key)" class="d-block w-100 p-4">

                <textarea v-if="fields[key] == 'textarea'" :value="val" @change="update($event, key)" rows="6" class="d-block w-100 p-4"></textarea>

                <input v-if="fields[key] == 'color'" type="text" :value="val" @change="update($event, key)" class="d-block w-100 p-4" :style="{'backgroundColor': val}">

                <input v-if="fields[key] == 'file'" type="file" @change="updateFile($event, key)" class="d-block w-100 p-4"> -->
                
            </div>

        </div>

    </div>
</template>

<script>
import axios from 'axios';
export default {

    components: {
    },

    props: ['settings', 'fields'],

    data: function () {
        return {
            title: 'Sandeep',
            fields: {
                brand: {},
            },
        };
    },

    methods: {

        async getFields(){
            let f = await axios.get('/api/data/fields?file=settings').then(res => res.data);
            this.fields.brand = f.brand;
            console.log(this.fields.brand);
        },

        async updateSettings(formData){
            let res = await axios.post('/api/data/save', formData).then(res => res);
            console.log(res);
        },

        update(event,key){
            let formData = new FormData();
            formData.append('file', 'settings');
            formData.append('key', key);
            formData.append('val', event.target.value);
            this.updateSettings(formData);
        },

        updateFile(event,key){
            let formData = new FormData();
            formData.append('file', 'settings');
            formData.append('key', key);
            formData.append('val', event.target.files[0]);
            this.updateSettings(formData);
        }

    },

    created() {
        this.getFields();
    },
}
</script>