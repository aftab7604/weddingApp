@extends('admin.layouts.app')
@section('content')
<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3"><strong>Order {{$order['user']['name']}} - {{$order['user']['bride_name']}}</strong></h1>
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
                            {{-- <a href="{{route('admin.places.create')}}" class="btn btn-success">Add New</a> --}}
                        </h5>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-responsive table-hover my-0">
                                    <tr>
                                        <th>Groom</th>
                                        <td>{{$order['user']['name']}}</td>
                                    </tr>
                                    <tr>
                                        <th>Bride</th>
                                        <td>{{$order['user']['bride_name']}}</td>
                                    </tr>
                                    <tr>
                                        <th>Phone</th>
                                        <td>{{$order['user']['phone']}}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{$order['user']['email']}}</td>
                                    </tr>
                                    <tr>
                                        <th>Address</th>
                                        <td>{{$order['user']['address']}}</td>
                                    </tr>
                                    <tr>
                                        <th>Wedding Date</th>
                                        <td>{{$order['user']['wedding_date']}}</td>
                                    </tr>
                                    <tr>
                                        <th>Order Date</th>
                                        <td>{{$order['order_date']}}</td>
                                    </tr>
                                    <tr>
                                        <th>Order Detail</th>
                                        <td>{{$order['order_details']}}</td>
                                    </tr>
                                    <tr>
                                        <th>Total Amount</th>
                                        <td>{{$order['total_amount']}}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <img class="card-img-top" src="{{asset('images/'.$order['place']['image'])}}" alt="Card image cap">
                                    <div class="card-body">
                                      <h5 class="card-title">{{$order['place']['price']}}</h5>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text">{{$order['place']['name']}}</p>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">
                                              {{$order['place']['description']}}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            
                            @forelse ($order['order_items'] as $item)
                            <div class="col-md-4">
                                <div class="card">
                                    <img class="card-img-top" src="{{asset('images/'.$item['product']['image'])}}" alt="Card image cap">
                                    <div class="card-body">
                                    <h5 class="card-title">{{$item['product']['price']}}</h5>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text">{{$item['product']['name']}}</p>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">
                                            {{$item['product']['description']}}
                                            </li>
                                        </ul>
                                    </div>
                                </div>   
                            </div>
                            @empty
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
            
        </div>

    </div>
</main>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
        $('#collapseThree').collapse()
    })
  </script>
@endsection