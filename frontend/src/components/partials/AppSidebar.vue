<template>
  <div class="sidebar" data="blue">
    <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red"
    -->
    <div class="sidebar-wrapper">
      <div class="logo">
        <a href="javascript:void(0)" class="simple-text logo-mini">
          4.0
        </a>
        <a href="javascript:void(0)" class="simple-text logo-normal">
          SERP
        </a>
      </div>
      <ul class="nav">
        <li class="active">
          <router-link class="" to="/"><i class="tim-icons icon-chart-pie-36"></i>Dashboard</router-link>
        </li>
        <ul class="list-unstyled components">
          <!--CADASTROS-->
          <li >
            <a href="#cadastros" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i
                class="tim-icons icon-settings-gear-63"></i>Cadastros</a>
            <ul class="collapse list-unstyled" id="cadastros">
              <li class="tabsubmenu60">
                <a href="#auxiliar" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Auxiliares</a>
                <ul class="collapse list-unstyled" id="auxiliar">
                  <li class="tabsubmenu20"><router-link class="nav-link" to="/frmconscadbanco">Banco</router-link></li>
                  <li class="tabsubmenu20"><a href="#">Grupo</a></li>
                  <li class="tabsubmenu20"><a href="#">SubGrupo</a></li>
                  <li class="tabsubmenu20"><a href="#">Unidade de Medida</a></li>
                  <li class="tabsubmenu20"><router-link class="nav-link" to="/frmconscadcondpagamento">Condição de Pagamento</router-link></li>
                  <li class="tabsubmenu20"><router-link class="nav-link" to="/frmconscadformapagamento">Forma de Pagamento</router-link></li>
                  <li class="tabsubmenu20"><a href="#">Transportadora</a></li>
                </ul>
              </li>
              <li class="tabsubmenu60">
                <router-link class="nav-link" to="/">Empresa</router-link>
              </li>
              <li class="tabsubmenu60">
                <router-link class="nav-link" to="/frmconstblusu">Funcionários</router-link>
              </li>
              <li class="tabsubmenu60">
                <router-link class="nav-link" to="/">Produto</router-link>
              </li>
              <li class="tabsubmenu60">
                <router-link class="nav-link" to="/">Fornecedor</router-link>
              </li>
              <li class="tabsubmenu60">
                <router-link class="nav-link" to="/">Cliente</router-link>
              </li>
              <li class="tabsubmenu60">
                <router-link class="nav-link"  to="/Editcadparam/1">Parâmetros</router-link>
              </li>
            </ul>
          </li>
          <!--MOVIMENTAÇÃO-->
          <li>
            <a href="#movimentacao" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i
                class="tim-icons icon-coins"></i>Movimentação</a>
            <ul class="collapse list-unstyled" id="movimentacao">
              <li class="tabsubmenu60">
                <a href="#compra" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Compra</a>
                <ul class="collapse list-unstyled" id="compra">
                  <li class="tabsubmenu20"><a href="#">Pedido de Compra</a></li>
                  <li class="tabsubmenu20"><a href="#">Emissão de Compra</a></li>
                  <li class="tabsubmenu20"><a href="#">Contas a pagar</a></li>
                </ul>
              </li>
              <li class="tabsubmenu60">
                <a href="#venda" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Venda</a>
                <ul class="collapse list-unstyled" id="venda">
                  <li class="tabsubmenu20"><a href="#">Emissão de Venda</a></li>
                  <li class="tabsubmenu20"><a href="#">Comanda</a></li>
                  <li class="tabsubmenu20"><a href="#">Caixa</a></li>
                  <li class="tabsubmenu20"><a href="#">Manutenção de Vendas</a></li>
                  <li class="tabsubmenu20"><a href="#">Contas a Receber</a></li>
                </ul>
              </li>
              <li class="tabsubmenu60">
                <a href="#financeiro" data-toggle="collapse" aria-expanded="false"
                  class="dropdown-toggle">Financeiro</a>
                <ul class="collapse list-unstyled" id="financeiro">
                  <li class="tabsubmenu60">
                    <a href="#boletos" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Boletos</a>
                    <ul class="collapse list-unstyled" id="boletos">
                      <li class="tabsubmenu20"><a href="#">Gerar Boletos</a></li>
                      <li class="tabsubmenu20"><a href="#">Gerar Remessa</a></li>
                      <li class="tabsubmenu20"><a href="#">Imprimir Boleto</a></li>
                      <li class="tabsubmenu20"><a href="#">Baixa Retorno</a></li>
                    </ul>
                  </li>
                </ul>
              </li>
              <li class="tabsubmenu60">
                <a href="#movimentocaixa" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Movimento
                  de Caixa</a>
                <ul class="collapse list-unstyled" id="movimentocaixa">
                  <li class="tabsubmenu20"><a href="#">Lançamento de Caixa</a></li>
                  <li class="tabsubmenu20"><a href="#">Fechamento de Caixa</a></li>
                  <li class="tabsubmenu20"><a href="#">Fluxo de Caixa</a></li>
                  <li class="tabsubmenu20"><a href="#">Cupom Fiscal</a></li>
                </ul>
              </li>
              <li class="tabsubmenu60">
                <a href="#nfe" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Nota Fiscal
                  Eletrônica</a>
                <ul class="collapse list-unstyled" id="nfe">
                  <li class="tabsubmenu20"><a href="#">Emissão</a></li>
                </ul>
              </li>
              <li class="tabsubmenu60">
                <a href="#produto" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Produto</a>
                <ul class="collapse list-unstyled" id="produto">
                  <li class="tabsubmenu20"><a href="#">Alteração de Estoque</a></li>
                  <li class="tabsubmenu20"><a href="#">Alteração de Preço</a></li>
                  <li class="tabsubmenu20"><a href="#">Composição de Produto</a></li>
                </ul>
              </li>
              <li class="tabsubmenu60">
                <router-link class="nav-link" to="/frmconstblusu">Produção</router-link>
              </li>
            </ul>
          </li>
          <!--RELATORIO-->
          <li>
            <a href="#relatorio" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i
                class="far fa-file"></i>Relatório</a>
            <ul class="collapse list-unstyled" id="relatorio">
              <li class="tabsubmenu60">
                <a href="#operacionais" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Operacionais</a>
                <ul class="collapse list-unstyled" id="operacionais">
                  <li class="tabsubmenu20"><a href="#">Produtos</a></li>
                  <li class="tabsubmenu20"><a href="#">Cliente</a></li>
                  <li class="tabsubmenu20"><a href="#">Fornecedor</a></li>
                </ul>
              </li>
              <li class="tabsubmenu60">
                <a href="#gerenciais" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Gerenciais</a>
                <ul class="collapse list-unstyled" id="gerenciais">
                  <li class="tabsubmenu20"><a href="#">Vendas</a></li>
                  <li class="tabsubmenu20"><a href="#">Contas a receber</a></li>
                  <li class="tabsubmenu20"><a href="#">Contas a pagar</a></li>
                  <li class="tabsubmenu20"><a href="#">Compras</a></li>
                  <li class="tabsubmenu20"><a href="#">2º Via - Recibo de Venda</a></li>
                </ul>
              </li>
              <li class="tabsubmenu60">
                <a href="#">Estatísticos</a>
              </li>
            </ul>
          </li>
          <!--FERRAMENTA-->
          <li>
            <a href="#ferramenta" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i
                class="tim-icons icon-pin"></i>ferramenta</a>
            <ul class="collapse list-unstyled" id="ferramenta">
              <li class="tabsubmenu60"><a href="#">Parâmetros</a></li>
              <li class="tabsubmenu60"><a href="#">Configuração de base de dados</a></li>
            </ul>
          </li>
          <!--SOBRE-->
          <li>
            <a href="#sobre"><i class="tim-icons icon-bell-55"></i>Sobre</a>
          </li>
        </ul>
      </ul>
    </div>
  </div>
</template>

<script>
import {
  mapGetters
} from 'vuex'

export default {
  name: 'Sidebar',
  data () {
    return {
      msg: 'Welcome to Your Vue.js App'
    }
  },
  computed: {
    ...mapGetters({
      getMenu: 'loading/getMenu',
      getModulo: 'modulousuModule/getModuloUsu',
      getMenususu: 'menuusuModule/getMenuUsu'
    }),
    currentUser () {
      return this.$store.state.auth.user
    },
    info () {
      return this.$store.state.auth.user.user.original
    }
  },
  mounted () {
    if (!this.currentUser) {
      this.$router.push('/')
    }
    this.carregaModulos()
    this.carregaMenus()
  },
  methods: {
    carregaModulos: async function () {
      let vm = this
      this.$store.dispatch('modulousuModule/showModuloUsuPermitidos', vm.info.id)
    },
    carregaMenus: async function () {
      let vm = this
      const params = '?idtblusu=' + vm.$store.state.auth.user.user.original.id + '&idmod=' + vm.idmod

      this.$store.dispatch('menuusuModule/showMenuUsuModpermitidos', params)
    }
  }
}

</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
  .tabsubmenu20 {
    margin-left: 20px;
  }

  .tabsubmenu50 {
    margin-left: 50px;
  }

  .tabsubmenu60 {
    margin-left: 60px;
  }

  .tabsubmenu150 {
    margin-left: 150px;
  }

  .sidebar .nav li>a,
  .off-canvas-sidebar .nav li>a {
    margin: 7px 15px 0;
    border-radius: 30px;
    color: #ffffff;
    display: block;
    text-decoration: none;
    position: relative;
    text-transform: uppercase;
    cursor: pointer;
    font-size: 0.765rem;
    padding: 2px 8px;
    line-height: 1.625rem;
  }

  .sidebar .nav li>a:hover,
  .off-canvas-sidebar .nav li>a:hover {
    color: black;
  }

</style>
