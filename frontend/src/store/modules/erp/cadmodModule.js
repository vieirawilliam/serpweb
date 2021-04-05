import axios from 'axios'
import swal from 'sweetalert'
var CAD_URL = localStorage.getItem('CAD_URL')

const state = {
  modulo: []
}
const getters = {
  getModulo (state) {
    return state.modulo
  },
  getTodoById: (state) => (id) => {
    return state.modulo.filter(modulo => modulo.id === id)
  }
}
const mutations = {
  setModulo (state, payload) {
    state.modulo = payload
  },
  storeModulo (state, payload) {
    state.modulo.push(payload)
  }
}
const actions = {
  indexMod: async (context) => {
    return new Promise((resolve, reject) => {
      axios.get(CAD_URL + 'cadmod')
        .then((res) => {
          if (res.data.success) {
            context.commit('setModulo', res.data.success)
            resolve(res.data.success)
          }
        })
        .catch(error => {
          reject(error.errors)
        })
    })
  },
  storeMod: async (context, payload) => {
    return new Promise((resolve, reject) => {
      swal('Confirma inclusão deste registro ?', {
        buttons: {
          cancel: 'cancela',
          ok: 'ok'
        }
      })
        .then((value) => {
          switch (value) {
            case 'ok':
              axios.post(CAD_URL + 'cadmod', payload)
                .then((res) => {
                  console.log(res)
                  if (res.data.success) {
                    // context.commit('storeGerente', res.data.success)
                    swal('Cadastro realizado com sucesso!')
                    resolve(res)
                  } else {
                    swal('Problemas na gravação deste registro!')
                    resolve(res)
                  }
                })
                .catch(errors => {
                  alert('Houve algum erro')
                  reject(errors)
                })
          }
        })
    })
  },
  showMod: async (context, value) => {
    return new Promise((resolve, reject) => {
      axios.get(CAD_URL + 'modulousu/' + value)
        .then((res) => {
          if (res.data.success) {
            console.log(res)
            context.commit('setModulo', res.data.success)
            resolve(res.data.success)
          }
        })
        .catch(error => {
          reject(error.errors)
        })
    })
  },
  updateMod: async (context, payload) => {
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
              axios.put(CAD_URL + 'cadmod/' + payload.id, payload)
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
  destroyMod: async (context, chave) => {
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
              axios.delete(CAD_URL + 'cadmod/' + chave)
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
  }
}

export default {
  namespaced: true,
  state,
  mutations,
  actions,
  getters
}
