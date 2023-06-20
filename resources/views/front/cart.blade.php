@extends('layouts.front')

@section('content')
{{-- {{dump($cartList)}} --}}
<div class="container">
    <div class="row justify-content-center">
        <div class="col-3">
            @include('front.common.cats')
        </div>
        <div class="col-9">
            <div class="card-body">

                {{-- начало большой вставки: --}}
                <div class="card-body">
                    <form action="{{route('update-cart')}}" method="post">
                        <ul class="list-group">
                            @forelse($cartList as $service)
                            <li class="list-group-item">
                                {{-- <div class="list-table"> --}}
                                <div class="list-table cart">
                                    <div class="list-table__content">
                                        <h3>{{$service->title}}</h3>

                                        <h4>{{$service->serviceAutoservice->title}}</h4>


                                        {{-- вставка ниже: --}}
                                        <h4>{{$service->total}}</h4>
                                        <h4>{{$service->start_date}}</h4>



                                        {{-- конец вставки --}}

                                        <div class="size">
                                            {{-- <input type="number" min="1" name="count[]" value="{{$service->count}}"> --}}
                                            <input type="hidden" name="ids[]" value="{{$service->id}}">
                                        </div>
                                        <div class="price"> {{$service->sum}} Eur</div>


                                    </div>
                                    <div class="list-table__buttons">

                                        {{-- <form action="{{route('operations-delete', $service)}}" method="post"> --}}
                                        <button type="submit" name="delete" value="{{$service->id}}" class="btn btn-outline-danger">Delete</button>

                                    </div>


                                </div>



                            </li>
                            @empty
                            <li class="list-group-item">Cart Empty</li>
                            @endforelse
                            {{-- <li class="list-group-item">
                                        <button type="submit" class="btn btn-outline-primary">Update cart</button>
                                    </li> --}}
                        </ul>
                        @csrf
                    </form>
                </div>



                {{-- начало новой вставки: --}}
                <ul class="list-group">
                    <li class="list-group-item">
                        <form action="{{route('make-order')}}" method="post">
                            <button type="submit" class="btn btn-outline-primary">Make order</button>
                            @csrf
                        </form>
                    </li>
                </ul>

                {{-- конец новой вставки --}}
            </div>
            {{-- конец большой вставки --}}


        </div>
    </div>
</div>
</div>
@endsection
