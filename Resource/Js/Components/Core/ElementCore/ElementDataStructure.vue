<template>
    <div>

        <div class="row p-5 pb-3">

            <div class="col-6">
                <div class="form-floating">
                    <input type="text" class="form-control" id="key" placeholder="" v-model="element.name">
                    <label for="key">Element Name</label>
                </div>
            </div>

            <div class="col-6">
                <div class="form-floating">
                    <select class="form-select" id="floatingSelect" v-model="element.type">
                        <option value="">Element Type</option>
                        <option value="static">Static</option>
                        <option value="recursive">Recursive</option>
                    </select>
                    <label for="floatingSelect">Element Type</label>
                </div>
            </div>

        </div>

        <div v-for="(elm, ind) in element.fields" :key="elm.name" class="row px-5">
            <div class="col-12">
                <div class="input-group mb-3">
                    
                    <input type="text" class="form-control" placeholder="Field Name" v-model="elm.name">
                    <input type="text" class="form-control" placeholder="Label Text" v-model="elm.text">
                    <input type="text" class="form-control" placeholder="Default Value" v-model="elm.value">
                    <input type="text" class="form-control" placeholder="Validation" v-model="elm.validation">

                    <select class="form-select" v-model="elm.type">
                        <option selected>Select Element Type</option>
                        <option value="text">Text</option>
                        <option value="date">Date</option>
                        <option value="time">Time</option>
                        <option value="email">Email</option>
                        <option value="password">Password</option>
                        <option value="textarea">Textarea</option>
                        <option value="color">Color</option>
                        <option value="image">Image</option>
                        <option value="file">File</option>
                        <option value="select">Select</option>
                    </select>
                    <select class="form-select" v-model="elm.grid">
                        <option selected>Is In Grid</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                    <select class="form-select" v-model="elm.form">
                        <option selected>Is in Form</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                    <button class="btn btn-outline-secondary" type="button" @click="deleteField(ind)">Delete</button>
                </div>
            </div>
        </div>

        <div class="row px-5">
            <div class="col-12">
                <div class="input-group mb-3">
                    
                    <input type="text" class="form-control" placeholder="Field Name" v-model="field.name">
                    <input type="text" class="form-control" placeholder="Label Text" v-model="field.text">
                    <input type="text" class="form-control" placeholder="Default Value" v-model="field.value">
                    <input type="text" class="form-control" placeholder="Validation" v-model="field.validation">

                    <select class="form-select" v-model="field.type">
                        <option selected>Select Element Type</option>
                        <option value="text">Text</option>
                        <option value="date">Date</option>
                        <option value="time">Time</option>
                        <option value="email">Email</option>
                        <option value="password">Password</option>
                        <option value="textarea">Textarea</option>
                        <option value="color">Color</option>
                        <option value="image">Image</option>
                        <option value="file">File</option>
                        <option value="select">Select</option>
                    </select>
                    <select class="form-select" v-model="field.grid">
                        <option selected>Is In Grid</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                    <select class="form-select" v-model="field.form">
                        <option selected>Is in Form</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                    <button class="btn btn-outline-secondary" type="button" :disabled="fieldInvalid" @click="addField()">ADD</button>
                </div>
            </div>
        </div>

        <div class="row px-5">
            <div class="col-12">
                <button class="btn btn-primary" :disabled="invalid" @click="createElement()">Create Element</button>
            </div>
        </div>

        <!-- Data Table -->
        <div class="container-fluid px-5 my-5">
            <div class="table-responsive">
                <table class="table">
                    <thead class="table-info">
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
                                    <span>{{ row[val.name] }}</span>
                                </td>
                            </template>

                            <td class="text-center" style="width: 125px; min-width: 125px;">
                                <button @click="editRow(row)" class="btn btn-sm btn-warning"><i class="bi bi-pen"></i></button>
                                <button @click="deleteRow(row)" class="btn btn-sm btn-danger ms-2"><i class="bi bi-trash"></i></button>
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
export default {

    components: {
    },

    data: function(){
        return {
            element: {
                id: null,
                name: '',
                type: 'static',
                fields: []
            },
            field: {
                name: '',
                text: '',
                type: 'text',
                value: '',
                validation: '',
                grid: 'Yes',
                form: 'Yes'
            },
            file: 'elements',
            rows: [],
            fields: [],
        };
    },

    methods: {

        createElement: async function(){
            let fd = new FormData();
            fd.append('name', this.element.name);
            fd.append('type', this.element.type);
            fd.append('fields', JSON.stringify(this.element.fields));
            let res = await axios.post('/api/element/create', fd).then(res => res.key);
            this.reset();
            this.getData();
        },

        reset(){
            this.resetField();
            this.element.id = null,
            this.element.name = '',
            this.element.type = 'static'
            this.element.fields = [];
        },

        resetField: function(){
            this.field.name = '';
            this.field.text = '';
            this.field.type = 'text';
            this.field.value = '';
            this.field.validation = '';
            this.field.grid = 'Yes';
            this.field.form = 'Yes';
        },

        addField: function(){
            let fld = {
                name: this.field.name,
                text: this.field.text,
                type: this.field.type,
                value: this.field.value,
                validation: this.field.validation,
                grid: this.field.grid,
                form: this.field.form
            };
            this.element.fields.push(fld);
            this.resetField();
        },
        
        deleteField: function(ind){
            this.element.fields.splice(ind, 1);
        },

        async getData(){
            let url = '/api/data/all?file=' + this.file;
            let data = await axios.get(url).then(res => res.data);
            this.rows = data;
        },

        async getFields(){
            let url = '/api/data/fields?file=' + this.file;
            let fields = await axios.get(url).then(res => res.data);
            this.fields = fields;
        },

        async deleteRow(row){
            let conf = confirm("Do you really want to delete this row?");
            if(conf){
                let frm = new FormData();
                frm.append('file', this.file);
                frm.append('name', row.name);
                frm.append('id', row.id);
                let data = await axios.post('/api/data/delete', frm).then(res => res.data);
                this.rows = data;
                let del = await axios.post('/api/element/delete', frm).then(res => res.data);
            }
        },

        async init (){
            await this.getFields();
            await this.getData();
        }

    },

    computed: {

        fieldInvalid: function(){
            let is = true;
            if(
                this.field.name != '' && 
                this.field.text != '' && 
                this.field.type != '' && 
                this.field.grid != '' && 
                this.field.form != ''
            ){
                is = false;
            }
            return is;
        },

        invalid: function(){
            let is = true;
            if(
                this.element.name != '' && 
                this.element.type != '' && 
                this.element.fields.length > 0
            ){
                is = false;
            }
            return is;
        },

    },

    created: function(){
        this.init();
    },

}
</script>