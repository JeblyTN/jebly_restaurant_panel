@extends('layouts.app')
@section('content')
    <div class="page-wrapper">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">{{ trans('lang.food_plural') }}</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">{{ trans('lang.dashboard') }}</a></li>
                    <li class="breadcrumb-item active">{{ trans('lang.food_plural') }}</li>
                </ol>
            </div>
            <div>
            </div>
        </div>
        <div class="row px-5 mb-2">
            <div class="col-12">
                <span class="font-weight-bold text-danger food-limit-note"></span>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs align-items-end card-header-tabs w-100 page-menu">
                                <li class="nav-item active">
                                    <a class="nav-link" href="{!! route('foods') !!}"><i
                                            class="fa fa-list mr-2"></i>{{ trans('lang.food_table') }}</a>
                                </li>
                                <li class="nav-item create-btn">
                                    <a class="nav-link" href="{!! route('foods.create') !!}"><i
                                            class="fa fa-plus mr-2"></i>{{ trans('lang.food_create') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{!! route('foods.global') !!}"><i
                                            class="fa fa-plus mr-2"></i>{{trans('lang.food_add_global')}}</a>
                                </li>
                                
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="mb-3 d-none" id="assign-tax-container" style="display: inline-block;margin: 12px;">
                                <button type="button" class="btn btn-sm btn-warning" id="assign-taxes-btn">
                                    {{ trans('lang.assign_taxes') }}
                                </button>
                            </div>
                            <div class="table-responsive m-t-10">
                                <table id="example24"
                                    class="display nowrap table table-hover table-striped table-bordered table table-striped"
                                    cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th class="delete-all"><input type="checkbox" id="is_active"><label
                                                    class="col-3 control-label" for="is_active">
                                                    <a id="deleteAll" class="do_not_delete" href="javascript:void(0)"><i
                                                            class="fa fa-trash"></i> {{ trans('lang.all') }}</a></label>
                                            </th>
                                            <th>{{ trans('lang.food_image') }}</th>
                                            <th>{{ trans('lang.item_name') }}</th>
                                            <th>{{ trans('lang.food_price') }}</th>
                                            <th>{{ trans('lang.item_category_id') }}</th>
                                            <th>{{ trans('lang.date') }}</th>
                                            <th>{{ trans('lang.food_publish') }}</th>
                                            <th>{{ trans('lang.actions') }}</th>
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
<div class="modal fade" id="taxModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ trans('lang.select_taxes') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="product-details mb-3">
                    <div class="box border p-3">
                        <div id="product_taxes"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn btn-primary" id="modal-add-taxes-btn">
                    {{ trans('lang.add_taxes') }}
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">

    var database = firebase.firestore();
    var offest = 1;
    var pagesize = 10;
    var end = null;
    var endarray = [];
    var start = null;
    var user_number = [];
    var vendorUserId = "{{ $vendorUserId }}";
    var authRole = "{{ $authRole }}";
    var empVendorId = "{{ $empVendorId }}";
    var vendorId;
    var ref = database.collection('vendor_products');
    var append_list = '';
    var placeholderImage = '';
    var activeCurrencyref = database.collection('currencies').where('isActive', "==", true);
    var activeCurrency = '';
    var currencyAtRight = false;
    var decimal_degits = 0;
    let currentPermissions = {
        isActive: true   
    };
    activeCurrencyref.get().then(async function(currencySnapshots) {
        currencySnapshotsdata = currencySnapshots.docs[0].data();
        activeCurrency = currencySnapshotsdata.symbol;
        currencyAtRight = currencySnapshotsdata.symbolAtRight;
        if (currencySnapshotsdata.decimal_degits) {
            decimal_degits = currencySnapshotsdata.decimal_degits;
        }
    });

    let selectedProductIds = [];
    let globalTaxScope = null;
    (async function() {
        let globalTaxSnapshot = await database.collection('settings').doc('globalSettings').get();
        let globalTax = globalTaxSnapshot.data();
        globalTaxScope = globalTax.taxScope;
    })();

    document.addEventListener("DOMContentLoaded", async function() {       
        $('#category_search_dropdown').hide();
        if (authRole === 'employee') {               
            const perm = await getEmployeePermissionForTitle(vendorUserId, "Manage Products");

            currentPermissions = {
                isActive: perm.isActive ?? false
            };           

            if (!currentPermissions.isActive) {
                alert('{{ trans("lang.no_permission") }}');
                $('#example24').hide();
                $('.page-menu').html('<p class="text-center text-danger font-weight-bold">{{ trans("lang.no_permission") }}</p>');
                return;
            }
        }
    
        $(document.body).on('click', '.redirecttopage', function() {
            var url = $(this).attr('data-url');
            window.location.href = url;
        });
        
        var placeholder = database.collection('settings').doc('placeHolderImage');
        placeholder.get().then(async function(snapshotsimage) {
            var placeholderImageData = snapshotsimage.data();
            placeholderImage = placeholderImageData.image;
        })

        const table = $('#example24').DataTable({
            pageLength: 10, // Number of rows per page
            processing: false, // Show processing indicator
            serverSide: true, // Enable server-side processing
            responsive: true,
            ajax: async function(data, callback, settings) {
                const start = data.start;
                const length = data.length;
                const searchValue = data.search.value.toLowerCase();
                const orderColumnIndex = data.order[0].column;
                const orderDirection = data.order[0].dir;
                const orderableColumns = ['', '', 'name', 'finalPrice', 'categoryName', 'createdAt',
                    '', ''
                ]; // Ensure this matches the actual column names
                const orderByField = orderableColumns[orderColumnIndex];
                if (searchValue.length >= 3 || searchValue.length === 0) {
                    $('#data-table_processing').show();
                }
                try {
                    const Vendor = await getVendorId(vendorUserId);
                    const querySnapshot = await ref.where('vendorID', "==", Vendor).get();
                    if (!querySnapshot || querySnapshot.empty) {
                        console.error("No data found in Firestore.");
                        $('#data-table_processing').hide(); // Hide loader
                        callback({
                            draw: data.draw,
                            recordsTotal: 0,
                            recordsFiltered: 0,
                            data: [] // No data
                        });
                        return;
                    }
                    let records = [];
                    let filteredRecords = [];
                    await Promise.all(querySnapshot.docs.map(async (doc) => {
                        let childData = doc.data();
                        childData.id = doc
                            .id; // Ensure the document ID is included in the data
                        var finalPrice = 0;
                        if (childData.hasOwnProperty('disPrice') && childData
                            .disPrice != '' && childData.disPrice != '0') {
                            finalPrice = childData.disPrice;
                        } else {
                            finalPrice = childData.price;
                        }
                        childData.finalPrice = parseInt(finalPrice);
                        childData.categoryName = await productCategory(childData
                            .categoryID);
                        var date = '';
                        var time = '';
                        if (childData.hasOwnProperty("createdAt") && childData
                            .expiresAt != '') {
                            try {
                                date = childData.createdAt.toDate().toDateString();
                                time = childData.createdAt.toDate()
                                    .toLocaleTimeString('en-US');
                            } catch (err) {}
                        }
                        var createdAt = date + ' ' + time;
                        childData.createDateTime=createdAt;
                        if (searchValue) {
                            if (
                                (childData.name && childData.name.toString()
                                    .toLowerCase().includes(searchValue)) ||
                                (childData.finalPrice && childData.finalPrice
                                    .toString().toLowerCase().includes(searchValue)
                                ) ||
                                (childData.categoryName && childData.categoryName
                                    .toString().toLowerCase().includes(
                                        searchValue) ||
                                    (createdAt && createdAt.toString().toLowerCase()
                                        .indexOf(searchValue) > -1)
                                )
                            ) {
                                filteredRecords.push(childData);
                            }
                        } else {
                            filteredRecords.push(childData);
                        }
                    }));
                    filteredRecords.sort((a, b) => {
                        let aValue = a[orderByField];
                        let bValue = b[orderByField];
                        if (orderByField === 'createdAt' && a[orderByField] != '' && b[
                                orderByField] != '') {
                            try {
                                aValue = a[orderByField] ? new Date(a[orderByField]
                                .toDate()).getTime() : 0;
                                bValue = b[orderByField] ? new Date(b[orderByField]
                                .toDate()).getTime() : 0;
                            } catch (err) {}
                        }
                        if (orderByField === 'finalPrice') {
                            aValue = a[orderByField] ? parseInt(a[orderByField]) : 0;
                            bValue = b[orderByField] ? parseInt(b[orderByField]) : 0;
                        } else {
                            aValue = a[orderByField] ? a[orderByField].toString()
                                .toLowerCase().trim() : '';
                            bValue = b[orderByField] ? b[orderByField].toString()
                                .toLowerCase().trim() : '';
                        }
                        if (orderDirection === 'asc') {
                            return (aValue > bValue) ? 1 : -1;
                        } else {
                            return (aValue < bValue) ? 1 : -1;
                        }
                    });
                    const totalRecords = filteredRecords.length;
                    const paginatedRecords = filteredRecords.slice(start, start + length);
                    const formattedRecords = await Promise.all(paginatedRecords.map(async (
                        childData) => {
                        return await buildHTML(childData);
                    }));
                    $('#data-table_processing').hide(); // Hide loader
                    callback({
                        draw: data.draw,
                        recordsTotal: totalRecords,
                        recordsFiltered: totalRecords,
                        data: formattedRecords
                    });
                } catch (error) {
                    console.error("Error fetching data from Firestore:", error);
                    jQuery('#overlay').hide();
                    callback({
                        draw: data.draw,
                        recordsTotal: 0,
                        recordsFiltered: 0,
                        data: []
                    });
                }
            },
            order: [5, 'asc'],
            columnDefs: [{
                    orderable: false,
                    targets: [0, 1, 6, 7]
                },
                {
                    targets: 5,
                    type: 'date',
                    render: function(data) {
                        return data;
                    }
                },
            ],
            "language": datatableLang,
        });

        function debounce(func, wait) {
            let timeout;
            const context = this;
            return function(...args) {
                clearTimeout(timeout);
                timeout = setTimeout(() => func.apply(context, args), wait);
            };
        }

         $('#assign-tax-container').insertAfter($('#example24_length'));
    });

    $(document.body).on('change', '#selected_search', function() {
        if (jQuery(this).val() == 'category') {
            var ref_category = database.collection('vendor_categories');
            ref_category.get().then(async function(snapshots) {
                snapshots.docs.forEach((listval) => {
                    var data = listval.data();
                    $('#category_search_dropdown').append($("<option></option").attr(
                        "value", data.id).text(data.title));
                });
            });
            jQuery('#search').hide();
            jQuery('#category_search_dropdown').show();
        } else {
            jQuery('#search').show();
            jQuery('#category_search_dropdown').hide();
        }
    });

    async function buildHTML(val) {
        var html = [];
        var id = val.id;
        var route1 = '{{ route('foods.edit', ':id') }}';
        route1 = route1.replace(':id', id);
       
        html.push('<td class="delete-all"><input type="checkbox" id="is_open_' + id + '" class="is_open" dataId="' +
                id + '"><label class="col-3 control-label"\n' +
                'for="is_open_' + id + '" ></label></td>');
       
        if (val.photo == '' && val.photo == null) {
            html.push('<td><div class="any"><img class="rounded" style="width:50px" src="' + placeholderImage +
                '" alt="image"></div></td>');
        } else {
            html.push('<td><div class="any"><img onerror="this.onerror=null;this.src=\'' + placeholderImage +
                '\'" class="rounded" style="width:50px" src="' + val.photo + '" alt="image"></div></td>');
        }
        const tax = val.taxSetting || [];

        let tax_titles = '';

      
        if (globalTaxScope === "product" && tax.length > 0) {
            const taxDisplay = tax
                .map(t => {
                    const value = t.type === 'percentage'
                        ? `${t.tax}%`
                        : currencyAtRight
                            ? `${t.tax} ${activeCurrency}`
                            : `${activeCurrency} ${t.tax}`;

                    return `${t.title}(${value})`;
                })
                .join(', ');

            tax_titles = `<p class="d-block text-muted">Taxes: ${taxDisplay}</p>`;
        }
        html.push('<td data-url="' + route1 + '" class="redirecttopage any">' + val.name + tax_titles + '</td>');
        if (val.hasOwnProperty('disPrice') && val.disPrice != '' && val.disPrice != '0') {
            if (currencyAtRight) {
                html.push('<td class="text-green">' + parseFloat(val.disPrice).toFixed(decimal_degits) + '' +
                    activeCurrency + ' <s>' + parseFloat(val.price).toFixed(decimal_degits) + '' +
                    activeCurrency + '</s></td>');
            } else {
                html.push('<td class="text-green">' + activeCurrency + '' + parseFloat(val.disPrice).toFixed(
                    decimal_degits) + ' <s>' + activeCurrency + '' + parseFloat(val.price).toFixed(
                    decimal_degits) + '</s></td>');
            }
        } else {
            if (currencyAtRight) {
                html.push('<td class="text-green">' + parseFloat(val.price).toFixed(decimal_degits) + '' +
                    activeCurrency + '</td>');
            } else {
                html.push('<td class="text-green">' + activeCurrency + '' + parseFloat(val.price).toFixed(
                    decimal_degits) + '</td>');
            }
        }
        
        html.push('<td class="category_' + val.categoryID + '">' + val.categoryName + '</td>');
        html.push('<td>'+val.createDateTime+'</td>');
        if (val.publish) {
            html.push('<td><label class="switch"><input type="checkbox" checked id="' + val.id +
                '" name="publish"><span class="slider round"></span></label></td>');
        } else {
            html.push('<td><label class="switch"><input type="checkbox" id="' + val.id +
                '" name="publish"><span class="slider round"></span></label></td>');
        }
        var action = '';
        action = action + '<span class="action-btn"><a href="' + route1 + '"><i class="fa fa-edit"></i></a>';
        
        action = action + '<a id="' + val.id +
            '" class="do_not_delete" name="food-delete" href="javascript:void(0)"><i class="fa fa-trash"></i></a>';
        
        action = action + '</span>';
        html.push(action);
        return html;
    }
    $(document).on("click", "input[name='publish']", function(e) {
        var ischeck = $(this).is(':checked');
        var id = this.id;
        if (ischeck) {
            database.collection('vendor_products').doc(id).update({
                'publish': true
            }).then(function(result) {});
        } else {
            database.collection('vendor_products').doc(id).update({
                'publish': false
            }).then(function(result) {});
        }
    });

    $("#is_active").click(function() {
        $("#example24 .is_open").prop('checked', $(this).prop('checked')).trigger('change');
    });
    
    $("#deleteAll").click(function() {
        if ($('#example24 .is_open:checked').length) {
            if (confirm('{{trans("lang.are_you_sure_want_to_delete_selected_data")}}')) {
                jQuery("#data-table_processing").show();
                $('#example24 .is_open:checked').each(async function() {
                    var dataId = $(this).attr('dataId');
                    await deleteDocumentWithImage('vendor_products', dataId, 'photo', 'photos');
                    window.location.reload();
                });
            }
        } else {
            alert('{{trans("lang.please_select_any_one_record")}}');
        }
    });

    async function productCategory(category) {
        var productCategory = '';
        await database.collection('vendor_categories').where("id", "==", category).get().then(async function(
            snapshotss) {
            if (snapshotss.docs[0]) {
                var category_data = snapshotss.docs[0].data();
                productCategory = category_data.title;
            }
        });
        return productCategory;
    }

    $(document).on("click", "a[name='food-delete']", async function(e) {
        jQuery("#data-table_processing").show();
        var id = this.id;
        await deleteDocumentWithImage('vendor_products', id, 'photo', 'photos');
        window.location.reload();
    });
    
    async function getVendorId(vendorUser) {

        let vendorId = '';
        let vendorData = null;
        let itemLimit = null;

        let vendorQuery;
        if (authRole === 'vendor') {
            vendorQuery = await database.collection('vendors').where('author', '==', vendorUser).get();
        } else {
            vendorQuery = await database.collection('vendors').where('id', '==', empVendorId).get();
        }
        if (vendorQuery.empty) {
            console.error('Vendor not found');
            return '';
        }

        vendorData = vendorQuery.docs[0].data();
        vendorId = vendorData.id;

        //Check subscription model
        const subscriptionSnap = await database.collection('settings').doc('restaurant').get();
        const subscriptionSetting = subscriptionSnap.data();
        const subscriptionModel = subscriptionSetting?.subscription_model === true;

        if (subscriptionModel && vendorData.subscription_plan && vendorData.subscription_plan.itemLimit ) {
            itemLimit = vendorData.subscription_plan.itemLimit;
            if (itemLimit !== '-1') {
                $('.food-limit-note').html(
                    `{{ trans('lang.note') }} :
                    {{ trans('lang.your_food_limit_is') }} ${itemLimit}
                    {{ trans('lang.so_only_first') }} ${itemLimit}
                    {{ trans('lang.foods_will_visible_to_customer') }}`
                );
            }
        }

        let countryName = getCookie('vendorCountryName') ?? '';
        if(globalTaxScope == "product" && countryName){
            const taxSnapshots = await database.collection('tax').where('enable', '==', true).where('scope', '==', 'product').where('country', '==', countryName).get();
            if (taxSnapshots.docs.length > 0) {
                window.taxSnapshots = taxSnapshots;
                $('#assign-tax-container').removeClass('d-none');
            }
        }

        return vendorId;
    }

    $('#assign-taxes-btn').on('click', async function() {

        $('#data-table_processing').show();

        $("#example24 .is_open:checked").each(function () {
            selectedProductIds.push($(this).attr('dataId'));
        });

        if (!selectedProductIds.length) {
            Swal.fire({ icon: 'warning', text: 'No products selected.' });
            $('#data-table_processing').hide();
            return;
        }

        let taxesHtml = '';
        window.taxSnapshots.docs.forEach((doc) => {
            let data = doc.data();
            let taxText = data.title + ' (';
            if (data.type === 'percentage') {
                taxText += data.tax + '%';
            } else {
                if (currencyAtRight) {
                    taxText += parseFloat(data.tax).toFixed(decimal_degits) + ' ' + activeCurrency;
                } else {
                    taxText += activeCurrency + parseFloat(data.tax).toFixed(decimal_degits);
                }
            }
            taxText += ')';
            let taxData = encodeURIComponent(JSON.stringify(data));
            taxesHtml += `
                <div class="form-check mb-2">
                    <input class="form-check-input product-tax"
                        type="checkbox"
                        data-tax='${taxData}'
                        id="tax_${doc.id}">
                    <label class="form-check-label" for="tax_${doc.id}">${taxText}</label>
                </div>
            `;
        });

        $('#product_taxes').html(taxesHtml);
        $('.product-tax').prop('checked', false);
        $('#taxModal').modal('show');
        $('#data-table_processing').hide();
    });

    $('#modal-add-taxes-btn').on('click', async function() {
        $('#taxModal').modal('hide');
        let selectedTaxes = [];
        $('.product-tax:checked').each(function () {
            let taxObj = $(this).data('tax');
            taxObj = JSON.parse(decodeURIComponent(taxObj));
            selectedTaxes.push(taxObj);
        });
        Swal.fire({
            title: 'Assigning taxes...',
            allowOutsideClick: false,
            didOpen: () => Swal.showLoading()
        });
        try {
            for (let productId of selectedProductIds) {
                const productRef = database.collection('vendor_products').doc(productId);
                await productRef.update({ taxSetting: selectedTaxes });
            }
            Swal.fire({
                icon: 'success',
                title: 'Taxes assigned successfully!',
                showConfirmButton: false,
                timer: 2000
            }).then(() => {
                location.reload();
            });
        } catch (error) {
            console.error(error);
            Swal.fire({ icon: 'error', text: 'Error assigning taxes.' });
        }
    });

</script>

@endsection
