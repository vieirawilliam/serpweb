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
            <b-breadcrumb-item active href="#foo">Cadastro de Parâmetros</b-breadcrumb-item>
            <!--<b-breadcrumb-item href="/dashboard">Bar</b-breadcrumb-item>-->
            <!--<b-breadcrumb-item active>Baz</b-breadcrumb-item>-->
          </b-breadcrumb>
        </div>
      </div>
    </div>
    <div class="content">
      <div class="row">
        <div class="col-md-6 d-flex align-items-stretch grid-margin mx-auto">
          <div class="card">
            <div class="card-header">
              <h5 class="title">{{titulo}} parâmetros</h5>
            </div>
            <div class="card-body">
              <form class="forms-sample" @submit.prevent="gravar">
                <b-tabs content-class="mt-3">
                  <b-tab title="Parâmetros do Sistemas" active>
                    <div class="row">
                      <div class="col-md-12  align-items-stretch grid-margin mx-auto">
                        <b-card-group deck>
                          <b-card header="Sequencias" class="text-center">
                            <b-form-group label="Cliente:" label-for="pxcliente" label-align-sm="left">
                              <b-form-input type="text" maxlength="10" placeholder="Proximo número do cliente" v-model="dados.pxcliente" :class="{'is-invalid' : errors.pxcliente}"></b-form-input>
                              <div class="invalid-feedback" v-show="errors.pxcliente">{{ errors.pxcliente }}</div>
                            </b-form-group>
                            <b-form-group label="Venda:" label-for="nome" label-align-sm="left">
                              <b-form-input type="text" maxlength="10" placeholder="Proximo número do Venda" v-model="dados.pxvenda" :class="{'is-invalid' : errors.pxvenda}"></b-form-input>
                              <div class="invalid-feedback" v-show="errors.pxvenda">{{ errors.pxvenda }}</div>
                            </b-form-group>
                            <b-form-group label="Pedido Compra:" label-for="nome" label-align-sm="left">
                              <b-form-input type="text" maxlength="10" placeholder="Proximo número da compra" v-model="dados.pxcompra" :class="{'is-invalid' : errors.pxcompra}"></b-form-input>
                              <div class="invalid-feedback" v-show="errors.pxcompra">{{ errors.pxcompra }}</div>
                            </b-form-group>
                            <b-form-group label="Orçamento:" label-for="nome" label-align-sm="left">
                              <b-form-input type="text" maxlength="10" placeholder="Proximo número do Orçamento" v-model="dados.pxorcamento" :class="{'is-invalid' : errors.pxorcamento}"></b-form-input>
                              <div class="invalid-feedback" v-show="errors.pxorcamento">{{ errors.pxorcamento }}</div>
                            </b-form-group>
                          </b-card>
                        </b-card-group>
                      </div>

                      <div class="col-md-6">
                        <b-form-group label="Desconto Máximo" label-for="descontomaximo">
                          <money  class="form-control form-control-sm" v-model="dados.descontomaximo" v-bind="money" title="Valor Desconto máximo"></money>
                        </b-form-group>
                      </div>
                      <div class="col-md-6">
                        <b-form-group label="Abertura de Conta:" label-for="tpaberturaconta">
                          <b-form-select v-model="dados.tpaberturaconta" :options="abertconta" size="sm" :class="{'is-invalid' : errors.tpaberturaconta}" />
                          <div class="invalid-feedback" v-show="errors.tpaberturaconta">{{ errors.tpaberturaconta }}</div>
                        </b-form-group>
                      </div>
                    </div>
                    <b-form-checkbox id="estoquenegativo" v-model="dados.estoquenegativo" name="estoquenegativo" value="1"
                      unchecked-value="0">
                      Estoque negativo
                    </b-form-checkbox>
                  </b-tab>
                  <b-tab title="Parâmetros de Venda">
                    <div class="row">
                      <div class="col-md-6">
                        <b-form-group label="Pesquisa Produtos - Venda:" label-for="status">
                          <b-form-select v-model="dados.pesqprodvenda" :options="pesqprod" size="sm" :class="{'is-invalid' : errors.pesqprodvenda}" />
                          <div class="invalid-feedback" v-show="errors.pesqprodvenda">{{ errors.pesqprodvenda }}</div>
                        </b-form-group>
                      </div>
                      <div class="col-md-6">
                        <b-form-group label="Pesquisa - Venda:" label-for="status">
                          <b-form-select v-model="dados.pesqvenda" :options="pesqprod" size="sm" :class="{'is-invalid' : errors.pesqvenda}" />
                          <div class="invalid-feedback" v-show="errors.pesqprod">{{ errors.pesqprod }}</div>
                        </b-form-group>
                      </div>
                      <div class="col-md-6">
                        <b-form-group label="Condição de Pagamento:" label-for="status">
                          <b-form-select v-model="dados.codcondpag" :options="getCondpag" value-field="id" text-field="desccondpag"  size="sm" :class="{'is-invalid' : errors.codcondpag}" />
                          <div class="invalid-feedback" v-show="errors.codcondpag">{{ errors.codcondpag }}</div>
                        </b-form-group>
                      </div>
                      <div class="col-md-6">
                        <b-form-group label="Forma de Pagamento:" label-for="status">
                          <b-form-select v-model="dados.codformapag" :options="getFormapag" value-field="id" text-field="descformapag"  size="sm"  :class="{'is-invalid' : errors.codformapag}" />
                          <div class="invalid-feedback" v-show="errors.codformapag">{{ errors.codformapag }}</div>
                        </b-form-group>
                      </div>
                      <div class="col-md-6">
                        <b-form-group label="Tabela de Preço:" label-for="status">
                          <b-form-select v-model="dados.tabela" :options="tabela" size="sm" :class="{'is-invalid' : errors.tabela}" />
                          <div class="invalid-feedback" v-show="errors.tabela">{{ errors.tabela }}</div>
                        </b-form-group>
                      </div>
                      <div class="col-md-6">
                        <b-form-group label="Modelo de Impressão:" label-for="status">
                          <b-form-select v-model="dados.modeloimp" :options="modimp" size="sm" :class="{'is-invalid' : errors.modeloimp}" />
                          <div class="invalid-feedback" v-show="errors.modeloimp">{{ errors.modeloimp }}</div>
                        </b-form-group>
                      </div>
                      <div class="col-md-6">
                        <b-form-checkbox id="mudaunitario" v-model="dados.mudaunitario" name="mudaunitario" value="1"
                          unchecked-value="0">
                          Muda unitário
                        </b-form-checkbox>
                      </div>
                      <div class="col-md-6">
                        <b-form-checkbox id="alteratabela" v-model="dados.alteratabela" name="alteratabela" value="1"
                          unchecked-value="0">
                          Altera tabela
                        </b-form-checkbox>
                      </div>
                    </div>
                  </b-tab>
                </b-tabs>
                <div class="row">
                  <div class="card-footer">
                    <b-button type="submit" variant="info" size="sm"><i class="mdi mdi-check-circle-outline"></i>Salvar
                    </b-button>
                    <b-button variant="secondary" size="sm" v-on:click="showFrmConsCadParam()">Cancelar</b-button>
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
import {Money} from 'v-money'

export default {
  name: 'FrmCadparam',
  props: ['acao', 'titulo'],
  components: {
    Money
  },
  data () {
    return {
      abertconta: [{
        text: 'MESA',
        value: 'M'
      },
      {
        text: 'COMANDA',
        value: 'C'
      }
      ],
      modimp: [{
        text: 'Bobina - 54c',
        value: 'B'
      },
      {
        text: 'Continuo',
        value: 'C'
      }
      ],
      tabela: [{
        text: '1',
        value: '1'
      },
      {
        text: '2',
        value: '2'
      },
      {
        text: '3',
        value: '3'
      },
      {
        text: '4',
        value: '4'
      },
      {
        text: '5',
        value: '5'
      }
      ],
      pesqprod: [{
        text: 'Código Interno',
        value: 'CI'
      },
      {
        text: 'Código de Barra',
        value: 'CB'
      },
      {
        text: 'Código do Fabricante',
        value: 'CF'
      },
      {
        text: 'Descrição',
        value: 'DE'
      }
      ],
      errors: {
        pxcliente: null,
        pxvenda: null,
        pxcompra: null,
        pxorcamento: null,
        tpaberturaconta: null,
        pesqprodvenda: null,
        pesqvenda: null,
        codcondpag: null,
        codformapag: null,
        tabela: null,
        modeloimp: null
      },
      items: [{
        text: '<i class=" mdi mdi-home "></i> Início',
        href: '/dashboard'
      },
      {
        text: 'Administração',
        href: ''
      },
      {
        text: 'Controle de acesso',
        href: ''
      }
      ],
      abertcont: {
        id: {
          label: 'ID',
          sortable: true
        },
        codvend: {
          label: 'Código',
          sortable: true
        },
        nomevend: {
          label: 'Nome',
          sortable: true
        },
        actions: {
          label: 'Ação',
          sortable: false
        }
      },
      dados: {
        id: '',
        pxcliente: '',
        pxvenda: '',
        pxcompra: '',
        pxorcamento: '',
        estoquenegativo: 0,
        descontomaximo: '',
        pesqprodvenda: '',
        pesqvenda: '',
        codcondpag: '',
        codformapag: '',
        mudaunitario: 0,
        tabela: '',
        alteratabela: 0,
        tpaberturaconta: '',
        modeloimp: ''
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
    this.montador()
  },
  methods: {
    montador: async function () {
      // this.$refs.usunome.focus()
      await this.carregaSelectCondpag()
      await this.carregaSelectFormapag()
      console.log('congpag' + this.getCondpag)
      let vm = this
      if (this.acao === 'editar') {
        this.$store.dispatch('cadparamModule/showParam', this.$route.params.id)
          .then(function (res) {
            vm.dados.id = res.id
            vm.dados.pxcliente = res.pxcliente
            vm.dados.pxvenda = res.pxvenda
            vm.dados.pxcompra = res.pxcompra
            vm.dados.pxorcamento = res.pxorcamento
            vm.dados.estoquenegativo = res.estoquenegativo
            vm.dados.descontomaximo = res.descontomaximo
            vm.dados.pesqprodvenda = res.pesqprodvenda
            vm.dados.pesqvenda = res.pesqvenda
            vm.dados.codcondpag = res.codcondpag
            vm.dados.codformapag = res.codformapag
            vm.dados.mudaunitario = res.mudaunitario
            vm.dados.tabela = res.tabela
            vm.dados.alteratabela = res.alteratabela
            vm.dados.tpaberturaconta = res.tpaberturaconta
            vm.dados.modeloimp = res.modeloimp
          }).catch(function (error) {
            alert('erro' + error)
          })
      }
    },
    carregaSelectCondpag: async function () {
      this.$store.dispatch('cadcondPagamentoModule/carregaSelectCondpag')
    },
    carregaSelectFormapag: async function () {
      this.$store.dispatch('cadformaPagamentoModule/carregaSelectformapag')
    },
    showFrmConsCadParam () {
      this.$router.push('/')
    },
    gravar () {
      let vm = this
      if (vm.acao === 'novo') {
        var url = 'cadparamModule/storeParam'
      } else if (vm.acao === 'editar') {
        url = 'cadparamModule/updateParam'
      }
      this.$store.dispatch(url, vm.dados)
        .then(function (res) {
          if (res.data.success) {
            vm.$router.push('/')
          } else {
            vm.errors.pxcliente = res.data.errors.pxcliente ? res.data.errors.pxcliente[0] : null
            vm.errors.pxvenda = res.data.errors.pxvenda ? res.data.errors.pxvenda[0] : null
            vm.errors.pxcompra = res.data.errors.pxcompra ? res.data.errors.pxcompra[0] : null
            vm.errors.pxorcamento = res.data.errors.pxorcamento ? res.data.errors.pxorcamento[0] : null
            vm.errors.tpaberturaconta = res.data.errors.tpaberturaconta ? res.data.errors.tpaberturaconta[0] : null
            vm.errors.pesqprodvenda = res.data.errors.pesqprodvenda ? res.data.errors.pesqprodvenda[0] : null
            vm.errors.pesqvenda = res.data.errors.pesqvenda ? res.data.errors.pesqvenda[0] : null
            vm.errors.codcondpag = res.data.errors.codcondpag ? res.data.errors.codcondpag[0] : null
            vm.errors.codformapag = res.data.errors.codformapag ? res.data.errors.codformapag[0] : null
            vm.errors.tabela = res.data.errors.tabela ? res.data.errors.tabela[0] : null
            vm.errors.modeloimp = res.data.errors.modeloimp ? res.data.errors.modeloimp[0] : null
          }
        })
        .catch(function (errors) {
          console.log(errors)
        })
    }
  },
  computed: {
    ...mapGetters({
      getCondpag: 'cadcondPagamentoModule/getCadcondpagamento',
      getFormapag: 'cadformaPagamentoModule/getCadformapagamento'
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
