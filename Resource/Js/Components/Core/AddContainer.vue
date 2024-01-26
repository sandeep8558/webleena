<template>
    <div v-if="login" :class="login ? 'container text-center p-3' : 'd-none'">
        <button @click="addElement()" class="btn btn-primary">Add {{ file == 'header' ? 'Header' : (file == 'footer' ? 'Footer' : '') }} Element</button>
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
        async addElement(){
            let fd = new FormData();
            fd.append('file', this.file);
            fd.append('page_id', this.page_id);
            fd.append('parent', 0);
            fd.append('element', 'div');
            fd.append('classes', 'p-5');
            let res = await axios.post('/api/data/insert', fd).then(res => res.data);
            this.addedEmit();
        },
        addedEmit(){
            this.$emit('added', 'Element Added');
        }
    },

    created: function(){
    },

}
</script>