import axios from 'axios'
import swal from 'sweetalert'
var CAD_URL = localStorage.getItem('CAD_URL')

const state = {
  menuusu: [],
  menuspermitidos: []
}
const getters = {
  getMenuUsu (state) {
    return state.menuusu
  },
  getTodoById: (state) => (path) => {
    return state.menuusu.filter(menuusu => menuusu.caminho === path)
  }
}
const mutations = {
  setMenuUsu (state, payload) {
    state.menuusu = payload
  },
  setMenusPermitidos (state, payload) {
    state.menuspermitidos = payload
  },
  storeMenuUsu (state, payload) {
    state.menuusu.push(payload)
  }
}
const actions = {
  indexMenuUsu: async (context, payload) => {
    return new Promise((resolve, reject) => {
      axios.get(CAD_URL + 'menuusu' + payload)
        .then((res) => {
          if (res.data.success) {
            context.commit('setMenuUsu', res.data.success)
            resolve(res.data.success)
          }
        })
        .catch(error => {
          reject(error.errors)
        })
    })
  },
  storeMenuUsu: async (context, payload) => {
    return new Promise((resolve, reject) => {
      axios.post(CAD_URL + 'menuusu', payload)
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
  showMenuUsu: async (context, value) => {
    return new Promise((resolve, reject) => {
      axios.get(CAD_URL + 'menusu/' + value)
        .then((res) => {
          if (res.data.success) {
            context.commit('setMenuUsu', res.data.success)
            resolve(res.data.success)
          }
        })
        .catch(error => {
          reject(error.errors)
        })
    })
  },
  showMenuUsuModpermitidos: async (context, payload) => {
    return new Promise((resolve, reject) => {
      axios.get(CAD_URL + 'menuusu/listamenusmodpermitidos/lista' + payload)
        .then((res) => {
          if (res.data.success) {
            context.commit('setMenuUsu', res.data.success)
            resolve(res.data.success)
          }
        })
        .catch(error => {
          reject(error.errors)
        })
    })
  },
  updateMenuUsu: async (context, payload) => {
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
  destroyMenuUsu: async (context, chave) => {
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
  listaAcesso: async (context, payload) => {
    return new Promise((resolve, reject) => {
      axios.post(CAD_URL + 'menuusu/verificaacesso/listaacesso', payload)
        .then((res) => {
          if (res.data) {
            // context.commit('setMenuUsu', res.data)
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
