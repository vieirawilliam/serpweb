import axios from 'axios'
import swal from 'sweetalert'
var CAD_URL = localStorage.getItem('CAD_URL')

const state = {
  gerente: []
}
const getters = {
  getGerente (state) {
    return state.gerente
  }
}
const mutations = {
  setGerente (state, payload) {
    state.gerente = payload
  },
  storeGerente (state, payload) {
    state.gerente.push(payload)
  }
}
const actions = {
  indexGer: async (context, payload) => {
    return new Promise((resolve, reject) => {
      axios.get(CAD_URL + 'cadger' + payload)
        .then((res) => {
          if (res.data.success) {
            context.commit('setGerente', res.data.success)
            resolve(res.data.success)
          }
        })
        .catch(error => {
          reject(error.errors)
        })
    })
  },
  storeGer: async (context, payload) => {
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
              axios.post(CAD_URL + 'cadger', payload)
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
  showGer: async (context, value) => {
    return new Promise((resolve, reject) => {
      axios.get(CAD_URL + 'cadger/' + value)
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
  updateGer: async (context, payload) => {
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
              axios.put(CAD_URL + 'cadger/' + payload.id, payload)
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
  destroyGer: async (context, chave) => {
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
              axios.delete(CAD_URL + 'cadger/' + chave)
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
  carregaSelectGer: async (context) => {
    return new Promise((resolve, reject) => {
      axios.get('http://apas.planoonline.test:8000/api/auth/cadger/carregaselect/lista')
        .then((res) => {
          if (res.data.success) {
            context.commit('setGerente', res.data.success)
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
