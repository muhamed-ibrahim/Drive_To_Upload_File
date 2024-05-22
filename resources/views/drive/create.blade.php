@extends('layouts.app')

@section('content')
<div class="container col-6">
    <h1 class="text-center">Upload File</h1>
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
            <form action="{{route('drive.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" value="{{old('title')}}" class="form-control">
                </div>
                <div class="form-group">
                    <label>Discribtion</label>
                    <input type="text" name="discribtion" value="{{old('discribtion')}}" class="form-control">
                </div>
                <div class="form-group">
                    <label>Upload File</label>
                    <input type="file" name="file_input" value="{{old('file_input')}}" class="form-control">
                </div>
                <button class="btn btn-info mt-3">Upload File</button>
            </form>

        </div>
    </div>
</div>


@endsection
