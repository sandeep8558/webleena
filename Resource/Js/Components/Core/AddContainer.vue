<template>
    <div v-if="login" :class="login ? 'container text-center p-3' : 'd-none'">
        <button @click="addContainer()" class="btn btn-primary">Add Container</button>
    </div>
</template>

<script>
import axios from 'axios';
export default {

    props: ['login', 'page_id', 'file'],

    data: function(){
        return {
            isEdit: false,
            isFull: false,
        };
    },

    methods: {
        async addContainer(){
            let fd = new FormData();
            fd.append('file', this.file);
            fd.append('page_id', this.page_id);
            fd.append('container_classes', 'p-5 mb-5');
            fd.append('row_classes', 'p-5');
            fd.append('full', 'container');
            let res = await axios.post('/api/data/insert', fd).then(res => res.data);
            this.addedEmit();
        },
        addedEmit(){
            this.$emit('added', 'Container Added');
        }
    },

    created: function(){
        //console.log(this.file);
    },

}
</script>