import axios from 'axios'
import swal from 'sweetalert'
var CAD_URL = localStorage.getItem('CAD_URL')

const state = {
  cadcondpagamento: []
}
const getters = {
  getCadcondpagamento (state) {
    return state.cadcondpagamento
  }
}
const mutations = {
  setCadcondpagamento (state, payload) {
    state.cadcondpagamento = payload
  },
  storeCadcondpagamento (state, payload) {
    state.cadcondpagamento.push(payload)
  }
}
const actions = {
  indexCadcondpag: async (context, payload) => {
    return new Promise((resolve, reject) => {
      axios.get(CAD_URL + 'cadcondpagamento' + payload)
        .then((res) => {
          if (res.data.success) {
            context.commit('setCadcondpagamento', res.data.success)
            resolve(res.data.success)
          }
        })
        .catch(error => {
          reject(error.errors)
        })
    })
  },
  storeCadcondpag: async (context, payload) => {
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
              axios.post(CAD_URL + 'cadcondpagamento', payload)
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
  showCadcondpag: async (context, value) => {
    return new Promise((resolve, reject) => {
      axios.get(CAD_URL + 'cadcondpagamento/' + value)
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
  updateCadcondpag: async (context, payload) => {
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
              axios.put(CAD_URL + 'cadcondpagamento/' + payload.id, payload)
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
  destroyCadcondpag: async (context, chave) => {
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
              axios.delete(CAD_URL + 'cadcondpagamento/' + chave)
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
  showcondicaopag: async (context, payload) => {
    return new Promise((resolve, reject) => {
      axios.get(CAD_URL + 'cadcondpagamento/showcondicaopag/lista/' + payload)
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
  carregaSelectCondpag: async (context) => {
    return new Promise((resolve, reject) => {
      axios.get(CAD_URL + 'cadcondpagamento/carregaselect/lista')
        .then((res) => {
          if (res.data.success) {
            context.commit('setCadcondpagamento', res.data.success)
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
