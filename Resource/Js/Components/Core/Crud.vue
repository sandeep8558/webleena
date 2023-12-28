<template>
    <div class="container shadow-4 m-15 p-15 rounded-8">
        
        <!-- Header Part -->
        <div class="row mb-15">
            <div class="col w-50 capitalize"><h2>{{ pageTitle }}</h2></div>
            <div class="col w-50 text-right">
                <button @click="isForm = !isForm" class="btn btn-sm" :class="btnClass">{{ btnText }}</button>
            </div>
        </div>

        <div v-if="isForm" class="mb-15 border border-1 p-15 rounded-8 shadow-4">
            
            <template v-for="val, key in fields" :key="key">
                <template v-if="val.form == 'Yes'">

                    <div v-if="val.type == 'text'" class="mb-8">
                        <label for="name">{{ val.text }}</label>
                        <input type="text" :value="frm[key]" @input="frm[key] = $event.target.value" class="d-block w-100 p-4">
                    </div>

                    <div v-if="val.type == 'textarea'" class="mb-8">
                        <label for="name">{{ val.text }}</label>
                        <textarea rows="4" :value="frm[key]" @input="frm[key] = $event.target.value" class="d-block w-100 p-4"></textarea>
                    </div>

                </template>
            </template>

            <div class="mb-8">
                <button @click="save()" class="btn btn-sm" :class="btnClass">Save</button>
            </div>

        </div>

        <div class="">
            <table class="table table-collapse" :class="tableClass">
                <thead class="">
                    <tr>
                        <th>ID</th>
                        
                        <template v-for="val, fld in fields" :key="fld">
                            <th v-if="val.grid == 'Yes'" class="capitalize">{{ val.text }}</th>
                        </template>

                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="row in data" :key="row.id">
                        <td>{{ row.id }}</td>
                        
                        <template v-for="val, fld in fields" :key="fld">
                            <td v-if="val.grid == 'Yes'">{{ row[fld] }}</td>
                        </template>

                        <td class="w-10 text-center">
                            <button @click="editRow(row)" class="btn btn-sm btn-warning px-5 py-3 mr-3">&#9998;</button>
                            <button @click="deleteRow(row.id)" class="btn btn-sm btn-danger px-5 py-3">&#128465;</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</template>

<script>
import axios from 'axios';
export default {

    props: ['file', 'title', 'btn', 'color'],

    data: function () {
        return {
            tableClass : '',
            btnClass: '',
            isForm: false,
            pageTitle: this.file + ' Manager',
            btnText: 'Add',
            data: [],
            fields: [],
            frm: {
                id: null
            },
        };
    },

    computed: {
    },

    methods: {

        init(){
            this.getFields();
            this.getData();
            this.pageTitle = this.title == undefined ? this.file + ' Manager' : this.title;
            this.btnText = this.btn == undefined ? ' Add' : this.btn;
            this.tableClass = this.color == undefined ? ' table-primary' : 'table-'+this.color;
            this.btnClass = this.color == undefined ? ' btn-primary' : 'btn-'+this.color;
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
                this.frm[fld] = '';
            }
        },

        async getData(){
            let url = '/api/data/all?file=' + this.file;
            let data = await axios.get(url).then(res => res.data);
            this.data = data;
        },

        async save(){
            if(this.validate()){
                let frm = new FormData();
                frm.append('file', this.file);
                frm.append('id', this.frm.id);
                for(let fld in this.fields){
                    frm.append(fld, this.frm[fld]);
                }
                if(this.frm.id == null){
                    await this.insertRow(frm);
                } else {
                    await this.updateRow(frm);
                }
                this.resetFields();
                this.isForm = false;
            }
        },

        validate(){
            let isValid = false;
            let is = true;
            for(let val in this.fields){
                is = is && (this.frm[val] == "" ? false : true);
            }
            return isValid = is;
        },

        editRow(row){
            this.isForm = true;
            this.frm.id = row.id;
            for(let fld in this.fields){
                this.frm[fld] = row[fld];
            }
        },

        async deleteRow(id){
            let conf = confirm("Do you really want to delete this row?");
            if(conf){
                let frm = new FormData();
                frm.append('file', this.file);
                frm.append('id', id);
                let data = await axios.post('/api/data/delete', frm).then(res => res.data);
                this.data = data;
            }
        },

        async insertRow(frm){
            let data = await axios.post('/api/data/insert', frm).then(res => res.data);
            this.data = data;
            
        },

        async updateRow(frm){
            let data = await axios.post('/api/data/update', frm).then(res => res.data);
            this.data = data;
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