@extends('layouts.app')

@section('content')
<div class="container col-6">
    <h1 class="text-center">Show File : {{$drive->id}}</h1>
    <div class="card">
        <div class="card-body">
                <div class="form-group">
                    <label>Title</label>
                    <input disabled type="text" name="title" value="{{$drive->title}}" class="form-control">
                </div>
                <div class="form-group">
                    <label>Discribtion</label>
                    <input disabled type="text" name="discribtion" value="{{$drive->discribtion}}" class="form-control">
                </div>
                <div class="form-group">
                    <label>Upload File</label>
                    <input disabled value="{{$drive->file}}" type="text" name="file_input" class="form-control">
                </div>
                <a href="{{route('drive.download',$drive->id)}}" class="btn btn-primary mt-3">Download</a>
        </div>
    </div>
</div>


@endsection
