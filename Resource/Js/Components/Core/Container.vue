<template>
<div class="container-fluid bg-danger mb-0" :class="contStyle">

    <div class="bg-info row mx-auto mb-0" :class="[isFull, rowStyle]" :role="login ? 'button' : ''" @click="isEdit = !isEdit">
        <div class="col p-5 bg-primary"></div>
    </div>




    <div v-if="isEdit && login" class="container bg-light my-3 p-3 rounded-3">

        <div class="mb-3 text-center">
            <button class="btn btn-sm btn-primary me-2" :class="styleToItem == 'Container' ? 'active' : ''" @click="styleTo('Container')">Container Style</button>
            <button class="btn btn-sm btn-primary me-2" :class="styleToItem == 'Row' ? 'active' : ''" @click="styleTo('Row')">Row Style</button>
            <button class="me-2 btn btn-sm btn-dark" @click="updateFull()">{{isFull == '' ? 'Standard' : 'Full'}}</button>
            <button class="me-2 btn btn-sm btn-danger" @click="deleteContainer()">Delete Container</button>
        </div>

        <properties @classChange="updateClass($event)" :str="classString"></properties>

    </div>
</div>
</template>

<script>
import axios from 'axios';
import Properties from './Properties/Properties.vue';
export default {

    components: {
        'properties': Properties,
    },

    props: ['login', 'file', 'cont'],

    data: function(){
        return {
            isEdit: false,
            isFull: this.cont.full,
            contStyle: this.cont.container_classes,
            rowStyle: this.cont.row_classes,
            classString: this.cont.container_classes,
            styleToItem:'Container',
        };
    },

    methods: {
        
        styleTo(elm){
            this.styleToItem = elm;
            if(elm == 'Container'){
                this.classString = this.contStyle;
            }
            if(elm == 'Row'){
                this.classString = this.rowStyle;
            }
        },

        updateClass(e){
            this.classString = e;
            if(this.styleToItem == 'Container'){
                this.contStyle = this.classString;
            }
            if(this.styleToItem == 'Row'){
                this.rowStyle = this.classString;
            }
            this.updateDataFile();
        },

        async updateFull(){
            if(this.isFull == ''){
                this.isFull = 'container';
            } else {
                this.isFull = '';
            }
            let fd = new FormData();
            fd.append('file', this.file);
            fd.append('id', this.cont.id);
            fd.append('full', this.isFull);
            await axios.post('/api/data/update', fd).then(res => res.data);
        },

        async updateDataFile(){
            let fd = new FormData();
            fd.append('file', this.file);
            fd.append('id', this.cont.id);
            fd.append('container_classes', this.contStyle);
            fd.append('row_classes', this.rowStyle);
            await axios.post('/api/data/update', fd).then(res => res.data);
        },

        async deleteContainer(){
            let fd = new FormData();
            fd.append('file', this.file);
            fd.append('id', this.cont.id);
            await axios.post('/api/data/delete', fd).then(res => res.data);
            this.$emit('containerDeleted', 'Container Deleted');
        }

    },

    created: function(){
        console.log(this.cont);
    },

}
</script>