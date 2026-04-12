@extends('layouts.app')
@section('content')
    <div class="page-wrapper">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">{{trans('lang.order_plural')}}</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                    <li class="breadcrumb-item active">{{trans('lang.order_plural')}}</li>
                </ol>
            </div>
            <div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div id="noPermissionMsg" class="text-center text-danger font-weight-bold mb-3" style="display:none;">
                                <p>{{ trans("lang.no_permission") }}</p>
                            </div>
                            <div class="table-responsive m-t-10">
                                <table id="orderTable"
                                       class="display nowrap table table-hover table-striped table-bordered table table-striped"
                                       cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th class="delete-all"><input type="checkbox" id="is_active"><label
                                                    class="col-3 control-label" for="is_active">
                                                <a id="deleteAll" class="do_not_delete" href="javascript:void(0)">
                                                    <i class="fa fa-trash"></i> {{trans('lang.all')}}</a></label></th>
                                        <th>{{trans('lang.order_id')}}</th>
                                        <th>{{trans('lang.order_user_id')}}</th>
                                        <th class="driverClass">{{trans('lang.driver_plural')}}</th>
                                        <th>{{trans('lang.order_order_status_id')}}</th>
                                        <th>{{trans('lang.amount')}}</th>
                                        <th>{{trans('lang.order_type')}}</th>
                                        <th>{{trans('lang.date')}}</th>
                                        <th>{{trans('lang.actions')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody id="append_list1">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        var database = firebase.firestore();
        var offest = 1;
        var pagesize = 10;
        var end = null;
        var endarray = [];
        var start = null;
        var user_id = "{{ $vendorUserId }}";
        var authRole = "{{ $authRole }}";
        var empVendorId = "{{ $empVendorId }}";
        let currentPermissions = {
            isActive: true   
        };
        var append_list = '';
        var user_number = [];
        var ref;
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
        
        document.addEventListener("DOMContentLoaded", async function() {      
            if (authRole === 'employee') {               
                const perm = await getEmployeePermissionForTitle(user_id, "Manage Order");
                currentPermissions = {
                    isActive: perm.isActive ?? false
                };  

                if (!currentPermissions.isActive) {
                    alert('{{ trans("lang.no_permission") }}');
                    $('#orderTable').hide();
                    $('#noPermissionMsg').show();                     
                    return;
                }
                const vendorSnap = await database
                    .collection('vendors')
                    .where('id', '==', empVendorId)
                    .limit(1)
                    .get();

                if (vendorSnap.empty) {
                    console.error('Vendor not found for employee');
                    return;
                }

                const authorId = vendorSnap.docs[0].data().author;
                ref = database
                    .collection('restaurant_orders')
                    .where('isPosOrder','==',false)
                    .where('vendor.author','==',authorId)
                    .orderBy('createdAt','desc');
            }else{
                ref = database
                .collection('restaurant_orders')
                .where('isPosOrder','==',false)
                .where('vendor.author','==',user_id)
                .orderBy('createdAt','desc');
            }
            
            $(document.body).on('click', '.redirecttopage', function () {
                var url = $(this).attr('data-url');
                window.location.href = url;
            });
            jQuery("#data-table_processing").show();
            const table = $('#orderTable').DataTable({
                pageLength: 10,
                processing: false,
                serverSide: true,
                responsive: true,
                ajax: async function (data, callback, settings) {
                    const start = data.start;
                    const length = data.length;
                    const searchValue = data.search.value.toLowerCase();
                    const orderColumnIndex = data.order[0].column;
                    const orderDirection = data.order[0].dir;
                    const orderableColumns = ['','id','client','driver','status','price','takeAway','createdAt',''];
                    const orderByField = orderableColumns[orderColumnIndex];
                    if (searchValue.length >= 3 || searchValue.length === 0) {
                        $('#data-table_processing').show();
                    }
                    try {
                        const querySnapshot = await ref.get();
                        if (!querySnapshot || querySnapshot.empty) {
                            $('#data-table_processing').hide();
                            callback({
                                draw: data.draw,
                                recordsTotal: 0,
                                recordsFiltered: 0,
                                data: []
                            });
                            return;
                        }
                        let records = [];
                        let filteredRecords = [];
                        await Promise.all(querySnapshot.docs.map(async (doc) => {
                            let childData = doc.data();
                            childData.id = doc.id;
                            if(childData.hasOwnProperty('author') && childData.author != null && childData.author != ''){
                                childData.afirstName = childData.author.firstName;
                                childData.alastName = childData.author.lastName;
                            }
                            else{
                                childData.afirstName = '';
                                childData.alastName = '';
                            }
                            if(childData.hasOwnProperty('driver') && childData.driver != null && childData.driver != '')
                            {
                                childData.dfirstName = childData.driver.firstName;
                                childData.dlastName = childData.driver.lastName;    
                            }
                            else{
                                childData.dfirstName = '';
                                childData.dlastName = '';
                            }
                            var client = '';
                            if (childData.afirstName != ' ' || childData.alastName != '') {
                                client = childData.afirstName + ' ' + childData.alastName;
                            }
                            childData.client = client ? client : ' ';
                            var driver = '';
                            if (childData.dfirstName != ' ' || childData.dlastName != '' ) {
                                driver = childData.dfirstName + ' ' + childData.dlastName;
                            }
                            childData.driver = driver ? driver : ' ';
                            var price = 0;
                            childData.price =  buildHTMLProductstotal(childData);
                            var takeAway = '';
                            if (childData.hasOwnProperty('takeAway') && childData.takeAway) {
                                takeAway = '<td>{{trans("lang.order_takeaway")}}</td>';
                            } else {
                                takeAway =  '<td>{{trans("lang.order_delivery")}}</td>';
                            }
                            childData.takeAway = takeAway ? takeAway : ' ';
                            var date = '';
                            var time = '';
                            if (childData.hasOwnProperty("createdAt") && childData.expiresAt != '') {
                                try {
                                    date = childData.createdAt.toDate().toDateString();
                                    time = childData.createdAt.toDate().toLocaleTimeString('en-US');
                                } catch (err) {
                                }
                            }
                            var createdAt = date + ' ' + time ;
                            if (searchValue) {
                                if (
                                    (childData.id && childData.id.toLowerCase().includes(searchValue)) ||
                                    (childData.client && childData.client.toLowerCase().includes(searchValue)) ||
                                    (childData.driver && childData.driver.toLowerCase().includes(searchValue)) ||
                                    (childData.status && childData.status.toLowerCase().includes(searchValue)) ||
                                    (childData.price && childData.price.toLowerCase().includes(searchValue)) ||
                                    (childData.takeAway && childData.takeAway.toLowerCase().includes(searchValue)) ||
                                    (createdAt && createdAt.toString().toLowerCase().indexOf(searchValue) > -1)
                                ) {
                                    filteredRecords.push(childData);
                                }
                            } else {
                                filteredRecords.push(childData);
                            }
                        }));
                        filteredRecords.sort((a, b) => {
                            let aValue = a[orderByField] ? a[orderByField].toString().toLowerCase().trim() : '';
                            let bValue = b[orderByField] ? b[orderByField].toString().toLowerCase().trim() : '';
                            if (orderByField === 'createdAt' && a[orderByField] != '' && b[orderByField] != '') {
                                try {
                                    aValue = a[orderByField] ? new Date(a[orderByField].toDate()).getTime() : 0;
                                    bValue = b[orderByField] ? new Date(b[orderByField].toDate()).getTime() : 0;
                                } catch (err) {
                                }
                            }
                            if (orderByField === 'price') {
                                aValue = a[orderByField] ? parseFloat(a[orderByField].replace(/[^0-9.]/g, '')) || 0 : 0;
                                bValue = b[orderByField] ? parseFloat(b[orderByField].replace(/[^0-9.]/g, '')) || 0 : 0;
                            }
                            if (orderDirection === 'asc') {
                                return (aValue > bValue) ? 1 : -1;
                            } else {
                                return (aValue < bValue) ? 1 : -1;
                            }
                        });
                        const totalRecords = filteredRecords.length;
                        const paginatedRecords = filteredRecords.slice(start, start + length);
                        const formattedRecords = await Promise.all(paginatedRecords.map(async (childData) => {
                            return await buildHTML(childData);
                        }));
                        $('#data-table_processing').hide();
                        callback({
                            draw: data.draw,
                            recordsTotal: totalRecords,
                            recordsFiltered: totalRecords,
                            data: formattedRecords
                        });
                    } catch (error) {
                        console.error("Error fetching data from Firestore:", error);
                        $('#data-table_processing').hide();
                        callback({
                            draw: data.draw,
                            recordsTotal: 0,
                            recordsFiltered: 0,
                            data: []
                        });
                    }
                },
                columnDefs: [
                    {
                        targets: 7,
                        type: 'date',
                        render: function (data) {
                            return data;
                        }
                    },
                    {orderable: false, targets: [0, 8,4]},
                ],
                order: [['7', 'desc']],
                "language": datatableLang,
            });
        function debounce(func, wait) {
            let timeout;
            const context = this;
            return function (...args) {
                clearTimeout(timeout);
                timeout = setTimeout(() => func.apply(context, args), wait);
            };
        }
        });
        async function buildHTML(val) {
            html=[];
            var id = val.id;
            var route1 = '{{route("orders.edit",":id")}}';
            route1 = route1.replace(':id', id);
            var printRoute = '{{route("vendors.orderprint",":id")}}';
            printRoute = printRoute.replace(':id', id);
            
            html.push('<td class="delete-all"><input type="checkbox" id="is_open_' + id + '" class="is_open" dataId="' + id + '"><label class="col-3 control-label"\n' +
                    'for="is_open_' + id + '" ></label></td>');
            
            html.push('<td><div data-url="'+route1+'" class="redirecttopage" style="cursor: pointer;">' + val.id + '</td>');
            if(val.client){
                html.push('<td>' + val.client + '</td>');
            }
            else{
                html.push('<td></td>');
            }
            if (val.driver) {
                html.push('<td >' + val.driver + '</td>');
            } else {
                html.push('<td></td>');
            }
            if (val.status == 'Order Placed') {
                html.push('<td><span class="order_placed">' + val.status + '</span></td>');
            } else if (val.status == 'Order Accepted') {
                html.push('<td><span class="order_accepted">' + val.status + '</span></td>');
            } else if (val.status == 'Order Rejected') {
                html.push('<td><span class="order_rejected">' + val.status + '</span></td>');
            }  else if (val.status == 'Order Cancelled') {
                html.push('<td><span class="order_rejected">' + val.status + '</span></td>');
            }else if (val.status == 'Driver Pending') {
                html.push('<td><span class="driver_pending order_placed">' + val.status + '</span></td>');
            } else if (val.status == 'Driver Rejected') {
                html.push('<td><span class="driver_rejected">' + val.status + '</span></td>');
            } else if (val.status == 'Order Shipped') {
                html.push('<td><span class="order_shipped">' + val.status + '</span></td>');
            } else if (val.status == 'In Transit') {
                html.push('<td><span class="in_transit">' + val.status + '</span></td>');
            } else if (val.status == 'Order Completed') {
                html.push('<td><span class="order_completed">' + val.status + '</span></td>');
            }else{
                html.push('<td><span class="order_placed">' + val.status + '</span></td>');
            }
            html.push('<td class="text-green">' + val.price + '</td>');
            html.push(val.takeAway);
            var createdAt_val = '';
            if (val.createdAt) {
                var date1 = val.createdAt.toDate().toDateString();
                createdAt_val = date1;
                var time = val.createdAt.toDate().toLocaleTimeString('en-US');
                createdAt_val = createdAt_val + ' ' + time;
            }
            html.push('<td>' + createdAt_val + '</td>');
            html.push(
                '<span class="action-btn">'
                + '<a href="' + printRoute + '"><i class="fa fa-print" style="font-size:20px;"></i></a>'
                + '<a href="' + route1 + '"><i class="fa fa-edit"></i></a>'
                +  '<a id="' + val.id + '" class="do_not_delete" name="order-delete" href="javascript:void(0)"><i class="fa fa-trash"></i></a>'
                    
                + '</span>'
            );

            return html;
        }
        $("#is_active").click(function () {
            $("#orderTable .is_open").prop('checked', $(this).prop('checked'));
        });

        $("#deleteAll").click(function() {
            const checkedOrders = $('#orderTable .is_open:checked');
            if (!checkedOrders.length) {
                alert("{{ trans('lang.please_select_any_one_record') }}");
                return;
            }
            if (!confirm("{{ trans('lang.are_you_sure_want_to_delete_selected_data') }}")) return;
            const orderIds = [];
            checkedOrders.each(function() {
                orderIds.push($(this).attr('dataId'));
            });
            deleteOrders(orderIds);
        });

        $(document).on("click", "a[name='order-delete']", function(e) {
            const orderId = this.id;
            deleteOrders([orderId]);
        });

        async function deleteOrders(orderIds) {
            if (!orderIds || !orderIds.length) return;
            jQuery("#data-table_processing").show();

            try {
                // Loop through each order
                for (let i = 0; i < orderIds.length; i++) {
                    const orderId = orderIds[i];

                    // Get drivers who have this order in orderRequestData
                    let snapshot1 = await database.collection("users")
                        .where("role", "==", "driver")
                        .where("orderRequestData", "array-contains", orderId)
                        .get();

                    // Get drivers who have this order in inProgressOrderID
                    let snapshot2 = await database.collection("users")
                        .where("role", "==", "driver")
                        .where("inProgressOrderID", "array-contains", orderId)
                        .get();

                    // Merge drivers (avoid duplicates)
                    let driversMap = new Map();
                    snapshot1.docs.concat(snapshot2.docs).forEach(doc => {
                        driversMap.set(doc.id, doc);
                    });

                    // Remove order ID from both arrays
                    let batch = database.batch();
                    driversMap.forEach((doc, driverId) => {
                        const driverRef = database.collection("users").doc(driverId);
                        batch.update(driverRef, {
                            orderRequestData: firebase.firestore.FieldValue.arrayRemove(orderId),
                            inProgressOrderID: firebase.firestore.FieldValue.arrayRemove(orderId)
                        });
                    });

                    await batch.commit();

                    // Delete the order itself
                    await database.collection('restaurant_orders').doc(orderId).delete();

                    console.log(`Order ${orderId} deleted and removed from all drivers`);
                }

                // Reload page after all orders processed
                setTimeout(() => {
                    window.location.reload();
                }, 1500);

            } catch (error) {
                console.error("Error deleting orders:", error);
                alert("Failed to delete some orders. Check console for details.");
            }
        }
        
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
    </script>
@endsection
