<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> SHOPEXPERT</title>


   <!--== Favicon ==-->
   <link rel="shortcut icon" href="{{asset('backend/dist/img/logo.png')}}" type="image/x-icon" />

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
 
<!--App Styles -->
<link rel="stylesheet" href="{{ asset('css/app.css') }}">

<!-- Font Awesome Icons -->
<link rel="stylesheet" href="{{asset('backend/plugins/fontawesome-free/css/all.min.css')}}">

<!-- Bootstrap 4 style -->
<link rel="stylesheet" href="{{asset('backend/dist/css/bootstrap.min.css')}}">

 <!-- overlayScrollbars -->
<link rel="stylesheet" href="{{asset('backend/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">

<!-- DataTables -->
<link rel="stylesheet" href="{{asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('backend/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">

<!-- Theme style -->
<link rel="stylesheet" href="{{asset('backend/dist/css/adminlte.min.css')}}">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div id="app" class="wrapper">

<!--     Preloader  -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="{{asset('backend/dist/img/logo.png')}}" alt="AdminLTELogo" height="60" width="60">
    </div> 

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light" id="topbar" style="display:none;" v-show="$route.path === '/' || 
        $route.path === '/register' || $route.path === '/forget' || 
        $route.matched.some(({ name }) => name === 'newpassword') || $route.matched.some(({ name }) => name === 'resetsuccess') || $route.path === '*' ? false : true">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
            <li class="nav-item">
            <router-link class="nav-link" to="/logout">Logout</router-link>
                <!-- <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                <i class="fas fa-th-large"></i>
                </a> -->
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4" id="leftsidebar" style="display:none;" v-show="$route.path === '/' || 
        $route.path === '/register' || $route.path === '/forget' || 
         $route.matched.some(({ name }) => name === 'newpassword') || $route.matched.some(({ name }) => name === 'resetsuccess') || $route.path === '*' ? false : true">
        <!-- Brand Logo -->
        <div>
        <?php
        $brand = DB::table('extra')->first();
        ?>
        <router-link to="/home" class="brand-link text-center">
            
            <span class="brand-text font-weight-light"><img src="{{asset('backend/dist/img/logo.png')}}" style="width:auto; height:37px" > </span>
        </router-link>

        </div>

        <!-- Sidebar -->
        <div class="sidebar">




            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">

                    <router-link to="/home" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </router-link>
                </li>

                <li class="nav-item menu-open">

                    <router-link to="/pos" class="nav-link">
                    <i class="nav-icon fas fa-cart-arrow-down"></i>
                        <p>POS</p>
                    </router-link>
                </li>

                <li class="nav-item menu-open">

                    <router-link to="/order" class="nav-link">
                    <i class="nav-icon fas fa-chart-line"></i>
                        <p>Order</p>
                    </router-link>
                </li>


                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p> Category
                            <i class="fas fa-angle-left right"></i>  
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <router-link to="/add-Category" class="nav-link">
                                <i class="nav-icon fas fa-file-alt"></i>
                                <p>Add Category</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/all-Category" class="nav-link">
                                <i class="nav-icon fas fa-file-alt"></i>
                                <p>All Categories</p>
                            </router-link>
                        </li>
                    
                    </ul>
                </li>

         
      
              

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p> Customer
                            <i class="fas fa-angle-left right"></i>  
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <router-link to="/add-customer" class="nav-link">
                                <i class="nav-icon fas fa-file-alt"></i>
                                <p>Add Customer</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/all-customer" class="nav-link">
                                <i class="nav-icon fas fa-file-alt"></i>
                                <p>All Customers</p>
                            </router-link>
                        </li>
                    
                    </ul>
                </li>


                

               

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p> Supplier
                            <i class="fas fa-angle-left right"></i>  
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <router-link to="/add-supplier" class="nav-link">
                                <i class="nav-icon fas fa-file-alt"></i>
                                <p>Add Supplier</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/all-supplier" class="nav-link">
                                <i class="nav-icon fas fa-file-alt"></i>
                                <p>All Suppliers</p>
                            </router-link>
                        </li>
                    
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p> Product
                            <i class="fas fa-angle-left right"></i>  
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <router-link to="/add-product" class="nav-link">
                                <i class="nav-icon fas fa-file-alt"></i>
                                <p>Add Product</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/all-product" class="nav-link">
                                <i class="nav-icon fas fa-file-alt"></i>
                                <p>All Product</p>
                            </router-link>
                        </li>
                    
                    </ul>
                </li>


                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p> Stocks
                            <i class="fas fa-angle-left right"></i>  
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <router-link to="/stocks" class="nav-link">
                                <i class="nav-icon fas fa-file-alt"></i>
                                <p>Stocks</p>
                            </router-link>
                        </li>
                      
                    
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p> Employee
                            <i class="fas fa-angle-left right"></i>  
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <router-link to="/add-employee" class="nav-link">
                                <i class="nav-icon fas fa-file-alt"></i>
                                <p>Add Employee</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/all-employee" class="nav-link">
                                <i class="nav-icon fas fa-file-alt"></i>
                                <p>All Employees</p>
                            </router-link>
                        </li>
                    
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p> Expense
                            <i class="fas fa-angle-left right"></i>  
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <router-link to="/add-expense" class="nav-link">
                                <i class="nav-icon fas fa-file-alt"></i>
                                <p>Add Expense</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/all-expense" class="nav-link">
                                <i class="nav-icon fas fa-file-alt"></i>
                                <p>All Expenses</p>
                            </router-link>
                        </li>
                    
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p> Salary
                            <i class="fas fa-angle-left right"></i>  
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <router-link to="/all-employee-salary" class="nav-link">
                                <i class="nav-icon fas fa-file-alt"></i>
                                <p>Pay Salary</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/all-salary" class="nav-link">
                                <i class="nav-icon fas fa-file-alt"></i>
                                <p>All Salaries</p>
                            </router-link>
                        </li>
                    
                    </ul>
                </li>

                
                



            
                
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    
        <router-view></router-view>
    

    

    
    <footer class="main-footer" id="appfooter" style="display:none;" v-show="$route.path === '/' || 
        $route.path === '/register' || $route.path === '/forget' || 
        $route.matched.some(({ name }) => name === 'newpassword') || $route.matched.some(({ name }) => name === 'resetsuccess') || $route.path === '*' ? false : true">
        <strong>Copyright &copy; 2021.</strong>
        All rights reserved.
        
    </footer>

     <!-- Control Sidebar
    <aside class="control-sidebar control-sidebar-dark" id="controllsidebar" v-show="$route.path === '/' || 
        $route.path === '/register' || $route.path === '/forget' || 
        $route.path === '/newpassword' || $route.path === '/resetsuccess' ? false : true">
 

        <div class="p-3">
      <div class="info clearfix">
 
                    <h5 class="name">Name</h5>
                    <span class="email">Email</span>

            </div> 
            <div class="">
              
            </div>
        </div>
    </aside>
  /.control-sidebar -->



</div>
<!-- ./wrapper -->



   <!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{asset('backend/plugins/jquery/jquery.min.js')}}"></script>
<!-- App Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<!-- DataTables  & Plugins -->
<script src="{{asset('backend/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('backend/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('backend/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('backend/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

<!-- Bootstrap 4 -->
<script src="{{asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- overlayScrollbars -->
<script src="{{asset('backend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>

<!-- Toastr -->
<script src="{{asset('backend/plugins/toastr/toastr.min.js')}}"></script>

<!-- sweetalert -->
<script src="{{asset('backend/plugins/sweetalert/sweetalert.min.js')}}"></script>

<!-- AdminLTE for demo purposes -->
<script src="{{asset('backend/dist/js/demo.js')}}"></script>

<!-- AdminLTE App -->
<script src="{{asset('backend/dist/js/adminlte.min.js')}}"></script>


   

<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>



@if(Session::has('message'))
        <script>
            var type = "{{ Session::get('alert-type', 'info') }}";
            switch(type){
                case 'info':
                    toastr.info("{{ Session::get('message') }}");
                    break;

                case 'success':
                    toastr.success("{{ Session::get('message') }}");
                    break;

                case 'warning':
                    toastr.warning("{{ Session::get('message') }}");
                    break;

                case 'error':
                    toastr.error("{{ Session::get('message') }}");
                    break;
            }
            </script>
        @endif


        <script>
       $('.delete').on('click', function(){

        let form_id = $(this).data('form-id');

        swal({
            title: "Are you sure?",
            text: "Once deleted, this will be deleted permanently!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $('#'+form_id).submit();
                swal("File has been deleted!", {
                icon: "success",
                });

            } else {
                swal("File is safe!");
            }
        }); 

    });

</script>

<script>
$('div.alert').not('.alert-important').delay(3000).fadeOut(350);
</script>

<script>
    
        let token = localStorage.getItem('token')

        if (token) {
            $("#topbar").css("display", "")
            $("#leftsidebar").css("display", "")
            $("#appfooter").css("display", "")
        }

</script>

</body>
</html>
