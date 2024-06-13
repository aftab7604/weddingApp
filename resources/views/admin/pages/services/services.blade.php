@extends('admin.layouts.app')
@section('content')
<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3"><strong>Services</strong></h1>
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
                            <a href="{{route('admin.services.create')}}" class="btn btn-success">Add New</a>
                        </h5>
                    </div>
                    <table class="table table-responsive table-hover my-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th></th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                             $i = 1;   
                            @endphp
                            @forelse ($list as $k=>$v)
                            <tr>
                                <td>{{$i++}}</td>
                                <td><img src="{{asset('images/'.$v['image'])}}" alt="img" class="img img-fluid" style="width:50px; height:50px;"></td>
                                <td>{{$v['name']}}</td>
                                <td>{{$v['description']}}</td>
                                <td>{{$v['price']}}</td>
                                <td>{{$v['status'] == 1 ? 'Active' : 'Inactive'}}</td>
                                <td>
                                    <a href="{{route('admin.services.edit',$v['id'])}}" class="text-warning">Edit</a> | <a href="{{route('admin.services.destroy',$v['id'])}}" class="text-danger" onclick="return confirm('Are you sure to delete?')">Delete</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7">No Record Found</td>  
                            </tr>
                            @endforelse
                            
                            
                        </tbody>
                    </table>
                </div>
            </div>
            
        </div>

    </div>
</main>
@endsection

@section('scripts')
@endsection