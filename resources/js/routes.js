//authentication components
let login = require('./components/auth/login.vue').default;
let register = require('./components/auth/register.vue').default;
let logout = require('./components/auth/logout.vue').default;
let forget = require('./components/auth/forget.vue').default;
let newpassword = require('./components/auth/newpassword.vue').default;
let resetsuccess = require('./components/auth/resetsuccess.vue').default;

//home components
let home = require('./components/home.vue').default;
let NotFoundComponent = require('./components/notFound.vue').default;


//employee components
let addemployee = require('./components/employee/create.vue').default;
let allemployee = require('./components/employee/index.vue').default;
let editemployee = require('./components/employee/edit.vue').default;
let showemployee = require('./components/employee/show.vue').default;

//expense components
let addexpense = require('./components/expense/create.vue').default;
let allexpense = require('./components/expense/index.vue').default;
let editexpense = require('./components/expense/edit.vue').default;
let showexpense = require('./components/expense/show.vue').default;

//salary components
let employee = require('./components/salary/all_employee.vue').default;
let paysalary = require('./components/salary/pay_salary.vue').default;
let allsalary = require('./components/salary/index.vue').default;
let showsalary = require('./components/salary/show.vue').default;

//category components
let addcategory = require('./components/category/create.vue').default;
let allcategory = require('./components/category/index.vue').default;
let editcategory = require('./components/category/edit.vue').default;
let showcategory = require('./components/category/show.vue').default;

//supplier components
let addsupplier = require('./components/supplier/create.vue').default;
let allsupplier = require('./components/supplier/index.vue').default;
let editsupplier = require('./components/supplier/edit.vue').default;
let showsupplier = require('./components/supplier/show.vue').default;

//product components
let addproduct = require('./components/product/create.vue').default;
let allproduct = require('./components/product/index.vue').default;
let editproduct = require('./components/product/edit.vue').default;
let showproduct = require('./components/product/show.vue').default;

//stocks components
let stocks = require('./components/stocks/stocks.vue').default;
let editstocks = require('./components/stocks/edit.vue').default;

//customer components
let addcustomer = require('./components/customer/create.vue').default;
let allcustomer = require('./components/customer/index.vue').default;
let editcustomer = require('./components/customer/edit.vue').default;
let showcustomer = require('./components/customer/show.vue').default;

//pos components
let pos = require('./components/pos/pos.vue').default;

//order components
let order = require('./components/order/index.vue').default;
let bydayorder = require('./components/order/byday.vue').default;
let showorder = require('./components/order/show.vue').default;

export const routes = [
    //authentication routes
    {path: '/' , component: login, name: '/'},
    {path: '/register' , component: register, name: 'register'},
    {path: '/logout' , component: logout, name: 'logout'},
    {path: '/forget' , component: forget, name: 'forget'},
    {path: '/newpassword/:id' , component: newpassword, name: 'newpassword'},
    {path: '/resetsuccess/:id' , component: resetsuccess, name: 'resetsuccess'},

    //home route
    {path: '/home' , component: home, name: 'home'},
    { path: '*', component: NotFoundComponent },

    //employee routes
    {path: '/add-employee' , component: addemployee, name: 'add-employee'},
    {path: '/all-employee' , component: allemployee, name: 'all-employee'},
    {path: '/edit-employee/:id' , component: editemployee, name: 'edit-employee'},
    {path: '/show-employee/:id' , component: showemployee, name: 'show-employee'},

    //expense routes
    {path: '/add-expense' , component: addexpense, name: 'add-expense'},
    {path: '/all-expense' , component: allexpense, name: 'all-expense'},
    {path: '/edit-expense/:id' , component: editexpense, name: 'edit-expense'},
    {path: '/show-expense/:id' , component: showexpense, name: 'show-expense'},

    //salary routes
    {path: '/all-employee-salary' , component: employee, name: 'all-employee-salary'},
    {path: '/pay-salary/:id' , component: paysalary, name: 'pay-salary'},
    {path: '/all-salary' , component: allsalary, name: 'all-salary'},
    {path: '/show-salary/:id' , component: showsalary, name: 'show-salary'},

    //category routes
    {path: '/add-category' , component: addcategory, name: 'add-category'},
    {path: '/all-category' , component: allcategory, name: 'all-category'},
    {path: '/edit-category/:id' , component: editcategory, name: 'edit-category'},
    {path: '/show-category/:id' , component: showcategory, name: 'show-category'},

    //supplier routes
    {path: '/add-supplier' , component: addsupplier, name: 'add-supplier'},
    {path: '/all-supplier' , component: allsupplier, name: 'all-supplier'},
    {path: '/edit-supplier/:id' , component: editsupplier, name: 'edit-supplier'},
    {path: '/show-supplier/:id' , component: showsupplier, name: 'show-supplier'},

    //product routes
    {path: '/add-product' , component: addproduct, name: 'add-product'},
    {path: '/all-product' , component: allproduct, name: 'all-product'},
    {path: '/edit-product/:id' , component: editproduct, name: 'edit-product'},
    {path: '/show-product/:id' , component: showproduct, name: 'show-product'},
    
    //stocks routes
    {path: '/stocks' , component: stocks, name: 'stocks'},
    {path: '/edit-stocks/:id' , component: editstocks, name: 'edit-stocks'},

    //customer routes
    {path: '/add-customer' , component: addcustomer, name: 'add-customer'},
    {path: '/all-customer' , component: allcustomer, name: 'all-customer'},
    {path: '/edit-customer/:id' , component: editcustomer, name: 'edit-customer'},
    {path: '/show-customer/:id' , component: showcustomer, name: 'show-customer'},

    //pos routes
    {path: '/pos' , component: pos, name: 'pos'},

    //order routes
    {path: '/order' , component: order, name: 'order'},
    {path: '/byday-order/:id' , component: bydayorder, name: 'byday-order'},
    {path: '/show-order/:id' , component: showorder, name: 'show-order'},

]

