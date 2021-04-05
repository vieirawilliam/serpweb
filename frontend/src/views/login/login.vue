<template>

  <section class="login">
    <div class="wrapper d-flex align-items-center auth login-full-bg">
      <div class="row w-100">
        <div class="col-lg-3 mx-auto">
          <div class="text-left p-5">
            <div class="logo">
              <img src="../../assets/img/logo.png" class="rounded mx-auto d-block">
            </div>
          </div>
          <form name="form" @submit.prevent="handleLogin">

            <div class="form-group">
              <label for="exampleInputEmail1">Usuário</label>
              <input type="text" v-model="user.usunome" required class="form-control" id="exampleInputEmail1"
                aria-describedby="emailHelp" placeholder="">
              <i class="mdi mdi-account"></i>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Senha</label>
              <input type="password" v-model="user.ususenha" required class="form-control" id="exampleInputPassword1"
                placeholder="">
              <i class="mdi mdi-eye"></i>
            </div>
            <div class="form-group">
              <button class="btn btn-light btn-block rounded-pill btn-sm" :disabled="loading" type="submit">
                <span v-show="loading" class="spinner-border spinner-border-sm text-dark"></span>
                <span class="blue">Login</span>
              </button>
            </div>
            <div class="form-group">
              <div v-if="message" class="alert alert-danger" role="alert">{{message}}</div>
            </div>
            <div class="mt-5 text-center">
              <a href="#" class="auth-link text-white">Recuperar senha!</a>
            </div>
            <div class="mt-5 text-center">
              <a href="#" class="auth-link text-white">NOVO USUÁRIO SOLICITAR ACESSO</a>
            </div>
            <div class="mt-5 text-center">
              <p class="auth-link text-white size12">Copyright © 2021 Semicolon Sistemas - Todos os direitos reservados</p>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

</template>

<script>
import User from '../../models/user'
import {
  mapGetters
} from 'vuex'
export default {
  name: 'Login',
  data () {
    return {
      user: new User('', ''),
      loading: false,
      message: ''
    }
  },
  computed: {
    ...mapGetters({
      loggedIn: 'auth/logado'
    })
  },
  created () {
    if (this.loggedIn) {
      this.$router.push('/dashboard')
    }
  },
  methods: {
    handleLogin () {
      this.loading = true
      if (this.user.usunome && this.user.ususenha) {
        this.$store.dispatch('auth/login', this.user).then(
          () => {
            this.$router.push('/dashboard')
          },
          error => {
            this.loading = false
            this.message =
                (error.response && error.response.data) ||
                error.message ||
                error.toString()
          }
        )
      }
    }
  }
}

</script>

<style scoped>
  .text-white {
    color: #344675 !important
  }

  .btn-light {
    color: #e9ecef !important
  }

</style>
