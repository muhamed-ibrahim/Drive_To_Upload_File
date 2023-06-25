@extends('layouts.app')

@section('content')
<div class="container col-6">
    <h1 class="text-center">Update File : {{$drive->id}}</h1>
    @if (Session::has('done'))
    <div class="alert alert-success">

        {{Session::get('done')}}
    </div>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="card">
        <div class="card-body">
            <form action="{{route('drive.update',$drive->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" value="{{$drive->title}}" class="form-control">
                </div>
                <div class="form-group">
                    <label>Discribtion</label>
                    <input type="text" name="discribtion" value="{{$drive->discribtion}}" class="form-control">
                </div>
                <div class="form-group">
                    <label>Upload File</label><br>
                    <span>{{$drive->file}}</span>
                    <input type="file" name="file_input" class="form-control">
                </div>
                <button class="btn btn-primary mt-3">Edit File</button>
            </form>

        </div>
    </div>
</div>


@endsection
