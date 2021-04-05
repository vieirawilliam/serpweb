import axios from 'axios'
import swal from 'sweetalert'
var CAD_URL = localStorage.getItem('CAD_URL')

const state = {
  cadbanco: []
}
const getters = {
  getCadbanco (state) {
    return state.cadbanco
  }
}
const mutations = {
  setCadbanco (state, payload) {
    state.cadbanco = payload
  },
  storeCadbanco (state, payload) {
    state.cadbanco.push(payload)
  }
}
const actions = {
  indexCadbanco: async (context, payload) => {
    return new Promise((resolve, reject) => {
      console.log('indexxxxbanco')
      axios.get(CAD_URL + 'cadbanco' + payload)
        .then((res) => {
          if (res.data.success) {
            context.commit('setCadbanco', res.data.success)
            resolve(res.data.success)
          }
        })
        .catch(error => {
          reject(error.errors)
        })
    })
  },
  storeCadbanco: async (context, payload) => {
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
              axios.post(CAD_URL + 'cadbanco', payload)
                .then((res) => {
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
                  swal('Houve algum erro')
                  reject(errors)
                })
          }
        })
    })
  },
  showCadbanco: async (context, value) => {
    return new Promise((resolve, reject) => {
      axios.get(CAD_URL + 'cadbanco/' + value)
        .then((res) => {
          if (res.data.success) {
            // context.commit('setGerente1', res.data.success)
            resolve(res.data.success)
          }
        })
        .catch(error => {
          reject(error.errors)
        })
    })
  },
  updateCadbanco: async (context, payload) => {
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
              axios.put(CAD_URL + 'cadbanco/' + payload.id, payload)
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
  destroyCadbanco: async (context, chave) => {
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
              axios.delete(CAD_URL + 'cadbanco/' + chave)
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
  showbanco: async (context, payload) => {
    return new Promise((resolve, reject) => {
      axios.get(CAD_URL + 'cadbanco/showbancoicaopag/lista/' + payload)
        .then((res) => {
          if (res.data.success) {
            // context.commit('setGerente1', res.data.success)
            resolve(res.data.success)
          }
        })
        .catch(error => {
          reject(error.errors)
        })
    })
  },
  carregaSelectbanco: async (context) => {
    return new Promise((resolve, reject) => {
      axios.get(CAD_URL + 'cadbanco/carregaselect/lista')
        .then((res) => {
          if (res.data.success) {
            context.commit('setCadbanco', res.data.success)
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
