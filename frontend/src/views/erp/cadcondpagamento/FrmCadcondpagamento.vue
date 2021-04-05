<template>
  <div class="">
    <div class="grid-margin">
      <div class="card">
        <div class="card-body">
          <b-breadcrumb>
                <b-breadcrumb-item href="/dashboard">
                  <b-icon icon="house-fill" scale="1.25" shift-v="1.25" aria-hidden="true"></b-icon>
                  Home
                </b-breadcrumb-item>
                <b-breadcrumb-item >Cadastros</b-breadcrumb-item>
                <b-breadcrumb-item >Auxiliares</b-breadcrumb-item>
                <b-breadcrumb-item active>Condição de Pagamento</b-breadcrumb-item>
              </b-breadcrumb>
        </div>
      </div>
    </div>
    <div class="content">
      <div class="row">
        <div class="col-md-5 d-flex align-items-stretch grid-margin mx-auto">
          <div class="card">
            <div class="card-header">
              <h5 class="title">{{titulo}} condição de pagamento</h5>
            </div>
            <div class="card-body">
              <form class="forms-sample" @submit.prevent="gravar">
                <div class="row mt-0">
                  <div class="col-md-5 mt-0">
                    <div class="">
                      <label>Código</label>
                      <input type="text" class="form-control" disabled="" placeholder="ID"  v-model="dados.id">
                    </div>
                  </div>
                </div>
                <div class="row mt-0">
                  <div class="col-md-12 pr-md-1">
                      <b-form-group label="Descrição" label-for="desccondpag" label-align-sm="left">
                        <b-form-input type="text" placeholder="Descrição" v-model="dados.desccondpag" :class="{'is-invalid' : errors.desccondpag}"></b-form-input>
                        <div class="invalid-feedback" v-show="errors.desccondpag">{{ errors.desccondpag }}</div>
                      </b-form-group>
                  </div>
                </div>
                <div class="row mt-0">
                  <div class="col-md-6 pr-md-1">
                    <b-form-group label="Nº Parcelas" label-for="numeroparcelas" label-align-sm="left">
                      <b-form-input type="number" placeholder="Número de parcelas" v-model="dados.numeroparcelas" :class="{'is-invalid' : errors.numeroparcelas}"></b-form-input>
                      <div class="invalid-feedback" v-show="errors.numeroparcelas">{{ errors.numeroparcelas }}</div>
                    </b-form-group>
                  </div>
                  <div class="col-md-6 pl-md-1">
                    <b-form-group label="Prazo" label-for="prazo" label-align-sm="left">
                      <b-form-input type="number" placeholder="Prazo" v-model="dados.prazo" :class="{'is-invalid' : errors.prazo}"></b-form-input>
                      <div class="invalid-feedback" v-show="errors.prazo">{{ errors.prazo }}</div>
                    </b-form-group>
                  </div>
                </div>
                <div class="row mt-0">
                  <div class="col-md-6">
                    <b-form-group label="Tipo" label-for="tipo">
                      <b-form-select v-model="dados.tipo" :options="tipo" size="sm" :class="{'is-invalid' : errors.tipo}" />
                      <div class="invalid-feedback" v-show="errors.tipo">{{ errors.tipo }}</div>
                    </b-form-group>
                  </div>
                </div>
                <div class="row">
                  <div class="card-footer">
                    <b-button type="submit" variant="info" size="sm"><i class="mdi mdi-check-circle-outline"></i>Salvar</b-button>
                          <b-button variant="secondary" size="sm" v-on:click="showFrmconscadcondpagamento()">Cancelar</b-button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="js">
import {
  mapGetters
} from 'vuex'
import {
  Money
} from 'v-money'

export default {
  name: 'FrmCadcondpagamento',
  props: ['acao', 'titulo'],
  components: {
    Money
  },
  data () {
    return {
      tipo: [{
        text: 'RECEBIMENTO',
        value: 'RECEBIMENTO'
      },
      {
        text: 'PAGAMENTO',
        value: 'PAGAMENTO'
      },
      {
        text: 'TODOS',
        value: 'TODOS'
      }
      ],
      errors: {
        desccondpag: null,
        numeroparcelas: null,
        prazo: null,
        tipo: null
      },
      dados: {
        id: '',
        codcondpag: 0,
        desccondpag: '',
        numeroparcelas: '',
        prazo: '',
        tipo: '',
        usucod: ''
      },
      money: {
        decimal: ',',
        thousands: '.',
        prefix: 'R$ ',
        suffix: '',
        precision: 2,
        masked: false
      }
    }
  },
  mounted () {
    if (this.acao === 'editar') {
      let vm = this
      this.$store.dispatch('cadcondPagamentoModule/showCadcondpag', this.$route.params.id)
        .then(function (res) {
          vm.dados.id = res.id
          vm.dados.codcondpag = res.codcondpag
          vm.dados.desccondpag = res.desccondpag
          vm.dados.numeroparcelas = res.numeroparcelas
          vm.dados.prazo = res.prazo
          vm.dados.tipo = res.tipo
        }).catch(function (error) {
          console.log('erro' + error)
        })
    }
  },
  methods: {
    showFrmconscadcondpagamento () {
      this.$router.push('/frmconscadcondpagamento')
    },
    gravar () {
      let vm = this
      if (vm.acao === 'novo') {
        vm.dados.usucod = this.$store.state.auth.user.user.original.id
        var url = 'cadcondPagamentoModule/storeCadcondpag'
      } else if (vm.acao === 'editar') {
        url = 'cadcondPagamentoModule/updateCadcondpag'
      }
      this.$store.dispatch(url, vm.dados)
        .then(function (res) {
          if (res.data.success) {
            vm.$router.push('/frmconscadcondpagamento')
          } else {
            vm.errors.desccondpag = res.data.errors.desccondpag ? res.data.errors.desccondpag[0] : null
            vm.errors.numeroparcelas = res.data.errors.numeroparcelas ? res.data.errors.numeroparcelas[0] : null
            vm.errors.prazo = res.data.errors.prazo ? res.data.errors.prazo[0] : null
            vm.errors.tipo = res.data.errors.tipo ? res.data.errors.tipo[0] : null
          }
        })
        .catch(function (errors) {
          console.log(errors)
        })
    }
  },
  computed: {
    ...mapGetters({
    })
  }
}

</script>

<style scoped>
  .fade-enter-active,
  .fade-leave-active {
    transition: opacity .5s;
  }

  .fade-enter,
  .fade-leave-to {
    opacity: 0;
  }

</style>
