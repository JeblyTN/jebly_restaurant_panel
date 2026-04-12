<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" <?php if (str_replace('_', '-', app()->getLocale()) == 'ar' || @$_COOKIE['is_rtl'] == 'true') { ?> dir="rtl" <?php } ?>>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title id="app_name"><?php echo @$_COOKIE['meta_title']; ?></title>
        <link rel="icon" id="favicon" type="image/x-icon" href="<?php echo str_replace('images/', 'images%2F', @$_COOKIE['favicon']); ?>">
        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        <!-- Styles -->
        <link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.min.css">
        <?php if (str_replace('_', '-', app()->getLocale()) == 'ar' || @$_COOKIE['is_rtl'] == 'true') { ?>
        <link href="{{ asset('assets/plugins/bootstrap/css/bootstrap-rtl.min.css') }}" rel="stylesheet">
        <?php } ?>
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <?php if (str_replace('_', '-', app()->getLocale()) == 'ar' || @$_COOKIE['is_rtl'] == 'true') { ?>
        <link href="{{ asset('css/style_rtl.css') }}" rel="stylesheet">
        <?php } ?>
        <link href="{{ asset('css/icons/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/plugins/toast-master/css/jquery.toast.css') }}" rel="stylesheet">
        <link href="{{ asset('css/colors/blue.css') }}" rel="stylesheet">
        <link href="{{ asset('css/chosen.css') }}" rel="stylesheet">
        <link href="{{ asset('css/bootstrap-tagsinput.css') }}" rel="stylesheet">
        <link href="{{ asset('css/toastr.min.css')}}" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
        <link href="{{ asset('assets/plugins/select2/dist/css/select2.min.css') }}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Urbanist:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

        <!--  @yield('style')-->

        <?php if (isset($_COOKIE['store_panel_color'])) { ?>

        <style type="text/css">
            .topbar {
                background:
                    <?php echo $_COOKIE['store_panel_color']; ?>;
            }

            .sidebar-nav ul li a {
                border-bottom:
                    <?php echo $_COOKIE['store_panel_color']; ?>;
            }

            .sidebar-nav ul li a:hover i {
                color:
                    <?php echo $_COOKIE['store_panel_color']; ?>;
            }

            .restaurant_payout_create-inner fieldset legend {
                background:
                    <?php echo $_COOKIE['store_panel_color']; ?>;
            }

            a {
                color:
                    <?php echo $_COOKIE['store_panel_color']; ?>;
            }

            a:hover,
            a:focus {
                color:
                    <?php echo $_COOKIE['store_panel_color']; ?>;
            }

            a.link:hover,
            a.link:focus {
                color:
                    <?php echo $_COOKIE['store_panel_color']; ?>;
            }

            html body blockquote {
                border-left: 5px solid<?php echo $_COOKIE['store_panel_color']; ?>;
            }

            .text-warning {
                color:
                    <?php echo $_COOKIE['store_panel_color']; ?> !important;
            }

            .text-info {
                color:
                    <?php echo $_COOKIE['store_panel_color']; ?> !important;
            }

            .sidebar-nav ul li a:hover {
                color:
                    <?php echo $_COOKIE['store_panel_color']; ?>;
            }

            .btn-primary {
                background:
                    <?php echo $_COOKIE['store_panel_color']; ?>;
                border: 1px solid<?php echo $_COOKIE['store_panel_color']; ?>;
            }

            .sidebar-nav>ul>li.active>a {
                color:
                    <?php echo $_COOKIE['store_panel_color']; ?>;
                border-left: 3px solid<?php echo $_COOKIE['store_panel_color']; ?>;
            }

            .sidebar-nav>ul>li.active>a i {
                color:
                    <?php echo $_COOKIE['store_panel_color']; ?>;
            }

            .bg-info {
                background-color:
                    <?php echo $_COOKIE['store_panel_color']; ?> !important;
            }

            .bellow-text ul li>span {
                color:
                    <?php echo $_COOKIE['store_panel_color']; ?>
            }

            .table tr td.redirecttopage {
                color:
                    <?php echo $_COOKIE['store_panel_color']; ?>
            }

            ul.rating {
                color:
                    <?php echo $_COOKIE['store_panel_color']; ?>;
            }

            nav-link.active {
                background-color:
                    <?php echo $_COOKIE['store_panel_color']; ?>;
            }

            .nav-tabs.card-header-tabs .nav-link:hover {
                background:
                    <?php echo $_COOKIE['store_panel_color']; ?>;
            }

            .nav-tabs .nav-item.show .nav-link,
            .nav-tabs .nav-link.active {
                color: #fff;
                background:
                    <?php echo $_COOKIE['store_panel_color']; ?>;
            }

            .btn-warning,
            .btn-warning.disabled {
                background:
                    <?php echo $_COOKIE['store_panel_color']; ?>;
                border: 1px solid<?php echo $_COOKIE['store_panel_color']; ?>;
                box-shadow: none;
            }

            .payment-top-tab .nav-tabs.card-header-tabs .nav-link.active,
            .payment-top-tab .nav-tabs.card-header-tabs .nav-link:hover {
                border-color:
                    <?php echo $_COOKIE['store_panel_color']; ?>;
            }

            .nav-tabs.card-header-tabs .nav-link span.badge-success {
                background:
                    <?php echo $_COOKIE['store_panel_color']; ?>;
            }

            .nav-tabs.card-header-tabs .nav-link.active span.badge-success,
            .nav-tabs.card-header-tabs .nav-link:hover span.badge-success,
            .sidebar-nav ul li a.active,
            .sidebar-nav ul li a.active:hover,
            .sidebar-nav ul li.active a.has-arrow:hover,
            .topbar ul.dropdown-user li a:hover {
                color:
                    <?php echo $_COOKIE['store_panel_color']; ?>;
            }

            .sidebar-nav ul li a.has-arrow:hover::after,
            .sidebar-nav .active>.has-arrow::after,
            .sidebar-nav li>.has-arrow.active::after,
            .sidebar-nav .has-arrow[aria-expanded="true"]::after,
            .sidebar-nav ul li a:hover {
                border-color:
                    <?php echo $_COOKIE['store_panel_color']; ?>;
            }

            [type="checkbox"]:checked+label::before {
                border-right: 2px solid<?php echo $_COOKIE['store_panel_color']; ?>;
                border-bottom: 2px solid<?php echo $_COOKIE['store_panel_color']; ?>;
            }

            .btn-primary:hover,
            .btn-primary.disabled:hover {
                background:
                    <?php echo $_COOKIE['store_panel_color']; ?>;
                border: 1px solid<?php echo $_COOKIE['store_panel_color']; ?>;
            }

            .btn-primary.active,
            .btn-primary:active,
            .btn-primary:focus,
            .btn-primary.disabled.active,
            .btn-primary.disabled:active,
            .btn-primary.disabled:focus,
            .btn-primary.active.focus,
            .btn-primary.active:focus,
            .btn-primary.active:hover,
            .btn-primary.focus:active,
            .btn-primary:active:focus,
            .btn-primary:active:hover,
            .open>.dropdown-toggle.btn-primary.focus,
            .open>.dropdown-toggle.btn-primary:focus,
            .open>.dropdown-toggle.btn-primary:hover,
            .btn-primary.focus,
            .btn-primary:focus,
            .btn-primary:not(:disabled):not(.disabled).active:focus,
            .btn-primary:not(:disabled):not(.disabled):active:focus,
            .show>.btn-primary.dropdown-toggle:focus,
            .btn-warning:hover,
            .btn-warning:hover,
            .btn-warning.disabled:hover,
            .btn-warning.active.focus,
            .btn-warning.active:focus,
            .btn-warning.active:hover,
            .btn-warning.focus:active,
            .btn-warning:active:focus,
            .btn-warning:active:hover,
            .open>.dropdown-toggle.btn-warning.focus,
            .open>.dropdown-toggle.btn-warning:focus,
            .open>.dropdown-toggle.btn-warning:hover,
            .btn-warning.focus,
            .btn-warning:focus {
                background:
                    <?php echo $_COOKIE['store_panel_color']; ?>;
                border-color:
                    <?php echo $_COOKIE['store_panel_color']; ?>;
                box-shadow: 0 0 0 0.2rem<?php echo $_COOKIE['store_panel_color']; ?>;
            }

            .language-options select option,
            .pagination>li>a.page-link:hover {
                background:
                    <?php echo $_COOKIE['store_panel_color']; ?>;
            }

            .nav-tabs.card-header-tabs .active.nav-item .nav-link {
                color: #fff;
                background:
                    <?php echo $_COOKIE['store_panel_color']; ?>;
            }

            .print-btn button {
                border: 2px solid<?php echo $_COOKIE['store_panel_color']; ?>;
                color:
                    <?php echo $_COOKIE['store_panel_color']; ?>;
            }

            .business-analytics .card-box i {
                background:
                    <?php echo $_COOKIE['store_panel_color']; ?>;
            }

            .order-status .data i,
            .order-status span.count {
                color:
                    <?php echo $_COOKIE['store_panel_color']; ?>;
            }
            [type="radio"]:checked + label::after, [type="radio"].with-gap:checked + label::after {
                background-color: <?php echo $_COOKIE['store_panel_color']; ?>;
            }
            [type="radio"]:checked + label::after, [type="radio"].with-gap:checked + label::before, [type="radio"].with-gap:checked + label::after {border: 2px solid <?php echo $_COOKIE['store_panel_color']; ?>;
            }
             .pagination > li > a.page-link:hover, .pagination > .active > a, .pagination > .active > span, .pagination > .active > a:hover, .pagination > .active > span:hover, .pagination > .active > a:focus, .pagination > .active > span:focus, .page-item.active .page-link{
                background: <?php echo $_COOKIE['store_panel_color']; ?>;
                border-color: <?php echo $_COOKIE['store_panel_color']; ?>;
             }
             
            @media screen and (max-width: 767px) {

                .mini-sidebar .sidebar-nav ul li a:hover,
                .sidebar-nav>ul>li.active>a {
                    color:
                        <?php echo $_COOKIE['store_panel_color']; ?> !important;
                }
            }
        </style>
        <?php } ?>

    </head>

    <body>

        <div id="app" class="fix-header fix-sidebar card-no-border">
            <div id="main-wrapper">
                <div id="data-table_processing" class="page-overlay" style="display:none;">
                    <div class="overlay-text">
                        <img src="{{ asset('images/spinner.gif') }}">
                    </div>
                </div>
                <header class="topbar">
                    <nav class="navbar top-navbar navbar-expand-md navbar-light">
                        @include('layouts.header')
                    </nav>
                </header>
                <aside class="left-sidebar">
                    <!-- Sidebar scroll-->
                    <div class="scroll-sidebar">
                        @include('layouts.menu')
                    </div>
                    <!-- End Sidebar scroll-->
                </aside>
            </div>

            <main class="py-4">
                @yield('content')
            </main>

            <div class="modal fade" id="notification_add_order" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered notification-main" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title order_placed_subject" id="exampleModalLongTitle"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h6><span id="auth_accept_name" class="order_placed_msg"></span></h6>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary"><a href="{{ url('orders') }}" id="notification_add_order_a">{{trans('lang.go')}}</a></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="notification_rejected_order" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered notification-main" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">{{trans('lang.order_rejected')}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h6>{{trans('lang.there_have_new_order_rejected')}}</h6>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary"><a href="{{ url('orders') }}">{{trans('lang.go')}}</a></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="notification_accepted_order" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered notification-main" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title driver_accepted_subject" id="exampleModalLongTitle"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h6><span id="np_accept_name" class="driver_accepted_msg"></span></h6>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary"><a href="{{ url('orders') }}" id="notification_accepted_a">{{trans('lang.go')}}</a></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="notification_completed_order" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered notification-main" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">{{trans('lang.order_completed')}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h6>>{{trans('lang.order_has_been_order_accepted')}}</h6>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary"><a href="{{ url('orders') }}">{{trans('lang.go')}}</a></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="notification_book_table_add_order" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered notification-main" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title dinein_order_placed_subject" id="exampleModalLongTitle"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h6><span id="auth_accept_name_book_table" class="dinein_order_placed_msg"></span></h6>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary"><a href="{{ url('booktable') }}" id="notification_book_table_add_order_a">{{trans('lang.go')}}</a>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="advertisement_accepted_notification" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered notification-main" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title advertisement_accepted_sub" id="exampleModalLongTitle"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h6><span id="advertisement_accepted_msg" class="advertisement_accepted_msg"></span></h6>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary"><a href="{{ url('advertisement') }}" id="advertisement_accepted_route">{{trans('lang.go')}}</a></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="advertisement_canceled_notification" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered notification-main" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title advertisement_cancelled_sub" id="exampleModalLongTitle"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h6><span id="advertisement_cancelled_msg" class="advertisement_cancelled_msg"></span></h6>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary"><a href="{{ url('advertisement') }}" id="advertisement_canceled_route">{{trans('lang.go')}}</a></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="advertisement_paused_notification" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered notification-main" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title advertisement_paused_sub" id="exampleModalLongTitle"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h6><span id="advertisement_paused_msg" class="advertisement_paused_msg"></span></h6>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary"><a href="{{ url('advertisement') }}" id="advertisement_paused_route">{{trans('lang.go')}}</a></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="advertisement_resumed_notification" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered notification-main" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title advertisement_resumed_sub" id="exampleModalLongTitle"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h6><span id="advertisement_resumed_msg" class="advertisement_resumed_msg"></span></h6>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary"><a href="{{ url('advertisement') }}" id="advertisement_resumed_route">{{trans('lang.go')}}</a></button>
                    </div>
                </div>
            </div>
        </div>
        </div>

        <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/bootstrap/js/popper.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/jquery.slimscroll.js') }}"></script>
        <script src="{{ asset('js/waves.js') }}"></script>
        <script src="{{ asset('js/sidebarmenu.js') }}"></script>
        <script src="{{ asset('assets/plugins/sticky-kit-master/dist/sticky-kit.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
        <script src="{{ asset('js/custom.min.js') }}"></script>
        <script src="{{ asset('js/jquery.resizeImg.js') }}"></script>
        <script src="{{ asset('assets/plugins/select2/dist/js/select2.min.js') }}"></script>
        <script src="{{ asset('js/toastr.min.js') }}"></script>

        <script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js"></script>
        <script type="text/javascript">
            jQuery(window).scroll(function() {
                var scroll = jQuery(window).scrollTop();
                if (scroll <= 60) {
                    jQuery("body").removeClass("sticky");
                } else {
                    jQuery("body").addClass("sticky");
                }
            });            
        </script>
        <script src="https://www.gstatic.com/firebasejs/9.23.0/firebase-app-compat.js"></script>
        <script src="https://www.gstatic.com/firebasejs/9.23.0/firebase-firestore-compat.js"></script>
        <script src="https://www.gstatic.com/firebasejs/9.23.0/firebase-storage-compat.js"></script>
        <script src="https://www.gstatic.com/firebasejs/9.23.0/firebase-auth-compat.js"></script>
        <script src="https://www.gstatic.com/firebasejs/9.23.0/firebase-database-compat.js"></script>
        <script src="{{ asset('js/geofirestore.js') }}"></script>
        <script src="https://cdn.firebase.com/libs/geofire/5.0.1/geofire.min.js"></script>
        <script src="{{ asset('js/crypto-js.js') }}"></script>
        <script src="{{ asset('js/jquery.cookie.js') }}"></script>
        <script src="{{ asset('js/jquery.validate.js') }}"></script>
        <script src="{{ asset('js/chosen.jquery.js') }}"></script>
        <script src="{{ asset('js/bootstrap-tagsinput.js') }}"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
        <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.1/xlsx.full.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.24/jspdf.plugin.autotable.min.js"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

        @yield('scripts')

        <script type="text/javascript">

            var vendorUserId = "{{ $vendorUserId }}";
            var authRole = "{{ $authRole }}";
            var empVendorId = "{{ $empVendorId }}";
            var route1 = '{{ route('orders.edit', ':id') }}';
            var booktable = '{{ route('booktable.edit', ':id') }}';
            var database = firebase.firestore();
            var pageloadded = 0;
            
            var placeholderImage = '';
            var documentVerificationEnable = false;
            var commisionModel = false;
            var subscriptionModel = false;
            var vendorId = null;
            var dineIn = false;
            var enableAdvertisement = false;
            var enableSelfDelivery = false;

            const datatableLang = {
                "decimal":        "",
                "emptyTable":     "{{ trans('lang.no_record_found') }}",
                "info":           "{{ trans('lang.datatable_info') }}", 
                "infoEmpty":      "{{ trans('lang.datatable_info_empty') }}", 
                "infoFiltered":   "{{ trans('lang.datatable_info_filtered') }}", 
                "lengthMenu":     "{{ trans('lang.datatable_length_menu') }}",
                "loadingRecords": "{{ trans('lang.loading') }}",
                "processing":     "{{ trans('lang.processing') }}",
                "search":         "{{ trans('lang.search') }}",
                "zeroRecords":    "{{ trans('lang.no_record_found') }}",
                "paginate": {
                    "first":      "{{ trans('lang.first') }}",
                    "last":       "{{ trans('lang.last') }}",
                    "next":       "{{ trans('lang.next') }}",
                    "previous":   "{{ trans('lang.previous') }}"
                },
                "aria": {
                    "sortAscending":  ": {{ trans('lang.sort_asc') }}",
                    "sortDescending": ": {{ trans('lang.sort_desc') }}"
                }
            };

            var placeholder = database.collection('settings').doc('placeHolderImage');
            placeholder.get().then(async function(snapshotsimage) {
                var placeholderImageData = snapshotsimage.data();
                placeholderImage = placeholderImageData.image;
            })
            
            var version = database.collection('settings').doc("Version");
            version.get().then(async function(snapshots) {
                var version_data = snapshots.data();
                if(version_data.web_version){
                    $('.web_version').html("V:" + version_data.web_version);
                }
            });

            var globalSettings = database.collection('settings').doc("globalSettings");
            globalSettings.get().then(async function(snapshots) {
                var globalSettingsData = snapshots.data();
                if (getCookie('meta_title') == undefined || getCookie('meta_title') == null || getCookie('meta_title') == "") {
                    document.title = globalSettingsData.meta_title;
                    setCookie('meta_title', globalSettingsData.meta_title, 365);
                }
                if (getCookie('favicon') == undefined || getCookie('favicon') == null || getCookie('favicon') ==
                    "") {
                    setCookie('favicon', globalSettingsData.favicon, 365);
                }
            });

            var commissionBusinessModel = database.collection('settings').doc("AdminCommission");
            commissionBusinessModel.get().then(async function(snapshots) {
                var commissionSetting = snapshots.data();
                if (commissionSetting.isEnabled == true) {
                    commisionModel = true;
                }
                document.dispatchEvent(new Event('commissionModelReady'));
            });

            var subscriptionBusinessModel = database.collection('settings').doc("restaurant");
            subscriptionBusinessModel.get().then(async function(snapshots) {
                var subscriptionSetting = snapshots.data();
                if (subscriptionSetting.subscription_model == true) {
                    subscriptionModel = true;
                }
            });

            function exportData(dt, format, config) {
                const {
                    columns,
                    fileName = 'Export',
                } = config;

                const filteredRecords = dt.ajax.json().filteredData;

                const fieldTypes = {};
                const dataMapper = (record) => {
                    return columns.map((col) => {
                        const value = record[col.key];
                        if (!fieldTypes[col.key]) {
                            if (value === true || value === false) {
                                fieldTypes[col.key] = 'boolean';
                            } else if (value && typeof value === 'object' && value.seconds) {
                                fieldTypes[col.key] = 'date';
                            } else if (typeof value === 'number') {
                                fieldTypes[col.key] = 'number';
                            } else if (typeof value === 'string') {
                                fieldTypes[col.key] = 'string';
                            } else {
                                fieldTypes[col.key] = 'string';
                            }
                        }

                        switch (fieldTypes[col.key]) {
                            case 'boolean':
                                return value ? 'Yes' : 'No';
                            case 'date':
                                return value ? new Date(value.seconds * 1000).toLocaleString() : '-';
                            case 'number':
                                return typeof value === 'number' ? value : 0;
                            case 'string':
                            default:
                                return value || '-';
                        }
                    });
                };

                const tableData = filteredRecords.map(dataMapper);

                const data = [columns.map(col => col.header), ...tableData];

                const columnWidths = columns.map((_, colIndex) =>
                    Math.max(...data.map(row => row[colIndex]?.toString().length || 0))
                );

                if (format === 'csv') {
                    const csv = data.map(row => row.map(cell => {
                        if (typeof cell === 'string' && (cell.includes(',') || cell.includes('\n') || cell.includes('"'))) {
                            return `"${cell.replace(/"/g,'""')}"`;
                        }
                        return cell;
                    }).join(',')).join('\n');

                    const blob = new Blob([csv], {
                        type: 'text/csv;charset=utf-8;'
                    });
                    saveAs(blob, `${fileName}.csv`);
                } else if (format === 'excel') {
                    const ws = XLSX.utils.aoa_to_sheet(data, {
                        cellDates: true
                    });

                    ws['!cols'] = columnWidths.map(width => ({
                        wch: Math.min(width + 5, 30)
                    }));

                    const wb = XLSX.utils.book_new();
                    XLSX.utils.book_append_sheet(wb, ws, 'Data');
                    XLSX.writeFile(wb, `${fileName}.xlsx`);
                } else if (format === 'pdf') {
                    const {
                        jsPDF
                    } = window.jspdf;
                    const doc = new jsPDF();

                    const totalLength = columnWidths.reduce((sum, length) => sum + length, 0);
                    const columnStyles = {};
                    columnWidths.forEach((length, index) => {
                        columnStyles[index] = {
                            cellWidth: (length / totalLength) * 180,
                        };
                    });

                    doc.setFontSize(16);
                    doc.text(fileName, 14, 16);

                    doc.autoTable({
                        head: [columns.map(col => col.header)],
                        body: tableData,
                        startY: 20,
                        theme: 'striped',
                        styles: {
                            cellPadding: 2,
                            fontSize: 10,
                        },
                        columnStyles,
                        margin: {
                            top: 30,
                            bottom: 30
                        },
                        didDrawPage: function(data) {
                            doc.setFontSize(10);
                            doc.text(fileName, data.settings.margin.left, 10);
                        }
                    });
                    doc.save(`${fileName}.pdf`);
                } else {
                    console.error('Unsupported format');
                }
            }

            database.collection('users').doc(vendorUserId).get().then(async function(usersnapshots) {
                var userData = usersnapshots.data();

                setTimeout(function(){
                    if (!userData.hasOwnProperty('profilePictureURL') || userData.profilePictureURL === '' || userData.profilePictureURL === null || userData.profilePictureURL === "null") {
                        $('.profile-pic').attr('src', placeholderImage);
                    } else {
                        $('.profile-pic').attr('src', userData.profilePictureURL);
                    }
                },500);
                
                var username = userData.firstName + ' ' + userData.lastName;
                $('#username').text(username);
               
                if(authRole == "employee"){
                    database.collection('vendors').where('author', '==', empVendorId).get().then(function(snapshots) {
                        if (snapshots.docs.length > 0) {
                            snapshots.forEach(function(doc) {
                                var data = doc.data();
                                // Assuming you have retrieved a Firestore value and stored it in a variable called 'value'
                                if (data.createdAt instanceof firebase.firestore.Timestamp) {
                                    // 'value' is a Firestore timestamp
                                } else if (typeof data.createdAt === 'object' && !Array.isArray(data
                                        .createdAt)) {
                                    const combinedValue = (data.createdAt._seconds) * 1000 + (data
                                        .createdAt._nanoseconds / 1000000);
                                    const regularTimestamp = new Date(combinedValue);
                                    doc.ref.update({
                                        "createdAt": regularTimestamp
                                    });
                                }
                            });
                        }
                    });
                }else{
                    database.collection('vendors').where('author', '==', vendorUserId).get().then(function(snapshots) {
                        if (snapshots.docs.length > 0) {
                            snapshots.forEach(function(doc) {
                                var data = doc.data();
                                // Assuming you have retrieved a Firestore value and stored it in a variable called 'value'
                                if (data.createdAt instanceof firebase.firestore.Timestamp) {
                                    // 'value' is a Firestore timestamp
                                } else if (typeof data.createdAt === 'object' && !Array.isArray(data
                                        .createdAt)) {
                                    const combinedValue = (data.createdAt._seconds) * 1000 + (data
                                        .createdAt._nanoseconds / 1000000);
                                    const regularTimestamp = new Date(combinedValue);
                                    doc.ref.update({
                                        "createdAt": regularTimestamp
                                    });
                                }
                            });
                        }
                    });
                }

                if(userData.vendorID){
                    let vendorRef = await database.collection('vendors').doc(userData.vendorID).get();
                    let vendorData = vendorRef.data();
                    if(vendorData.latitude && vendorData.longitude){
                        let countryName = await getCountryFromLatLng(vendorData.latitude,vendorData.longitude);
                        setCookie('vendorCountryName', countryName, 365);
                    }
                }
            });

            var orderPlacedSubject = '';
            var orderPlacedMsg = '';
            var dineInPlacedSubject = '';
            var dineInPlacedMsg = '';
            var driverAcceptedMsg = '';
            var driverAcceptedSubject = '';
            var scheduleOrderPlacedSubject = '';
            var scheduleOrderPlacedMsg = '';
            var advApprovedSub = '';
            var advApprovedMsg = '';
            var advCancelledSub = '';
            var advCancelledMsg = '';
            var advPausedSub = '';
            var advPausedMsg = '';
            var advResumedSub = '';
            var advResumedMsg = '';
            database.collection('dynamic_notification').get().then(async function(snapshot) {
                if (snapshot.docs.length > 0) {
                    snapshot.docs.map(async (listval) => {
                        val = listval.data();
                        if (val.type == "dinein_placed") {
                            dineInPlacedSubject = val.subject;
                            dineInPlacedMsg = val.message;
                        } else if (val.type == "order_placed") {
                            orderPlacedSubject = val.subject;
                            orderPlacedMsg = val.message;
                        } else if (val.type == "driver_accepted") {
                            driverAcceptedSubject = val.subject;
                            driverAcceptedMsg = val.message;
                        } else if (val.type == "schedule_order") {
                            scheduleOrderPlacedSubject = val.subject;
                            scheduleOrderPlacedMsg = val.message;
                        } else if (val.type == "advertisement_approved") {
                            advApprovedSub = val.subject;
                            advApprovedMsg = val.message;
                        } else if (val.type == "advertisement_cancelled") {
                            advCancelledSub = val.subject;
                            advCancelledMsg = val.message;
                        } else if (val.type == "advertisement_paused") {
                            advPausedSub = val.subject;
                            advPausedMsg = val.message;
                        } else if (val.type == "advertisement_resumed") {
                            advResumedSub = val.subject;
                            advResumedMsg = val.message;
                        }
                    });
                }
            });
            if(authRole == "employee"){
                database.collection('restaurant_orders').where('vendor.author', "==", empVendorId).onSnapshot(function(doc) {
                    if (pageloadded) {
                        doc.docChanges().forEach(function(change) {
                            val = change.doc.data();
                            if (change.type == "added") {
                                if (val.status == "Order Placed") {
                                    if (val.author.firstName) {}
                                    if (val.scheduleTime != undefined && val.scheduleTime != null && val
                                        .scheduleTime != '') {
                                        $('.order_placed_subject').text(scheduleOrderPlacedSubject);
                                        $('.order_placed_msg').text(scheduleOrderPlacedMsg);
                                    } else {
                                        $('.order_placed_subject').text(orderPlacedSubject);
                                        $('.order_placed_msg').text(orderPlacedMsg);
                                    }
                                    if (route1) {
                                        jQuery("#notification_add_order_a").attr("href", route1.replace(':id', val
                                            .id));
                                    }
                                    jQuery("#notification_add_order").modal('show');
                                }
                            } else if (change.type == "modified") {
                                //change.status
                                if (val.status == "Order Placed") {
                                    if (val.author.firstName) {}
                                    if (route1) {
                                        jQuery("#notification_add_order_a").attr("href", route1.replace(':id', val
                                            .id));
                                    }
                                    if (val.scheduleTime != undefined && val.scheduleTime != null && val
                                        .scheduleTime != '') {
                                        $('.order_placed_subject').text(scheduleOrderPlacedSubject);
                                        $('.order_placed_msg').text(scheduleOrderPlacedMsg);
                                    } else {
                                        $('.order_placed_subject').text(orderPlacedSubject);
                                        $('.order_placed_msg').text(orderPlacedMsg);
                                    }
                                    jQuery("#notification_add_order").modal('show');
                                } else if (val.status == "Driver Accepted") {
                                    if (val.driver && val.driver.firstName) {}
                                    if (route1) {
                                        jQuery("#notification_accepted_a").attr("href", route1.replace(':id', val
                                            .id));
                                    }
                                    $('.driver_accepted_subject').text(driverAcceptedSubject);
                                    $('.driver_accepted_msg').text(driverAcceptedMsg);
                                    jQuery("#notification_accepted_order").modal('show');
                                }
                            }
                        });
                    } else {
                        pageloadded = 1;
                    }
                });
            }else{
                database.collection('restaurant_orders').where('vendor.author', "==", vendorUserId).onSnapshot(function(doc) {
                    if (pageloadded) {
                        doc.docChanges().forEach(function(change) {
                            val = change.doc.data();
                            if (change.type == "added") {
                                if (val.status == "Order Placed") {
                                    if (val.author.firstName) {}
                                    if (val.scheduleTime != undefined && val.scheduleTime != null && val
                                        .scheduleTime != '') {
                                        $('.order_placed_subject').text(scheduleOrderPlacedSubject);
                                        $('.order_placed_msg').text(scheduleOrderPlacedMsg);
                                    } else {
                                        $('.order_placed_subject').text(orderPlacedSubject);
                                        $('.order_placed_msg').text(orderPlacedMsg);
                                    }
                                    if (route1) {
                                        jQuery("#notification_add_order_a").attr("href", route1.replace(':id', val
                                            .id));
                                    }
                                    jQuery("#notification_add_order").modal('show');
                                }
                            } else if (change.type == "modified") {
                                //change.status
                                if (val.status == "Order Placed") {
                                    if (val.author.firstName) {}
                                    if (route1) {
                                        jQuery("#notification_add_order_a").attr("href", route1.replace(':id', val
                                            .id));
                                    }
                                    if (val.scheduleTime != undefined && val.scheduleTime != null && val
                                        .scheduleTime != '') {
                                        $('.order_placed_subject').text(scheduleOrderPlacedSubject);
                                        $('.order_placed_msg').text(scheduleOrderPlacedMsg);
                                    } else {
                                        $('.order_placed_subject').text(orderPlacedSubject);
                                        $('.order_placed_msg').text(orderPlacedMsg);
                                    }
                                    jQuery("#notification_add_order").modal('show');
                                } else if (val.status == "Driver Accepted") {
                                    if (val.driver && val.driver.firstName) {}
                                    if (route1) {
                                        jQuery("#notification_accepted_a").attr("href", route1.replace(':id', val
                                            .id));
                                    }
                                    $('.driver_accepted_subject').text(driverAcceptedSubject);
                                    $('.driver_accepted_msg').text(driverAcceptedMsg);
                                    jQuery("#notification_accepted_order").modal('show');
                                }
                            }
                        });
                    } else {
                        pageloadded = 1;
                    }
                }); 
            }
            var pageloadded_book = 0;
            if(authRole == "employee"){
                database.collection('booked_table').where('vendor.author', "==", empVendorId).onSnapshot(function(doc) {
                    if (pageloadded_book) {
                        doc.docChanges().forEach(function(change) {
                            val = change.doc.data();
                            if (change.type == "added") {
                                if (val.status == "Order Placed") {
                                    if (val.author.firstName) {}
                                    if (route1) {
                                        jQuery("#notification_book_table_add_order_a").attr("href", booktable
                                            .replace(':id', val.id));
                                    }
                                    $('.dinein_order_placed_subject').text(dineInPlacedSubject);
                                    $('.dinein_order_placed_msg').text(dineInPlacedMsg);
                                    jQuery("#notification_book_table_add_order").modal('show');
                                }
                            }
                        });
                    } else {
                        pageloadded_book = 1;
                    }
                });
            }else{
                database.collection('booked_table').where('vendor.author', "==", vendorUserId).onSnapshot(function(doc) {
                    if (pageloadded_book) {
                        doc.docChanges().forEach(function(change) {
                            val = change.doc.data();
                            if (change.type == "added") {
                                if (val.status == "Order Placed") {
                                    if (val.author.firstName) {}
                                    if (route1) {
                                        jQuery("#notification_book_table_add_order_a").attr("href", booktable
                                            .replace(':id', val.id));
                                    }
                                    $('.dinein_order_placed_subject').text(dineInPlacedSubject);
                                    $('.dinein_order_placed_msg').text(dineInPlacedMsg);
                                    jQuery("#notification_book_table_add_order").modal('show');
                                }
                            }
                        });
                    } else {
                        pageloadded_book = 1;
                    }
                });
            }
            var pageLoadedAdvertisement = 0;
            database.collection('users').where('id', '==', vendorUserId).get().then(async function(snapshots) {
                var userData = snapshots.docs[0].data();
                if (userData.hasOwnProperty('vendorID') && userData.vendorID != '' && userData.vendorID != null) {
                    vendorId = userData.vendorID;
                    database.collection('advertisements').where('vendorId', "==", vendorId).onSnapshot(function(doc) {

                        if (pageLoadedAdvertisement) {

                            doc.docChanges().forEach(function(change) {
                                val = change.doc.data();
                                var recentlyModifiedAd = localStorage.getItem('storeModifiedAd');

                                if (recentlyModifiedAd === val.id) {
                                    localStorage.removeItem('storeModifiedAd');
                                    return;
                                }
                                if (change.type == "modified") {
                                    var routeAdview = "{{ route('advertisements.view', ':id') }}";
                                    routeAdview = routeAdview.replace(':id', val.id);
                                    if (val.status == 'approved') {

                                        if (val.status == 'approved' && val.isPaused) {
                                            $('.advertisement_paused_sub').html(advPausedSub);
                                            $('.advertisement_paused_msg').html(advPausedMsg);
                                            $('#advertisement_paused_notification').modal('show');
                                            $('#advertisement_paused_route').attr('href', routeAdview);
                                        } else if (val.status == 'approved' && val.isPaused == null) {

                                            $('.advertisement_accepted_msg').html(advApprovedMsg);
                                            $('.advertisement_accepted_sub').html(advApprovedSub);
                                            $('#advertisement_accepted_notification').modal('show');
                                            $('#advertisement_accepted_route').attr('href', routeAdview);
                                        } else {
                                            $('.advertisement_resumed_sub').html(advResumedSub);
                                            $('.advertisement_resumed_msg').html(advResumedMsg);
                                            $('#advertisement_resumed_notification').modal('show');
                                            $('#advertisement_resumed_route').attr('href', routeAdview);
                                        }
                                    } else if (val.status == 'canceled') {
                                        $('.advertisement_cancelled_sub').html(advCancelledSub);
                                        $('.advertisement_cancelled_msg').html(advCancelledMsg);
                                        $('#advertisement_canceled_notification').modal('show');
                                        $('#advertisement_canceled_route').attr('href', routeAdview);
                                    }

                                }
                            })
                        } else {
                            pageLoadedAdvertisement = 1;
                        }
                    })

                }


            });

            var langcount = 0;
            var languages_list = database.collection('settings').doc('languages');
            languages_list.get().then(async function(snapshotslang) {
                snapshotslang = snapshotslang.data();
                if (snapshotslang != undefined) {
                    snapshotslang = snapshotslang.list;
                    languages_list_main = snapshotslang;
                    snapshotslang.forEach((data) => {
                        if (data.isActive == true) {
                            langcount++;
                            $('#language_dropdown').append($("<option></option>").attr("value", data.slug)
                                .text(data.title));
                        }
                    });
                    if (langcount > 1) {
                        $("#language_dropdown_box").css('visibility', 'visible');
                    }
                    <?php if (session()->get('locale')) { ?>
                    $("#language_dropdown").val("<?php echo session()->get('locale'); ?>");
                    <?php } ?>
                }
            });
            var url = "{{ route('changeLang') }}";
            $(".changeLang").change(function() {
                var slug = $(this).val();
                languages_list_main.forEach((data) => {
                    if (slug == data.slug) {
                        if (data.is_rtl == undefined) {
                            setCookie('is_rtl', 'false', 365);
                        } else {
                            setCookie('is_rtl', data.is_rtl.toString(), 365);
                        }
                        window.location.href = url + "?lang=" + slug;
                    }
                });
            });

            function setCookie(name, value, days) {
                var expires = "";
                if (days) {
                    var date = new Date();
                    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                    expires = "; expires=" + date.toUTCString();
                }
                document.cookie = name + "=" + (value || "") + expires + "; path=/";
            }

            function getCookie(name) {
                var nameEQ = name + "=";
                var ca = document.cookie.split(';');
                for (var i = 0; i < ca.length; i++) {
                    var c = ca[i];
                    while (c.charAt(0) == ' ') c = c.substring(1, c.length);
                    if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
                }
                return null;
            }

            function formatCurrency(amount, currency = {}) {
                const symbol = currency.symbol || '';
                const decimals = currency.decimal_degits ?? 2;
                const symbolAtRight = Boolean(currency.symbolAtRight);
                const formatted = parseFloat(amount).toFixed(decimals);
                return symbolAtRight
                    ? formatted + ' ' + symbol
                    : symbol + formatted;
            }
            
            database.collection('settings').doc("notification_setting").get().then(async function(snapshots) {
                var data = snapshots.data();
                if (data != undefined) {
                    serviceJson = data.serviceJson;
                    if (serviceJson != '' && serviceJson != null) {
                        $.ajax({
                            type: 'POST',
                            data: {
                                serviceJson: btoa(serviceJson),
                            },
                            url: "{{ route('store-firebase-service') }}",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(data) {}
                        });
                    }
                }
            });
            var refDistance = database.collection('settings').doc("RestaurantNearBy");
            refDistance.get().then(async function(snapshots) {
                try {
                    var data = snapshots.data();
                    var distanceType = data.distanceType.charAt(0).toUpperCase() + data.distanceType.slice(1);
                    $('#distanceType').val(distanceType);
                    $('.global_distance_type').html(distanceType);

                } catch (error) {

                }
            });
            //On delete item delete image also from bucket general code
            const deleteDocumentWithImage = async (collection, id, singleImageField, arrayImageField) => {
                // Reference to the Firestore document
                const docRef = database.collection(collection).doc(id);
                try {
                    const doc = await docRef.get();
                    if (!doc.exists) {
                        console.log("No document found for deletion");
                        return;
                    }
                    const data = doc.data();
                    // Deleting single image field
                    if (singleImageField) {
                        if (Array.isArray(singleImageField)) {
                            for (const field of singleImageField) {
                                const imageUrl = data[field];
                                if (imageUrl) await deleteImageFromBucket(imageUrl);
                            }
                        } else {
                            const imageUrl = data[singleImageField];
                            if (imageUrl) await deleteImageFromBucket(imageUrl);
                        }
                    }
                    // Deleting array image field
                    if (arrayImageField) {
                        if (Array.isArray(arrayImageField)) {
                            for (const field of arrayImageField) {
                                const arrayImages = data[field];
                                if (arrayImages && Array.isArray(arrayImages)) {
                                    for (const imageUrl of arrayImages) {
                                        if (imageUrl) await deleteImageFromBucket(imageUrl);
                                    }
                                }
                            }
                        } else {
                            const arrayImages = data[arrayImageField];
                            if (arrayImages && Array.isArray(arrayImages)) {
                                for (const imageUrl of arrayImages) {
                                    if (imageUrl) await deleteImageFromBucket(imageUrl);
                                }
                            }
                        }
                    }
                    // Deleting images in variants array within item_attribute
                    const item_attribute = data.item_attribute || {}; // Access item_attribute
                    const variants = item_attribute.variants || []; // Access variants array inside item_attribute
                    if (variants.length > 0) {
                        for (const variant of variants) {
                            const variantImageUrl = variant.variant_image;
                            if (variantImageUrl) {
                                await deleteImageFromBucket(variantImageUrl);
                            }
                        }
                    }
                    // Optionally delete the Firestore document after image deletion
                    await docRef.delete();
                    console.log("Document and images deleted successfully.");
                } catch (error) {
                    console.error("Error deleting document and images:", error);
                }
            };

            const deleteImageFromBucket = async (imageUrl) => {
                try {
                    const storageRef = firebase.storage().ref();

                    // Check if the imageUrl is a full URL or just a child path
                    let oldImageUrlRef;
                    if (imageUrl.includes('https://')) {
                        // Full URL
                        oldImageUrlRef = storageRef.storage.refFromURL(imageUrl);
                    } else {
                        // Child path, use ref instead of refFromURL
                        oldImageUrlRef = storageRef.storage.ref(imageUrl);
                    }
                    var envBucket = "<?php echo env('FIREBASE_STORAGE_BUCKET'); ?>";
                    var imageBucket = oldImageUrlRef.bucket;
                    // Check if the bucket name matches
                    if (imageBucket === envBucket) {
                        // Delete the image
                        await oldImageUrlRef.delete();
                        console.log("Image deleted successfully.");
                    }
                } catch (error) {

                }
            };


            database.collection('users').where('id', '==', vendorUserId).get().then(async function(snapshot) {
                var data = snapshot.docs[0].data();
                if(data.role == "vendor"){
                    if (commisionModel || subscriptionModel) {
                        if (data.hasOwnProperty('subscriptionPlanId') && data.subscriptionPlanId != null) {
                            var isSubscribed = true;
                        } else {
                            var isSubscribed = false;
                        }
                    } else {
                        var isSubscribed = '';
                    }
                    var url = "{{ route('setSubcriptionFlag') }}";
                    $.ajax({

                        type: 'POST',

                        url: url,

                        data: {

                            email: "{{ Auth::user()->email }}",
                            isSubscribed: isSubscribed
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },

                        success: function(data) {
                            if (data.access) {

                            }
                        }

                    })
                }

            })

            initNavMenus();

            function initNavMenus(){

                if (vendorUserId) {
                    database.collection('settings').doc("DineinForRestaurant").get().then(async function(
                        settingSnapshots) {
                        if (settingSnapshots.data()) {
                            var settingData = settingSnapshots.data();
                            if (settingData.isEnabled) {
                                dineIn = true;
                            }
                        }
                    })
                    database.collection('settings').doc("globalSettings").get().then(async function(
                        settingSnapshots) {
                        if (settingSnapshots.data()) {
                            var settingData = settingSnapshots.data();
                            if (settingData.isEnableAdsFeature) {
                                enableAdvertisement = true;
                            }
                            if (settingData.isSelfDelivery) {
                                enableSelfDelivery = true;
                            }
                        }
                    })
                }
                
                database.collection('settings').doc("document_verification_settings").get().then(async function(snapshots) {
                    var documentVerification = snapshots.data();
                    if (documentVerification.isRestaurantVerification) {
                        documentVerificationEnable = true;
                        var newLi = `
                            <li>
                            <a class="waves-effect waves-dark" href="{!! url('document-list') !!}" aria-expanded="false">
                                <i class="mdi mdi-file-document"></i>
                                <span class="hide-menu">{{ trans('lang.document_plural') }}</span>
                            </a>
                        </li>`;
                        $('#sidebarnav').append(newLi);

                    }
                })

                database.collection('users').where('id', '==', vendorUserId).get().then(async function(snapshots) {
                    var userData = snapshots.docs[0].data();
                    var checkVendor = null;
                    if (userData.hasOwnProperty('vendorID') && userData.vendorID != '' && userData.vendorID != null) {
                        vendorId = userData.vendorID;
                        checkVendor = userData.vendorID;
                    }
                    var newLi = '';
                    if(userData.role == "vendor"){
                        newLi += `<li>
                            <a class="waves-effect waves-dark" href="{!! route('point.of.sale') !!}" aria-expanded="false">
                                <i class="mdi mdi-calculator"></i>
                                <span class="hide-menu">{{ trans('lang.point_of_sale') }}</span>
                            </a>
                        </li>`;
                        newLi += `<li>
                            <a class="waves-effect waves-dark" href="{!! route('pos.order') !!}" aria-expanded="false">
                                <i class="mdi mdi-receipt"></i>
                                <span class="hide-menu">{{ trans('lang.pos_orders') }}</span>
                            </a>
                        </li>`;

                        newLi += `<li>
                            <a class="waves-effect waves-dark" href="{!! route('role.index') !!}" aria-expanded="false">
                                <i class="mdi mdi-lock"></i>
                                <span class="hide-menu">{{ trans('lang.employee_role') }}</span>
                            </a>
                        </li>`;
                        newLi += `<li>
                            <a class="waves-effect waves-dark" href="{!! route('employee.index') !!}" aria-expanded="false">
                                <i class="mdi mdi-account"></i>
                                <span class="hide-menu">{{ trans('lang.employee_plural') }}</span>
                            </a>
                        </li>`;
                        if (subscriptionModel == true || commisionModel == true) {
                            newLi += `<li>
                                            <a class="waves-effect waves-dark" href="{!! route('subscription-plan.show') !!}" aria-expanded="false">
                                                <i class="mdi mdi-crown"></i>
                                                <span class="hide-menu">{{ trans('lang.change_subscription') }}</span>
                                            </a>
                                        </li>`;

                        }
                        newLi += `<li>
                                <a class="waves-effect waves-dark" href="{!! url('my-subscriptions') !!}" aria-expanded="false">
                                    <i class="mdi mdi-wallet-membership"></i>
                                    <span class="hide-menu">{{ trans('lang.my_subscriptions') }}</span>
                                </a>
                            </li>`;
                    
                        if ((userData.hasOwnProperty('isDocumentVerify') && userData.isDocumentVerify == true) || documentVerificationEnable == false) {
                            newLi += `
                            <li>
                                <a class="waves-effect waves-dark" href="{!! url('restaurant') !!}" aria-expanded="false">
                                    <i class="mdi mdi-store"></i>
                                    <span class="hide-menu">{{ trans('lang.myrestaurant_plural') }}</span>
                                </a>
                            </li>`;

                            if (checkVendor != null) {
                                newLi += `
                                <li>
                                    <a class="waves-effect waves-dark" href="{!! url('foods') !!}" aria-expanded="false">
                                        <i class="mdi mdi-food"></i>
                                        <span class="hide-menu">{{ trans('lang.food_plural') }}</span>
                                    </a>
                                </li>
                                <li><a class="has-arrow waves-effect waves-dark" href="#"
                                        data-toggle="collapse" data-target="#orderDropdown">
                                        <i class="mdi mdi-reorder-horizontal"></i>
                                        <span class="hide-menu">{{ trans('lang.order_plural') }}</span>
                                    </a>
                                    <ul id="orderDropdown" aria-expanded="false" class="collapse">
                                        <li><a href="{!! url('orders') !!}">{{ trans('lang.order_plural') }}</a></li>
                                        <li><a href="{!! url('placedOrders') !!}">{{ trans('lang.placed_orders') }}</a></li>
                                        <li><a href="{!! url('acceptedOrders') !!}">{{ trans('lang.accepted_orders') }}</a></li>
                                        <li><a href="{!! url('rejectedOrders') !!}">{{ trans('lang.rejected_orders') }}</a></li>

                                    </ul>
                                </li> `;
                                if (dineIn) {
                                    newLi +=
                                        `<li>
                                    <a class="waves-effect waves-dark"
                                        href="{!! url('booktable') !!}" aria-expanded="false">
                                        <i class="fa fa-table "></i>
                                        <span class="hide-menu">{{ trans('lang.book_table') }} / {{ trans('lang.dine_in_history') }}</span>
                                    </a>
                                </li>`;

                                }
                                newLi += `<li><a class="waves-effect waves-dark"
                                        href="{!! url('coupons') !!}" aria-expanded="false">
                                        <i class="mdi mdi-sale"></i>
                                        <span class="hide-menu">{{ trans('lang.coupon_plural') }}</span>
                                    </a>
                                </li>`;
                                if (enableAdvertisement) {
                                    newLi += `<li><a class="has-arrow waves-effect waves-dark" href="#"
                                data-toggle="collapse" data-target="#adsDropdown">
                                <i class="mdi mdi-newspaper"></i>
                                <span class="hide-menu">{{ trans('lang.advertisement_plural') }}</span>
                                    </a>
                                    <ul id="adsDropdown" aria-expanded="false" class="collapse">
                                        <li><a href="{!! url('advertisements/pending') !!}">{{ trans('lang.pending') }}</a></li>
                                        <li><a href="{!! url('advertisements') !!}">{{ trans('lang.ads_list') }}</a></li>
                                    </ul>
                                </li>`;
                                }
                                if (enableSelfDelivery) {
                                    newLi += `<li><a class="waves-effect waves-dark"
                                        href="{!! url('deliveryman') !!}" aria-expanded="false">
                                        <i class="mdi mdi-run"></i>
                                        <span class="hide-menu">{{ trans('lang.delivery_man') }}</span>
                                    </a>
                                    </li>`;
                                }

                                newLi += `<li><a class="waves-effect waves-dark" href="{!! url('payments') !!}"
                                aria-expanded="false">
                                        <i class="mdi mdi-wallet"></i>
                                        <span class="hide-menu">{{ trans('lang.payment_plural') }}</span>
                                    </a>
                                </li>`;
                            }
                            newLi += `<li><a class=" waves-effect waves-dark" href="{!! url('withdraw-method') !!}"
                                aria-expanded="false">
                                        <i class="fa fa-credit-card "></i>
                                        <span class="hide-menu">{{ trans('lang.withdrawal_method') }}</span>
                                    </a>
                                </li>
                            
                                <li><a class="waves-effect waves-dark"
                                        href="{!! url('wallettransaction') !!}" aria-expanded="false">
                                        <i class="mdi mdi-swap-horizontal"></i>
                                        <span class="hide-menu">{{ trans('lang.wallet_transaction_plural') }}</span>
                                    </a>
                                </li>`

                        if(enableAdvertisement){
                            newLi+=`<li class="waves-effect waves-dark p-2">
                                <div class="promo-card">
                                    <div class="position-relative">
                                        <img src="{{asset('images/advertisement_promo.png')}}" class="mw-100" alt="">
                                        <h4 class="mb-2 mt-3">{{trans('lang.want_to_get_highlighted')}}</h4>
                                        <p class="mb-4">
                                            {{trans('lang.create_ads_to_get_highlighted_on_the_app_and_web_browser')}}
                                        </p>
                                        <a href="{{route('advertisements.create')}}" class="btn btn-primary">{{trans('lang.create_ads')}}</a>
                                    </div>
                                </div>
                            </li>`
                        }

                        }
                    }
                    if(userData.role == "employee"){
                        if (!userData.hasOwnProperty('employeePermissionId') || !userData.employeePermissionId) {
                            // No role assigned → maybe show message or empty menu
                            newLi += `<li><a href="#"><i class="mdi mdi-alert"></i> <span>No permissions assigned</span></a></li>`;
                        } else {
                            database.collection('vendor_employee_roles')
                                .doc(userData.employeePermissionId)
                                .get()
                                .then(function(roleSnap) {
                                    if (!roleSnap.exists) {
                                        console.warn("Employee role document not found");
                                        return;
                                    }

                                    var roleData = roleSnap.data();
                                    $('#roleName').removeClass('d-none');
                                    $('#roleName').text("{{trans('lang.assinged_role')}}" + ' : '+roleData.title);
                                    var advPerm = false;

                                    if (roleData.isEnable !== true) {                                       
                                        return;
                                    }

                                    // Build menu based on permissions
                                    var perms = roleData.permissions || [];

                                    perms.forEach(function(perm) {
                                        // Only add if isActive is true
                                        if (perm.isActive !== true) return;

                                        var title = perm.title;
                                        var menuHtml = '';
                                        switch (title) {
                                            case "Employee Role":
                                                menuHtml = `
                                                <li>
                                                    <a class="waves-effect waves-dark" href="{!! route('role.index') !!}" aria-expanded="false">
                                                        <i class="mdi mdi-lock"></i>
                                                        <span class="hide-menu">{{ trans('lang.employee_role') }}</span>
                                                    </a>
                                                </li>`;
                                                break;

                                            case "All Employee":
                                                menuHtml = `
                                                <li>
                                                    <a class="waves-effect waves-dark" href="{!! route('employee.index') !!}" aria-expanded="false">
                                                        <i class="mdi mdi-account"></i>
                                                        <span class="hide-menu">{{ trans('lang.employee_plural') }}</span>
                                                    </a>
                                                </li>`;
                                                break;

                                            case "Restaurant Information's":
                                                menuHtml = `
                                                <li>
                                                    <a class="waves-effect waves-dark" href="{!! url('restaurant') !!}" aria-expanded="false">
                                                        <i class="mdi mdi-store"></i>
                                                        <span class="hide-menu">{{ trans('lang.myrestaurant_plural') }}</span>
                                                    </a>
                                                </li>`;
                                                break;
                                            
                                            case "Manage Products":
                                                menuHtml = `
                                                <li>
                                                    <a class="waves-effect waves-dark" href="{!! url('foods') !!}" aria-expanded="false">
                                                        <i class="mdi mdi-food"></i>
                                                        <span class="hide-menu">{{ trans('lang.food_plural') }}</span>
                                                    </a>
                                                </li>`;
                                                break;

                                            case "Manage Order":
                                                menuHtml = `
                                                <li>
                                                    <a class="has-arrow waves-effect waves-dark" href="#"
                                                    data-toggle="collapse" data-target="#orderDropdown">
                                                        <i class="mdi mdi-reorder-horizontal"></i>
                                                        <span class="hide-menu">{{ trans('lang.order_plural') }}</span>
                                                    </a>
                                                    <ul id="orderDropdown" aria-expanded="false" class="collapse">
                                                        <li><a href="{!! url('orders') !!}">{{ trans('lang.order_plural') }}</a></li>
                                                        <li><a href="{!! url('placedOrders') !!}">{{ trans('lang.placed_orders') }}</a></li>
                                                        <li><a href="{!! url('acceptedOrders') !!}">{{ trans('lang.accepted_orders') }}</a></li>
                                                        <li><a href="{!! url('rejectedOrders') !!}">{{ trans('lang.rejected_orders') }}</a></li>
                                                    </ul>
                                                </li>`;
                                                break;   
                                            case "Offers":
                                                menuHtml = `
                                                <li>
                                                    <a class="waves-effect waves-dark" href="{!! url('coupons') !!}" aria-expanded="false">
                                                        <i class="mdi mdi-sale"></i>
                                                        <span class="hide-menu">{{ trans('lang.coupon_plural') }}</span>
                                                    </a>
                                                </li>`;
                                                break;
                                            case "Special Discounts":                                               
                                                break;

                                            case "Advertisement":
                                                if (enableAdvertisement) {
                                                    menuHtml = `
                                                    <li><a class="has-arrow waves-effect waves-dark" href="#"
                                                        data-toggle="collapse" data-target="#adsDropdown">
                                                        <i class="mdi mdi-newspaper"></i>
                                                        <span class="hide-menu">{{ trans('lang.advertisement_plural') }}</span>
                                                            </a>
                                                            <ul id="adsDropdown" aria-expanded="false" class="collapse">
                                                                <li><a href="{!! url('advertisements/pending') !!}">{{ trans('lang.pending') }}</a></li>
                                                                <li><a href="{!! url('advertisements') !!}">{{ trans('lang.ads_list') }}</a></li>
                                                            </ul>
                                                        </li>`;
                                                }
                                                advPerm = true;
                                                break;
                                          
                                            case "Manage Delivery Man":
                                                if (enableSelfDelivery) {
                                                    menuHtml = `
                                                    <li>
                                                        <a class="waves-effect waves-dark" href="{!! url('deliveryman') !!}" aria-expanded="false">
                                                            <i class="mdi mdi-run"></i>
                                                            <span class="hide-menu">{{ trans('lang.delivery_man') }}</span>
                                                        </a>
                                                    </li>`;
                                                }
                                                break;

                                            case "Woking Hours":   
                                                // Usually part of restaurant info
                                                break;

                                            case "Withdraw Method":
                                                menuHtml = `
                                                <li>
                                                    <a class="waves-effect waves-dark" href="{!! url('withdraw-method') !!}" aria-expanded="false">
                                                        <i class="fa fa-credit-card"></i>
                                                        <span class="hide-menu">{{ trans('lang.withdrawal_method') }}</span>
                                                    </a>
                                                </li>`;
                                                break;
                                           
                                            case "Add Dine in":
                                                break;
                                            case "Dine in Request":
                                                if (dineIn) {
                                                    menuHtml = `
                                                    <li>
                                                        <a class="waves-effect waves-dark" href="{!! url('booktable') !!}" aria-expanded="false">
                                                            <i class="fa fa-table"></i>
                                                            <span class="hide-menu">{{ trans('lang.book_table') }} / {{ trans('lang.dine_in_history') }}</span>
                                                        </a>
                                                    </li>`;
                                                }
                                                break;

                                            default:
                                                // unknown permission 
                                                break;
                                        }
                                        
                                        if (menuHtml) {
                                            newLi += menuHtml;
                                        }
                                    });
                                    if(enableAdvertisement && advPerm){
                                        newLi+=`<li class="waves-effect waves-dark p-2">
                                            <div class="promo-card">
                                                <div class="position-relative">
                                                    <img src="{{asset('images/advertisement_promo.png')}}" class="mw-100" alt="">
                                                    <h4 class="mb-2 mt-3">{{trans('lang.want_to_get_highlighted')}}</h4>
                                                    <p class="mb-4">
                                                        {{trans('lang.create_ads_to_get_highlighted_on_the_app_and_web_browser')}}
                                                    </p>
                                                    <a href="{{route('advertisements.create')}}" class="btn btn-primary">{{trans('lang.create_ads')}}</a>
                                                </div>
                                            </div>
                                        </li>`
                                    }

                                    $('#sidebarnav').append(newLi);
                                    setActiveMenu();
                                })
                                .catch(function(err) {
                                    console.error("Error fetching employee role:", err);
                                });

                            return;
                        }
                    }
                    $('#sidebarnav').append(newLi);
                    setActiveMenu();
                });

            }

            function setActiveMenu(){
                var currentUrl = window.location.href;
                $('#sidebarnav a').each(function() {
                    var $link = $(this);
                    if ($link[0].href === currentUrl) {
                        $link.addClass('active');
                        var $li = $link.closest('li');
                        $li.addClass('active');
                        $link.parents('ul.collapse').each(function() {
                            var $submenu = $(this);
                            $submenu.addClass('show');
                            $submenu.attr('aria-expanded', 'true');
                            $submenu.closest('li').children('a.has-arrow').attr('aria-expanded', 'true'); 
                        });
                    }
                });
            }


        // Global function to check if employee has permission for a specific title/section
        async function getEmployeePermissionForTitle(userId, permissionTitle) {
            if (!userId || !permissionTitle) {
                return { isActive: false };
            }

            try {
                // 1. Get user
                const userSnap = await database.collection('users')
                    .where('id', '==', userId)
                    .limit(1)
                    .get();

                if (userSnap.empty) {
                    return { isActive: false };
                }

                const userData = userSnap.docs[0].data();

                if (!userData.employeePermissionId) {
                    return { isActive: false };
                }

                // 2. Get role
                const roleSnap = await database.collection('vendor_employee_roles')
                    .doc(userData.employeePermissionId)
                    .get();

                if (!roleSnap.exists) {
                    return { isActive: false };
                }

                const roleData = roleSnap.data();

                if (roleData.isEnable !== true) {
                    return { isActive: false };
                }

                // 3. Find permission
                const perm = (roleData.permissions || []).find(p => p.title === permissionTitle);

                if (!perm) {
                    return { isActive: false };
                }

                // Return the same field name you're already using
                return {
                    isActive: !!perm.isActive
                };

            } catch (err) {
                console.error("Error fetching employee permission:", err);
                return { isActive: false };
            }
        }

        async function getCountryFromLatLng(lat, lng) {
            const url = `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`;
            const response = await fetch(url, {
                headers: {
                    'Accept': 'application/json'
                }
            });
            const data = await response.json();
            return data?.address?.country || '';
        }

        </script>

    </body>

</html>
