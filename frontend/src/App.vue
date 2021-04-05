<template>
  <div id="app">
    <div v-if="loggedIn">
      <div class="wrapper">
        <app-header />
        <div>
          <app-sidebar />
          <div class="main-panel">
            <div class="content">
              <transition name="fade">
                <router-view></router-view>
              </transition>
            </div>
            <app-footer />
          </div>
        </div>
      </div>
    </div>
    <div v-else>
      <div class="wrapper" ref="loadingContainer">
        <div class="main-panel full-main-panel">
          <div class="content-wrapper">
            <transition name="fade">
              <router-view></router-view>
            </transition>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="js">
import AppHeader from '../src/components/partials/AppHeader'
import AppSidebar from '../src/components/partials/AppSidebar'
import AppFooter from '../src/components/partials/AppFooter'

import {
  mapGetters
} from 'vuex'

export default {
  name: 'App',
  components: {
    AppHeader,
    AppSidebar,
    AppFooter
  },
  data: function () {
    return {
      isLoading: false,
      fullPage: true
    }
  },
  computed: {
    ...mapGetters({
      load: 'loading/getStatus',
      loggedIn: 'auth/logado'
    })
  }
}

</script>

<style>

  .custom-control-inline {
    margin-right: 0;
  }

  .btn {
    font-size: 0.765rem !important;
  }

  .form-control {
    font-size: 0.765rem !important;
    height: calc(1em + 0.75rem + 2px);
    font-family: "Poppins", sans-serif;
  }

  .custom-select-sm {
    height: calc(1.5em + 0.5rem + 2px);
    padding-top: 0.25rem;
    padding-bottom: 0.25rem;
    padding-left: 0.5rem;
    font-size: 0.765rem;
  }
</style>
