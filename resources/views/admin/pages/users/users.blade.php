@extends('admin.layouts.app')
@section('content')
<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3"><strong>Users</strong></h1>
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
                            <a href="{{route('admin.users.create')}}" class="btn btn-success">Add New</a>
                        </h5>
                    </div>
                    <table class="table table-responsive table-hover my-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Groom</th>
                                <th>Bride</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Wedding Date</th>
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
                                <td>{{$v['bride_name']}}</td>
                                <td>{{$v['email']}}</td>
                                <td>{{$v['phone']}}</td>
                                <td>{{$v['address']}}</td>
                                <td>{{$v['wedding_date']}}</td>
                                <td>
                                    <a href="{{route('admin.users.edit',$v['id'])}}" class="text-warning">Edit</a> | <a href="{{route('admin.users.destroy',$v['id'])}}" class="text-danger" onclick="return confirm('Are you sure to delete?')">Delete</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8">No User Found</td>  
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