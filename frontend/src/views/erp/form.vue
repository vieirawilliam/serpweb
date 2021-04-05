<template>
  <div class="">
    <div class="grid-margin">
      <div class="card">
        <div class="card-body">
          <b-breadcrumb>
            <b-breadcrumb-item href="/dashboard">
              <b-icon icon="house-fill" scale="1.25" shift-v="1.25" aria-hidden="true"></b-icon>
              Home
            </b-breadcrumb-item>
            <b-breadcrumb-item href="#foo">Cadastro de Usuário</b-breadcrumb-item>
            <!--<b-breadcrumb-item href="/dashboard">Bar</b-breadcrumb-item>-->
            <!--<b-breadcrumb-item active>Baz</b-breadcrumb-item>-->
          </b-breadcrumb>
        </div>
      </div>
    </div>
    <div class="content">
      <div class="row">
        <div class="col-md-8 d-flex align-items-stretch grid-margin mx-auto">
          <div class="card">
            <div class="card-header">
              <h5 class="title">{{titulo}} usuário</h5>
            </div>
            <div class="card-body">
              <form>
                <div class="row">
                  <div class="col-md-5 pr-md-1">
                    <div class="form-group">
                      <label>Company (disabled)</label>
                      <input type="text" class="form-control" disabled="" placeholder="Company"
                        value="Creative Code Inc.">
                    </div>
                  </div>
                  <div class="col-md-3 px-md-1">
                    <div class="form-group">
                      <label>Username</label>
                      <input type="text" class="form-control" placeholder="Username" value="michael23">
                    </div>
                  </div>
                  <div class="col-md-4 pl-md-1">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email address</label>
                      <input type="email" class="form-control" placeholder="mike@email.com">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 pr-md-1">
                    <div class="form-group">
                      <label>First Name</label>
                      <input type="text" class="form-control" placeholder="Company" value="Mike">
                    </div>
                  </div>
                  <div class="col-md-6 pl-md-1">
                    <div class="form-group">
                      <label>Last Name</label>
                      <input type="text" class="form-control" placeholder="Last Name" value="Andrew">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Address</label>
                      <input type="text" class="form-control" placeholder="Home Address"
                        value="Bld Mihail Kogalniceanu, nr. 8 Bl 1, Sc 1, Ap 09">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4 pr-md-1">
                    <div class="form-group">
                      <label>City</label>
                      <input type="text" class="form-control" placeholder="City" value="Mike">
                    </div>
                  </div>
                  <div class="col-md-4 px-md-1">
                    <div class="form-group">
                      <label>Country</label>
                      <input type="text" class="form-control" placeholder="Country" value="Andrew">
                    </div>
                  </div>
                  <div class="col-md-4 pl-md-1">
                    <div class="form-group">
                      <label>Postal Code</label>
                      <input type="number" class="form-control" placeholder="ZIP Code">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-8">
                    <div class="form-group">
                      <label>About Me</label>
                      <textarea rows="4" cols="80" class="form-control" placeholder="Here can be your description"
                        value="Mike">Lamborghini Mercy, Your chick she so thirsty, I'm in that two seat Lambo.</textarea>
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <div class="card-footer">
               <b-button type="submit" variant="info" size="sm"><i class="mdi mdi-check-circle-outline"></i>Salvar</b-button>
                    <b-button variant="secondary" size="sm" v-on:click="showFrmconstblusu()">Cancelar</b-button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'tblusu',
  data () {
    return {
      msg: 'Welcome to Your Vue.js App',
      items: [{
        text: '<i class="mdi mdi-account"></i> Início',
        href: '/dashboard'
      },
      {
        text: 'Cadastros',
        href: ''
      },
      {
        text: 'Usuários',
        href: ''
      }
      ]
    }
  }
}

</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
