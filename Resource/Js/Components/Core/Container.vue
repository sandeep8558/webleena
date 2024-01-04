<template>
<div>

    <appgrid @clicked="setAppGridProps($event)" :cont="container" :login="login" :selecteditem="{ id: id, classes: classes }"></appgrid>

    <!-- Properties Panel -->
    <div v-if="(id!=null && id!='') && login" class="container bg-light my-3 p-3 rounded-3">
        <div class="row mb-3">

            <div class="col text-start">
                <button class="btn btn-sm btn-primary me-2" @click="addElement()"><i class="bi bi-plus-lg"></i></button>
            </div>

            <div class="col-auto">
                <button class="me-2 btn btn-sm btn-dark" @click="isExpert = !isExpert">
                    <i v-if="isExpert" class="bi bi-airplane"></i>
                    <i v-if="!isExpert" class="bi bi-bus-front"></i>
                </button>
                <button class="btn btn-sm btn-danger" @click="deleteElement()">
                    <i class="bi bi-trash"></i>
                </button>
            </div>

        </div>

        <div v-if="isExpert" class="">
            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" @input="updateClass(classes)" v-model="classes">
        </div>

        <div v-if="!isExpert" class="">
            Beginner Mode
        </div>

        <!-- <properties @classChange="updateClass($event)" :str="classes"></properties> -->

    </div>

</div>
</template>

<script>
import axios from 'axios';
import Properties from './Properties/Properties.vue';

import AppGrid from './AppGrid.vue';

/* All Element Components Goes here */
import Navbar from './Elements/Navbar.vue';

export default {

    components: {
        'properties': Properties,
        'navbar': Navbar,
        'appgrid': AppGrid,
    },

    props: ['login', 'file', 'cont'],

    data: function(){
        return {
            container: this.cont,
            isExpert: true,
            classes: '',
            id: null,
        };
    },

    watch: {
        cont: function(nv, ov){
            this.container = nv;
        },
    },

    methods: {

        setAppGridProps(e){
            this.id = e.id;
            this.classes = e.classes;
        },

        async addElement(){
            let fd = new FormData();
            fd.append('file', this.file);
            fd.append('parent', this.id);
            fd.append('element', 'div');
            fd.append('classes', 'p-5');
            let res = await axios.post('/api/data/insert', fd).then(res => res.data);
            this.$emit('added', 'Element Added');
        },

        updateClass(classes){
            this.classes = classes;
            this.updateDataFile();
        },

        async updateDataFile(){
            let fd = new FormData();
            fd.append('file', this.file);
            fd.append('id', this.id);
            fd.append('classes', this.classes);
            await axios.post('/api/data/update', fd).then(res => res.data);
        },

        async deleteElement(){
            let fd = new FormData();
            fd.append('file', this.file);
            fd.append('id', this.id);
            await axios.post('/api/data/deletewithchildren', fd).then(res => res.data);
            this.$emit('containerDeleted', 'Container Deleted');
        },

    },

    created: function(){
    },

}
</script>