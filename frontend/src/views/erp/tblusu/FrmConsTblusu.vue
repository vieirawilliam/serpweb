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
            <b-breadcrumb-item href="#foo">Consulta de Usuário</b-breadcrumb-item>
            <!--<b-breadcrumb-item href="/dashboard">Bar</b-breadcrumb-item>-->
            <!--<b-breadcrumb-item active>Baz</b-breadcrumb-item>-->
          </b-breadcrumb>
          <h6>
            CONSULTA DE USUÁRIOS
          </h6>
        </div>
      </div>
    </div>
    <tabelacons acao="crud" modulo="tblusuModule" index="indexUsu" destroy="destroyUsu"
                cad="cadtblusu" edit="Edittblusu" :campos="fields" legenda="sim" chave="id" sort="id"
                :sortdi="sortDirection" :isdelete="true" :ppage="10"></tabelacons>
  </div>
</template>

<script>
import tabelacons from '../../../components/tabelacons'

export default {
  name: 'FrmConsTblusu',
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
      items: [{
        text: '<i class=" mdi mdi-home "></i> Início',
        href: '/dashboard'
      },
      {
        text: 'Adminstração',
        href: ''
      },
      {
        text: 'Acessos',
        href: ''
      }
      ],
      fields: [
        {
          key: 's',
          label: 'S',
          sortable: true
        },
        {
          key: 'id',
          label: 'ID',
          sortable: true
        },
        {
          key: 'usucod',
          label: 'Código',
          sortable: true
        },
        {
          key: 'usunome',
          label: 'Login',
          sortable: true
        },
        {
          key: 'nome',
          label: 'Nome',
          sortable: true
        },
        {
          key: 'status',
          label: 'Status',
          sortable: true
        },
        {
          key: 'prestador',
          label: 'Prestador',
          sortable: true
        },
        {
          key: 'situacao',
          label: 'Situação',
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
