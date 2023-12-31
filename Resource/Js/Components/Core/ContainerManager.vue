<template>
    <div>
        
        <container v-for="cont in containers" @containerDeleted="contDeleted($event)" :key="cont.id" :login='login' :file="file" :cont="cont"></container>

        <addcontainer @added="added($event)" :page_id='page_id' :login='login' :file="file"></addcontainer>

    </div>
</template>

<script>
import axios from 'axios';
import AddContainer from './AddContainer.vue';
import Container from './Container.vue';
export default {

    components: {
        'addcontainer': AddContainer,
        'container': Container,
    },

    props: ['login', 'page_id', 'file'],

    data: function(){
        return {
            containers : [],
        };
    },

    methods: {
        added(e){
            this.getContainers();
        },
        contDeleted(e){
            this.getContainers();
        },
        async getContainers(){
            let res = await axios.get('/api/fetch/rows?file=' + this.file + '&key=page_id&val=' + this.page_id).then(res => res.data);
            this.containers = res;
        },
    },

    created: function(){
        this.getContainers();
    },

}
</script>