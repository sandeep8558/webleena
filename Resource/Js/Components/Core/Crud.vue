<template>
    <div class="">
        
        <!-- Header Part -->
        <div class="row align-items-center mx-0 py-4 shadow mb-5">
            <div class="col px-5 text-capitalize"><h4>{{ pageTitle }}</h4></div>
            <div v-if="typ == 'recursive'" class="col-auto px-5 text-end">
                <button @click="isForm = !isForm" class="btn" :class="btnClass">{{ btnText }}</button>
            </div>
        </div>

        <!-- Form -->
        <div v-if="isForm" class="container-fluid px-5 mb-5">
            <div class="shadow py-5 px-4 row m-0 rounded-3">
                
                <template v-for="fld in fields" :key="fld.name">
                    <div v-if="fld.form == 'Yes'" class="col-12 mb-4">
                        <formelement @change="updateValue(fld.name, frm[fld.name])" :type="fld.type" :label="fld.text" :key="fld.name" v-model="frm[fld.name]"></formelement>
                    </div>
                </template>

                <div v-if="typ == 'recursive'" class="col-12">
                    <button @click="save()" class="btn" :class="btnClass" :disabled="invalid">Save</button>
                </div>
                
            </div>
        </div>

        <!-- Data Table -->
        <div v-if="typ == 'recursive'" class="container-fluid px-5">
            <div class="table-responsive">
                <table class="table">
                    <thead :class="tableClass">
                        <tr>
                            <th style="width: 60px; min-width: 60px;" class="text-center p-3">ID</th>
                            
                            <template v-for="val, fld in fields" :key="fld">
                                <th v-if="val.grid == 'Yes'" class="capitalize text-nowrap p-3">{{ val.text }}</th>
                            </template>

                            <th class="text-center p-3" style="width: 125px; min-width: 125px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="row in rows" :key="row.id">
                            <td style="width: 60px; min-width: 60px;" class="text-center">{{ row.id }}</td>
                            
                            <template v-for="val in fields" :key="val.id">
                                <td v-if="val.grid == 'Yes'">
                                    <img v-if="valueType(val.name) == 'image'" style="width:50px;" :src="row[val.name]" />
                                    <span v-if="valueType(val.name) != 'image'">{{ row[val.name] }}</span>
                                </td>
                            </template>

                            <td class="text-center" style="width: 125px; min-width: 125px;">
                                <button @click="editRow(row)" class="btn btn-sm btn-warning"><i class="bi bi-pen"></i></button>
                                <button @click="deleteRow(row.id)" class="btn btn-sm btn-danger ms-2"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</template>

<script>
import axios from 'axios';
import FormElement from './FormElement.vue';
export default {

    props: ['file', 'title', 'btn', 'color'],

    components: {
        'formelement': FormElement,
    },

    data: function () {
        return {
            tableClass : '',
            btnClass: '',
            isForm: true,
            pageTitle: this.file + ' Manager',
            btnText: 'Add',
            rows: [],
            fields: [],
            frm: {
                id: null
            },
            typ: null,
        };
    },

    computed: {
        invalid(){
            let is = true;
            let a = [];
            for(let p in this.frm){
                if(p != 'id'){
                    if(this.frm[p] != null && this.frm[p] != '' && this.frm[p] != undefined){
                        a.push(true);
                    } else {
                        a.push(false);
                    }
                }
            }
            is = a.includes(false);
            return is;
        },
    },

    methods: {

        valueType(key){
            let typ = null;
            this.fields.forEach(f => {
                if(f['name'] == key){
                    typ = f['type'];
                }
            });
            return typ;
        },

        async getType(){
            let url = '/api/data/type?file=' + this.file;
            let typ = await axios.get(url).then(res => res.data);
            this.typ = typ;
        },

        async getFields(){
            let url = '/api/data/fields?file=' + this.file;
            let fields = await axios.get(url).then(res => res.data);
            this.fields = fields;
            this.resetFields();
        },

        async resetFields(){
            this.frm.id = null;
            for(let fld in this.fields){
                if(this.fields[fld].form == 'Yes'){
                    let p = this.fields[fld].name;
                    this.frm[p] = '';
                }
            }
        },

        async getData(){
            let url = '/api/data/all?file=' + this.file;
            let data = await axios.get(url).then(res => res.data);
            this.rows = data;
        },

        async save(){
                
            let frm = new FormData();
            frm.append('file', this.file);
            for(let fld in this.frm){
                frm.append(fld, this.frm[fld]);
            }

            if(this.frm.id == null){
                await this.insertRow(frm);
            } else {
                await this.updateRow(frm);
            }
            
            this.resetFields();

        },

        editRow(row){
            this.isForm = true;
            this.frm.id = row.id;

            for(let fld in this.fields){
                if(this.fields[fld].form == 'Yes'){
                    let key = this.fields[fld]['name'];
                    this.frm[key] = row[key];
                }
            }

        },

        async deleteRow(id){
            let conf = confirm("Do you really want to delete this row?");
            if(conf){
                let frm = new FormData();
                frm.append('file', this.file);
                frm.append('id', id);
                let data = await axios.post('/api/data/delete', frm).then(res => res.data);
                this.rows = data;
            }
        },

        async insertRow(frm){
            console.log(frm);
            let data = await axios.post('/api/data/insert', frm).then(res => res.data);
            this.rows = data;
            
        },

        async updateRow(frm){
            let data = await axios.post('/api/data/update', frm).then(res => res.data);
            this.rows = data;
        },

        updateValue(key, val){
            if(this.typ == 'static'){
                let formData = new FormData();
                formData.append('file', this.file);
                formData.append('key', key);
                formData.append('val', val);
                this.updateSettings(formData);
            }
        },

        async updateSettings(formData){
            let res = await axios.post('/api/data/save', formData).then(res => res);
        },

        async init(){
            await this.getType();
            await this.getFields();
            await this.getData();

            if(this.typ == 'static'){
                for(let row in this.rows){
                    this.frm[row] = this.rows[row];
                }
            }

            this.pageTitle = this.title == undefined ? this.file + ' Manager' : this.title;
            this.btnText = this.btn == undefined ? ' Add' : this.btn;
            this.tableClass = this.color == undefined ? ' table-primary' : 'table-'+this.color;
            this.btnClass = this.color == undefined ? ' btn-primary' : 'btn-'+this.color;
        },

    },

    created: function (){
        this.init();
    },

}
</script>

<!--
## arguments
file | title | btn
 -->