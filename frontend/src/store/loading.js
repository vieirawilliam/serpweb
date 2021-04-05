const state = {
  spinner: false,
  showmenu: true
}
const getters = {
  getStatus (state) {
    return state.spinner
  },
  getMenu (state) {
    return state.showmenu
  }
}
const mutations = {
  ligar (state) {
    state.spinner = true
  },
  desligar (state) {
    state.spinner = false
  },
  show (state) {
    state.showmenu = true
  },
  hide (state) {
    state.showmenu = false
  }

}
const actions = {
  on: async (context) => {
    context.commit('ligar')
  },
  off: async (context) => {
    context.commit('desligar')
  },
  mostrar: async (context) => {
    context.commit('show')
  },
  esconder: async (context) => {
    context.commit('hide')
  }
}

export default {
  namespaced: true,
  state,
  mutations,
  actions,
  getters
}
