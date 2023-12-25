<script>
import axios from 'axios';
import FormElement from '../Form/FormElement.vue';
export default {

    components: {
        'form_element': FormElement
    },

    props: ['settings', 'fields'],

    data: function () {
        return {
            name: 'Rathod',
        };
    },

    methods: {

        async updateSettings(formData){
            /* let fd = new FormData();
            fd.append('key', 'brand');
            fd.append('val', 'Royce Automation'); */

            axios.post('/api/data/save', formData).then(res => {
                console.log(res);
            });

            /* const options = {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: jsonStringify(formData)
            };

            fetch('/api/data/save', options)
            .then(res => {
                let a = res.json();
                console.log(a);
            }); */
        },

        update(event,key){
            let formData = new FormData();
            formData.append('key', key);
            formData.append('val', event.target.value);
            this.updateSettings(formData);
        },

        updateFile(event,key){
            let formData = new FormData();
            formData.append('key', key);
            formData.append('val', event.target.files[0]);
            this.updateSettings(formData);
        }

    },

    created() {
    },
}
</script>

<template>
    <div class="container">

        <div class="m-15 shadow-4 rounded-8 p-15">

            <div v-for="val, key in settings" :key="key" class="mb-10">
                <div class="mb-5 capitalize">{{ key }} - {{ fields[key] }}</div>


                <input v-if="fields[key] == 'text'" type="text" :value="val" @change="update($event, key)" class="d-block w-100 p-4">

                <input v-if="fields[key] == 'email'" type="email" :value="val" @change="update($event, key)" class="d-block w-100 p-4">

                <textarea v-if="fields[key] == 'textarea'" :value="val" @change="update($event, key)" rows="6" class="d-block w-100 p-4"></textarea>

                <input v-if="fields[key] == 'color'" type="text" :value="val" @change="update($event, key)" class="d-block w-100 p-4" :style="{'backgroundColor': val}">

                <input v-if="fields[key] == 'file'" type="file" @change="updateFile($event, key)" class="d-block w-100 p-4">
                
            </div>

        </div>

    </div>
</template>