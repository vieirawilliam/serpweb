import axios from 'axios'
import swal from 'sweetalert'
var CAD_URL = localStorage.getItem('CAD_URL')

const state = {
  menus: []
}
const getters = {
  getMenus (state) {
    return state.menus
  },
  getTodoById: (state) => (idmod) => {
    return state.menus.filter(menus => menus.id_mod === idmod)
  },
  getMenuModule: (state) => (idmod) => {
    return state.menus.find(menus => menus.id_mod === idmod)
  }
}
const mutations = {
  setMenus (state, payload) {
    state.menus = payload
  },
  storeMenus (state, payload) {
    state.menus.push(payload)
  }
}
const actions = {
  indexMenus: async (context) => {
    return new Promise((resolve, reject) => {
      axios.get(CAD_URL + 'tabmenu')
        .then((res) => {
          if (res.data.success) {
            context.commit('setMenus', res.data.success)
            resolve(res.data.success)
          }
        })
        .catch(error => {
          reject(error.errors)
        })
    })
  },
  storeMenus: async (context, payload) => {
    return new Promise((resolve, reject) => {
      axios.post(CAD_URL + 'tabmenu', payload)
        .then((res) => {
          console.log(res)
          if (res.data.success) {
            // context.commit('storeGerente', res.data.success)
            resolve(res)
          } else {
            resolve(res)
          }
        })
        .catch(errors => {
          alert('Houve algum erro tabmenu')
          reject(errors)
        })
    })
  },
  showMenus: async (context, value) => {
    return new Promise((resolve, reject) => {
      axios.get(CAD_URL + 'tabmenu/' + value)
        .then((res) => {
          if (res.data.success) {
            context.commit('setMenus', res.data.success)
            resolve(res.data.success)
          }
        })
        .catch(error => {
          reject(error.errors)
        })
    })
  },
  updateMenus: async (context, payload) => {
    return new Promise((resolve, reject) => {
      swal('Confirma alteração deste registro ?', {
        buttons: {
          cancel: 'cancela',
          ok: 'ok'
        }
      })
        .then((value) => {
          switch (value) {
            case 'ok':
              axios.put(CAD_URL + 'tabmenu/' + payload.id, payload)
                .then((res) => {
                  if (res.data.success) {
                    swal('Cadastro alterado com sucesso!')
                    resolve(res)
                  } else {
                    swal('Problemas na alteração deste registro!')
                    resolve(res)
                  }
                })
                .catch(error => {
                  reject(error.errors)
                })
          }
        })
    })
  },
  destroyMenus: async (context, chave) => {
    return new Promise((resolve, reject) => {
      swal('Confirma realmente excluir este registro ?', {
        buttons: {
          cancel: 'cancela',
          ok: 'ok'
        }
      })
        .then((value) => {
          switch (value) {
            case 'ok':
              axios.delete(CAD_URL + 'tabmenu/' + chave)
                .then((res) => {
                  if (res.data.success) {
                    // context.commit('setGerente', res.data.success);
                    // console.log(res.data.success);
                    swal('Cadastro excluido com sucesso!!')
                    resolve(res)
                  } else {
                    swal('Erro ao excluir o cadastro!!')
                    resolve(res)
                  }
                })
                .catch(error => {
                  reject(error.errors)
                })
          }
        })
    })
  },
  listaMenus: async (context, payload) => {
    return new Promise((resolve, reject) => {
      axios.post(CAD_URL + 'tabmenu/listamenus/listatabmenu', payload)
        .then((res) => {
          if (res.data) {
            context.commit('setMenus', res.data)
            resolve(res.data)
          }
        })
        .catch(error => {
          reject(error.errors)
        })
    })
  }
}

export default {
  namespaced: true,
  state,
  mutations,
  actions,
  getters
}
