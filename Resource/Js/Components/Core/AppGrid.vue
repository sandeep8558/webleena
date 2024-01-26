<template>

    <div v-if="container.element == 'div'" class="elmGrid position-relative" :class="[ classes, ((login && selecteditem.id == container.id) ? dangerBorder : (login) ? lightBorder : noBorder)]">
        <button v-if="login && (selecteditem.id != container.id)" @click="emitClick()" class="grid-select-btn" :class="[]"><i class="bi bi-bounding-box"></i></button>
        <button v-if="login && (selecteditem.id == container.id)" @click="dselectItem()" class="grid-select-btn"><i class="bi bi-x-lg"></i></button>
        <appgrid @clicked="setAppGridProps($event)" @handleClicked="handleClicked($event)" v-for="child in children" :key="child" :cont="child" :login="login" :selecteditem="{ id: this.selecteditem.id, classes: this.selecteditem.classes }"></appgrid>
    </div>

    <div v-if="container.element != 'div'" class="elmGrid position-relative" :class="[ classes, ((login && selecteditem.id == container.id) ? dangerBorder : (login) ? lightBorder : noBorder)]">
        <button v-if="login && (selecteditem.id != container.id)" @click="emitClick()" class="grid-select-btn" :class="[]"><i class="bi bi-bounding-box"></i></button>
        <button v-if="login && (selecteditem.id == container.id)" @click="dselectItem()" class="grid-select-btn"><i class="bi bi-x-lg"></i></button>

        <template v-if="container.element == 'Header1'">
            <header1 v-for="fld, ind in fields" :key="fld" v-bind="fields[ind]"></header1>
        </template>

        <template v-if="container.element == 'Header2'">
            <header2 v-for="fld, ind in fields" :key="fld" v-bind="fields[ind]"></header2>
        </template>

        <template v-if="container.element == 'Header3'">
            <header3 v-for="fld, ind in fields" :key="fld" v-bind="fields[ind]"></header3>
        </template>

        <template v-if="container.element == 'Header4'">
            <header4 v-for="fld, ind in fields" :key="fld" v-bind="fields[ind]"></header4>
        </template>

        <template v-if="container.element == 'Header5'">
            <header5 v-for="fld, ind in fields" :key="fld" v-bind="fields[ind]"></header5>
        </template>

        <template v-if="container.element == 'Header6'">
            <header6 v-for="fld, ind in fields" :key="fld" v-bind="fields[ind]"></header6>
        </template>

        <template v-if="container.element == 'Paragraph'">
            <paragraph v-for="fld, ind in fields" :key="fld" v-bind="fields[ind]"></paragraph>
        </template>

        <template v-if="container.element == 'Image'">
            <wl_image v-for="fld, ind in fields" :key="fld" v-bind="fields[ind]"></wl_image>
        </template>

        <template v-if="container.element == 'Button'">
            <wl_button v-for="fld, ind in fields" :key="fld" v-bind="fields[ind]"></wl_button>
        </template>

    </div>

</template>

<script>
import axios from 'axios';
import Header1 from './Elements/Header1.vue';
import Header2 from './Elements/Header2.vue';
import Header3 from './Elements/Header3.vue';
import Header4 from './Elements/Header4.vue';
import Header5 from './Elements/Header5.vue';
import Header6 from './Elements/Header6.vue';
import Paragraph from './Elements/Paragraph.vue';
import WLImage from './Elements/WLImage.vue';
import Button from './Elements/Button.vue';

export default {

    name: 'appgrid',

    components: {
        'header1': Header1,
        'header2': Header2,
        'header3': Header3,
        'header4': Header4,
        'header5': Header5,
        'header6': Header6,
        'paragraph': Paragraph,
        'wl_image': WLImage,
        'wl_button': Button,
    },

    props: ['cont', 'login', 'selecteditem'],

    data: function(){
        return {
            container: null,
            isEdit: true,
            id: null,
            classes: '',
            noBorder: 'border-0',
            lightBorder: 'border-dasshed-gray',
            dangerBorder: 'border-dasshed-red',
            children: [],
            fields: null,
        };
    },


    watch: {
        selecteditem: function(newVal, oldVal){
            if(this.id == newVal.id){
                this.classes = newVal.classes;
            }
        },
        cont: function(nv, ov){
            this.init();
        },
    },

    methods: {

        async getFields(){
            if(this.container.element != 'div'){
                let url = '/api/fetch/rows?file=' + this.container.element + '&dir=../Elements&key='+this.container.key+'&val='+this.container.val;
                let res = await axios.get(url).then(res => res.data);
                this.fields = res;
            }
        },

        getChildren(){
            this.children = this.container.children;
        },

        emitClassChange(){
            this.$emit('classChanged', this.classes);
        },

        dselectItem(){
            this.$emit('clicked', {classes: '', id: null});
        },

        setAppGridProps(e){
            this.$emit('clicked', {classes: e.classes, id: e.id});
        },

        handleClicked(e){
            this.$emit('handleClicked', e);
        },

        emitClick(){
            this.$emit('handleClicked', this.container);
            this.$emit('clicked', {classes: this.classes, id: this.id});
        },

        init(){
            this.container = this.cont;
            this.id = this.container.id;
            this.classes = this.container.classes;
            this.getFields();
            this.getChildren();
        },

    },

    created: function(){
        this.init();
    },

}
</script>