<template lang="html">
  <div>
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
                <b-breadcrumb-item active>Cadastro de bancos</b-breadcrumb-item>
              </b-breadcrumb>
          <h6>
            CONSULTA DE BANCOS
          </h6>
        </div>
      </div>
    </div>
    <tabelacons acao="crud" modulo="cadbancoModule" index="indexCadbanco" destroy="destroyCadbanco" cad="cadcadbanco" edit="Editcadbanco"
    :campos="fields" chave="id" sort="id" :sortdi="sortDirection" :isdelete="true" :ppage="10"></tabelacons>
  </div>
</template>

<script>
import tabelacons from '../../../components/tabelacons'

export default {
  name: 'FrmConsCadbanco',
  props: ['acao'],
  components: {
    tabelacons
  },
  data () {
    return {
      selected: 'TODOS',
      options: [
        { text: 'TODOS', value: 'TODOS' },
        { text: 'ATIVO', value: 'ATIVO' },
        { text: 'INATIVO', value: 'INATIVO' }
      ],
      fields: [
        {
          key: 'id',
          label: 'ID',
          sortable: true
        },
        {
          key: 'numbanco',
          label: 'Nº Banco',
          sortable: true
        },
        {
          key: 'descbanco',
          label: 'Descrição',
          sortable: true
        },
        {
          key: 'actions',
          label: 'Ação',
          sortable: false
        }
      ],
      perPage: 5,
      currentPage: 1,
      isBusy: false,
      staffData: {},
      showTable: false,
      sortBy: 'id',
      sortDesc: false,
      sortDirection: 'asc',
      filter: ''
    }
  }
}

</script>

<style scoped>
 .espaco_esquerda{
    margin-right: 20px !important;
    border: 1px dolid red;
  }
  table.b-table[aria-busy='true'] {
  opacity: 1;
}
</style>
