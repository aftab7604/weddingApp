@extends('admin.layouts.app')
@section('content')
<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3"><strong>Vendors</strong> Create</h1>

        <div class="row">
            <div class="col-12 col-lg-12 col-xxl-12 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <a href="{{route('admin.vendors')}}" class="btn btn-success">Back</a>
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
                                <form action="{{route('admin.vendors.store')}}" method="post">
                                    @csrf
                                    <div class="form-group mt-2">
                                        <label for="name">Name</label>
                                        <input type="text"  id="name" name="name" autocomplete="off" class="form-control" placeholder="Enter name here">
                                        @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="phone">Phone</label>
                                        <input type="text"  id="phone" name="phone" autocomplete="off" class="form-control" placeholder="Enter phone here">
                                        @if ($errors->has('phone'))
                                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="address">Address</label>
                                        <textarea id="address" name="address" autocomplete="off" class="form-control" placeholder="Enter address here"></textarea>
                                        @if ($errors->has('address'))
                                        <span class="text-danger">{{ $errors->first('address') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="email">Email</label>
                                        <input type="email"  id="email" name="email" autocomplete="off" class="form-control" placeholder="Enter email here">
                                        @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="password">Password</label>
                                        <input type="password"  id="password" name="password" autocomplete="off" class="form-control" placeholder="Enter password here">
                                        @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
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