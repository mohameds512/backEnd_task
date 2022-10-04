import './bootstrap';
import { createApp } from 'vue';
import App from './vue/app.vue';
import router from './router/index'

import Swal from 'sweetalert2/dist/sweetalert2.js';
import 'sweetalert2/dist/sweetalert2.css'

window.Swal = Swal;
    const toast = Swal.mixin({
        toast:true,
        position:'top-end',
        showConfirmButton:false,
        timer:3000,
        timerProgressBar:true,
    });
window.toast = toast;

/* import the fontawesome core */
import { library } from '@fortawesome/fontawesome-svg-core'

/* import font awesome icon component */
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

/* import specific icons */
import { faEdit, faTrash, faCircleXmark } from '@fortawesome/free-solid-svg-icons'

/* add icons to the library */
library.add(faEdit, faTrash,faCircleXmark)

const app = createApp(App);
app.use(router);

app.component('font-awesome-icon', FontAwesomeIcon);
app.mount('#app');
