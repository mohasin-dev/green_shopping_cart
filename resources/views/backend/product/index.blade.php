@extends('backend.layouts.app')

@section('title','Product')

@push('css')
    <!-- JQuery DataTable Css -->
    <link href="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <a class="btn btn-primary waves-effect" href="{{ route('admin.product.create') }}">
                <i class="material-icons">add</i>
                <span>Add New Product</span>
            </a>
        </div>
        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            ALL Products
                            <span class="badge bg-blue">{{ $products->count() }}</span>
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Purchase Price</th>
                                    <th>Regular Price</th>
                                    <th>Sale Price</th>
                                    <th>Stock</th>
                                    <th>Featured</th>
                                    {{-- <th>Is Discount</th>
                                    <th>Discount Type</th>
                                    <th>Discount Amount</th> --}}
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Purchase Price</th>
                                    <th>Regular Price</th>
                                    <th>Sale Price</th>
                                    <th>Stock</th>
                                    <th>Featured</th>
                                    {{-- <th>Is Discount</th>
                                    <th>Discount Type</th>
                                    <th>Discount Amount</th> --}}
                                    <th>Action</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                    @foreach($products as $key=>$product)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $product->product_title }}</td>
                                            <td>{{ $product->purchase_price }}</td>
                                            <td>{{ $product->regular_price }}</td>
                                            <td>{{ $product->sale_price }}</td>
                                            <td>{{ $product->stock }}</td>
                                            <td>
                                                @if ($product->featured == 1)
                                                Yes
                                                @else
                                                No
                                                @endif
                                            </td>
                                            {{-- <td>{{ $product->is_discount }}</td>
                                            <td>{{ $product->discount_type }}</td>
                                            <td>{{ $product->discount_amount }}</td> --}}
                                            <td class="text-center">
                                                <a href="{{ route('admin.product.edit',$product->id) }}" class="btn btn-info waves-effect">
                                                    <i class="material-icons">edit</i>
                                                </a>
                                                <button class="btn btn-danger waves-effect" type="button" onclick="deleteproduct({{ $product->id }})">
                                                    <i class="material-icons">delete</i>
                                                </button>
                                                <form id="delete-form-{{ $product->id }}" action="{{ route('admin.product.destroy',$product->id) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
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
             {{--<a class="btn btn-primary waves-effect" href="{{ route('admin.product.create') }}">
                <i class="material-icons">add</i>
                <span>Add New Product</span>
            </a>--}}
        </div>
        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            ALL Deleted Products
                            <span class="badge bg-blue">{{ $deleted_products->count() }}</span>
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Category URL</th>
                                    <th>Updated At</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Action</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                    @foreach($deleted_products as $key=>$deleted_product)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $deleted_product->product_title }}</td>
                                            <td>{{ $deleted_product->created_at }}</td>
                                            <td>{{ $deleted_product->updated_at }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('admin.product.restore',$deleted_product->id) }}" class="btn btn-info waves-effect">
                                                    {{-- <i class="material-icons">edit</i> --}}Restore
                                                </a>
                                                <button class="btn btn-danger waves-effect" type="button" onclick="restore_product({{ $deleted_product->id }})">
                                                    {{-- <i class="material-icons">delete</i> --}}Permanent Delete
                                                </button>
                                                <form id="restore-form-{{ $deleted_product->id }}" action="{{ route('admin.product.permanent.delete',$deleted_product->id) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    {{-- @method('DELETE') --}}
                                                </form>
                                            </td>
                                        </tr>


                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Exportable Table -->
    </div>
@endsection

@push('js')
    <!-- Jquery DataTable Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>

    <script src="{{ asset('assets/backend/js/pages/tables/jquery-datatable.js') }}"></script>
    <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
    <script type="text/javascript">
        function deleteproduct(id) {
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
    function restore_product(id) {
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
                document.getElementById('restore-form-'+id).submit();
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
