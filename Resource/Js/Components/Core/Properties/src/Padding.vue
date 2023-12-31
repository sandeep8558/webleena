<template>
    <div class="row">
        
        <div class="col-auto"> <span class="d-inline-block" style="width: 200px;">{{ propName }}</span></div>
        
        <div class="col pe-4">

            <div class="row">

                <div v-for="item in items" :key="item.name" class="col-auto px-1">
                    <div class="input-group input-group-sm">
                        <label class="input-group-text" for="inputGroupSelect01" style="min-width: 40px;">{{ item.name }}</label>
                        <select class="form-select" id="inputGroupSelect01" @change="emitClasses()" v-model="item.value" style="max-width: 100px;">
                            <option value="">NA</option>
                            <option v-for="val in item.values" :key="val" :value="val">{{ val }}</option>
                        </select>
                    </div>
                </div>

            </div>

        </div>

    </div>
</template>

<script>

export default {

    props: [
        'str'
    ],

    data: function(){
        return {
            propName: "Padding",
            classes: [],
            items: [
                {
                    name: 'P',
                    value: '',
                    values: ['p-0','p-1','p-2','p-3','p-4','p-5','p-auto']
                },
                {
                    name: 'PX',
                    value: '',
                    values: ['px-0','px-1','px-2','px-3','px-4','px-5','px-auto']
                },
                {
                    name: 'PY',
                    value: '',
                    values: ['py-0','py-1','py-2','py-3','py-4','py-5','py-auto']
                },
                {
                    name: 'PT',
                    value: '',
                    values: ['pt-0','pt-1','pt-2','pt-3','pt-4','pt-5','pt-auto']
                },
                {
                    name: 'PB',
                    value: '',
                    values: ['pb-0','pb-1','pb-2','pb-3','pb-4','pb-5','pb-auto']
                },
                {
                    name: 'PS',
                    value: '',
                    values: ['ps-0','ps-1','ps-2','ps-3','ps-4','ps-5','ps-auto']
                },
                {
                    name: 'PE',
                    value: '',
                    values: ['pe-0','pe-1','pe-2','pe-3','pe-4','pe-5','pe-auto']
                }
            ],
        };
    },

    methods: {

        setClasses(){

            this.resetValues();
            
            this.classes = this.str.split(" ");

            this.items.forEach(item => {
                this.classes.forEach(cl => {
                    if(item.values.includes(cl)){
                        item.value = cl;
                    }
                });
            });
            this.emitClasses();
        },

        resetValues(){
            this.items.forEach(item => {
                item.value = '';
            });
        },

        emitClasses(){
            let cls = [];
            this.items.forEach(item => {
                if(item.value != ""){
                    cls.push(item.value);
                }
            });
            let o = {
                prop: this.propName,
                arr: cls
            };
            this.$emit('classChange', o);
        },

    },

    watch: {
        str: function(o, n){
            this.setClasses();
        },
    },

    created: function(){
        this.setClasses();
    },
}
</script>