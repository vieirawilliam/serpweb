import Vue from 'vue'
import Vuex from 'vuex'

import { auth } from './auth.module'
import loading from './loading'
import tblusuModule from './modules/erp/tblusuModule'
import modulousuModule from './modules/erp/modulousuModule'
import tabmenuModule from './modules/erp/tabmenuModule'
import menuusuModule from './modules/erp/menuusuModule'
import cadFilialModule from './modules/erp/cadFilialModule'
import cadmodModule from './modules/erp/cadmodModule'
import cadgerModule from './modules/erp/cadgerModule'
import cadvendModule from './modules/erp/cadvendModule'
import cadparamModule from './modules/erp/cadparamModule'
import cadcondPagamentoModule from './modules/erp/cadcondPagamentoModule'
import cadformaPagamentoModule from './modules/erp/cadformaPagamentoModule'
import cadbancoModule from './modules/erp/cadbancoModule'

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    auth,
    loading,
    tblusuModule,
    modulousuModule,
    tabmenuModule,
    menuusuModule,
    cadFilialModule,
    cadmodModule,
    cadgerModule,
    cadvendModule,
    cadparamModule,
    cadcondPagamentoModule,
    cadformaPagamentoModule,
    cadbancoModule
  }
})
