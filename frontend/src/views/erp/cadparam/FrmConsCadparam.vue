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
            <b-breadcrumb-item href="#foo">Consulta de Parâmetros</b-breadcrumb-item>
            <!--<b-breadcrumb-item href="/dashboard">Bar</b-breadcrumb-item>-->
            <!--<b-breadcrumb-item active>Baz</b-breadcrumb-item>-->
          </b-breadcrumb>
          <h6>
            CONSULTA DE PARÂMETROS
          </h6>
        </div>
      </div>
    </div>
    <tabelacons acao="crud" modulo="cadparamModule" index="indexParam" destroy="destroyParam" cad="cadcadparam" edit="Editcadparam" :campos="fields" chave="id" sort="id" :sortdi="sortDirection" :isdelete="true" :ppage="10"></tabelacons>
  </div>
</template>

<script>
import tabelacons from '../../../components/tabelacons'

export default {
  name: 'FrmConsCadparam',
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
      itens: [{
        text: '<i class=" mdi mdi-home "></i> Início',
        href: '/dashboard'
      },
      {
        text: 'Manutenção',
        href: ''
      },
      {
        text: 'Parâmentros',
        href: ''
      }
      ],
      fields: [
        {
          key: 'id',
          label: 'ID',
          sortable: true
        },
        {
          key: 'rsocial',
          label: 'Razão Social',
          sortable: true
        },
        {
          key: 'cgc',
          label: 'CNPJ',
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
