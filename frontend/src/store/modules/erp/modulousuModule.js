import axios from 'axios'
var CAD_URL = localStorage.getItem('CAD_URL')

const state = {
  modulousu: []
}
const getters = {
  getModuloUsu (state) {
    return state.modulousu
  }
}
const mutations = {
  setModuloUsu (state, payload) {
    state.modulousu = payload
  },
  storeModuloUsu (state, payload) {
    state.modulousu.push(payload)
  }
}
const actions = {
  indexModuloUsu: async (context) => {
    return new Promise((resolve, reject) => {
      axios.get(CAD_URL + 'modulousu')
        .then((res) => {
          if (res.data.success) {
            context.commit('setModuloUsu', res.data.success)
            resolve(res.data.success)
          }
        })
        .catch(error => {
          reject(error.errors)
        })
    })
  },
  storeModuloUsu: async (context, payload) => {
    return new Promise((resolve, reject) => {
      axios.post(CAD_URL + 'modulousu', payload)
        .then((res) => {
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
  showModuloUsu: async (context, value) => {
    return new Promise((resolve, reject) => {
      axios.get(CAD_URL + 'modulousu/' + value)
        .then((res) => {
          if (res.data.success) {
            context.commit('setModuloUsu', res.data.success)
            resolve(res.data.success)
          } else {
          }
        })
        .catch(error => {
          reject(error.errors)
        })
    })
  },
  showModuloUsuPermitidos: async (context, value) => {
    return new Promise((resolve, reject) => {
      axios.get(CAD_URL + 'modulousu/listamodusupermitidos/lista/' + value)
        .then((res) => {
          if (res.data.success) {
            context.commit('setModuloUsu', res.data.success)
            resolve(res.data.success)
          } else {
          }
        })
        .catch(error => {
          reject(error.errors)
        })
    })
  },
  updateModuloUsu: async (context, payload) => {
    return new Promise((resolve, reject) => {
      axios.put(CAD_URL + 'modulousu/' + payload.id, payload)
        .then((res) => {
          if (res.data.success) {
            resolve(res)
          } else {
            resolve(res)
          }
        })
        .catch(error => {
          reject(error.errors)
        })
    })
  },
  destroyModuloUsu: async (context, chave) => {
    return new Promise((resolve, reject) => {
      axios.delete(CAD_URL + 'modulousu/' + chave)
        .then((res) => {
          if (res.data.success) {
            resolve(res)
          } else {
            resolve(res)
          }
        })
        .catch(error => {
          reject(error.errors)
        })
    })
  },
  listaUnicoModulo: async (context, payload) => {
    return new Promise((resolve, reject) => {
      axios.post(CAD_URL + 'modulousu/listaunicomodulousu/listaunicomod', payload)
        .then((res) => {
          if (res.data.success) {
            // context.commit('setModuloUsu', res.data.success)
            resolve(res.data.success)
          } else {
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
