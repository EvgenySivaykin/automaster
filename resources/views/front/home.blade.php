@extends('layouts.front')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-3">
            {{-- cats --}}
            @include('front.common.cats')
        </div>

        <div class="col-9">

            <div class="card-body">
                <div class="container">
                    <div class="row justify-content-center">
                        @forelse($mechanics as $mechanic)
                        <div class="col-4">
                            <div class="list-table">
                                <div class="top">
                                    <h3>{{$mechanic->first_name}}</h3>
                                    <h3>{{$mechanic->last_name}}</h3>
                                    <div class="data">
                                        <h4>autoservice: {{$mechanic->mechanicAutoservice->title}}</h4>
                                    </div>
                                    <div class="smallimg">
                                        @if($mechanic->photo)
                                        <img src="{{asset($mechanic->photo)}}">
                                        @else
                                        <img src="{{asset('no.jpeg')}}">
                                        @endif
                                    </div>
                                </div>
                                <div class="bottom">
                                    <div class="vote">
                                        <div>
                                            {{-- RATING: {{$mechanic->result}} --}}


                                            @if ($mechanic->result == 'no rating')
                                            RATING: {{$mechanic->result}}
                                            @else
                                            @php
                                            $stars = str_repeat('&#9733;', $mechanic->result); // HTML код желтой звездочки - &#9733;
                                            @endphp
                                            RATING: <span class="rating-stars">{!! $stars !!}</span>
                                            @endif





                                            <!-- Выводит звездочки в виде строки -->

                                            {{-- @php
                                            $stars = str_repeat('&#9733;', $mechanic->result); // HTML код желтой звездочки - &#9733;
                                            @endphp
                                            RATING: <span class="rating-stars">{!! $stars !!}</span> --}}
                                            <!-- Выводит звездочки в виде строки -->






                                        </div>
                                        <div>
                                            @if(isset($user))
                                            <form class='mt-3' action="{{route('update_rating', $mechanic)}}" method="post" enctype="multipart/form-data">
                                                <label>Your vote: </label>
                                                <input required type="number" min="1" max="5" name="rating">
                                                {{-- <button type="submit" class="col-3 mt-3 btn btn-outline-primary">Vote</button> --}}
                                                <button type="submit" class="col-5 btn btn-outline-danger">Vote</button>
                                                @csrf
                                                @method('put')
                                            </form>
                                            @endif
                                        </div>
                                        {{-- конец изменения --}}


                                    </div>
                                    <div class="buy">
                                        <div class="mb-3">
                                            <div class="list-table_buttons">
                                                <a href="{{route('choose', $mechanic)}}" class="btn btn-outline-primary">Choose</a>

                                                {{-- <button type="submit" class="btn btn-outline-primary mt-3">Choose</button> --}}



                                                {{-- доделать!!! --}}
                                                {{-- <div class="col-12">
                                            <div class="mb-3"> --}}
                                                {{-- <form action="{{route('mechanics-store')}}" method="post" enctype="multipart/form-data"> --}}
                                                {{-- <form action="{{route('add-to-cart')}}" method="post">
                                                <label class="form-label">Service</label>
                                                <select class="form-select" name="autoservice_id">
                                                    @foreach($services as $service) --}}
                                                    {{-- <option value="{{$autoservice->id}}"> --}}
                                                    {{-- <option value="{{$service->id}}" @if($service->id == old('service_id')) selected @endif>
                                                    {{$service->title}} / {{$service->duration}} h. / {{$service->price}} eur.
                                                    </option>
                                                    @endforeach
                                                </select> --}}

                                                {{-- вставка ниже: --}}
                                                {{-- <label class="form-label">Operation start</label>
                                                    <input type="date" class="form-control" name="orepation_start_date" value="{{old('orepation_start_date')}}">
                                                <input type="time" class="form-control" name="orepation_start_time" value="{{old('orepation_start_time')}}"> --}}
                                                {{-- конец вставки --}}

                                                {{-- <button type="submit" class="btn btn-outline-primary mt-3">Buy</button> --}}
                                                {{-- <input type="hidden" name="product" value="{{$service->id}}"> --}}
                                                {{-- @csrf
                                                </form> --}}
                                                {{-- </div>
                                        </div> --}}
                                            </div>
                                        </div>
                                    </div>



                                </div>
                            </div>

                        </div>
                        @empty
                        <li class="list-group-item">No mechanics yet</li>
                        @endforelse
                    </div>
                </div>
                <div class="m-2">{{ $mechanics->links() }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
