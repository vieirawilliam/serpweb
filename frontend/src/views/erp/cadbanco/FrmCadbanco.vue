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
            <b-breadcrumb-item>Cadastros</b-breadcrumb-item>
            <b-breadcrumb-item>Auxiliares</b-breadcrumb-item>
            <b-breadcrumb-item active>Banco</b-breadcrumb-item>
          </b-breadcrumb>
        </div>
      </div>
    </div>
    <div class="content">
      <div class="row">
        <div class="col-md-7 d-flex align-items-stretch grid-margin mx-auto">
          <div class="card">
            <div class="card-header">
              <h5 class="title">{{titulo}} banco</h5>
            </div>
            <div class="card-body">
              <form class="forms-sample" @submit.prevent="gravar">
                <div class="row mt-0">
                  <div class="col-md-12 mt-0">
                    <b-card-group deck>
                      <b-card header="Dados Gerais" class="text-center">
                        <div class="row mt-0">
                          <div class="col-md-6 text-left">
                            <label class="control-label">Código</label>
                            <input type="text" class="form-control" disabled="" placeholder="ID" v-model="dados.id">
                          </div>
                          <div class="col-md-6">
                            <b-form-group label="Status" label-for="status" label-align-sm="left">
                              <b-form-select v-model="dados.status" :options="status" size="sm" ref="status"
                                :class="{'is-invalid' : errors.status}" />
                              <div class="invalid-feedback" v-show="errors.status">{{ errors.status }}</div>
                            </b-form-group>
                          </div>
                        </div>
                        <div class="row mt-0">
                          <div class="col-md-12 pr-md-1">
                            <b-form-group label="Descrição" label-for="descbanco" label-align-sm="left">
                              <b-form-input type="text" placeholder="Descrição" v-model="dados.descbanco"
                                :class="{'is-invalid' : errors.descbanco}"></b-form-input>
                              <div class="invalid-feedback" v-show="errors.descbanco">{{ errors.descbanco }}</div>
                            </b-form-group>
                          </div>
                        </div>
                      </b-card>
                    </b-card-group>
                  </div>
                </div>
                <div class="row mt-0">
                  <div class="col-md-12 mt-0">
                    <b-card-group deck>
                      <b-card header="Dados do Banco" class="text-center">
                        <div class="row mt-0">
                          <div class="col-md-6">
                            <b-form-group label-cols="6" label-cols-lg="4" content-cols-lg="8" label-size="sm" label="Carteira:" label-for="input-sm">
                              <b-form-input id="input-sm" size="sm" v-model="dados.carteira"></b-form-input>
                            </b-form-group>
                          </div>
                          <div class="col-md-6">
                            <b-form-group label-cols="6" label-cols-lg="4"  content-cols-lg="8" label-size="sm" label="Variação:" label-for="input-sm">
                              <b-form-input id="input-sm" size="sm" v-model="dados.variacao"></b-form-input>
                            </b-form-group>
                          </div>
                        </div>
                        <div class="row mt-0">
                          <div class="col-md-6">
                            <b-form-group label-cols="6" label-cols-lg="4" content-cols-lg="8" label-size="sm" label="Nº do Banco:" label-for="input-sm">
                              <b-form-input id="input-sm" size="sm" v-model="dados.numbanco" :class="{'is-invalid' : errors.numbanco}"></b-form-input>
                              <div class="invalid-feedback" v-show="errors.numbanco">{{ errors.numbanco }}</div>
                            </b-form-group>
                          </div>
                          <div class="col-md-6">
                            <b-form-group label-cols="6" label-cols-lg="4"  content-cols-lg="8" label-size="sm" label="Agência:" label-for="input-sm">
                              <b-form-input id="input-sm" size="sm" v-model="dados.agencia" :class="{'is-invalid' : errors.agencia}"></b-form-input>
                              <div class="invalid-feedback" v-show="errors.agencia">{{ errors.agencia }}</div>
                            </b-form-group>
                          </div>
                        </div>
                        <div class="row mt-0">
                          <div class="col-md-6">
                            <b-form-group label-cols="6" label-cols-lg="4" content-cols-lg="8" label-size="sm" label="Nº da Conta:" label-for="input-sm">
                              <b-form-input id="input-sm" size="sm" v-model="dados.conta" :class="{'is-invalid' : errors.conta}"></b-form-input>
                              <div class="invalid-feedback" v-show="errors.conta">{{ errors.conta }}</div>
                            </b-form-group>
                          </div>
                          <div class="col-md-6">
                            <b-form-group label-cols="6" label-cols-lg="4"  content-cols-lg="8" label-size="sm" label="Nº do Boleto:" label-for="input-sm">
                              <b-form-input id="input-sm" size="sm" v-model="dados.seqboleto" :class="{'is-invalid' : errors.seqboleto}"></b-form-input>
                              <div class="invalid-feedback" v-show="errors.seqboleto">{{ errors.seqboleto }}</div>
                            </b-form-group>
                          </div>
                        </div>
                      </b-card>
                    </b-card-group>
                  </div>
                </div>
                <div class="row mt-0">
                  <div class="col-md-12 mt-0">
                    <b-card-group deck>
                      <b-card header="Dados Complementares" class="text-center">
                        <div class="row mt-0">
                          <div class="col-md-6">
                            <b-form-group label-cols="6" label-cols-lg="4" content-cols-lg="8" label-size="sm" label="Nº. Convênio:" label-for="input-sm">
                              <b-form-input id="input-sm" size="sm" v-model="dados.convenio"></b-form-input>
                            </b-form-group>
                          </div>
                          <div class="col-md-6">
                            <b-form-group label-cols="6" label-cols-lg="4"  content-cols-lg="8" label-size="sm" label="Layout:" label-for="input-sm">
                              <b-form-select v-model="dados.layout" :options="cnab" size="sm"
                                :class="{'is-invalid' : errors.layout}" />
                            </b-form-group>
                          </div>
                        </div>
                        <div class="row mt-0">
                          <div class="col-md-6">
                            <b-form-group label-cols="6" label-cols-lg="4" content-cols-lg="8" label-size="sm" label="Seq. Remessa:" label-for="input-sm">
                              <b-form-input id="input-sm" size="sm" v-model="dados.remessa" :class="{'is-invalid' : errors.remessa}"></b-form-input>
                              <div class="invalid-feedback" v-show="errors.remessa">{{ errors.remessa }}</div>
                            </b-form-group>
                          </div>
                          <div class="col-md-6">
                            <b-form-group label-cols="6" label-cols-lg="4"  content-cols-lg="8" label-size="sm" label="No. Cheque:" label-for="input-sm">
                              <b-form-input id="input-sm" size="sm" v-model="dados.numcheque"></b-form-input>
                            </b-form-group>
                          </div>
                        </div>
                      </b-card>
                    </b-card-group>
                  </div>
                </div>
                <div class="row">
                  <div class="card-footer">
                    <b-button type="submit" variant="info" size="sm"><i
                      class="mdi mdi-check-circle-outline"></i>Salvar
                    </b-button>
                    <b-button variant="secondary" size="sm" v-on:click="showFrmconscadbanco()">Cancelar
                      </b-button>
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
  name: 'FrmCadbanco',
  props: ['acao', 'titulo'],
  components: {
    Money
  },
  data () {
    return {
      id: '',
      status: [
        {
          text: 'ATIVO',
          value: 'ATIVO'
        },
        {
          text: 'INATIVO',
          value: 'INATIVO'
        }
      ],
      cnab: [
        {
          text: 'CBR454',
          value: 'CBR454'
        },
        {
          text: 'CNAB240',
          value: 'CNAB240'
        },
        {
          text: 'OUTROS',
          value: 'OUTROS'
        },
        {
          text: 'CEFSIGCB',
          value: 'CEFSIGCB'
        },
        {
          text: 'CNAB400',
          value: 'CNAB400'
        }
      ],
      errors: {
        id: null,
        codbanco: null,
        numbanco: null,
        agencia: null,
        conta: null,
        seqboleto: null,
        carteira: null,
        descbanco: null,
        convenio: null,
        remessa: null,
        variacao: null,
        layout: null,
        codcontabil: null,
        numcheque: null,
        status: null,
        datafim: null,
        debito: null,
        esptit: null,
        aceite: null,
        diasbaixa: null,
        cedente: null,
        emissao: null,
        distrib: null,
        usucod: null
      },
      dados: {
        codbanco: 0,
        numbanco: '',
        agencia: '',
        conta: '',
        seqboleto: '',
        carteira: '',
        descbanco: '',
        convenio: '',
        remessa: '',
        variacao: '',
        layout: '',
        codcontabil: '',
        numcheque: '',
        status: '',
        datafim: null,
        debito: '',
        esptit: '',
        aceite: '',
        diasbaixa: '',
        cedente: '',
        emissao: '',
        distrib: '',
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
    this.$refs.status.focus()

    if (this.acao === 'editar') {
      let vm = this
      this.$store.dispatch('cadbancoModule/showCadbanco', this.$route.params.id)
        .then(function (res) {
          vm.id = res.id
          vm.dados.id = res.id
          vm.dados.status = res.status
          vm.dados.descbanco = res.descbanco
          vm.dados.carteira = res.carteira
          vm.dados.variacao = res.variacao
          vm.dados.numbanco = res.numbanco
          vm.dados.agencia = res.agencia
          vm.dados.conta = res.conta
          vm.dados.seqboleto = res.seqboleto
          vm.dados.convenio = res.convenio
          vm.dados.layout = res.layout
          vm.dados.remessa = res.remessa
          vm.dados.numcheque = res.numcheque
        }).catch(function (error) {
          console.log('erro' + error)
        })
    }
  },
  methods: {
    showFrmconscadbanco () {
      this.$router.push('/frmconscadbanco')
    },
    gravar () {
      let vm = this
      if (vm.acao === 'novo') {
        vm.dados.usucod = this.$store.state.auth.user.user.original.id
        var url = 'cadbancoModule/storeCadbanco'
      } else if (vm.acao === 'editar') {
        url = 'cadbancoModule/updateCadbanco'
      }
      this.$store.dispatch(url, vm.dados)
        .then(function (res) {
          if (res.data.success) {
            vm.$router.push('/frmconscadbanco')
          } else {
            vm.errors.status = res.data.errors.status ? res.data.errors.status[0] : null
            vm.errors.descbanco = res.data.errors.descbanco ? res.data.errors.descbanco[0] : null
            vm.errors.carteira = res.data.errors.carteira ? res.data.errors.carteira[0] : null
            vm.errors.variacao = res.data.errors.variacao ? res.data.errors.variacao[0] : null
            vm.errors.numbanco = res.data.errors.numbanco ? res.data.errors.numbanco[0] : null
            vm.errors.agencia = res.data.errors.agencia ? res.data.errors.agencia[0] : null
            vm.errors.conta = res.data.errors.conta ? res.data.errors.conta[0] : null
            vm.errors.seqboleto = res.data.errors.seqboleto ? res.data.errors.seqboleto[0] : null
            vm.errors.convenio = res.data.errors.convenio ? res.data.errors.convenio[0] : null
            vm.errors.layout = res.data.errors.layout ? res.data.errors.layout[0] : null
            vm.errors.remessa = res.data.errors.remessa ? res.data.errors.remessa[0] : null
            vm.errors.numcheque = res.data.errors.numcheque ? res.data.errors.numcheque[0] : null
          }
        })
        .catch(function (errors) {
          console.log(errors)
        })
    }
  },
  computed: {
    ...mapGetters({})
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
