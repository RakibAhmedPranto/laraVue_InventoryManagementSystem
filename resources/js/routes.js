// auth Components
let login = require('./components/auth/login.vue').default;
let register = require('./components/auth/register.vue').default;
let forget = require('./components/auth/forgetPassword.vue').default;
let logout = require('./components/auth/logout.vue').default;


//dashboard Components
let home = require('./components/Home.vue').default;

//Employee Components
let employeeCreate = require('./components/employee/create.vue').default;
let employeeIndex = require('./components/employee/index.vue').default;


export const routes = [
    { path: '/', component: login, name:'/' },
    { path: '/register', component: register, name:'register' },
    { path: '/forget', component: forget, name:'forget' },
    { path: '/logout', component: logout, name:'logout' },
    { path: '/home', component: home, name:'home' },
    { path: '/employee/create', component: employeeCreate, name:'employee.create' },
    { path: '/employee', component: employeeIndex, name:'employee' },
  ]
