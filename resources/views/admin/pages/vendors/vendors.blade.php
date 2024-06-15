@extends('admin.layouts.app')
@section('content')
<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3"><strong>Vendors</strong></h1>
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
                            <a href="{{route('admin.vendors.create')}}" class="btn btn-success">Add New</a>
                        </h5>
                    </div>
                    <table class="table table-responsive table-hover my-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                             $i = 1;   
                            @endphp
                            @forelse ($users as $k=>$v)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$v['name']}}</td>
                                <td>{{$v['phone']}}</td>
                                <td>{{$v['address']}}</td>
                                <td>{{$v['email']}}</td>
                                <td>
                                    <a href="{{route('admin.vendors.edit',$v['id'])}}" class="text-warning">Edit</a> | 
                                    <a href="{{route('admin.vendors.destroy',$v['id'])}}" class="text-danger" onclick="return confirm('Are you sure to delete?')">Delete</a> |
                                    <a href="{{route('admin.vendors.services',$v['id'])}}" class="text-warning">Services</a> |
                                    <a href="{{route('admin.vendors.places',$v['id'])}}" class="text-warning">Places</a>
                                
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6">No User Found</td>  
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