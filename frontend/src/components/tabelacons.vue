<template lang="html">
  <div>
    <section class="dashboard">
      <div class="row">
        <div class="col-12 grid-margin">
          <div class="card">
            <div v-if="acao==='crud'" class="closeform">
              <div class="float-right"><i class="mdi mdi-close-circle-outline" v-on:click="showPrincipal()"></i></div>
            </div>
            <div class="card-body">
              <b-col lg="6" class="pb-2">
                <div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" checked="valeu" name="inlineRadioOptions"
                      id="inlineRadio1" value="option1"><span class="espaco_esquerda">Código</span>
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2"
                      value="option1"><span class="espaco_esquerda">Nome</span>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <b-form-group>
                        <b-form-input type="text" maxlength="40" placeholder="Login"></b-form-input>
                      </b-form-group>
                    </div>
                    <div class="col-md-4">
                      <b-form-group>
                        <b-form-select v-model="selected" :options="options" size="sm" lg="2" class="espaco_esquerda">
                        </b-form-select>
                      </b-form-group>
                    </div>
                    <div>
                      <b-button v-if="acao==='crud' && menusmod[0].incluir === 'S'" variant="info" size="sm" v-on:click="showForm()">Novo</b-button>
                    </div>
                  </div>
                </div>
              </b-col>
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <b-table ref="table" :busy="isBusy" id="my-table" :per-page="perPage" :current-page="currentPage"
                      striped hover responsive="sm" :sort-by.sync="sortBy" :sort-desc.sync="sortDesc" :items="lista"
                      :fields="fields" :filter="filter" @row-dblclicked="rowDblClickHandler">
                      <template v-if="acao==='crud'" #cell(s)="row">
                        <span>
                          <div :class="'rounded-circle ' + corstatus(row.item.status)"></div>
                        </span>
                      </template>
                      <template v-if="acao==='crud'" #cell(actions)="row">
                        <span>
                          <b-button v-if="menusmod[0].alterar === 'S'" variant="success" size="sm"
                            @click="visualizar(row.item)"><i class="tim-icons icon-settings"></i></b-button>
                          <b-button variant="danger" size="sm" v-if="isdelete === true &&  menusmod[0].excluir === 'S'"
                            @click="excluir(row.item)">
                            <i class="tim-icons icon-simple-remove"></i> </b-button>
                        </span>
                      </template>
                    </b-table>
                    <div class="row space">
                      <div v-if="legenda" class="col-sm">
                        <div class="row legenda" col="md-6">
                          <b-img class="rounded-circle" v-bind="mainProps" blank-color="#138496"></b-img><span
                            class="espaco_esquerda"> Administrador</span>
                          <b-img class="rounded-circle" v-bind="mainProps" blank-color="#ffde7b"></b-img><span
                            class="espaco_esquerda"> Empresa</span>
                          <b-img class="rounded-circle" v-bind="mainProps" blank-color="#f59910"></b-img><span
                            class="espaco_esquerda"> Usuário</span>
                          <b-img class="rounded-circle" v-bind="mainProps" blank-color="#73e26b"></b-img><span
                            class="espaco_esquerda"> Prestador</span>
                          <!-- <div class="rounded-circle" style="height:15px; width:15px; background:red"></div><span class="espaco_esquerda">Prestador</span>-->
                        </div>
                      </div>
                      <div class="col-sm">
                        <b-pagination pills v-model="currentPage" :total-rows="rows" :per-page="perPage"
                          aria-controls="my-table" align="right">
                        </b-pagination>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  name: 'tabelacons',
  props: [
    'acao', 'modulo', 'campos', 'index', 'destroy', 'cad', 'edit', 'legenda', 'chave', 'sort', 'sortdi', 'isdelete',
    'ppage', 'scond'
  ],
  data () {
    return {
      selected: 'TODOS',
      options: [{
        text: 'TODOS',
        value: 'TODOS'
      },
      {
        text: 'ATIVO',
        value: 'ATIVO'
      },
      {
        text: 'INATIVO',
        value: 'INATIVO'
      }
      ],
      fields: [],
      perPage: this.ppage,
      page: 1,
      currentPage: 1,
      isBusy: false,
      staffData: {},
      showTable: false,
      sortBy: this.sort,
      sortDesc: false,
      sortDirection: '',
      filter: '',
      mainProps: {
        blank: true,
        width: 15,
        height: 15,
        class: 'm1'
      }
    }
  },
  created: function () {
    // Carrega quais campos ira aparecer na tabela
    this.fields = this.campos
    // this.$refs.table.refresh()
  },
  mounted () {
    // this.lista()
    // this.$refs.table.refresh()
  },
  methods: {
    lista: async function (ctx, callback) {
      let vm = this
      vm.isBusy = true

      if (vm.page === ctx.currentPage) {
        if (this.sortDirection === '') {
          this.sortDirection = this.sortdi
        } else {
          if (this.sortDirection === 'desc') {
            this.sortDirection = 'asc'
          } else {
            this.sortDirection = 'desc'
          }
        }
      }

      vm.page = ctx.currentPage

      const params = '?page=' + ctx.currentPage + '&sortBy=' + ctx.sortBy + '&sortDesc=' + this.sortDirection +
          '&filter=' + ctx.filter +
          '&scond1=' + vm.selected + '&perpage=' + vm.perPage + '&scond2=' + this.scond

      this.$store.dispatch(this.modulo + '/' + this.index, params)
        .then(function (response) {
          vm.staffData = response
          vm.isBusy = false
          callback(response.data)
        })
    },
    excluir (value) {
      let vm = this
      var url = this.modulo + '/' + this.destroy
      // eslint-disable-next-line
        this.$store.dispatch(url, eval('value.' + vm.chave))
        .then(function (res) {
          if (res.data.success) {
            vm.sortDirection = ''
            vm.$refs.table.refresh()
          }
        })
        .catch(function (error) {
          console.log(error)
        })
    },
    showForm () {
      this.$router.push('/' + this.cad)
    },
    showPrincipal () {
      this.$router.push('/dashboard')
    },
    visualizar: function (value) {
      let vm = this
      vm.$router.push({
        name: this.edit,
        params: {
          // eslint-disable-next-line
            id: eval('value.' + vm.chave)
        }
      })
    },
    rowDblClickHandler (item, index, event) {
      let vm = this
      if (this.acao !== 'crud') {
        // eslint-disable-next-line
          let id = eval('item.' + vm.chave)
        vm.setResult(vm.chave, id)
      }
    },
    setResult: function (campo, id) {
      this.$emit('result', {
        campo: id
      })
    },
    corstatus: function (status) {
      if (status === 'USUARIO') {
        return 'cor_usu'
      } else if (status === 'ADMINISTRADOR') {
        return 'cor_admin'
      } else if (status === 'EMPRESA') {
        return 'cor_empr'
      } else if (status === 'PRESTADOR') {
        return 'cor_prest'
      }
    }
  },
  computed: {
    rows () {
      return this.staffData.total
    },
    menusmod () {
      return this.$store.getters['menuusuModule/getTodoById'](this.$route.path)
    }
  }
}

</script>

<style>
  .espaco_esquerda {
    margin-right: 20px !important;
    font-size: .76rem;
  }

  .legenda {
    margin-top: 10px;
    display: block;
  }

  .space {
    margin-top: 20px !important;
    clear: both;
  }

  table.b-table[aria-busy='true'] {
    opacity: 1;
    font-size: .76rem !important;
  }

  .cor_admin {
    background: #138496;
    height: 15px;
    width: 15px
  }

  .cor_empr {
    background: #ffde7b;
    height: 15px;
    width: 15px
  }

  .cor_usu {
    background: #f59910;
    height: 15px;
    width: 15px
  }

  .cor_prest {
    background: #73e26b;
    height: 15px;
    width: 15px
  }

  .table {
    font-size: .765rem !important;
  }

</style>
