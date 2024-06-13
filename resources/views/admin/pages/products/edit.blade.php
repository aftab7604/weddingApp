@extends('admin.layouts.app')
@section('content')
<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3"><strong>Products</strong> Edit</h1>

        <div class="row">
            <div class="col-12 col-lg-12 col-xxl-12 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <a href="{{route('admin.products')}}" class="btn btn-success">Back</a>
                        </h5>
                        
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                @if(Session::has('success'))
                                <span class="text-success">{{ Session::get('success') }}</span>
                                @endif  

                                @if(Session::has('error'))
                                <span class="text-danger">{{ Session::get('error') }}</span>
                                @endif    
                                <form action="{{route('admin.products.update')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$item->id}}">
                                    <div class="form-group mt-2 text-center">
                                        <label for="image">
                                            <img src="{{asset('images/'.$item->image)}}" alt="img" class="img img-fluid w-50 h-50 mb-4">
                                        </label>
                                        
                                        <input type="file"  id="image" name="image" class="form-control">
                                        @if ($errors->has('image'))
                                        <span class="text-danger">{{ $errors->first('image') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="name">Name</label>
                                        <input type="text"  id="name" value="{{$item->name}}" name="name" autocomplete="off" class="form-control" placeholder="Enter name here">
                                        @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="description">Description</label>
                                        <textarea id="description" name="description" autocomplete="off" class="form-control" placeholder="Enter description here">{{$item->description}}</textarea>
                                        @if ($errors->has('description'))
                                        <span class="text-danger">{{ $errors->first('description') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="price">price</label>
                                        <input type="number" step="any" value="{{$item->price}}"  id="price" name="price" autocomplete="off" class="form-control" placeholder="Enter price here">
                                        @if ($errors->has('price'))
                                        <span class="text-danger">{{ $errors->first('price') }}</span>
                                        @endif
                                    </div>

                                    <div class="form-group mt-2">
                                        <label for="status">Status</label>
                                        <select name="status" id="status" class="form-control">
                                            <option {{ $item->status == 1 ? "selected" : "" }} value="1" selected>Active</option>
                                            <option {{ $item->status == 0 ? "selected" : "" }} value="0">Inactive</option>
                                        </select>
                                        @if ($errors->has('status'))
                                        <span class="text-danger">{{ $errors->first('status') }}</span>
                                        @endif
                                    </div>
                                    
                                    
                                    <div class="form-group mt-2">
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            
        </div>

    </div>
</main>
@endsection

@section('scripts')
@endsection