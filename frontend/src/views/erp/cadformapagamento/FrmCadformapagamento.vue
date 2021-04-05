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
                <b-breadcrumb-item active>Forma de Pagamentos</b-breadcrumb-item>
              </b-breadcrumb>
        </div>
      </div>
    </div>
    <div class="content">
      <div class="row">
        <div class="col-md-5 d-flex align-items-stretch grid-margin mx-auto">
          <div class="card">
            <div class="card-header">
              <h5 class="title">{{titulo}} forma de pagamentos</h5>
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
                      <b-form-group label="Descrição" label-for="descformapag" label-align-sm="left">
                        <b-form-input type="text" placeholder="Descrição" v-model="dados.descformapag" :class="{'is-invalid' : errors.descformapag}"></b-form-input>
                        <div class="invalid-feedback" v-show="errors.descformapag">{{ errors.descformapag }}</div>
                      </b-form-group>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                        <b-form-checkbox id="geracontasreceber" v-model="dados.geracontasreceber" name="geracontasreceber" value="1"
                          unchecked-value="0">
                          Gera contas a receber
                        </b-form-checkbox>
                      </div>
                      <div class="col-md-6">
                        <b-form-checkbox id="permitevendaprazo" v-model="dados.permitevendaprazo" name="permitevendaprazo" value="1"
                          unchecked-value="0">
                          Vendas á prazo
                        </b-form-checkbox>
                      </div>
                </div>
                <div class="row">
                  <div class="card-footer">
                    <b-button type="submit" variant="info" size="sm"><i class="mdi mdi-check-circle-outline"></i>Salvar</b-button>
                          <b-button variant="secondary" size="sm" v-on:click="showFrmconscadformapagamento()">Cancelar</b-button>
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
  name: 'FrmCadformapagamento',
  props: ['acao', 'titulo'],
  components: {
    Money
  },
  data () {
    return {
      errors: {
        desccondpag: null
      },
      dados: {
        id: '',
        codformapag: 0,
        descformapag: '',
        geracontasreceber: 0,
        permitevendaprazo: 0,
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
      this.$store.dispatch('cadformaPagamentoModule/showCadformapag', this.$route.params.id)
        .then(function (res) {
          vm.dados.id = res.id
          vm.dados.codformapag = res.codformapag
          vm.dados.descformapag = res.descformapag
          vm.dados.geracontasreceber = res.geracontasreceber
          vm.dados.permitevendaprazo = res.permitevendaprazo
        }).catch(function (error) {
          console.log('erro' + error)
        })
    }
  },
  methods: {
    showFrmconscadformapagamento () {
      this.$router.push('/frmconscadformapagamento')
    },
    gravar () {
      let vm = this
      if (vm.acao === 'novo') {
        vm.dados.usucod = this.$store.state.auth.user.user.original.id
        var url = 'cadformaPagamentoModule/storeCadformapag'
      } else if (vm.acao === 'editar') {
        url = 'cadformaPagamentoModule/updateCadformapag'
      }
      this.$store.dispatch(url, vm.dados)
        .then(function (res) {
          if (res.data.success) {
            vm.$router.push('/frmconscadformapagamento')
          } else {
            vm.errors.descformapag = res.data.errors.descformapag ? res.data.errors.descformapag[0] : null
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
