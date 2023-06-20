@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>Add new service</h1>
                </div>

                <div class="card-body">
                    <form action="{{route('operations-store')}}" method="post">

                        <div class="mb-3">
                            <label class="form-label">Service title</label>
                            <input type="text" class="form-control" name="service_title" value="{{old('service_title')}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Service duration, h</label>
                            <input type="text" class="form-control" name="service_duration" value="{{old('service_duration')}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Service price, eur</label>
                            <input type="text" class="form-control" name="service_price" value="{{old('service_price')}}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Autoservice</label>
                            <select class="form-select" name="autoservice_id">
                                @foreach($autoservices as $autoservice)
                                {{-- <option value="{{$autoservice->id}}"> --}}
                                <option value="{{$autoservice->id}}" @if($autoservice->id == old('autoservice_id')) selected @endif>
                                    {{$autoservice->title}}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-outline-primary">Add New</button>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
