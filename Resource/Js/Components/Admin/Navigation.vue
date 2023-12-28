<template>
    <div class="container shadow-4 m-15 px-15 pt-15 pb-10 rounded-8">

        <div id="nested-sort-wrap"></div>

        <h2 class="mb-15">Navigation Manager</h2>

        <!-- <div class="mb-15">
            Draggable ITEM: {{ draggedItem ? draggedItem.name : 'Not Selected' }}
        </div>

        <div class="mb-15">
            Origin: {{ origin ? origin : 'Not Selected' }}
        </div> -->

        <div class="row mb-15">

            <div class="col w-40" @drop="drop($event, 'main')" @dragover="allowDrop($event)">
                <div v-for="page in pages" :key="page.id" class="p-10 border border-1 rounded-5 shadow-4 mb-12 pointer" draggable="true" @dragstart="dragStarted(page, 'main')">{{ page.name }}</div>
            </div>

            <div class="col w-60 pl-15 mb-15">
                <div class="border border-2 p-15" style="min-height: 480px;" @drop="drop($event, 'nav')" @dragover="allowDrop($event)">
                    <div v-for="page, ind in nav" :key="page.id" class="p-10 border border-1 rounded-5 shadow-4 mb-12 pointer navItem" draggable="true" @dragstart="dragStarted(page, 'nav', ind);" @drop="dropReplace($event, 'nav', ind)">
                        {{ page.name }}
                    </div>
                </div>
            </div>

        </div>

        <div class="mb-15">
            <input :value="navName" @input="navName = $event.target.value" type="text" class="p-5 rounded-5 w-80">
            <button v-if="id == null" class="btn btn-sm btn-primary w-20" @click="insert()">Save</button>
            <button v-if="id != null" class="btn btn-sm btn-primary w-20" @click="update()">Update</button>
        </div>

        <div class="mb-15">

            <div v-for="nav in navs" :key="nav.id" class="border broder-1 p-15">
                <h3>{{ nav.name }}</h3>
                <pre>
                    {{ JSON.parse(nav.str) }}
                </pre>
                <button @click="deleteRow(nav.id)" class="btn btn-sm btn-danger">Delete</button>
                <button @click="editRow(nav)" class="btn btn-sm btn-warning">Edit</button>
            </div>

        </div>

    </div>
  </template>
  
<script>
import axios from 'axios';
export default {

    props: ['pages'],

    data: function () {
        return {
            origin: null,
            draggedItem: null,
            draggedItemIndex: null,
            nav: [],

            id: null,
            navName: "",
            navs: [],
        };
    },

    methods: {

        dropReplace(e, origin, ind){
            this.delItem(this.draggedItemIndex);
            this.nav.splice(ind, 0, this.draggedItem);
        },

        delItem(ind){
            this.nav.splice(ind, 1);
        },

        drop(e, origin){
            if(this.origin == 'main' && origin == 'nav'){
                this.nav.push(this.draggedItem);
            }
            if(this.origin == 'nav' && origin == 'nav'){
                /* Change Order */
            }
            if(this.origin == 'nav' && origin == 'main'){
                this.delItem(this.draggedItemIndex);
            }
            e.preventDefault();
        },

        allowDrop(e) {
            e.preventDefault();
        },

        dragStarted(e, origin, ind=null){
            this.origin = origin;
            this.draggedItem = e;
            this.draggedItemIndex = ind;
        },

        async getNavs(){
            let res = await axios.get('/api/data/all?file=nav').then(res => res.data);
            this.navs = res;
        },

        async insert(){
            let fd = new FormData();
            fd.append('file', 'nav');
            fd.append('name', this.navName);
            fd.append('str', JSON.stringify(this.nav));
            let res = await axios.post('/api/data/insert', fd).then(res => res.data);
            this.navs = res;
        },

        editRow(nav){
            this.navName = nav.name;
            this.id = nav.id;
            this.nav = JSON.parse(nav.str);
        },

        async update(){
            let fd = new FormData();
            fd.append('file', 'nav');
            fd.append('name', this.navName);
            fd.append('id', this.id);
            fd.append('str', JSON.stringify(this.nav));
            let res = await axios.post('/api/data/update', fd).then(res => res.data);
            this.navs = res;
        },

        async deleteRow(id){
            let fd = new FormData();
            fd.append('file', 'nav');
            fd.append('id', id);
            let res = await axios.post('/api/data/delete', fd).then(res => res.data);
            this.navs = res;
        },

    },

    created: function(){
        this.getNavs();
    },

}
</script>