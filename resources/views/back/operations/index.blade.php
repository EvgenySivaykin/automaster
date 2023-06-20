@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>All services</h1>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @forelse($services as $service)
                        <li class="list-group-item">
                            <div class="list-table">
                                <div class="list-table__content">
                                    <h3 class="service">{{$service->title}}</h3>
                                    <div class="data">
                                        <h4>Autoservice: <b>{{$service->serviceAutoservice->title}}</b></h4>
                                        <h4>Duration: {{$service->duration}} h.</h4>
                                        <h4>Price: {{$service->price}} eur.</h4>
                                    </div>
                                </div>
                                <div class="list-table__buttons">
                                    <a href="{{route('operations-edit', $service)}}" class="btn btn-outline-success">Edit</a>
                                    <form action="{{route('operations-delete', $service)}}" method="post">
                                        <button type="submit" class="btn btn-outline-danger">Delete</button>
                                        @csrf
                                        @method('delete')
                                    </form>
                                </div>
                            </div>
                        </li>
                        @empty
                        <li class="list-group-item">No services yet</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
