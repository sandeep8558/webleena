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
            propName: "Shadow",
            classes: [],
            items: [
                {
                    name: 'SHADOW',
                    value: '',
                    values: ['shadow-sm','shadow','shadow-lg']
                },
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