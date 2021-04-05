import axios from 'axios'

var API_URL = localStorage.getItem('API_URL')

class AuthService {
  login (user) {
    return axios
      .post(API_URL + 'login', {
        crossdomain: true,
        usunome: user.usunome,
        ususenha: user.ususenha
      })
      .then(response => {
        if (response.data.access_token) {
          localStorage.setItem('user', JSON.stringify(response.data))
        }
        return response.data
      })
  }
  logout () {
    localStorage.removeItem('user')
  }
  register (user) {
    return axios.post(API_URL + 'signup', {
      crossdomain: true,
      usunome: user.usunome,
      email: user.email,
      ususenha: user.ususenha
    })
  }
}

export default new AuthService()
