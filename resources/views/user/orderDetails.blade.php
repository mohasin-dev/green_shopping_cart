@extends('backend.layouts.app')

@section('title','Order Details')

@push('css')
    <!-- JQuery DataTable Css -->
    <link href="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="container-fluid">
        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2 class="text-center">
                           <img src="{{ asset('images/setting/'. setting()->logo) }}">
                        </h2>
                    </div>
                    <div class="body" style="padding-bottom: 0;">
                        <div class="table-responsive">
                            <table class="table table-bsaleed table-striped table-hover dataTable js-exportable">
                                <thead>
                                <tr>
                                    <th>User Details</th>
                                    <th>Shipping Details</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="body">
                                               <p>{{ $userDetails->name }} {{ $userDetails->last_name }}</p>
                                               <p>{{ $userDetails->email }}</p>
                                               <p>{{ $userDetails->mobile_number }}</p>
                                               <p>{{ $userDetails->address }}</p>
                                               @php
                                                    $upazila_info = App\Upazila::where('id',$userDetails->upazila_id)->first();
                                                @endphp
                                                @if ( $upazila_info)
                                                <p>{{ $upazila_info->upazila_name }}</p>
                                                @endif
                                                @if ( $upazila_info)
                                                <p>{{ App\District::where('id', $upazila_info->district_id)->first()->district_name }}<br>
                                                </p>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <div class="body">
                                                <p>Invoice No: GHB{{ $order_id }}</p>
                                                <p>{{ $shippingDetails->name }}</p>
                                                <p>{{ $shippingDetails->email }}</p>
                                                <p>{{ $shippingDetails->phone }}</p>
                                                <p>{{ $shippingDetails->address }}</p>
                                                @php
                                                    $upazila_info = App\Upazila::where('id',$shippingDetails->upazila_id)->first();
                                                @endphp
                                                @if ( $upazila_info)
                                                <p>{{ $upazila_info->upazila_name }}</p>
                                                @endif
                                                @if ( $upazila_info)
                                                <p>{{ App\District::where('id', $upazila_info->district_id)->first()->district_name }}<br>
                                                </p>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bsaleed table-striped table-hover dataTable js-exportable">
                                    <div class="header" style="padding: 0 0 10px; 0">
                                        <h2 class="text-center">
                                            Order Invoice
                                        </h2>
                                    </div>
                                <thead>
                                    <tr>
                                        <td>Payment Method:</td>
                                        <td>
                                            @if ($shippingDetails->payment_method == 1)
                                            Cash In Delevery
                                            @elseif($shippingDetails->payment_method == 2)
                                            Bkash | Transaction Number : {{ $shippingDetails->transaction_number }}
                                            @elseif($shippingDetails->payment_method == 3)
                                            Roket | Transaction Number : {{ $shippingDetails->transaction_number }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>SL</th>
                                        <th>Product Name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orderDetails as $key=>$item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->product->product_title }}
                                        @isset($item->product->colors)

                                                @php
                                                $color = DB::table('color_product')->where('product_id', $item->product_id)->where('color_id', $item->color)->get();
                                                @endphp
                                                @foreach ($color as $color_id)
                                                    ({{ App\Color::find($color_id->color_id)->first()->color_name }})
                                                @endforeach
                                        @endisset

                                        <td>{{ price_format($item->product->regular_price) }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ price_format($item->product->regular_price * $item->quantity)}}</td>
                                    </tr>
                                    @endforeach



                                    @if ($shippingDetails->discount > 0 )
                                        <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>Coupon Discount (-)</td>
                                        <td> {{ price_format($shippingDetails->discount) }}</td>
                                        </tr>
                                    @endif
                                    @if ($shippingDetails->custom_discount > 0 )
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>Special Discount (-)</td>
                                        <td>{{ price_format($shippingDetails->custom_discount) }}</td>
                                    </tr>
                                    @endif
                                    <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>Shipping (+)</td>
                                            <td>{{ price_format(100) }}</td>

                                        </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>Grand Total</td>
                                        <td>{{ price_format($shippingDetails->total - $shippingDetails->custom_discount) }}</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="5" style="text-align: center;">
                                            <span>{{ setting()->company_name }},</span> <span>{{ setting()->address1 }}, {{ setting()->address2 }}</span> <span>{{ setting()->mobile_number1 }}, {{ setting()->mobile_number2 }}.</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="5" style="text-align: center;">
                                            <p class="text-center" style="margin-bottom: 5px;">copyright © 2019. Green Hat Bazar | All right reserved </p>
                                            <p class="text-center" style="margin-bottom: 0px;">Design &amp; Developed By <a href="http://intezie.com" target="_blank">Intezie Limited</a> | Powered By Creativity &amp; Technology</p>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Exportable Table -->
    </div>


    <div class="container-fluid">
        <div class="block-header">
             {{--<a class="btn btn-primary waves-effect" href="{{ route('admin.order_detail.create') }}">
                <i class="material-icons">add</i>
                <span>Add New order_detail</span>
            </a>--}}
        </div>
        <!-- Exportable Table -->

        <!-- #END# Exportable Table -->
    </div>
@endsection

@push('js')
    <!-- Jquery DataTable Plugin Js -->
    {{-- <script src="{{ asset('assets/backend/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>

    <script src="{{ asset('assets/backend/js/pages/tables/jquery-datatable.js') }}"></script> --}}
    <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
    <script type="text/javascript">
        function deleteorder_detail(id) {
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('delete-form-'+id).submit();
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swal(
                        'Cancelled',
                        'Your data is safe :)',
                        'error'
                    )
                }
            })
        }
    </script>

<script type="text/javascript">
    function order_confirm(id) {
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false,
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                event.preventDefault();
                document.getElementById('delete-form-'+id).submit();
            } else if (
                // Read more about handling dismissals
                result.dismiss === swal.DismissReason.cancel
            ) {
                swal(
                    'Cancelled',
                    'Your data is safe :)',
                    'error'
                )
            }
        })
    }
</script>
@endpush



