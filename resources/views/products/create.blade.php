@extends('templates.master')

@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">Add New Product</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <a href="{{asset('/')}}" class="btn btn-info btn-icon-text mb-2 mb-md-0">
                All Products
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">

            @if ($errors->any())
                <div class="mt-2 alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="mb-3">
                    <label for="name" class="form-label">Product Name <span class="text-danger">*</span></label>
                    <input id="name" name="name" type="text" class="form-control" placeholder="Product Name">
                </div>
                <div class="mb-3">
                    <label for="detail" class="form-label">Detail Product Name <span class="text-danger">*</span></label>
                    <textarea class="form-control" placeholder="Detail Product Name" name="detail" id="detail" cols="12" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price Product Name <span class="text-danger">*</span></label>
                    <textarea class="form-control" placeholder="Detail Product Name" name="price" id="price" cols="12" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Product Image <span class="text-danger">*</span></label>
                    <input id="image" name="image" type="file" class="form-control">
                </div>
<<<<<<< HEAD
                <div>
                    <button type="submit" class="btn btn-success btn-icon-text mb-2 mb-md-0">
                        Save Product Data
                    </button>
                </div>


=======

                <div>
                    <button type="submit" class="btn btn-success btn-icon-text mb-2 mb-md-0">
                       Save Product Data
                    </button>
                </div>

>>>>>>> origin/main
            </form>
        </div>

    </div>
@endsection

