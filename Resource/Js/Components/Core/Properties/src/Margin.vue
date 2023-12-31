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
            propName: "Margin",
            classes: [],
            items: [
                {
                    name: 'M',
                    value: '',
                    values: ['m-0','m-1','m-2','m-3','m-4','m-5','m-auto']
                },
                {
                    name: 'MX',
                    value: '',
                    values: ['mx-0','mx-1','mx-2','mx-3','mx-4','mx-5','mx-auto']
                },
                {
                    name: 'MY',
                    value: '',
                    values: ['my-0','my-1','my-2','my-3','my-4','my-5','my-auto']
                },
                {
                    name: 'MT',
                    value: '',
                    values: ['mt-0','mt-1','mt-2','mt-3','mt-4','mt-5','mt-auto']
                },
                {
                    name: 'MB',
                    value: '',
                    values: ['mb-0','mb-1','mb-2','mb-3','mb-4','mb-5','mb-auto']
                },
                {
                    name: 'MS',
                    value: '',
                    values: ['ms-0','ms-1','ms-2','ms-3','ms-4','ms-5','ms-auto']
                },
                {
                    name: 'ME',
                    value: '',
                    values: ['me-0','me-1','me-2','me-3','me-4','me-5','me-auto']
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