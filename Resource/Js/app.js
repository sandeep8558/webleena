import App from './Components/App.vue';
import Settings from './Components/Admin/Settings.vue';
import FormElement from './Components/Form/FormElement.vue';

const options = {
    data(){
        return {
            title: "Leena IT Solutions"
        };
    },
};

/* Created vue object */
const vue = Vue.createApp(options);

/* All Components goes here */
vue.component('App', App);
vue.component('Settings', Settings);
vue.component('form_element', FormElement);

/* Linked vue to #app ID */
const app = vue.mount('#app');