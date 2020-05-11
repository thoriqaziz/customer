<template>
    <div>
        <div v-if="loading">Loading...</div>
        <div v-else>
            <div v-if="customers.length === 0">
                <p>No customers yet. <router-link to="/customers/create">Get Started</router-link></p>
            </div>

            <ul class="list-group" id="list-customer">
                <div v-for="customer in customers" :key="customer.id">
                    <router-link :to="'/customers/' + customer.customer_id" class="d-flex border-bottom border-secondary p-2 text-decoration-none">
                        <li class="list-group-item border-0">
                            <div class="row">
                                <div class="col-md-3">
                                    <UserLogo :name="customer.name" />
                                </div>
                                <div class="col-md-9">
                                    <label class="name lead m-0">{{ customer.name }}</label>
                                    <br>
                                    <span class="text-muted small text-truncate">{{ customer.email }}</span>
                                </div>
                            </div>
                        </li>
                    </router-link>
                </div>
            </ul>
            
        </div>
    </div>
</template>
<script>
import UserLogo from '../components/UserLogo';

export default {
    name: "CustomersIndex",

    components: { UserLogo },
    
    mounted() {
        axios.get('/api/customers')
            .then(response => {
                this.customers = response.data.data;

                this.loading = false;
            })
            .catch(error => {
                this.loading = false;

                alert('Unable to fetch customers.');
            })
    },

    data: function () {
        return {
            loading: true,
            customers: null,
        }
    }
}
</script>