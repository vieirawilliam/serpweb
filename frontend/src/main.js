// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import store from './store'
import axios from 'axios'
import swal from 'sweetalert'

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

import money from 'v-money'

Vue.config.productionTip = false

Vue.use(BootstrapVue)
Vue.use(IconsPlugin)
Vue.use(money, {precision: 4})

let tempUrl = new URL(location.href).host.split('.')
const subDomain = tempUrl[0]
// php artisan serve --host=pet.planoonline.com.br --port=8000
const CAD_URL = 'http://' + subDomain + '.planoonline.test:8000/api/auth/'
// php artisan serve --host=pet.planoonlineauth.com.br --port=8081
const API_URL = 'http://' + subDomain + '.planoonline.test:8081/api/auth/'
// php artisan serve --host=pet.planoonlinecobranca.com.br --port=8082
const CAD_COBRANCA = 'http://' + subDomain + '.planoonlinecobranca.com.br:8082/api/'
// php artisan serve --host=pet.planoonlineauth.com.br --port=8082
const CONT_URL = 'http://' + subDomain + '.planoonline.test:8083/api/auth/'

localStorage.setItem('API_URL', API_URL)
localStorage.setItem('CAD_URL', CAD_URL)
localStorage.setItem('CAD_COBRANCA', CAD_COBRANCA)
localStorage.setItem('CONT_URL', CONT_URL)

axios.interceptors.request.use(request => {
  let token = JSON.parse(localStorage.getItem('user'))
  store.dispatch('loading/on')
  if (token) {
    request.headers.common['Authorization'] = `Bearer ${token.access_token}`
  }
  return request
})

axios.interceptors.response.use((response) => {
  store.dispatch('loading/off')
  return response
}, (error) => {
  store.dispatch('loading/off')
  const {
    status
  } = error.response

  if (status === 401) {
    store.dispatch('auth/logout')
    router.push('/')
  }
  if (status >= 500) {

  }
  return Promise.reject(error)
})

router.beforeEach((to, from, next) => {
  const publicPages = ['/login', '/']
  const authRequired = !publicPages.includes(to.path)
  const loggedIn = store.state.auth.status.loggedIn

  if (authRequired && !loggedIn) {
    store.dispatch('auth/logout')
    next('/')
  } else {
    next()
  }
  next()
})

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  store,
  swal,
  components: { App },
  template: '<App/>'
})
