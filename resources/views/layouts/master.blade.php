<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8" />
    <title>APLIKASI ABSENSI | @yield('title','Dashboard')</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />

    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="{{asset('assets/assets/plugins/jquery-ui/jquery-ui.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/img/favicon.png')}}" rel="shortcut icon">
    <link href="{{asset('assets/assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/assets/plugins/font-awesome/css/all.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/assets/plugins/animate/animate.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/assets/css/default/style.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/assets/css/default/style-responsive.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/assets/css/default/theme/default.css')}}" rel="stylesheet" id="theme" />
    <!-- ================== END BASE CSS STYLE ================== -->

    <!-- ================== BEGIN PAGE LEVEL CSS STYLE ================== -->
    <link href="{{asset('assets/assets/plugins/jquery-jvectormap/jquery-jvectormap.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/assets/plugins/bootstrap-calendar/css/bootstrap_calendar.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/assets/plugins/gritter/css/jquery.gritter.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/assets/plugins/nvd3/build/nv.d3.css')}}" rel="stylesheet" />
    <!-- ================== END PAGE LEVEL CSS STYLE ================== -->
    <link rel="stylesheet" href="{{asset('assets/css/sweetalert.css')}}">



    <link href="{{asset('assets/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/assets/plugins/ionRangeSlider/css/ion.rangeSlider.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/assets/plugins/ionRangeSlider/css/ion.rangeSlider.skinNice.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/assets/plugins/password-indicator/css/password-indicator.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/assets/plugins/bootstrap-combobox/css/bootstrap-combobox.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/assets/plugins/bootstrap-select/bootstrap-select.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/assets/plugins/jquery-tag-it/css/jquery.tagit.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/assets/plugins/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/assets/plugins/select2/dist/css/select2.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/assets/plugins/bootstrap-eonasdan-datetimepicker/build/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/assets/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker-fontawesome.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker-glyphicons.css')}}" rel="stylesheet" />
    <!-- ================== BEGIN BASE JS ================== -->
    <script src="{{asset('assets/assets/plugins/pace/pace.min.js')}}"></script>
    <!-- <link href="{{asset('css/custom.css')}}" rel="stylesheet" /> -->
    <link href="{{asset('assets/css/custom.css')}}" rel="stylesheet" />
    <!-- ================== END BASE JS ================== -->

    @yield('plugins_styles')
    <!-- THEME STYLES-->
    <!-- PAGE LEVEL STYLES-->
    @yield('page_styles')
</head>

<body>
    <!-- begin #page-loader -->
    <div id="page-loader" class="fade show"><span class="spinner"></span></div>
    <!-- end #page-loader -->

    <!-- begin #page-container -->
    <div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
        <!-- begin #header -->
        <div id="header" class="header navbar-default">
            <!-- begin navbar-header -->
            <div class="navbar-header">
                <a href="{{url('/dashboard')}}" class="navbar-brand"><img src="{{asset('assets/img/favicon.png')}}"> <b>APLIKASI</b> ABSENSI</a>
                <button type="button" class="navbar-toggle" data-click="sidebar-toggled">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <!-- end navbar-header -->

            <!-- begin header-nav -->
            <ul class="navbar-nav navbar-right">


                <li class="dropdown navbar-user">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{asset('assets/img/users/user.png')}}" alt="" />
                        <span class="d-none d-md-inline">{{Auth::user()->nama}}</span> <b class="caret"></b>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <!-- <a href="javascript:;" class="dropdown-item">Edit Profile</a> -->
                        <!-- <div class="dropdown-divider"></div> -->
                        <a href="{{url('/auth/logout')}}" class="dropdown-item">Log Out</a>
                    </div>
                </li>
            </ul>
            <!-- end header navigation right -->
        </div>
        <!-- end #header -->

        <!-- begin #sidebar -->
        {{-- START SIDEBAR --}}
        @include('includes.sidebar')
        {{-- END SIDEBAR --}}
        <div class="sidebar-bg"></div>
        <!-- end #sidebar -->

        <!-- begin #content -->
        @yield('content')
        <!-- end #content -->

        <!-- begin theme-panel -->
        <div class="theme-panel theme-panel-lg">
            <a href="javascript:;" data-click="theme-panel-expand" class="theme-collapse-btn"><i class="fa fa-cog"></i></a>
            <div class="theme-panel-content">
                <h5 class="m-t-0">Color Theme</h5>
                <ul class="theme-list clearfix">
                    <li><a href="javascript:;" class="bg-red" data-theme="red" data-theme-file="{{asset('assets/assets/css/default/theme/red.css')}}" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Red">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-pink" data-theme="pink" data-theme-file="{{asset('assets/assets/css/default/theme/pink.css')}}" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Pink">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-orange" data-theme="orange" data-theme-file="{{asset('assets/assets/css/default/theme/orange.css')}}" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Orange">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-yellow" data-theme="yellow" data-theme-file="{{asset('assets/assets/css/default/theme/yellow.css')}}" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Yellow">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-lime" data-theme="lime" data-theme-file="{{asset('assets/assets/css/default/theme/lime.css')}}" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Lime">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-green" data-theme="green" data-theme-file="{{asset('assets/assets/css/default/theme/green.css')}}" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Green">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-teal" data-theme="default" data-theme-file="{{asset('assets/assets/css/default/theme/default.css')}}" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Default">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-aqua" data-theme="aqua" data-theme-file="{{asset('assets/assets/css/default/theme/aqua.css')}}" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Aqua">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-blue" data-theme="blue" data-theme-file="{{asset('assets/assets/css/default/theme/blue.css')}}" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Blue">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-purple" data-theme="purple" data-theme-file="{{asset('assets/assets/css/default/theme/purple.css')}}" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Purple">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-indigo" data-theme="indigo" data-theme-file="{{asset('assets/assets/css/default/theme/indigo.css')}}" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Indigo">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-black" data-theme="black" data-theme-file="{{asset('assets/assets/css/default/theme/black.css')}}" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Black">&nbsp;</a></li>
                </ul>
                <div class="divider"></div>
                <div class="row m-t-10">
                    <div class="col-md-6 control-label text-inverse f-w-600">Header Styling</div>
                    <div class="col-md-6">
                        <select name="header-styling" class="form-control form-control-sm">
                            <option value="1">default</option>
                            <option value="2">inverse</option>
                        </select>
                    </div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-6 control-label text-inverse f-w-600">Header</div>
                    <div class="col-md-6">
                        <select name="header-fixed" class="form-control form-control-sm">
                            <option value="1">fixed</option>
                            <option value="2">default</option>
                        </select>
                    </div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-6 control-label text-inverse f-w-600">Sidebar Styling</div>
                    <div class="col-md-6">
                        <select name="sidebar-styling" class="form-control form-control-sm">
                            <option value="1">default</option>
                            <option value="2">grid</option>
                        </select>
                    </div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-6 control-label text-inverse f-w-600">Sidebar</div>
                    <div class="col-md-6">
                        <select name="sidebar-fixed" class="form-control form-control-sm">
                            <option value="1">fixed</option>
                            <option value="2">default</option>
                        </select>
                    </div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-6 control-label text-inverse f-w-600">Sidebar Gradient</div>
                    <div class="col-md-6">
                        <select name="content-gradient" class="form-control form-control-sm">
                            <option value="1">disabled</option>
                            <option value="2">enabled</option>
                        </select>
                    </div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-6 control-label text-inverse f-w-600">Content Styling</div>
                    <div class="col-md-6">
                        <select name="content-styling" class="form-control form-control-sm">
                            <option value="1">default</option>
                            <option value="2">black</option>
                        </select>
                    </div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-6 control-label text-inverse f-w-600">Direction</div>
                    <div class="col-md-6">
                        <select name="direction" class="form-control form-control-sm">
                            <option value="1">LTR</option>
                            <option value="2">RTL</option>
                        </select>
                    </div>
                </div>
                <div class="divider"></div>
                <div class="divider"></div>
                <div class="row m-t-10">
                    <div class="col-md-12">
                        <a href="javascript:;" class="btn btn-inverse btn-block btn-rounded" data-click="reset-local-storage"><b>Reset Local Storage</b></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- end theme-panel -->

        <!-- begin scroll to top btn -->
        <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>

        <!-- end scroll to top btn -->
    </div>
    <!-- end page container -->


    <div class="to-top"><i class="fa fa-angle-double-up"></i></div>

    <div id="footer" class="footer">
        © {{date('Y')}} | Aplikasi Absen PT Indra Karya
    </div>
    <!-- ================== BEGIN BASE JS ================== -->
    <script src="{{asset('assets/assets/plugins/jquery/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('assets/assets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    <script src="{{asset('assets/assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/js/angular.min.js')}}"></script>
    <!--[if lt IE 9]>
		<script src="{{asset('')}}assets/assets/crossbrowserjs/html5shiv.js"></script>
		<script src="{{asset('')}}assets/assets/crossbrowserjs/respond.min.js"></script>
		<script src="{{asset('')}}assets/assets/crossbrowserjs/excanvas.min.js"></script>
	<![endif]-->
    <script src="{{asset('assets/assets/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
    <script src="{{asset('assets/assets/plugins/js-cookie/js.cookie.js')}}"></script>
    <script src="{{asset('assets/assets/js/theme/default.min.js')}}"></script>
    <script src="{{asset('assets/assets/js/apps.min.js')}}"></script>
    <!-- ================== END BASE JS ================== -->

    <!-- ================== BEGIN PAGE LEVEL JS ================== -->
    <script src="{{asset('assets/assets/plugins/d3/d3.min.js')}}"></script>
    <script src="{{asset('assets/assets/plugins/nvd3/build/nv.d3.js')}}"></script>
    <script src="{{asset('assets/assets/plugins/jquery-jvectormap/jquery-jvectormap.min.js')}}"></script>
    <script src="{{asset('assets/assets/plugins/jquery-jvectormap/jquery-jvectormap-world-merc-en.js')}}"></script>
    <script src="{{asset('assets/assets/plugins/bootstrap-calendar/js/bootstrap_calendar.min.js')}}"></script>
    <script src="{{asset('assets/assets/plugins/gritter/js/jquery.gritter.js')}}"></script>
    <script src="{{asset('assets/assets/js/demo/dashboard-v2.min.js')}}"></script>
    <!-- ================== END PAGE LEVEL JS ================== -->
    <script src="{{asset('assets/js/sweetalert.js')}}"></script>


    <script src="{{asset('assets/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
    <script src="{{asset('assets/assets/plugins/ionRangeSlider/js/ion-rangeSlider/ion.rangeSlider.min.js')}}"></script>
    <script src="{{asset('assets/assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
    <script src="{{asset('assets/assets/plugins/masked-input/masked-input.min.js')}}"></script>
    <script src="{{asset('assets/assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js')}}"></script>
    <script src="{{asset('assets/assets/plugins/password-indicator/js/password-indicator.js')}}"></script>
    <script src="{{asset('assets/assets/plugins/bootstrap-combobox/js/bootstrap-combobox.js')}}"></script>
    <script src="{{asset('assets/assets/plugins/bootstrap-select/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('assets/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js')}}"></script>
    <script src="{{asset('assets/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput-typeahead.js')}}"></script>
    <script src="{{asset('assets/assets/plugins/jquery-tag-it/js/tag-it.min.js')}}"></script>
    <script src="{{asset('assets/assets/plugins/bootstrap-daterangepicker/moment.js')}}"></script>
    <script src="{{asset('assets/assets/plugins/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    <script src="{{asset('assets/assets/plugins/select2/dist/js/select2.min.js')}}"></script>
    <script src="{{asset('assets/assets/plugins/bootstrap-eonasdan-datetimepicker/build/js/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="{{asset('assets/assets/plugins/bootstrap-show-password/bootstrap-show-password.js')}}"></script>
    <script src="{{asset('assets/assets/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js')}}"></script>
    <script src="{{asset('assets/assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker.js')}}"></script>
    <script src="{{asset('assets/assets/plugins/clipboard/clipboard.min.js')}}"></script>
    <script src="{{asset('assets/assets/js/demo/form-plugins.demo.min.js')}}"></script>
    @include('sweetalert::alert')

    @yield('plugins_scripts')
    <!-- CORE SCRIPTS-->
    <!-- PAGE LEVEL SCRIPTS-->
    @yield('page_scripts')
    <script>
        $(document).ready(function() {
            App.init();
            DashboardV2.init();
            FormPlugins.init();
        });
    </script>
</body>

</html>