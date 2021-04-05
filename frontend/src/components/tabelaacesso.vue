<template>
  <div>
    <b-form-group>
      <b-row>
        <b-col>
          <b-form-checkbox v-on:change="setMenus()" @input="selectAll" v-model="allSelected" :id="'todos' + idcadastro" :name="'todos' + idcadastro" :value="true" :unchecked-value="false" size="sm">Marcar todos</b-form-checkbox>
        </b-col>
      </b-row>
    </b-form-group>
    <span>Opções do Menu</span>
    <div class="card">
      <table class="table table-sm">
        <thead>
          <tr>
            <th scope="col">Código</th>
            <th scope="col">Menu</th>
            <th scope="col">Incluir</th>
            <th scope="col">Alterar</th>
            <th scope="col">Excluir</th>
            <th scope="col">Consultar</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(tabmenu, index) in filtramenu" :key="index">
            <th scope="row">{{tabmenu.id}}</th>
            <td>{{tabmenu.nmtela}}</td>
            <td>
              <div class="custom-control custom-checkbox">
                <b-form-checkbox v-on:change="setMenus()" :id="tabmenu.id + 'i'"  v-model="tabmenu.incluir" :name="tabmenu.id + 'i'" value="S" unchecked-value="N" size="sm"></b-form-checkbox>
              </div>
            </td>
            <td>
              <div class="custom-control custom-checkbox">
                <b-form-checkbox v-on:change="setMenus()" :id="tabmenu.id + 'a'" v-model="tabmenu.alterar" :name="tabmenu.id + 'a'" value="S" unchecked-value="N" size="sm"></b-form-checkbox>
              </div>
            </td>
            <td>
              <div class="custom-control custom-checkbox">
                <b-form-checkbox v-on:change="setMenus()" :id="tabmenu.id + 'e'" v-model="tabmenu.excluir" :name="tabmenu.id + 'e'" value="S" unchecked-value="N" size="sm"></b-form-checkbox>
              </div>
            </td>
            <td>
              <div class="custom-control custom-checkbox">
                <b-form-checkbox v-on:change="setMenus()" :id="tabmenu.id + 'c'" v-model="tabmenu.consultar" :name="tabmenu.id + 'c'" value="S" unchecked-value="N" size="sm"></b-form-checkbox>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script lang="js">
import {
  mapGetters
} from 'vuex'

export default {
  name: 'tabelaacesso',
  props: ['acao', 'titulo', 'idcadastro', 'listamenu'],
  components: {
  },
  data () {
    return {
      menus: [],
      allSelected: null
    }
  },
  mounted () {
  },
  methods: {
    selectAll: function () {
      let vm = this

      if (this.allSelected) {
        this.menus.forEach(function (item, i) {
          vm.menus[i].alterar = 'S'
          vm.menus[i].consultar = 'S'
          vm.menus[i].excluir = 'S'
          vm.menus[i].incluir = 'S'
        })
      } else {
        this.menus.forEach(function (item, i) {
          vm.menus[i].alterar = 'N'
          vm.menus[i].consultar = 'N'
          vm.menus[i].excluir = 'N'
          vm.menus[i].incluir = 'N'
        })
      }
    },
    setMenus: function () {
      let vm = this
      vm.$emit('menus', {
        'idcadastro': vm.idcadastro,
        'menus': vm.menus
      })
    }
  },
  computed: {
    ...mapGetters({
      getMenus: 'tabmenuModule/getMenus'
    }),
    filtramenu: function () {
      let vm = this
      vm.menus = []
      if (vm.listamenu.length > 0) {
        vm.listamenu.forEach(function (item, i) {
          if (item.id_mod === vm.idcadastro) {
            vm.menus.push(item)
          }
        })
        vm.setMenus()
      }
      return vm.menus
    }
  }
}

</script>

<style scoped>
  .fade-enter-active, .fade-leave-active {
  transition: opacity .5s;
}
.fade-enter, .fade-leave-to {
  opacity: 0;
}

.custom-control-inline{
  margin-right: 0;
}

</style>
