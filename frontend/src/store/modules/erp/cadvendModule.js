import axios from 'axios'
import swal from 'sweetalert'
var CAD_URL = localStorage.getItem('CAD_URL')

const state = {
  vendedor: []
}
const getters = {
  getVendedor (state) {
    return state.vendedor
  }
}
const mutations = {
  setVendedor (state, payload) {
    state.vendedor = payload
  },
  storeVendedor (state, payload) {
    state.vendedor.push(payload)
  }
}
const actions = {
  indexVend: async (context, payload) => {
    return new Promise((resolve, reject) => {
      axios.get(CAD_URL + 'cadvend' + payload)
        .then((res) => {
          if (res.data.success) {
            context.commit('setVendedor', res.data.success)
            resolve(res.data.success)
          }
        })
        .catch(error => {
          reject(error.errors)
        })
    })
  },
  storeVend: async (context, payload) => {
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
              axios.post(CAD_URL + 'cadvend', payload)
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
                  swal('Houve algum erro')
                  reject(errors)
                })
          }
        })
    })
  },
  showVend: async (context, value) => {
    return new Promise((resolve, reject) => {
      axios.get(CAD_URL + 'cadvend/' + value)
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
  updateVend: async (context, payload) => {
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
              axios.put(CAD_URL + 'cadvend/' + payload.id, payload)
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
  destroyVend: async (context, chave) => {
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
              axios.delete(CAD_URL + 'cadvend/' + chave)
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
  showvendedor: async (context, payload) => {
    return new Promise((resolve, reject) => {
      axios.get(CAD_URL + 'cadvend/showvendedor/lista/' + payload)
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
  }
}

export default {
  namespaced: true,
  state,
  mutations,
  actions,
  getters
}
