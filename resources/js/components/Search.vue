<template>
    <div v-if="isVisible">
        <input class="form-control mr-sm-2" id="searchTerm" placeholder="Search..." v-model="searchTerm" @input="search" @focus="focus = true">

        <div v-if="focus" class="position-absolute bg-dark rounded text-white p-2">
            <div v-if="results == 0" @click="focus = false">No result found for '{{ searchTerm }}'</div>
            <div v-for="result in results" :key="result.id" @click="focus = false">
                <router-link :to="result.url" class="block py-2">
                    <div class="text-white mt-2 mb-2">
                        <p class="mb-0">{{ result.name }}</p>
                        <span class="text-white small text-truncate">{{ result.email }}</span>
                    </div>
                </router-link>
            </div>
        </div>
    </div>
</template>

<script>

import _ from 'lodash';

export default {
    name: "Search",

    props: {
        isVisible: null,
    },

    data: function () {
        return {
            searchTerm: '',
            focus: false,
            results: []
        }
    },

    methods: {
        search: _.debounce(function (e) {
            if (this.searchTerm.length < 2) {
                return;
            }

            axios.post('/api/search', {searchTerm: this.searchTerm})
                .then(response => {
                    this.results = response.data.data;
                })
                .catch(error => {
                    console.log(error.response);
                });
        }, 300)
    }
}
</script>