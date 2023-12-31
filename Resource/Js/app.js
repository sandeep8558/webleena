import { createApp } from "../../node_modules/vue/index";

/* Alll Components Goes Here */
import ForgotPassword from './Components/Auth/ForgotPassword.vue';
import Crud from './Components/Core/Crud.vue';
import ContainerManager from './Components/Core/ContainerManager.vue';
import Settings from './Components/Admin/Settings.vue';
import Navigation from './Components/Admin/Navigation.vue';

/* Options for main vue object */
const options = {
    data: function(){
        return {
            title: "Sandy Randy"
        };
    },
    components: {
        'forgot-password': ForgotPassword,
        'crud': Crud,
        'containermanager': ContainerManager,
        'Settings': Settings,
        'navigation': Navigation
    },
};

/* Created vue object */
const vue = createApp(options);

/* Linked vue to #app ID */
const app = vue.mount('#app');


// Import our custom CSS
import '../scss/styles.scss';

// Import all of Bootstrap's JS
import * as bootstrap from 'bootstrap';