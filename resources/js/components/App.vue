<template>
    <div class="wrapper">

    <!-- /#sidebar-wrapper -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <h3>Dashboard</h3>
        </div>
        <div class="user">
            <div class="user-userpic">
                <img src="img/avatar.png" class="img-responsive" alt="">
                <div class="user-usertitle-name"> {{ name }} </div>
            </div>
        </div>
        <ul class="list-unstyled">
          <li :class="{ 'active': title === 'Create New Customer' }">
              <router-link to="/customers/create"><i class="fa fa-plus"></i> Add New Customer</router-link>
          </li>
          <li :class="{ 'active': title === 'List of Customers' }">
              <router-link to="/customers"><i class="fa fa-list"></i> All Customers</router-link>
          </li>
          <li>
              <router-link to="/logout"><i class="fa fa-sign-out"></i> Logout</router-link>
          </li>
      </ul>
    </nav>

    <!-- Page Content -->
    <div id="page-content-wrapper">
      <nav class="navbar navbar-light bg-light mt-4 border-bottom border-secondary">
        <div class="navbar-brand">{{ title }}</div>
        <Search :isVisible="searchVisible" />
      </nav>

      <div class="container-fluid pt-4">
        <router-view :user="user" ></router-view>
      </div>
    </div>
    <!-- /#page-content-wrapper -->

  </div>
</template>

<script>
import Search from '../components/Search';

export default {
    name: "App",

    components: { Search },

    props: ['user'],

    created() {

      this.title = this.$route.meta.title;
      this.name = this.user.name;
      this.searchVisible = this.$route.meta.searchVisible;

        window.axios.interceptors.request.use(
            (config) => {
                if (config.method === "get") {
                    config.url = config.url + '?api_token=' + this.user.api_token;
                }
                else {
                    config.data = {
                        ...config.data,
                        api_token: this.user.api_token
                    };
                }

                return config;
            }
        )
    },

    data: function () {
        return {
            title: '',
            name: '',
            searchVisible: null,
        }
    },

    watch: {
        $route(to, from) {
            this.title = to.meta.title;
            this.name = this.user.name;
            this.searchVisible = to.meta.searchVisible;
        },

        title() {
            document.title = this.title + ' | i-Customer App'
        }
    }
}
</script>