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
            <b-breadcrumb-item href="#foo">Cadastro de Parâmentros</b-breadcrumb-item>
            <!--<b-breadcrumb-item href="/dashboard">Bar</b-breadcrumb-item>-->
            <!--<b-breadcrumb-item active>Baz</b-breadcrumb-item>-->
          </b-breadcrumb>
        </div>
      </div>
    </div>
    <div class="content">
      <div class="row">
        <div class="col-md-8 d-flex align-items-stretch grid-margin mx-auto">
          <div class="card">
            <div class="card-header">
              <h5 class="title">{{titulo}} Parâmentros</h5>
            </div>
            <div class="card-body">
              <form class="forms-sample" @submit.prevent="gravar">
                <b-tabs content-class="mt-3">
                  <b-tab title="Parâmetros do Sistemas" active>
                    <div class="row">
                      <div class="col-md-3">
                        <b-form-group label="Login" label-for="usunome">
                          <b-form-input type="text" ref="usunome" maxlength="40" placeholder="Login"
                            v-model="dados.usunome" :class="{'is-invalid' : errors.usunome}"></b-form-input>
                          <div class="invalid-feedback" v-show="errors.usunome">{{ errors.usunome }}</div>
                        </b-form-group>
                      </div>
                      <div class="col-md-3">
                        <b-form-group label="Senha" label-for="ususenha">
                          <b-form-input type="password" maxlength="20" placeholder="Senha" v-model="dados.ususenha"
                            :class="{'is-invalid' : errors.ususenha}"></b-form-input>
                          <div class="invalid-feedback" v-show="errors.ususenha">{{ errors.ususenha }}</div>
                        </b-form-group>
                      </div>
                      <div class="col-md-3">
                        <b-form-group label="Situação" label-for="situacao">
                          <b-form-select v-model="dados.situacao" :options="situacao" size="sm" />
                        </b-form-group>
                      </div>
                      <div class="col-md-3">
                        <b-form-group label="Perfil" label-for="status">
                          <b-form-select v-model="dados.status" :options="status" size="sm" />
                        </b-form-group>
                      </div>
                    </div>
                    <b-form-group label="Nome" label-for="nome">
                      <b-form-input type="text" maxlength="80" placeholder="Nome" v-model="dados.nome"
                        :class="{'is-invalid' : errors.nome}"></b-form-input>
                      <div class="invalid-feedback" v-show="errors.nome">{{ errors.nome }}</div>
                    </b-form-group>
                    <div class="row">
                      <div class="col-md-7">
                        <b-form-group label="Email" label-for="email">
                          <b-form-input type="email" @change="retornaFotoGravatar()" placeholder="Email"
                            v-model="dados.email"></b-form-input>
                          <div class="invalid-feedback" v-show="errors.email">{{ errors.email }}</div>
                        </b-form-group>
                      </div>
                      <div v-if="dados.email" class="col-md-3">
                        <b-form-group label="Foto" label-for="foto">
                          <b-avatar variant="info" :src="fotoperfil"></b-avatar>
                          <a target="_blank" title="Alterar sua foto no Gravatar" href="https://br.gravatar.com/"
                            class="btn btn-outline-success btn-sm">Alterar foto</a>
                        </b-form-group>
                      </div>
                    </div>
                    <b-form-group label="Filial" label-for="codfilial">
                      <b-form-select v-model="dados.codfilial" value-field="codfilial" text-field="nomefilial"
                        :options="getFilial" size="sm" :class="{'is-invalid' : errors.codfilial}" />
                      <div class="invalid-feedback" v-show="errors.codfilial">{{ errors.codfilial }}</div>
                    </b-form-group>
                    <transition name="fade">
                      <div v-if="dados.status==='VENDEDOR'" class="row">
                        <div class="col-md-12">
                          <pesquisa @pesquisa="setpesquisa" refmodal="modalvend" titulo="Vendedor"
                            modulo="cadvendModule" indexmod="indexVend" :campos="fieldsvend"
                            metodo_pesquisa_id="showvendedor" idretorno="id" codigoretorno="codvend"
                            nomeretorno="nomevend" :id_pesq="dados.id_codvend"></pesquisa>
                        </div>
                      </div>
                    </transition>
                    <div class="row">
                      <div class="col-md-3">
                        <b-form-group label="Início" label-for="datacad">
                          <b-form-input type="date" v-model="dados.datacad" :class="{'is-invalid' : errors.datacad}">
                          </b-form-input>
                          <div class="invalid-feedback" v-show="errors.datacad">{{ errors.datacad }}</div>
                        </b-form-group>
                      </div>
                      <div class="col-md-3">
                        <b-form-group label="Inativação:" label-for="datafim">
                          <b-form-input type="date" v-model="dados.datafim" :class="{'is-invalid' : errors.datafim}">
                          </b-form-input>
                        </b-form-group>
                      </div>
                    </div>
                  </b-tab>
                  <b-tab title="Parâmetros de Venda">
                    <h6>Módulos</h6>
                  </b-tab>
                </b-tabs>
                <div class="row">
                  <div class="card-footer">
                    <b-button type="submit" variant="info" size="sm"><i class="mdi mdi-check-circle-outline"></i>Salvar</b-button>
                    <b-button variant="secondary" size="sm" v-on:click="showFrmconstblusu()">Cancelar</b-button>
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
import pesquisa from '../../../components/pesquisa'
import tabelacons from '../../../components/tabelacons'
import tabelaacesso from '../../../components/tabelaacesso'

export default {
  name: 'FrmCadparam',
  props: ['acao', 'titulo'],
  components: {
    pesquisa,
    tabelacons,
    tabelaacesso
  },
  data () {
    return {
      situacao: [{
        text: 'ATIVO',
        value: 'ATIVO'
      },
      {
        text: 'INATIVO',
        value: 'INATIVO'
      }
      ],
      errors: {
        usunome: null,
        ususenha: null,
        situacao: null,
        status: null,
        nome: null,
        datacad: null,
        codfilial: null
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
      fieldsvend: {
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
        usunome: '',
        ususenha: '',
        nome: '',
        situacao: '',
        status: '',
        email: '',
        id_codger: null,
        id_codvend: null,
        codfilial: null,
        codvend: '',
        datacad: null,
        datafim: null,
        modulos: [],
        menus: {
          ans: [],
          audmedica: [],
          autguias: [],
          cadgerais: [],
          comercial: [],
          contmedicas: [],
          financeiros: [],
          medpreventiva: [],
          mobileapp: [],
          parametros: [],
          senhas: []
        }
      },
      fotoperfil: ''
    }
  },
  filters: {
    subStr: function (string) {
      if (string != null) {
        return string.toString().substring(0, 22)
      }
    },
    upper: function (value) {
      if (!value) return ''
      value = value.toString()
      return value.toUpperCase()
    }
  },
  mounted () {
    this.montador()
  },
  methods: {
    montador: async function () {
      // this.$refs.usunome.focus()
      let vm = this
      if (this.acao === 'editar') {
        this.$store.dispatch('tblusuModule/showUsu', this.$route.params.id)
          .then(function (res) {
            vm.dados.id = res.id
            vm.dados.usunome = res.usunome
            vm.dados.ususenha = res.ususenha
            vm.dados.nome = res.nome
            vm.dados.situacao = res.situacao
            vm.dados.status = res.status
            vm.dados.email = res.email
            vm.retornaFotoGravatar()
            vm.dados.id_codger = res.id_codger
            vm.dados.id_codvend = res.id_codvend
            vm.dados.codfilial = res.codfilial
            vm.dados.datacad = res.datacad
            vm.dados.datafim = res.datafim
          }).catch(function (error) {
            alert('erro' + error)
          })
      } else {
        vm.dados.situacao = 'ATIVO'
        vm.dados.status = 'USUARIO'
        vm.dados.datacad = '2020-06-29'
      }
      await this.carregaSelectGer()
      await this.carregaModulos()
      await this.showMenus()
    },
    carregaSelectGer: function () {
      this.$store.dispatch('cadgerModule/carregaSelectGer')
    },
    carregaModulos: async function () {
      let vm = this
      if (vm.acao === 'novo') {
        await vm.$store.dispatch('cadmodModule/indexMod')
          .then(function (response) {
            response.forEach(function (item, i) {
              vm.dados.modulos.push(item)
            })
          })
      } else {
        await vm.$store.dispatch('cadmodModule/showMod', vm.$route.params.id)
          .then(function (response) {
            response.forEach(function (item, i) {
              vm.dados.modulos.push(item)
            })
          })
      }
    },
    showFrmconstblusu () {
      this.carregaMenus()
      this.$router.push('/frmconstblusu')
    },
    gravar () {
      let vm = this
      if (vm.acao === 'novo') {
        var url = 'tblusuModule/storeUsu'
      } else if (vm.acao === 'editar') {
        url = 'tblusuModule/updateUsu'
      }
      this.$store.dispatch(url, vm.dados)
        .then(function (res) {
          if (res.data.success) {
            vm.$router.push('/frmconstblusu')
          } else {
            vm.errors.usunome = res.data.errors.usunome ? res.data.errors.usunome[0] : null
            vm.errors.ususenha = res.data.errors.ususenha ? res.data.errors.ususenha[0] : null
            vm.errors.nome = res.data.errors.nome ? res.data.errors.nome[0] : null
            vm.errors.status = res.data.errors.status ? res.data.errors.status[0] : null
            vm.errors.situacao = res.data.errors.situacao ? res.data.errors.situacao[0] : null
            // vm.errors.id_codger = res.data.errors.id_codger ? res.data.errors.id_codger[0] : null
            vm.errors.codfilial = res.data.errors.codfilial ? res.data.errors.codfilial[0] : null
            vm.errors.datacad = res.data.errors.datacad ? res.data.errors.datacad[0] : null
          }
        })
        .catch(function (errors) {
          console.log(errors)
        })
    },
    setpesquisa: function (pesquisa) {
      let vm = this
      vm.dados.codvend = pesquisa.codigo
      vm.dados.id_codvend = pesquisa.id
    },
    setMenus: function (menus) {
      let vm = this
      if (menus.idcadastro === '1') {
        vm.dados.menus.ans = []
        vm.dados.menus.ans = menus
      } else if (menus.idcadastro === '2') {
        vm.dados.menus.audmedica = []
        vm.dados.menus.audmedica = menus
      } else if (menus.idcadastro === '3') {
        vm.dados.menus.autguias = []
        vm.dados.menus.autguias = menus
      } else if (menus.idcadastro === '4') {
        vm.dados.menus.cadgerais = []
        vm.dados.menus.cadgerais = menus
      } else if (menus.idcadastro === '5') {
        vm.dados.menus.comercial = []
        vm.dados.menus.comercial = menus
      } else if (menus.idcadastro === '6') {
        vm.dados.menus.contmedicas = []
        vm.dados.menus.contmedicas = menus
      } else if (menus.idcadastro === '8') {
        vm.dados.menus.financeiros = []
        vm.dados.menus.financeiros = menus
      } else if (menus.idcadastro === '9') {
        vm.dados.menus.medpreventiva = []
        vm.dados.menus.medpreventiva = menus
      } else if (menus.idcadastro === '10') {
        vm.dados.menus.mobileapp = []
        vm.dados.menus.mobileapp = menus
      } else if (menus.idcadastro === '11') {
        vm.dados.menus.parametros = []
        vm.dados.menus.parametros = menus
      } else if (menus.idcadastro === '12') {
        vm.dados.menus.senhas = []
        vm.dados.menus.senhas = menus
      } else if (menus.idcadastro === '13') {
        vm.dados.menus.senhas = []
        vm.dados.menus.senhas = menus
      }
    },
    showMenus: function () {
      let vm = this
      if (vm.acao === 'novo') {
        vm.$store.dispatch('tabmenuModule/showMenus').then(function (res) {
          if (res) {
            vm.menusall = res
          }
        })
      } else {
        const params = '?&usuario=' + vm.$route.params.id
        // this.$store.dispatch('menuusuModule/indexMenuUsu', params
        vm.menusall = vm.$store.dispatch('menuusuModule/indexMenuUsu', params).then(function (res) {
          if (res) {
            vm.menusall = res
          }
        })
      }
    },
    retornaFotoGravatar: function () {
      let vm = this

      this.$store.dispatch('tblusuModule/retornaFotoGravatar', vm.dados.email)
        .then((res) => {
          if (res) {
            vm.fotoperfil = res
          }
        })
    },
    carregaMenus: async function () {
      let vm = this
      const params = '?idtblusu=' + vm.$store.state.auth.user.user.original.id + '&idmod=' + vm.idmod

      this.$store.dispatch('menuusuModule/showMenuUsuModpermitidos', params)
    }
  },
  computed: {
    ...mapGetters({
      getGerente: 'cadgerModule/getGerente',
      getVendedor: 'cadvendModule/getVendedor',
      getFilial: 'cadFilialModule/getFiliaisAtivas',
      getModulo: 'cadmodModule/getModulo'
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
