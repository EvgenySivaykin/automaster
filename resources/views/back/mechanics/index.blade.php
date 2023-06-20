@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1>All mechanics</h1>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @forelse($mechanics as $mechanic)
                        <li class="list-group-item">
                            <div class="list-table">
                                <div class="list-table__content">
                                    {{-- <h3>{{$mechanic->first_name}}</h3>
                                    <h3>{{$mechanic->last_name}}</h3> --}}
                                    <h3>{{$mechanic->first_name}} {{$mechanic->last_name}}</h3>

                                    <div class="data">
                                        <h4>autoservice: {{$mechanic->mechanicAutoservice->title}}</h4>
                                    </div>

                                    <div class="smallimg">
                                        @if($mechanic->photo)
                                        <img src="{{asset($mechanic->photo)}}">
                                        @endif
                                    </div>

                                </div>
                                <div class="list-table__buttons">
                                    <a href="{{route('mechanics-edit', $mechanic)}}" class="btn btn-outline-success">Edit</a>

                                    <form action="{{route('mechanics-delete', $mechanic)}}" method="post">
                                        <button type="submit" class="btn btn-outline-danger">Delete</button>
                                        @csrf
                                        @method('delete')
                                    </form>
                                </div>
                            </div>
                        </li>
                        @empty
                        <li class="list-group-item">No mechanics yet</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
