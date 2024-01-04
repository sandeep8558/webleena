<template>

    <div v-if="container.element == 'div'" class="elmGrid position-relative" :class="[ classes, ((login && selecteditem.id == container.id) ? dangerBorder : (login) ? lightBorder : noBorder)]">
        
        <button v-if="login && (selecteditem.id != container.id)" @click="emitClick()" class="grid-select-btn" :class="[]"><i class="bi bi-bounding-box"></i></button>
        
        <button v-if="login && (selecteditem.id == container.id)" @click="dselectItem()" class="grid-select-btn"><i class="bi bi-x-lg"></i></button>

        <appgrid @clicked="setAppGridProps($event)" v-for="child in children" :key="child" :cont="child" :login="login" :selecteditem="{ id: this.selecteditem.id, classes: this.selecteditem.classes }"></appgrid>

    </div>

    <p v-if="container.element == 'p'" :contenteditable="login ? true : false" class="elmGrid position-relative" :class="[ classes, ((login && selecteditem.id == container.id) ? dangerBorder : (login) ? lightBorder : noBorder)]">
        
        <button v-if="login && (selecteditem.id != container.id)" @click="emitClick()" class="grid-select-btn" :class="[]"><i class="bi bi-bounding-box"></i></button>
        
        <button v-if="login && (selecteditem.id == container.id)" @click="dselectItem()" class="grid-select-btn"><i class="bi bi-x-lg"></i></button>

        <appgrid @clicked="setAppGridProps($event)" v-for="child in children" :key="child" :cont="child" :login="login" :selecteditem="{ id: this.selecteditem.id, classes: this.selecteditem.classes }"></appgrid>

        Praise the Lord

    </p>

    <!-- <navbar @click="emitClick()" v-if="container.element == 'navbar'">I am NAVBAR</navbar> -->

</template>

<script>
import Navbar from './Elements/Navbar.vue';
export default {

    name: 'appgrid',

    components: {
        'navbar': Navbar,
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

        setAppGridProps(e){
            this.$emit('clicked', {classes: e.classes, id: e.id});
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

        emitClick(){
            this.$emit('clicked', {classes: this.classes, id: this.id});
        },

        init(){
            this.container = this.cont;
            this.id = this.container.id;
            this.classes = this.container.classes;

            this.getChildren();

        },

    },

    created: function(){
        this.init();
    },

}
</script>