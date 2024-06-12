@extends('admin.layouts.app')
@section('content')
<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3"><strong>Users</strong> Create</h1>

        <div class="row">
            <div class="col-12 col-lg-12 col-xxl-12 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <a href="{{route('admin.users')}}" class="btn btn-success">Back</a>
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
                                <form action="{{route('admin.users.store')}}" method="post">
                                    @csrf
                                    <div class="form-group mt-2">
                                        <label for="name">Groom</label>
                                        <input type="text"  id="name" name="name" autocomplete="off" class="form-control" placeholder="Enter groom name here">
                                        @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="bride_name">Bride</label>
                                        <input type="text"  id="bride_name" name="bride_name" autocomplete="off" class="form-control" placeholder="Enter bride name here">
                                        @if ($errors->has('bride_name'))
                                        <span class="text-danger">{{ $errors->first('bride_name') }}</span>
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
                                        <label for="wedding_date">Wedding Date</label>
                                        <input type="date"  id="wedding_date" name="wedding_date" autocomplete="off" class="form-control" placeholder="Enter wedding date here">
                                        @if ($errors->has('wedding_date'))
                                        <span class="text-danger">{{ $errors->first('wedding_date') }}</span>
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