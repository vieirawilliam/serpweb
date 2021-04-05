import axios from 'axios'
import swal from 'sweetalert'
var CAD_URL = localStorage.getItem('CAD_URL')

const state = {
  usuario: []
}
const getters = {
  getUsuario (state) {
    return state.usuario
  }
}
const mutations = {
  setUsuario (state, payload) {
    state.usuario = payload
  },
  storeUsuario (state, payload) {
    state.usuario.push(payload)
  }
}
const actions = {
  indexUsu: async (context, payload) => {
    return new Promise((resolve, reject) => {
      axios.get(CAD_URL + 'tblusu' + payload)
        .then((res) => {
          if (res.data.success) {
            context.commit('setUsuario', res.data.success)
            resolve(res.data.success)
          }
        })
        .catch(error => {
          reject(error.errors)
        })
    })
  },
  storeUsu: async (context, payload) => {
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
              axios.post(CAD_URL + 'tblusu', payload)
                .then((res) => {
                  console.log(res)
                  if (res.data.success) {
                    // context.commit('storeGerente', res.data.success)
                    let user = JSON.parse(localStorage.getItem('user'))
                    const params = '?idtblusu=' + user.user.original.id + '&idmod='
                    context.dispatch('menuusuModule/showMenuUsuModpermitidos', params, { root: true })
                    context.dispatch('modulousuModule/showModuloUsuPermitidos', user.user.original.id, { root: true })
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
  showUsu: async (context, value) => {
    return new Promise((resolve, reject) => {
      axios.get(CAD_URL + 'tblusu/' + value)
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
  updateUsu: async (context, payload) => {
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
              axios.put(CAD_URL + 'tblusu/' + payload.id, payload)
                .then((res) => {
                  if (res.data.success) {
                    swal('Cadastro alterado com sucesso!')
                    let user = JSON.parse(localStorage.getItem('user'))
                    const params = '?idtblusu=' + user.user.original.id + '&idmod='
                    context.dispatch('menuusuModule/showMenuUsuModpermitidos', params, { root: true })
                    context.dispatch('modulousuModule/showModuloUsuPermitidos', user.user.original.id, { root: true })
                    resolve(res)
                  } else {
                    swal('Problemas na alteração deste registro!')
                    resolve(res)
                  }
                })
                .catch(error => {
                  swal('Houve algum erro')
                  reject(error.errors)
                })
          }
        })
    })
  },
  destroyUsu: async (context, chave) => {
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
              axios.delete(CAD_URL + 'tblusu/' + chave)
                .then((res) => {
                  if (res.data.success) {
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
  retornaFotoGravatar: async (context, value) => {
    return new Promise((resolve, reject) => {
      axios.get(CAD_URL + 'tblusu/retornafotogravatar/foto/' + value)
        .then((res) => {
          if (res.data) {
            // context.commit('setGerente1', res.data.success)
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
