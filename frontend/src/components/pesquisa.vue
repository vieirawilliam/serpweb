/*eslint-disable no-eval */
<template>
  <div>
    <div class="form-group">
      <b-input-group :prepend="titulo" class="mb-2">
        <input id="codigopesq" class="form-control col-md-2" type="text" @change="busca($event.target.value)"
          v-model="dados.codigo">
        <b-form-input :hidden="visible" type="text" readonly v-model="dados.nome"></b-form-input>
        <b-button variant="secondary" size="sm"  @click="showModal"><i class="fas fa-search"></i></b-button>
        <b-modal :ref="refmodal" ok-only ok-title="Cancela" ok-variant="secondary" size="xl"
          :title="'Consulta ' + titulo">
          <tabelacons @result="setresult" acao="consultar" :modulo="modulo" :index="indexmod" :campos="campos"
            :chave="idretorno" :sort="idretorno" sortdi="asc" :isdelete="true" :ppage="10"></tabelacons>
        </b-modal>
      </b-input-group>
    </div>
  </div>
</template>

<script lang="js">
import {
  mapGetters
} from 'vuex'
import tabelacons from '../components/tabelacons'
import swal from 'sweetalert'

export default {
  name: 'pesquisa',
  props: ['titulo', 'aligntitulo', 'modulo', 'indexmod', 'campos', 'metodo_pesquisa_id', 'idretorno', 'codigoretorno',
    'nomeretorno', 'id_pesq', 'refmodal', 'parametro', 'acao', 'visible'
  ],
  components: {
    tabelacons
  },
  data () {
    return {
      dados: {
        id: '',
        codigo: '',
        nome: ''
      }
    }
  },
  filters: {},
  mounted () {
    if (this.id_pesq != null) {
      this.busca(this.id_pesq)
    } else {
      this.dados.id = ''
      this.dados.codigo = ''
      this.dados.nome = ''
    }
  },
  methods: {
    busca: function (value) {
      let vm = this
      let params = ''
      if (this.parametro) {
        params = '?' + vm.idretorno + '=' + value + this.parametro
      } else {
        params = '?' + vm.idretorno + '=' + value
      }

      this.$store.dispatch(vm.modulo + '/' + vm.metodo_pesquisa_id, params)
        .then(function (res) {
          /* eslint-disable no-eval */
          if (Object.keys(res).length > 0) {
            vm.dados.id = eval('res.' + vm.idretorno)
            vm.dados.codigo = eval('res.' + vm.codigoretorno)
            vm.dados.nome = eval('res.' + vm.nomeretorno)
            vm.setPesquisa()
          } else {
            if (vm.acao === 'novo') {
              swal('Código errado ou não permitido!')
            }
            vm.dados.id = ''
            vm.dados.codigo = ''
            vm.dados.nome = ''
          }
        }).catch(function (error) {
          console.log('erro' + error)
        })
    },
    setPesquisa: function () {
      let vm = this
      this.$emit('pesquisa', {
        'id': vm.dados.id,
        'codigo': vm.dados.codigo,
        'nome': vm.dados.nome
      })
    },
    setresult: function (result) {
      let vm = this
      this.$refs[vm.refmodal].hide()
      vm.busca(result.campo)
    },
    showModal () {
      let vm = this
      this.$refs[vm.refmodal].show()
    },
    limpaCampos () {
      this.dados.id = ''
      this.dados.codigo = ''
      this.dados.nome = ''
      document.getElementById('codigopesq').focus()
    }
  },
  computed: {
    ...mapGetters({
      getPlanocontabil: 'planocontabilModule/getPlanocontabil',
      getParametro: 'cadparamModule/getParametro'
    })
  }
}

</script>
<style scoped>
  .espaco_esquerda {
    margin-right: 20px !important;
    border: 1px solid red;
  }

  .form-group .input-group-prepend .input-group-text,
  .form-group .input-group-append .input-group-text,
  .input-group .input-group-prepend .input-group-text,
  .input-group .input-group-append .input-group-text {
    padding: 0px 0 0px 0px;
  }

  .input-group-text {
    font-size: 0.765rem;
  }

  .btn, .navbar .navbar-nav>a.btn {
    border-width: 2px;
    border: none;
    position: relative;
    overflow: hidden;
    margin: 0px 1px;
    border-radius: 0.4285rem;
    cursor: pointer;
    background: #344675;
    background-image: -webkit-linear-gradient(to bottom left, #344675, #263148, #344675);
    background-image: -o-linear-gradient(to bottom left, #344675, #263148, #344675);
    background-image: -moz-linear-gradient(to bottom left, #344675, #263148, #344675);
    background-image: linear-gradient(to bottom left, #344675, #263148, #344675);
    background-size: 210% 210%;
    background-position: top right;
    background-color: #344675;
    transition: all 0.15s ease;
    box-shadow: none;
    color: #ffffff;
}

</style>
