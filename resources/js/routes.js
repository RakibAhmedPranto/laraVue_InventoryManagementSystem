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

//Product Components
let productCreate = require('./components/product/create.vue').default;
let productEdit = require('./components/product/edit.vue').default;
let productIndex = require('./components/product/index.vue').default;

//Customer Components
let customerCreate = require('./components/customer/create.vue').default;
let customerEdit = require('./components/customer/edit.vue').default;
let customerIndex = require('./components/customer/index.vue').default;

//Expense Components
let expenseCreate = require('./components/expense/create.vue').default;
let expenseEdit = require('./components/expense/edit.vue').default;
let expenseIndex = require('./components/expense/index.vue').default;
//stock Components

let stockUpdate = require('./components/stock/updateStock.vue').default;
let stockIndex = require('./components/stock/index.vue').default;

//Salary Components
let salary = require('./components/salary/allEmployee.vue').default;
let paySalary = require('./components/salary/create.vue').default;
let allSalary = require('./components/salary/index.vue').default;
let salaryDetail = require('./components/salary/salaryDetail.vue').default;

//pos

let pos = require('./components/pos/index.vue').default;



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
    //product routes
    { path: '/product/create', component: productCreate, name:'product.create' },
    { path: '/product/edit/:id', component: productEdit, name:'product.edit' },
    { path: '/product', component: productIndex, name:'product' },
    //customer routes
    { path: '/customer/create', component: customerCreate, name:'customer.create' },
    { path: '/customer/edit/:id', component: customerEdit, name:'customer.edit' },
    { path: '/customer', component: customerIndex, name:'customer' },
    //expense routes
    { path: '/expense/create', component: expenseCreate, name:'expense.create' },
    { path: '/expense/edit/:id', component: expenseEdit, name:'expense.edit' },
    { path: '/expense', component: expenseIndex, name:'expense' },
    //salary routes
    { path: '/salary/given', component: salary, name:'salary.given' },
    { path: '/salary', component: allSalary, name:'salary' },
    { path: '/salary/pay/:id', component: paySalary, name:'salary.pay' },
    { path: '/salary/detail/:id', component: salaryDetail, name:'salary.detail' },

    //srock routes
    { path: '/stock/update/:id', component: stockUpdate, name:'stock.update' },
    { path: '/stock', component: stockIndex, name:'stock' },

    //pos
    { path: '/pos', component: pos, name:'pos' },

  ]
