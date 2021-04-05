import Vue from 'vue'
import Router from 'vue-router'
import HelloWorld from '@/components/HelloWorld'
import dashboard from '@/views/dashboard'
import login from '@/views/login/login'

import FrmConsTblusu from '@/views/erp/tblusu/FrmConsTblusu'
import Cadtblusu from '@/views/erp/tblusu/Cadtblusu'
import Edittblusu from '@/views/erp/tblusu/Edittblusu'

import FrmConsCadparam from '@/views/erp/cadparam/FrmConsCadparam'
import Cadcadparam from '@/views/erp/cadparam/Cadcadparam'
import Editcadparam from '@/views/erp/cadparam/Editcadparam'

import FrmConsCadcondpagamento from '@/views/erp/cadcondpagamento/FrmConsCadcondpagamento'
import Cadcondpagamento from '@/views/erp/cadcondpagamento/Cadcondpagamento'
import Editcadcondpagamento from '@/views/erp/cadcondpagamento/Editcadcondpagamento'

import FrmConsCadformapagamento from '@/views/erp/cadformapagamento/FrmConsCadformapagamento'
import Cadformapagamento from '@/views/erp/cadformapagamento/Cadformapagamento'
import Editcadformapagamento from '@/views/erp/cadformapagamento/Editcadformapagamento'

import FrmConsCadbanco from '@/views/erp/cadbanco/FrmConsCadbanco'
import Cadcadbanco from '@/views/erp/cadbanco/Cadcadbanco'
import Editcadbanco from '@/views/erp/cadbanco/Editcadbanco'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/HelloWorld',
      name: 'HelloWorld',
      component: HelloWorld
    },
    {
      path: '/',
      name: 'login',
      component: login
    },
    {
      path: '/dashboard',
      name: 'dashboard',
      component: dashboard
    },
    // USUARIOS
    {
      path: '/frmconstblusu',
      name: 'FrmConstblusu',
      component: FrmConsTblusu
    },
    {
      path: '/cadtblusu',
      name: 'Cadtblusu',
      component: Cadtblusu
    },
    {
      path: '/edittblusu/:id',
      name: 'Edittblusu',
      component: Edittblusu
    },
    // CADPARAM
    {
      path: '/frmconscadparam',
      name: 'FrmConsCadparam',
      component: FrmConsCadparam
    },
    {
      path: '/cadcadparam',
      name: 'Cadcadparam',
      component: Cadcadparam
    },
    {
      path: '/editcadparam/:id',
      name: 'Editcadparam',
      component: Editcadparam
    },
    // CADCONDPAGAMENTO
    {
      path: '/frmconscadcondpagamento',
      name: 'FrmConsCadcondpagamento',
      component: FrmConsCadcondpagamento
    },
    {
      path: '/cadcondpagamento',
      name: 'Cadcondpagamento',
      component: Cadcondpagamento
    },
    {
      path: '/editcadcondpagamento/:id',
      name: 'Editcadcondpagamento',
      component: Editcadcondpagamento
    },
    // CADFORMAPAGAMENTO
    {
      path: '/frmconscadformapagamento',
      name: 'FrmConsCadformapagamento',
      component: FrmConsCadformapagamento
    },
    {
      path: '/cadformapagamento',
      name: 'Cadformapagamento',
      component: Cadformapagamento
    },
    {
      path: '/editcadformapagamento/:id',
      name: 'Editcadformapagamento',
      component: Editcadformapagamento
    },
    // CADCONDPAGAMENTO
    {
      path: '/frmconscadbanco',
      name: 'FrmConsCadbanco',
      component: FrmConsCadbanco
    },
    {
      path: '/cadcadbanco',
      name: 'Cadcadbanco',
      component: Cadcadbanco
    },
    {
      path: '/editcadbanco/:id',
      name: 'Editcadbanco',
      component: Editcadbanco
    }
  ]
})
