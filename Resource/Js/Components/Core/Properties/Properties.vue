<template>
    <div>
        <padding @classChange="setEventValue($event)" :str="str" class="mb-3"></padding>
        <margin @classChange="setEventValue($event)" :str="str" class="mb-3"></margin>
        <shadow @classChange="setEventValue($event)" :str="str" class=""></shadow>
    </div>
</template>

<script>

import Padding from './src/Padding.vue';
import Margin from './src/Margin.vue';
import Shadow from './src/Shadow.vue';

export default {

    components: {
        'padding': Padding,
        'margin': Margin,
        'shadow': Shadow,
    },

    props: [
        'str',
    ],

    computed: {
        receivedStr(){
            return this.str;
        },
    },

    data: function(){
        return {
            reg: [
                {
                    prop: 'Padding',
                    arr: [],
                },
                {
                    prop: 'Margin',
                    arr: [],
                },
                {
                    prop: 'Shadow',
                    arr: [],
                },
            ],
            screens: ['xs', 'sm', 'md', 'lg', 'xl', 'xxl'],
            classString: this.receivedStr,
            classArray: [],
        };
    },

    methods: {
        emitChange(){
            this.$emit('classChange', this.classString);
        },

        mergeClasses(){
            let a = [];
            this.reg.forEach((re,ind) => {
                re.arr.forEach(ar => {
                    a.push(ar);
                });
            });
            this.classString = a.join(' ')
            this.emitChange();
        },

        setEventValue(e){
            this.reg.forEach((re, ind) => {
                if(re.prop === e.prop){
                    this.reg[ind].arr = e.arr;
                }
            });

            this.mergeClasses();
        },

       
    },

    created: function(){
        this.mergeClasses();
    },

}
</script>