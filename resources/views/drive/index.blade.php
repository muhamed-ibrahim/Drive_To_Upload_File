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
                        <th class="text-center">Action</th>
                    </tr>
                    @forelse ($drive as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->title }}</td>
                            <td>{{ $data->discribtion }}</td>
                            <td>
                                <a class="btn btn-info ms-4" href="{{ route('drive.show', $data->id) }}">Show</a>
                                <a class="btn btn-primary ms-4 " href="{{ route('drive.edit', $data->id) }}">Edit</a>
                                <a class="btn btn-secondary ms-4" href="{{ route('drive.destroy', $data->id) }}">Delete</a>
                                @if (Auth::user()->id == $data->userId)
                                    @if ($data->status == 0)
                                        <a class="btn text-primary ms-4"
                                            href="{{ route('shared.Drive', $data->id) }}">Private</a>
                                    @else
                                        <a class="btn text-danger ms-4"
                                            href="{{ route('shared.Drive', $data->id) }}">Public</a>
                                    @endif
                                @endif

                            </td>

                        </tr>
                    @empty
                        <div class="alert alert-danger">No Data Added Yet</div>
                    @endforelse
                </table>
            </div>
        </div>
    </div>
@endsection
