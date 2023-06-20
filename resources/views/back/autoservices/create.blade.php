@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>Add new autoservice</h1>
                </div>

                <div class="card-body">
                    <form action="{{route('autoservices-store')}}" method="post">

                        <div class="mb-3">
                            <label class="form-label">Autoservice title</label>
                            <input type="text" class="form-control" name="autoservice_title" value="{{old('autoservice_title')}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Autoservice address</label>
                            <input type="text" class="form-control" name="autoservice_address" value="{{old('autoservice_address')}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Autoservice phone</label>
                            <input type="text" class="form-control" name="autoservice_phone" value="{{old('autoservice_phone')}}">
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
