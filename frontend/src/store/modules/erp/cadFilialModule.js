import axios from 'axios'
import swal from 'sweetalert'
var CAD_URL = localStorage.getItem('CAD_URL')

const state = {
  filiais: [],
  masterFilial: '',
  filiaisAtivas: []
}
const getters = {
  getFiliais (state) {
    return state.filiais
  },
  getFiliaisAtivas (state) {
    return state.filiaisAtivas
  },
  getmasterFilial (state) {
    return state.masterFilial
  }
}
const mutations = {
  setFilial (state, payload) {
    state.filiais = payload
  },
  setFilialAtivas (state, payload) {
    state.filiaisAtivas = payload
  },
  storeFilial (state, payload) {
    state.filiais.push(payload)
  }
}
const actions = {
  indexFilial: async (context, payload) => {
    return new Promise((resolve, reject) => {
      axios.get(CAD_URL + 'cadfilial/getFiliais' + payload)
        .then((res) => {
          if (res.data.success) {
            context.commit('setFilial', res.data.success)
            resolve(res.data.success)
          }
        })
        .catch(error => {
          reject(error.errors)
        })
    })
  },
  indexFilialAtivas: async (context, payload) => {
    return new Promise((resolve, reject) => {
      axios.get(CAD_URL + 'cadfilial/getFiliaisAtivas')
        .then((res) => {
          if (res.data.success) {
            context.commit('setFilialAtivas', res.data.success)
            resolve(res.data.success)
          }
        })
        .catch(error => {
          reject(error.errors)
        })
    })
  },
  storeFilial: async (context, payload) => {
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
              axios.post(CAD_URL + 'cadfilial/store', payload)
                .then((res) => {
                  if (res.data.success) {
                    // context.commit('storeFilial', res.data.success)
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
  showFilial: async (context, value) => {
    return new Promise((resolve, reject) => {
      axios.get(CAD_URL + 'cadfilial/getFilialByID/' + value)
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
  updateFilial: async (context, payload) => {
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
              axios.put(CAD_URL + 'cadfilial/update/' + payload.codfilial, payload)
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
  }
}

export default {
  namespaced: true,
  state,
  mutations,
  actions,
  getters
}
