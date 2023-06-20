@extends('layouts.front')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1 id="bigname">{{$mechanic->first_name}} {{$mechanic->last_name}}</h1>
                </div>

                <div class="card-body">
                    {{-- <form action="{{route('mechanics-update', $mechanic)}}" method="post" enctype="multipart/form-data"> --}}
                    <div class="container">
                        <div class="row">
                            <div class="col-4">
                                <div class="mb-3">
                                    <h4 id="work"> Work in <b>{{$mechanic->mechanicAutoservice->title}}</b></h4>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="mb-3">
                                    <h4> Address: <b>{{$mechanic->mechanicAutoservice->address}}</b></h4>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="mb-3">
                                    <h4> Phone: <b>{{$mechanic->mechanicAutoservice->phone}}</b></h4>
                                </div>
                            </div>


                            @if($mechanic->photo)
                            <div class="col-4">
                                <div class="mb-3">
                                    <img src="{{asset($mechanic->photo)}}">
                                </div>
                            </div>
                            @endif

                            <div class="col-8">
                                <div class="mb-3">
                                    <form action="{{route('add-to-cart')}}" method="post" enctype="multipart/form-data">
                                        <label class="form-label mt-5"><b>Service</b></label>

                                        <select class="form-select" name="product">
                                            @foreach($services as $service)
                                            @if($service->serviceAutoservice->title === $mechanic->mechanicAutoservice->title)
                                            <option value="{{$service->id}}">
                                                {{-- {{$service->title}} / {{$service->serviceAutoservice->title}} / {{$service->duration}} h. / {{$service->price}} eur. --}}
                                                {{$service->title}} / {{$service->duration}} h. / {{$service->price}} eur.
                                            </option>
                                            @endif
                                            @endforeach
                                        </select>


                                        {{-- вставка ниже: --}}
                                        <label class="form-label mt-5"><b>Operation start</b></label>
                                        <input type="date" class="form-control mt-3" name="start_date" value="{{old('start_date')}}">
                                        <input type="time" class="form-control mt-3" name="start_time" value="{{old('start_time')}}">

                                        <input type="hidden" name="mech" value="{{$mechanic->id}}">


                                        {{-- конец вставки --}}

                                        <div class="d-grid gap-2 col-6 mx-auto mt-3">
                                            <button type="submit" class="btn btn-primary">Add operation in my CART</button>
                                        </div>

                                        {{-- <input type="hidden" name="product" value="{{$service->id}}"> --}}

                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
