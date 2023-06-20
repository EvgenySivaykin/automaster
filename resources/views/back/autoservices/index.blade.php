@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1>All autoservices</h1>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @forelse($autoservices as $autoservice)
                        <li class="list-group-item">
                            <div class="list-table">
                                <div class="list-table__content">
                                    <h3>{{$autoservice->title}}</h3>
                                    <div class="data">
                                        <h4>Address: {{$autoservice->address}}</h4>
                                        <h4>Phone: {{$autoservice->phone}}</h4>
                                    </div>
                                </div>
                                <div class="list-table__buttons">

                                    <a href="{{route('autoservices-edit', $autoservice)}}" class="btn btn-outline-success">Edit</a>
                                    <form action="{{route('autoservices-delete', $autoservice)}}" method="post">
                                        <button type="submit" class="btn btn-outline-danger">Delete</button>
                                        @csrf
                                        @method('delete')
                                    </form>
                                </div>
                            </div>
                        </li>
                        @empty
                        <li class="list-group-item">No autoservices yet</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
