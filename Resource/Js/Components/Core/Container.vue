<template>
<div>

    <appgrid @clicked="setAppGridProps($event)" @handleClicked="handleClicked($event)" :cont="container" :login="login" :selecteditem="{ id: id, classes: classes }"></appgrid>

    <!-- Properties Panel -->
    <div v-if="(id!=null && id!='') && login" class="container bg-light my-3 p-3 rounded-3 shadow">
        <div class="row mb-3">

            <div class="col text-start">
                
                <button class="btn btn-sm btn-primary me-2" @click="addElement('div')">
                    <i class="bi bi-plus-lg"></i>
                </button>

                <button class="me-2 btn btn-sm btn-outline-dark" :class="[tab == 'Elements' ? 'active' : '']" @click="tab = 'Elements'" title="Elements">
                    <i class="bi bi-ui-checks"></i>
                </button>

                <button class="me-2 btn btn-sm btn-outline-dark" :class="[tab == 'Layout' ? 'active' : '']" @click="tab = 'Layout'" title="Layout">
                    <i class="bi bi-columns"></i>
                </button>

                <button class="me-2 btn btn-sm btn-outline-dark" :class="[tab == 'Basic' ? 'active' : '']" @click="tab = 'Basic'" title="Basic">
                    <i class="bi bi-box-seam"></i>
                </button>

                <button class="me-2 btn btn-sm btn-outline-dark" :class="[tab == 'Complex' ? 'active' : '']" @click="tab = 'Complex'" title="Complex">
                    <i class="bi bi-boxes"></i>
                </button>

            </div>


            <div class="col-auto">
                
                <button class="me-2 btn btn-sm btn-outline-dark" :class="[tab == 'Classes' ? 'active' : '']" @click="tab = 'Classes'" title="Classes">
                    <i class="bi bi-lightning-fill"></i>
                </button>

                <button class="me-2 btn btn-sm btn-outline-dark" :class="[tab == 'UI' ? 'active' : '']" @click="tab = 'UI'" title="UI Classes">
                    <i class="bi bi-bus-front"></i>
                </button>
                
                <button class="btn btn-sm btn-danger" @click="deleteElement()">
                    <i class="bi bi-trash"></i>
                </button>

            </div>

        </div>

        <div v-if="tab == 'Elements' || tab == 'Layout' || tab == 'Basic' || tab == 'Complex'" class="">
            
            <h4 v-if="tab == 'Elements'" class="my-4">All Elements</h4>

            <h4  v-if="tab == 'Layout'" class="my-4">Layout Elements</h4>

            <h4  v-if="tab == 'Basic'" class="my-4">Basic Elements</h4>

            <h4  v-if="tab == 'Complex'" class="my-4">Complex Elements</h4>

            <div class="row m-0">

                <!-- Elements -->
                <div v-if="tab == 'Elements'" class="col-4 overflow-auto ps-0" style="max-height: 480px;">
                    <button @click="selectElement(elm)" class="btn btn-outline-primary d-block w-100 mb-2 text-start" :class="[elm.id == element.id ? 'active' : '']" v-for="elm in elements.all" :key="elm.id">{{ elm.name }}</button>
                </div>

                <div v-if="tab == 'Layout'" class="col-4 overflow-auto ps-0" style="max-height: 480px;">
                    <button @click="selectElement(elm)" class="btn btn-outline-primary d-block w-100 mb-2 text-start" :class="[elm.id == element.id ? 'active' : '']" v-for="elm in elements.layout" :key="elm.id">{{ elm.name }}</button>
                </div>

                <div  v-if="tab == 'Basic'" class="col-4 overflow-auto ps-0" style="max-height: 480px;">
                    <button @click="selectElement(elm)" class="btn btn-outline-primary d-block w-100 mb-2 text-start" :class="[elm.id == element.id ? 'active' : '']" v-for="elm in elements.basic" :key="elm.id">{{ elm.name }}</button>
                </div>

                <div v-if="tab == 'Complex'" class="col-4 overflow-auto ps-0" style="max-height: 480px;">
                    <button @click="selectElement(elm)" class="btn btn-outline-primary d-block w-100 mb-2 text-start" :class="[elm.id == element.id ? 'active' : '']" v-for="elm in elements.complex" :key="elm.id">{{ elm.name }}</button>
                </div>

                <!-- Element Preview -->
                <div class="col border border-dark border-2 rounded shadow p-4 text-center">

                    <div v-if="selectedElement != null" class="row px-5 py-3">
                        <div class="col mb-3">
                            <div class="form-floating">
                                <select @change="element.val = null" class="form-select" id="floatingSelect" aria-label="Element Key" v-model="element.key">
                                    <option selected>Select Key</option>
                                    <option value="new">New Element</option>
                                    <option value="id">ID</option>
                                    <option v-for="fld in element.fields" :key="fld" :value="fld.name">{{ fld.text }}</option>
                                </select>
                                <label for="floatingSelect">Select Key</label>
                            </div>
                        </div>
                        <div v-if="element.key != 'new'" class="col mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="floatingInput" placeholder="" v-model="element.value">
                                <label for="floatingInput">Value</label>
                            </div>
                        </div>
                        <div v-if="element.key != 'new'" class="col-12">
                            <button @click="saveExisting()" :disabled="isKeyValue" class="btn btn-primary">Save</button>
                        </div>
                    </div>

                    <!-- CRUD for Data Entry -->
                    <crud v-if="selectedElement != null && element.key == 'new'" :file="selectedElement" :dir="'Elements'" :istitle="false" :isgrid="false" @inserted="saveElement($event)"></crud>

                </div>
            </div>
        </div>

        <div v-if="tab == 'Classes'" class="">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="Enter Classes" @input="updateClass(classes)" v-model="classes">
                <label for="floatingInput">Container Clases</label>
            </div>

            <div class="row" v-for="dta in selected.data" :key="dta.id">
                <div class="col-12 mb-4" v-for="fld in selected.fields" :key="fld.name">
                    <formelement @change="updateValue(fld.name, dta[fld.name])" :type="fld.type" :label="fld.text" :key="fld.name" v-model="dta[fld.name]"></formelement>
                </div>
            </div>

            <!-- <crud v-if="selected.element != null && selected.element != 'div'" :file="selected.element" :dir="'Elements'" :istitle="false" :isgrid="false" @inserted="saveElement($event)"></crud> -->

        </div>

        <div v-if="tab == 'UI'" class="">
            Beginner Mode
        </div>

        <!-- <properties @classChange="updateClass($event)" :str="classes"></properties> -->

    </div>

</div>
</template>

<script>
import axios from 'axios';
import Properties from './Properties/Properties.vue';
import Crud from './Crud.vue';
import AppGrid from './AppGrid.vue';
import FormElement from './FormElement.vue';


export default {

    components: {
        'properties': Properties,
        'crud': Crud,
        'appgrid': AppGrid,
        'formelement': FormElement,
    },

    props: ['login', 'file', 'cont'],

    data: function(){
        return {
            container: this.cont,
            tab: 'Classes', /* Elements | Classes | UI Classes */
            classes: '',
            id: null,
            element: {
                fields: [],
                id: null,
                name: null,
                classes: null,
                key: 'new',
                value: null
            },
            elements: {
                all: [],
                layout: [],
                basic: [],
                complex: []
            },
            selected: {
                cont: null,
                fields: [],
                data: null
            },
        };
    },

    computed: {
        selectedElement: function(){
            return  this.element.name;
        },
        isKeyValue: function(){
            let is = true;
            if(this.element.key != null && this.element.value != null){
                is = false;
            }
            return is;
        },
    },

    watch: {
        cont: function(nv, ov){
            this.container = nv;
        },
    },

    methods: {

        saveElement(e){
            this.element.key = 'id';
            this.element.value = e.id;
            this.saveExisting();
        },

        saveExisting(){
            this.addElement(this.element.name, this.element.key, this.element.value);
        },

        async selectElement(elm){
            await this.resetElement();
            this.element.id = await elm.id;
            this.element.name = await elm.name;
            this.element.classes = await elm.classes;
            this.getFields(elm.name);
        },

        resetElement(){
            this.element.fields = [];
            this.element.id = null;
            this.element.name = null;
            this.element.classes = null;
            this.element.key = 'new';
            this.element.val = null;
        },

        updateValue(key, val){
            let formData = new FormData();
            formData.append('file', this.selected.cont.element);
            formData.append('dir', '../Elements');
            formData.append('id', this.selected.data[0].id);
            formData.append(key, val);
            this.updateSettings(formData);
        },

        async updateSettings(formData){
            let res = await axios.post('/api/data/update', formData).then(res => res);
            this.$emit('added', 'Added');
        },

        init(){
            this.getElements();
            this.getLayoutElements();
            this.getBasicElements();
            this.getComplexElements();
        },

        async getElements(){
            let url = '/api/data/all?file=elements';
            let res = await axios.get(url).then(res => res.data);
            this.elements.all = res;
        },

        async getLayoutElements(){
            let url = '/api/data/rows?file=elements&key=category&val=Layout';
            let res = await axios.get(url).then(res => res.data);
            this.elements.layout = res;
        },
        async getBasicElements(){
            let url = '/api/data/rows?file=elements&key=category&val=Basic';
            let res = await axios.get(url).then(res => res.data);
            this.elements.basic = res;
        },
        async getComplexElements(){
            let url = '/api/data/rows?file=elements&key=category&val=Complex';
            let res = await axios.get(url).then(res => res.data);
            this.elements.complex = res;
        },

        async getFields(file){
            let url = '/api/data/fields?file=' + file + '&dir=../Elements';
            let res = await axios.get(url).then(res => res.data);
            this.element.fields = res;
        },

        async handleClicked(e){
            this.resetSelected();
            console.log('here we have to get fields');
            if(e.element != 'div'){
                
                let uri = '/api/data/rows?file=' + e.element + '&dir=../Elements&key='+e.key+'&val='+e.val;
                let ress = await axios.get(uri).then(res => res.data);
                this.selected.data = ress;
                
                let url = '/api/data/fields?file=' + e.element + '&dir=../Elements';
                let res = await axios.get(url).then(res => res.data);
                this.selected.fields = res;

                console.log(res);
            }
            this.selected.cont = e;
        },

        resetSelected(){
            this.selected.fields = [];
            this.selected.cont = null;
            this.selected.data = null;
        },

        setAppGridProps(e){
            this.id = e.id;
            this.classes = e.classes;
        },

        async addElement(elm, key='', val=''){
            let fd = new FormData();
            fd.append('file', this.file);
            fd.append('parent', this.id);
            fd.append('element', elm);
            fd.append('classes', 'p-5');
            fd.append('key', key);
            fd.append('val', val);
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
            let conf = confirm("Are you sure to delete?");
            if(conf){
                let fd = new FormData();
                fd.append('file', this.file);
                fd.append('id', this.id);
                await axios.post('/api/data/deletewithchildren', fd).then(res => res.data);
                this.$emit('containerDeleted', 'Container Deleted');
            }
        },

    },

    created: function(){
        this.init();
    },

}
</script>