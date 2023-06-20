@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1>Orders</h1>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach($orders as $order)
                        <li class="list-group-item">
                            <div class="list-table">

                                <div class="list-table__content">
                                    <h3># {{$order->id}}
                                        <b class="m-5">{{$order->user->name}}</b>
                                    </h3>
                                    <i class="m-5">{{$order->services->total}} eur</i>


                                    <ul class="list-group">
                                        @foreach($order->services->services as $service)
                                        <li class="list-group-item">
                                            {{$service->title}}
                                        </li>
                                        @endforeach
                                    </ul>

                                </div>
                                <div>
                                    {{-- тут будет кнопка --}}

                                    @if($order->status == 0)
                                    <form action="{{route('orders-update', $order)}}" method="post" class="mt-2">
                                        <button type="submit" class="btn btn-outline-primary">Finish Order</button>
                                        @csrf
                                        @method('put')
                                    </form>
                                    @endif
                                    <form action="{{route('orders-delete', $order)}}" method="post" class="mt-2">
                                        <button type="submit" class="btn btn-outline-danger">Delete Order</button>
                                        @csrf
                                        @method('delete')
                                    </form>

                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection