@extends('layout.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h3>Products</h3>
                    <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#new">Create
                        New</button>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <table class="table" id="buttons-datatables">
                        <thead>
                            <th>#</th>
                            <th>Image</th>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Purchase Price</th>
                          {{--   <th>Sale Price</th> --}}
                            <th>Default</th>
                            <th>Alert</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach ($items as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td><img src="{{ $item->img }}" style="width:100px;"></td>
                                    <td>{{ $item->code }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->category->name }}</td>
                                    <td>{{ number_format($item->pprice, 2) }}</td>
                                   {{--  <td>{{ number_format($item->price, 2) }}</td> --}}
                                    <td>{{ $item->isDefault }}</td>
                                    <td>{{ $item->alert }}</td>
                                    <td>
                                        <button type="button" class="btn btn-info " data-bs-toggle="modal"
                                            data-bs-target="#edit_{{ $item->id }}">Edit</button>
                                    </td>
                                </tr>
                                <div id="edit_{{ $item->id }}" class="modal fade" tabindex="-1"
                                    aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="myModalLabel">Edit - Product</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"> </button>
                                            </div>
                                            <form action="{{ route('product.update', $item->id) }}" enctype="multipart/form-data" method="post">
                                                @csrf
                                                @method('patch')
                                                <div class="modal-body">
                                                    <div class="form-group mt-2">
                                                        <label for="code">Code</label>
                                                        <input type="text" name="code" required
                                                            value="{{ $item->code }}" id="code"
                                                            class="form-control">
                                                    </div>
                                                    <div class="form-group mt-2">
                                                        <label for="name">Name</label>
                                                        <input type="text" name="name" required
                                                            value="{{ $item->name }}" id="name"
                                                            class="form-control">
                                                    </div>
                                                    <div class="form-group mt-2">
                                                        <label for="catID">Category</label>
                                                       <select name="catID" id="catID" class="form-control">
                                                        @foreach ($cats as $cat)
                                                            <option value="{{$cat->id}}" @selected($cat->id == $item->catID)>{{$cat->name}}</option>
                                                        @endforeach
                                                       </select>
                                                    </div>
                                                    <div class="form-group mt-2">
                                                        <label for="isDefault">Default</label>
                                                       <select name="isDefault" id="isDefault" class="form-control">
                                                            <option value="No" @selected($item->isDefault == "No")>No</option>
                                                            <option value="Yes" @selected($item->isDefault == "Yes")>Yes</option>

                                                       </select>
                                                    </div>
                                                    <div class="form-group mt-2">
                                                        <label for="pprice">Purchase Price</label>
                                                        <input type="number" step="any" name="pprice" required
                                                            value="{{ $item->pprice }}" min="0" id="pprice"
                                                            class="form-control">
                                                    </div>
                                                    <div class="form-group mt-2">
                                                        <label for="alert">Alert</label>
                                                        <input type="number" step="any" name="alert" required
                                                            value="{{ $item->alert }}" min="0" id="alert"
                                                            class="form-control">
                                                    </div>
                                                   {{--  <div class="form-group mt-2">
                                                        <label for="price">Sale Price</label>
                                                        <input type="number" step="any" name="price" required
                                                            value="{{ $item->price }}" min="0" id="price"
                                                            class="form-control">
                                                    </div> --}}
                                                   {{--  <div class="form-group mt-2">
                                                        <label for="discount">Discount</label>
                                                        <input type="number" step="any" name="discount" required
                                                            value="{{ $item->discount }}" min="0"
                                                            id="discount" class="form-control">
                                                    </div> --}}
                                                    <div class="row">
                                                        <div class="col-md-6 mt-2">
                                                            <div class="form-group">
                                                                <input type="file" id="image1" name="img" class="form-control" accept="image/*">
                                                                @error('image')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 mt-2">
                                                            <img id="imagePreview1" src="{{$item->img}}" alt="Image Preview" style="display: none; max-width: 150px; max-height: 150px;">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </div>
                                            </form>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Default Modals -->

    <div id="new" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Create New Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <form action="{{ route('product.store') }}" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mt-2">
                            <label for="code">Code</label>
                            <input type="text" name="code" required id="code" class="form-control">
                        </div>
                        <div class="form-group mt-2">
                            <label for="name">Name</label>
                            <input type="text" name="name" required id="name" class="form-control">
                        </div>
                        <div class="form-group mt-2">
                            <label for="catID">Category</label>
                           <select name="catID" id="catID" class="form-control">
                            @foreach ($cats as $cat)
                                <option value="{{$cat->id}}">{{$cat->name}}</option>
                            @endforeach
                           </select>
                        </div>
                        <div class="form-group mt-2">
                            <label for="isDefault">Default</label>
                           <select name="isDefault" id="isDefault" class="form-control">
                                <option value="No" >No</option>
                                <option value="Yes" >Yes</option>

                           </select>
                        </div>
                        <div class="form-group mt-2">
                            <label for="pprice">Purchase Price</label>
                            <input type="number" step="any" name="pprice" required
                                value="" min="0" id="pprice"
                                class="form-control">
                        </div>
                        <div class="form-group mt-2">
                            <label for="alert">Alert</label>
                            <input type="number" step="any" name="alert" required
                                 min="0" id="alert"
                                class="form-control">
                        </div>
                        <div class="row">
                            <div class="col-md-6 mt-2">
                                <div class="form-group">
                                    <input type="file" id="image" required name="img" class="form-control" accept="image/*">
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mt-2">
                                <img id="imagePreview" src="#" alt="Image Preview" style="display: none; max-width: 150px; max-height: 150px;">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection

@section('page-css')
<link rel="stylesheet" href="{{ asset('assets/libs/datatable/datatable.bootstrap5.min.css') }}" />
<!--datatable responsive css-->
<link rel="stylesheet" href="{{ asset('assets/libs/datatable/responsive.bootstrap.min.css') }}" />

<link rel="stylesheet" href="{{ asset('assets/libs/datatable/buttons.dataTables.min.css') }}">
@endsection
@section('page-js')
    <script src="{{ asset('assets/libs/datatable/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('assets/libs/datatable/dataTables.bootstrap5.min.js')}}"></script>
    <script src="{{ asset('assets/libs/datatable/dataTables.responsive.min.js')}}"></script>
    <script src="{{ asset('assets/libs/datatable/dataTables.buttons.min.js')}}"></script>
    <script src="{{ asset('assets/libs/datatable/buttons.print.min.js')}}"></script>
    <script src="{{ asset('assets/libs/datatable/buttons.html5.min.js')}}"></script>
    <script src="{{ asset('assets/libs/datatable/vfs_fonts.js')}}"></script>
    <script src="{{ asset('assets/libs/datatable/pdfmake.min.js')}}"></script>
    <script src="{{ asset('assets/libs/datatable/jszip.min.js')}}"></script>

    <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>
    <script>
        $(document).ready(function () {
    // Listen for changes in the file input
    $("#image").change(function () {
        // Get the selected file
        var file = this.files[0];
        if (file) {
            // Create a FileReader
            var reader = new FileReader();
            // Set a function to run when the file is loaded
            reader.onload = function (e) {
                // Set the source of the image element to the Data URL
                $("#imagePreview").attr("src", e.target.result);
                // Display the image element
                $("#imagePreview").show();
            };
            // Read the file as a Data URL
            reader.readAsDataURL(file);
        }
    });
    });
    </script>
@endsection
