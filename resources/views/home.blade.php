@extends('layouts.app')
@section('content')
    <div id="main-wrapper" class="page-wrapper" style="min-height: 207px;">
        <div class="container-fluid">
            <div class="card mb-3 business-analytics" style="display:none">
                <div class="card-body">
                    <div class="row flex-between align-items-center g-2 mb-3 order_stats_header">
                        <div class="col-sm-6">
                            <h4 class="d-flex align-items-center text-capitalize gap-10 mb-0">{{trans('lang.dashboard_business_analytics')}}</h4>
                        </div>
                    </div>
                    <div class="row business-analytics_list">
                        <div class="col-sm-6 col-lg-4 mb-3">
                            <div class="card-box redirectionCheck" onclick="location.href='{!! route('payments') !!}'">
                                <h5>{{trans('lang.dashboard_total_earnings')}}</h5>
                                <h2 id="earnings_count"></h2>
                                <i class="mdi mdi-cash-usd"></i>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-4 mb-3">
                            <div class="card-box redirectionCheck" onclick="location.href='{!! route('orders') !!}'">
                                <h5>{{trans('lang.dashboard_total_orders')}}</h5>
                                <h2 id="order_count"></h2>
                                <i class="mdi mdi-cart"></i>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-4 mb-3">
                            <div class="card-box redirectionCheck" onclick="location.href='{!! route('foods') !!}'">
                                <h5>{{trans('lang.dashboard_total_products')}}</h5>
                                <h2 id="product_count"></h2>
                                <i class="mdi mdi-buffer"></i>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <a class="order-status pending redirectionCheck" href="{!! route('placedOrders') !!}">
                                <div class="data">
                                    <i class="mdi mdi-lan-pending"></i>
                                    <h6 class="status">{{trans('lang.dashboard_order_placed')}}</h6>
                                </div>
                                <span class="count" id="placed_count"></span> </a>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <a class="order-status confirmed redirectionCheck" href="{!! route('acceptedOrders') !!}">
                                <div class="data">
                                    <i class="mdi mdi-check-circle"></i>
                                    <h6 class="status">{{trans('lang.dashboard_order_confirmed')}}</h6>
                                </div>
                                <span class="count" id="confirmed_count"></span> </a>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <a class="order-status packaging redirectionCheck" href="{!! route('orders') !!}">
                                <div class="data">
                                    <i class="mdi mdi-clipboard-outline"></i>
                                    <h6 class="status">{{trans('lang.dashboard_order_shipped')}}</h6>
                                </div>
                                <span class="count" id="shipped_count"></span> </a>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <a class="order-status delivered redirectionCheck" href="{!! route('orders') !!}">
                                <div class="data">
                                    <i class="mdi mdi-check-circle-outline"></i>
                                    <h6 class="status">{{trans('lang.dashboard_order_completed')}}</h6>
                                </div>
                                <span class="count" id="completed_count"></span>
                            </a>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <a class="order-status canceled redirectionCheck" href="{!! route('rejectedOrders') !!}">
                                <div class="data">
                                    <i class="mdi mdi-window-close"></i>
                                    <h6 class="status">{{trans('lang.dashboard_order_canceled')}}</h6>
                                </div>
                                <span class="count" id="canceled_count"></span>
                            </a>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <a class="order-status failed redirectionCheck" href="{!! route('orders') !!}">
                                <div class="data">
                                    <i class="mdi mdi-alert-circle-outline"></i>
                                    <h6 class="status">{{trans('lang.dashboard_order_failed')}}</h6>
                                </div>
                                <span class="count" id="failed_count"></span>
                            </a>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <a class="order-status failed redirectionCheck" href="{!! route('orders') !!}">
                                <div class="data">
                                    <i class="mdi mdi-car-connected"></i>
                                    <h6 class="status">{{trans('lang.dashboard_order_pending')}}</h6>
                                </div>
                                <span class="count" id="pending_count"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row business-analytics-graph" style="display:none">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header no-border">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title">{{trans('lang.total_sales')}}</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="position-relative">
                                <canvas id="sales-chart" height="200"></canvas>
                            </div>
                            <div class="d-flex flex-row justify-content-end">
                                <span class="mr-2"> <i class="fa fa-square" style="color:#2EC7D9"></i> {{trans('lang.dashboard_this_year')}} </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header no-border">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title">{{trans('lang.service_overview')}}</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="flex-row">
                                <canvas id="visitors" height="222"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header no-border">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title">{{trans('lang.sales_overview')}}</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="flex-row">
                                <canvas id="commissions" height="222"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row daes-sec-sec mb-3">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header no-border d-flex justify-content-between">
                            <h3 class="card-title">{{trans('lang.recent_orders')}}</h3>
                            <div class="card-tools">
                                <a href="{{route('orders')}}" class="btn btn-tool btn-sm redirectionCheck"><i class="fa fa-bars"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-striped table-valign-middle" id="orderTable">
                                <thead>
                                <tr>
                                    <th>{{trans('lang.order_id')}}</th>
                                    <th>{{trans('lang.order_user_id')}}</th>
                                    <th>{{trans('lang.order_type')}}</th>
                                    <th>{{trans('lang.total_amount')}}</th>
                                    <th>{{trans('lang.quantity')}}</th>
                                    <th>{{trans('lang.order_date')}}</th>
                                    <th>{{trans('lang.order_order_status_id')}}</th>
                                </tr>
                                </thead>
                                <tbody id="append_list_recent_order">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

    <script src="{{asset('js/chart.js')}}"></script>

    <script>

        jQuery("#data-table_processing").show();
        
        var database = firebase.firestore();
        var currency = database.collection('settings');
        var currentCurrency = '';
        var currencyAtRight = false;
        var decimal_degits = 0;
        var refCurrency = database.collection('currencies').where('isActive', '==', true);
        refCurrency.get().then(async function (snapshots) {
            var currencyData = snapshots.docs[0].data();
            currentCurrency = currencyData.symbol;
            currencyAtRight = currencyData.symbolAtRight;
            if (currencyData.decimal_degits) {
                decimal_degits = currencyData.decimal_degits;
            }
        });       

        var vendorUserId = "{{ $vendorUserId }}";
        var vendorId = null;        
        var authRole = "{{ $authRole }}";
        var empVendorId = "{{ $empVendorId }}";
        if(authRole == 'vendor'){
            $('.business-analytics').show();
            $('.business-analytics-graph').show();
        }else{
            $('.business-analytics').hide();
            $('.business-analytics-graph').hide();
        }
        database.collection('users').doc(vendorUserId).get().then(async function(snapshots) {
            var userData=snapshots.data();
            if(userData.hasOwnProperty('vendorID')&&userData.vendorID!=''&&userData.vendorID!=null) {
                database.collection('settings').doc("document_verification_settings").get().then(async function(snapshots) {
                    var documentVerification=snapshots.data();
                    if(documentVerification.isRestaurantVerification) {
                        if((userData.hasOwnProperty('isDocumentVerify')&&userData.isDocumentVerify==true)) {

                        }else{
                            const divs = document.querySelectorAll('.redirectionCheck');

                            divs.forEach(div => {
                                div.removeAttribute('onclick'); // Remove the onclick attribute
                                div.style.cursor = "default";   // Optional: Change the cursor to indicate non-clickable
                            });

                            // Replace href for specific <a> elements by class
                            const links = document.querySelectorAll('.redirectionCheck');
                            links.forEach(link => {
                                link.setAttribute('href', '#');
                                link.style.pointerEvents = "none"; // Optional: Disable clicks
                                link.style.cursor = "default";    // Optional: Change cursor
                            });
                        }
                    }
                })
            }else{

                const divs = document.querySelectorAll('.redirectionCheck');

                divs.forEach(div => {
                    div.removeAttribute('onclick'); // Remove the onclick attribute
                    div.style.cursor = "default";   // Optional: Change the cursor to indicate non-clickable
                });

                // Replace href for specific <a> elements by class
                const links = document.querySelectorAll('.redirectionCheck');
                links.forEach(link => {
                    link.setAttribute('href', '#');
                    link.style.pointerEvents = "none"; // Optional: Disable clicks
                    link.style.cursor = "default";    // Optional: Change cursor
                });
            }
        });
        
        getVendorId(vendorUserId).then(data => {
            
            vendorId = data;
            
            jQuery("#data-table_processing").show();
            
            $(document).ready(function () {
                database.collection('restaurant_orders').where('vendorID', "==", vendorId).get().then(
                    (snapshot) => {
                        jQuery("#order_count").empty();
                        jQuery("#order_count").text(snapshot.docs.length);
                    });
                database.collection('vendor_products').where('vendorID', "==", vendorId).get().then(
                    (snapshot) => {
                        jQuery("#product_count").empty();
                        jQuery("#product_count").text(snapshot.docs.length);
                        setVisitors();
                    });
                getTotalEarnings();
                database.collection('restaurant_orders').where('vendorID', "==", vendorId).where('status', 'in', ["Order Placed"]).get().then(
                    (snapshot) => {
                        jQuery("#placed_count").empty();
                        jQuery("#placed_count").text(snapshot.docs.length);
                    });
                database.collection('restaurant_orders').where('vendorID', "==", vendorId).where('status', 'in', ["Order Accepted", "Driver Accepted"]).get().then(
                    (snapshot) => {
                        jQuery("#confirmed_count").empty();
                        jQuery("#confirmed_count").text(snapshot.docs.length);
                    });
                database.collection('restaurant_orders').where('vendorID', "==", vendorId).where('status', 'in', ["Order Shipped", "In Transit"]).get().then(
                    (snapshot) => {
                        jQuery("#shipped_count").empty();
                        jQuery("#shipped_count").text(snapshot.docs.length);
                    });
                database.collection('restaurant_orders').where('vendorID', "==", vendorId).where('status', 'in', ["Order Completed"]).get().then(
                    (snapshot) => {
                        jQuery("#completed_count").empty();
                        jQuery("#completed_count").text(snapshot.docs.length);
                    });
                database.collection('restaurant_orders').where('vendorID', "==", vendorId).where('status', 'in', ["Order Rejected"]).get().then(
                    (snapshot) => {
                        jQuery("#canceled_count").empty();
                        jQuery("#canceled_count").text(snapshot.docs.length);
                    });
                database.collection('restaurant_orders').where('vendorID', "==", vendorId).where('status', 'in', ["Driver Rejected"]).get().then(
                    (snapshot) => {
                        jQuery("#failed_count").empty();
                        jQuery("#failed_count").text(snapshot.docs.length);
                    });
                database.collection('restaurant_orders').where('vendorID', "==", vendorId).where('status', 'in', ["Driver Pending"]).get().then(
                    (snapshot) => {
                        jQuery("#pending_count").empty();
                        jQuery("#pending_count").text(snapshot.docs.length);
                    });
                var offest = 1;
                var pagesize = 10;
                var start = null;
                var end = null;
                var endarray = [];
                var inx = parseInt(offest) * parseInt(pagesize);
                var append_listrecent_order = document.getElementById('append_list_recent_order');
                append_listrecent_order.innerHTML = '';
                ref = database.collection('restaurant_orders');
                ref.orderBy('createdAt', 'desc').where('status', 'in', ["Order Placed", "Order Accepted", "Driver Pending", "Driver Accepted", "Order Shipped", "In Transit"]).where('vendorID', "==", vendorId).limit(inx).get().then(async (snapshots) => {
                    var html = '';
                    html = await buildOrderHTML(snapshots);
                    if (html != '') {
                        append_listrecent_order.innerHTML = html;
                        start = snapshots.docs[snapshots.docs.length - 1];
                        endarray.push(snapshots.docs[0]);
                    }
                    $('#orderTable').DataTable({
                        order: [],
                        columnDefs: [
                            {
                                targets: 5,
                                type: 'date',
                                render: function (data) {
                                    return data;
                                }
                            },
                            {orderable: false, targets: [6]},
                        ],
                        order: [['5', 'desc']],
                        "language": datatableLang,
                        responsive: true
                    });
                });
            });
        });
       
        async function getVendorId(vendorUser) {
            var vendorId = null;
            if (vendorUser) {
                var vendorSnapshots  = await database.collection('vendors').where('author', "==", vendorUser).get();
                if (!vendorSnapshots.empty) {
                    var vendorData = vendorSnapshots.docs[0].data();
                    vendorId = vendorData.id;
                }
            }
            return vendorId;
        }
       
        async function getTotalEarnings() {

            const months = Array(12).fill(0);
            const currentYear = new Date().getFullYear();

            let totalEarning = 0;
            let adminCommissionTotal = 0;

            await database.collection('restaurant_orders').where('vendorID', "==", vendorId).where('status', 'in', ["Order Completed"]).get().then((orderSnapshots) => {
                orderSnapshots.docs.forEach((doc) => {

                    let order = doc.data();
                    
                    let order_subtotal = 0;
                    let total_discount = 0;
                    let total_tax_amount = 0;
                    let tip_amount = parseFloat(order.tip_amount || 0);
                    let deliveryCharge = parseFloat(order.deliveryCharge || 0);
                    let platformFee = parseFloat(order.platformFee || 0);
                    let packagingCharge = parseFloat(order.vendor.packagingCharge || 0);

                    //  Calculate subtotal and product extras
                    for (let i = 0; i < order.products.length; i++) {
                        let product = order.products[i];
                        let itemGross = (parseFloat(product.price) + parseFloat(product.extras_price || 0)) * parseInt(product.quantity);
                        order_subtotal += itemGross;
                    }

                    // Total discounts
                    let order_discount = parseFloat(order.discount || 0);
                    let special_discount = parseFloat(order.specialDiscount?.special_discount || 0);
                        total_discount = order_discount + special_discount;

                    // Calculate item-level taxes (if product-level)
                    if (order.taxScope === "product") {
                        let itemSubtotal = order_subtotal;
                        order.products.forEach(product => {
                            let itemGross = (parseFloat(product.price) + parseFloat(product.extras_price || 0)) * parseInt(product.quantity);
                            let itemDiscount = (itemSubtotal > 0) ? (itemGross / itemSubtotal) * total_discount : 0;
                            let itemTaxable = Math.max(0, itemGross - itemDiscount);
                            let itemTaxes = product.taxSetting || [];
                            itemTaxes.forEach(tax => {
                                if (tax.enable) {
                                    let taxAmount = 0;
                                    if (tax.type === "percentage") {
                                        taxAmount = (tax.tax / 100) * itemTaxable;
                                    } else {
                                        taxAmount = tax.tax;
                                    }
                                    total_tax_amount += parseFloat(taxAmount);
                                }
                            });
                        });
                    } 

                    // Order-level taxes (if order-level)
                    if (order.taxScope === "order") {
                        let orderTaxable = Math.max(0, order_subtotal - total_discount);
                        (order.taxSetting || []).forEach(tax => {
                            if (tax.enable) {
                                let taxAmount = 0;
                                if (tax.type === "percentage") {
                                    taxAmount = (tax.tax / 100) * orderTaxable;
                                } else {
                                    taxAmount = tax.tax;
                                }
                                total_tax_amount += parseFloat(taxAmount);
                            }
                        });
                    }

                    // Packaging taxes
                    let extraCharges = [
                        {amount: packagingCharge, taxes: order.packagingTax || []},
                    ];

                    extraCharges.forEach(scope => {
                        scope.taxes?.forEach(tax => {
                            if (tax.enable) {
                                let taxAmount = 0;
                                if (tax.type === "percentage") {
                                    taxAmount = (tax.tax / 100) * scope.amount;
                                } else {
                                    taxAmount = tax.tax;
                                }
                                total_tax_amount += parseFloat(taxAmount);
                            }
                        });
                    });

                    //Final subtotal after discounts
                    order_subtotal = order_subtotal - total_discount;

                    // Final total
                    let order_total = order_subtotal + packagingCharge + total_tax_amount;
                    
                    // Total earning
                    totalEarning += order_total;

                    // Monthly graph
                    if (order.createdAt) {
                        let date = order.createdAt.toDate();
                        if (date.getFullYear() === currentYear) {
                            months[date.getMonth()] += order_total;
                        }
                    }
                });
            });

            let formattedTotal = currencyAtRight
                ? totalEarning.toFixed(decimal_degits) + currentCurrency
                : currentCurrency + totalEarning.toFixed(decimal_degits);
        
            $("#earnings_count, #earnings_count_graph, .earnings_over_time, #total_earnings_header").text(formattedTotal);

            let labels = ['JAN','FEB','MAR','APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC'];
            
            renderChart($('#sales-chart'), months, labels);

            setCommision();
            
            jQuery("#data-table_processing").hide();
        }

        async function buildOrderHTML(snapshots) {
            var html = '';
            await Promise.all(snapshots.docs.map(async (listval) => {
                var val = listval.data();
                var getData = await getListData(val);
                html += getData;
            }));
            return html;
        }
        async function getListData(val) {
            var html = '';
            var route = '';
            if(authRole == 'vendor'){
                route = '<?php echo route("orders.edit", ":id"); ?>';
                route = route.replace(':id', val.id);
            }else{
                const perm = await getEmployeePermissionForTitle(vendorUserId, "Manage Order");                 

                if (perm.isActive) {
                    route = '<?php echo route("orders.edit", ":id"); ?>';
                    route = route.replace(':id', val.id);
                } else{
                    route = 'javascript:void(0)';
                }
            }
           
            html = html + '<tr>';
            html = html + '<td data-url="' + route + '" class="redirecttopage">' + val.id + '</td>';
            html = html + '<td data-url="' + route + '" class="redirecttopage">' + val.author.firstName + ' ' + val.author.lastName + '</td>';
            if (val.takeAway == true) {
                html = html + '<td data-url="' + route + '" class="redirecttopage">Take away</td>';
            } else {
                html = html + '<td data-url="' + route + '" class="redirecttopage">Order Delivery</td>';
            }
            var price = 0;
            if (val.deliveryCharge != undefined) {
                price = parseInt(val.deliveryCharge) + price;
            }
            if (val.tip_amount != undefined) {
                price = parseInt(val.tip_amount) + price;
            }
            var date = '';
            var time = '';
            if (val.hasOwnProperty('createdAt')) {
                try {
                    date = val.createdAt.toDate().toDateString();
                    time = val.createdAt.toDate().toLocaleTimeString();
                } catch (e) {
                }
            }
            var price = await buildHTMLProductstotal(val);
            html = html + '<td data-url="' + route + '" class="redirecttopage">' + price + '</td>';
            html = html + '<td data-url="' + route + '" class="redirecttopage"><i class="fa fa-shopping-cart"></i> ' + val.products.length + '</td>';
            html = html + '<td data-url="' + route + '" class="redirecttopage">' + date + ' ' + time + '</td>';
            if (val.status == 'Order Placed') {
                html = html + '<td class="order_placed redirecttopage" data-url="' + route + '"><span>' + val.status + '</span></td>';
            } else if (val.status == 'Order Accepted') {
                html = html + '<td class="order_accepted redirecttopage" data-url="' + route + '"><span>' + val.status + '</span></td>';
            } else if (val.status == 'Order Rejected') {
                html = html + '<td class="order_rejected redirecttopage" data-url="' + route + '"><span>' + val.status + '</span></td>';
            } else if (val.status == 'Driver Pending') {
                html = html + '<td class="driver_pending redirecttopage" data-url="' + route + '"><span>' + val.status + '</span></td>';
            } else if (val.status == 'Driver Rejected') {
                html = html + '<td class="driver_rejected redirecttopage" data-url="' + route + '"><span>' + val.status + '</span></td>';
            } else if (val.status == 'Order Shipped') {
                html = html + '<td class="order_shipped redirecttopage" data-url="' + route + '"><span>' + val.status + '</span></td>';
            } else if (val.status == 'In Transit') {
                html = html + '<td class="in_transit redirecttopage" data-url="' + route + '"><span>' + val.status + '</span></td>';
            } else if (val.status == 'Order Completed') {
                html = html + '<td class="order_completed redirecttopage" data-url="' + route + '"><span>' + val.status + '</span></td>';
            }
            html = html + '</a></tr>';
            return html;
        }
        function renderChart(chartNode, data, labels) {
            var ticksStyle = {
                fontColor: '#495057',
                fontStyle: 'bold'
            };
            var mode = 'index';
            var intersect = true;
            return new Chart(chartNode, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            backgroundColor: '#2EC7D9',
                            borderColor: '#2EC7D9',
                            data: data
                        }
                    ]
                },
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        mode: mode,
                        intersect: intersect,
                        callbacks: {
                            label: function (tooltipItem, chartData) {
                                let datasetLabel = chartData.datasets[tooltipItem.datasetIndex].label || '';
                                let value = tooltipItem.yLabel;
                                if (currencyAtRight) {
                                    return datasetLabel + ": " + value.toFixed(2) + currentCurrency;
                                } else {
                                    return datasetLabel + ": " + currentCurrency + value.toFixed(2);
                                }
                            }
                        }
                    },
                    hover: {
                        mode: mode,
                        intersect: intersect
                    },
                    legend: {
                        display: false
                    },
                    scales: {
                        yAxes: [{
                            gridLines: {
                                display: true,
                                lineWidth: '4px',
                                color: 'rgba(0, 0, 0, .2)',
                                zeroLineColor: 'transparent'
                            },
                            ticks: $.extend({
                                beginAtZero: true,
                                callback: function (value, index, values) {
                                    if (currencyAtRight) {
                                        return value.toFixed(2) + currentCurrency;
                                    } else {
                                        return currentCurrency + value.toFixed(2);
                                    }
                                }
                            }, ticksStyle)
                        }],
                        xAxes: [{
                            display: true,
                            gridLines: {
                                display: false
                            },
                            ticks: ticksStyle
                        }]
                    }
                }
            })
        }
        $(document).ready(function () {
            $(document.body).on('click', '.redirecttopage', function () {
                var url = $(this).attr('data-url');
                window.location.href = url;
            });
        });
        function buildHTMLProductstotal(snapshotsProducts) {
            let order_subtotal = 0;
            let total_discount = 0;
            let total_tax_amount = 0;
            let tip_amount = parseFloat(snapshotsProducts.tip_amount || 0);
            let deliveryCharge = parseFloat(snapshotsProducts.deliveryCharge || 0);
            let platformFee = parseFloat(snapshotsProducts.platformFee || 0);
            let packagingCharge = parseFloat(snapshotsProducts.vendor.packagingCharge || 0);

            //  Calculate subtotal and product extras
            for (let i = 0; i < snapshotsProducts.products.length; i++) {
                let product = snapshotsProducts.products[i];
                let itemGross = (parseFloat(product.price) + parseFloat(product.extras_price || 0)) * parseInt(product.quantity);
                order_subtotal += itemGross;
            }

            // Total discounts
            let order_discount = parseFloat(snapshotsProducts.discount || 0);
            let special_discount = parseFloat(snapshotsProducts.specialDiscount?.special_discount || 0);
                total_discount = order_discount + special_discount;

            // Calculate item-level taxes (if product-level)
            if (snapshotsProducts.taxScope === "product") {
                let itemSubtotal = order_subtotal;
                snapshotsProducts.products.forEach(product => {
                    let itemGross = (parseFloat(product.price) + parseFloat(product.extras_price || 0)) * parseInt(product.quantity);
                    let itemDiscount = (itemSubtotal > 0) ? (itemGross / itemSubtotal) * total_discount : 0;
                    let itemTaxable = Math.max(0, itemGross - itemDiscount);
                    let itemTaxes = product.taxSetting || [];
                    itemTaxes.forEach(tax => {
                        if (tax.enable) {
                            let taxAmount = 0;
                            if (tax.type === "percentage") {
                                taxAmount = (tax.tax / 100) * itemTaxable;
                            } else {
                                taxAmount = tax.tax;
                            }
                            total_tax_amount += parseFloat(taxAmount);
                        }
                    });
                });
            } 

            // Order-level taxes (if order-level)
            if (snapshotsProducts.taxScope === "order") {
                let orderTaxable = Math.max(0, order_subtotal - total_discount);
                (snapshotsProducts.taxSetting || []).forEach(tax => {
                    if (tax.enable) {
                        let taxAmount = 0;
                        if (tax.type === "percentage") {
                            taxAmount = (tax.tax / 100) * orderTaxable;
                        } else {
                            taxAmount = tax.tax;
                        }
                        total_tax_amount += parseFloat(taxAmount);
                    }
                });
            }

            // Delivery, packaging, platform taxes
            let extraCharges = [
                {amount: packagingCharge, taxes: snapshotsProducts.packagingTax || []},
            ];

            extraCharges.forEach(scope => {
                scope.taxes?.forEach(tax => {
                    if (tax.enable) {
                        let taxAmount = 0;
                        if (tax.type === "percentage") {
                            taxAmount = (tax.tax / 100) * scope.amount;
                        } else {
                            taxAmount = tax.tax;
                        }
                        total_tax_amount += parseFloat(taxAmount);
                    }
                });
            });

            //Final subtotal after discounts
            order_subtotal = order_subtotal - total_discount;

            // Final total
            let order_total = order_subtotal + packagingCharge + total_tax_amount;

            if (currencyAtRight) {
                order_total_val = parseFloat(order_total).toFixed(decimal_degits) + '' + currentCurrency;
            } else {
                order_total_val = currentCurrency + '' + parseFloat(order_total).toFixed(decimal_degits);
            }

            return order_total_val;
        }
        function setVisitors() {
            const data = {
                labels: [
                    "{{trans('lang.dashboard_total_orders')}}",
                    "{{trans('lang.dashboard_total_products')}}",
                ],
                datasets: [{
                    data: [jQuery("#order_count").text(), jQuery("#product_count").text()],
                    backgroundColor: [
                        '#B1DB6F',
                        '#7360ed',
                    ],
                    hoverOffset: 4
                }]
            };
            return new Chart('visitors', {
                type: 'doughnut',
                data: data,
                options: {
                    maintainAspectRatio: false,
                }
            })
        }
        function setCommision() {
            const data = {
                labels: [
                    "{{trans('lang.dashboard_total_earnings')}}"
                ],
                datasets: [{
                    data: [jQuery("#earnings_count").text().replace(currentCurrency, "")],
                    backgroundColor: [
                        '#feb84d',
                        '#9b77f8',
                        '#fe95d3'
                    ],
                    hoverOffset: 4
                }]
            };
            return new Chart('commissions', {
                type: 'doughnut',
                data: data,
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        callbacks: {
                            label: function (tooltipItems, data) {
                                return data.labels[tooltipItems.index] + ': ' + currentCurrency + data.datasets[0].data[tooltipItems.index];
                            }
                        }
                    }
                }
            })
        }
    </script>
@endsection
