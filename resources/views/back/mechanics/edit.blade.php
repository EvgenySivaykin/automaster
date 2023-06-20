@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1>Edit mechanic</h1>
                </div>

                <div class="card-body">
                    <form action="{{route('mechanics-update', $mechanic)}}" method="post" enctype="multipart/form-data">
                        <div class="container">
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label">Mechanic first name</label>
                                        <input type="text" class="form-control" name="mechanic_first_name" value="{{old('mechanic_first_name', $mechanic->first_name)}}">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label">Mechanic last name</label>
                                        <input type="text" class="form-control" name="mechanic_last_name" value="{{old('mechanic_last_name', $mechanic->last_name)}}">
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="mb-3">
                                        <label class="form-label">Autoservice</label>
                                        <select class="form-select" name="autoservice_id">
                                            @foreach($autoservices as $autoservice)
                                            <option value="{{$autoservice->id}}" @if($autoservice->id == $mechanic->autoservice_id) selected @endif>

                                                {{$autoservice->title}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="mb-3">
                                        <label class="form-label">Mechanic Photo</label>
                                        <input type="file" class="form-control" name="photo">
                                    </div>
                                </div>

                                @if($mechanic->photo)
                                <div class="col-4">
                                    <div class="mb-3">
                                        <img src="{{asset($mechanic->photo)}}">
                                    </div>
                                </div>
                                @endif

                            </div>
                        </div>
                        <button type="submit" class="btn btn-outline-primary">Save</button>

                        @if($mechanic->photo)
                        <button type="submit" class="btn btn-outline-danger" name="delete_photo" value="1">Delete Photo</button>
                        @endif

                        @csrf
                        @method('put')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
