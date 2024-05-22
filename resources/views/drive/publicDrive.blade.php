@extends('layouts.app')

@section('content')
    <div class="container col-6">
        <h1 class="text-center">List Of Files</h1>
        @if (Session::has('done'))
            <div class="alert alert-success">
                {{ Session::get('done') }}
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                <table class="table">
                    <tr>
                        <th>#</th>
                        <th>ID</th>
                        <th>Title</th>
                        <th>uploaded by</th>
                        <th>Download</th>
                    </tr>
                    @forelse ($drive as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->title }}</td>
                            <td>{{ $data->discribtion }}</td>
                            <td>{{ $data->name }}</td>
                            <td><a href="{{route('drive.download',$data->id)}}" class="btn btn-primary">Download</a></td>
                        </tr>
                    @empty
                        <div class="alert alert-danger">No Data Added Yet</div>
                    @endforelse
                </table>
            </div>
        </div>
    </div>
@endsection
