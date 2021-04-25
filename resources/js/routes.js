// auth Components
let login = require('./components/auth/login.vue').default;
let register = require('./components/auth/register.vue').default;
let forget = require('./components/auth/forgetPassword.vue').default;
let logout = require('./components/auth/logout.vue').default;


//dashboard Components
let home = require('./components/Home.vue').default;

//Employee Components
let employeeCreate = require('./components/employee/create.vue').default;
let employeeEdit = require('./components/employee/edit.vue').default;
let employeeIndex = require('./components/employee/index.vue').default;
//Supplier Components
let supplierCreate = require('./components/supplier/create.vue').default;
let supplierEdit = require('./components/supplier/edit.vue').default;
let supplierIndex = require('./components/supplier/index.vue').default;
//Category Components
let categoryCreate = require('./components/category/create.vue').default;
let categoryEdit = require('./components/category/edit.vue').default;
let categoryIndex = require('./components/category/index.vue').default;


export const routes = [
    { path: '/', component: login, name:'/' },
    { path: '/register', component: register, name:'register' },
    { path: '/forget', component: forget, name:'forget' },
    { path: '/logout', component: logout, name:'logout' },
    { path: '/home', component: home, name:'home' },

    //employee routes
    { path: '/employee/create', component: employeeCreate, name:'employee.create' },
    { path: '/employee/edit/:id', component: employeeEdit, name:'employee.edit' },
    { path: '/employee', component: employeeIndex, name:'employee' },
    //supplier routes
    { path: '/supplier/create', component: supplierCreate, name:'supplier.create' },
    { path: '/supplier/edit/:id', component: supplierEdit, name:'supplier.edit' },
    { path: '/supplier', component: supplierIndex, name:'supplier' },
    //category routes
    { path: '/category/create', component: categoryCreate, name:'category.create' },
    { path: '/category/edit/:id', component: categoryEdit, name:'category.edit' },
    { path: '/category', component: categoryIndex, name:'category' },
  ]
