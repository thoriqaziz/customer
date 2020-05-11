import Vue from 'vue';
import VueRouter from 'vue-router';
import ExampleComponent from "./components/ExampleComponent";
import CustomersIndex from "./views/CustomersIndex";
import CustomersCreate from "./views/CustomersCreate";
import CustomersDetail from "./views/CustomersDetail";
import CustomersEdit from "./views/CustomersEdit";
import Logout from "./components/Logout";

Vue.use(VueRouter);

export default new VueRouter({
    routes: [
        { 
            path: '/', component: ExampleComponent,
            meta: { title: 'Welcome', searchVisible: false }
        },
        { 
            path: '/customers', component: CustomersIndex,
            meta: { title: 'List of Customers', searchVisible: true }
        },
        { 
            path: '/customers/create', component: CustomersCreate,
            meta: { title: 'Create New Customer', searchVisible: false }
        },
        { 
            path: '/customers/:id', component: CustomersDetail,
            meta: { title: 'Details Customers', searchVisible: false }
        },
        { 
            path: '/customers/:id/edit', component: CustomersEdit,
            meta: { title: 'Edit Customers', searchVisible: false }
        },
        { 
            path: '/logout', component: Logout,
        }
    ],
    mode: 'history'
});