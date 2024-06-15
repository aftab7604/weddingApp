@extends('admin.layouts.app')
@section('content')
<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3"><strong>Service</strong> Products - {{$service['name']}}</h1>
        @if(Session::has('success'))
        <span class="text-success">{{ Session::get('success') }}</span>
        @endif  

        @if(Session::has('error'))
        <span class="text-danger">{{ Session::get('error') }}</span>
        @endif    

        <div class="row">
            <div class="col-12 col-lg-12 col-xxl-12 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#addModal" class="btn btn-success">Add New</a>
                        </h5>
                    </div>
                    <table class="table table-responsive table-hover my-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th></th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                             $i = 1;   
                            @endphp
                            @forelse ($service['products'] as $k=>$v)
                            <tr>
                                <td>{{$i++}}</td>
                                <td></td>
                                <td>{{$v['name']}}</td>
                                <td>
                                    <a class="text-danger" href="{{route('admin.service.product.detach',[$service['id'],$v['id']])}}" onclick="return confirm('Are you sure to delete?')">Delete</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4">No Data Found</td>  
                            </tr>
                            @endforelse
                            
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>  

  
<!-- Add Service Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{route('admin.service.products.attach',$service['id'])}}" method="post">
                @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Add Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                <select name="product_id" id="product_id" class="form-control">
                    <option value="">Select Product</option>
                    @foreach ($products as $product)
                    <option value="{{$product['id']}}">{{$product['name']}}</option>
                    @endforeach
                </select>
                    
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')

@endsection