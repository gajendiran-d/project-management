@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                <div class="card">
                    <div class="card-header">{{ __('Project List') }}</div>
                    <div class="card-body">
                        <div align="right">
                            <a href="{{ route('projects.create')}}" class="btn btn-success">Add</a>
                        </div>
                        @if ($projects->isEmpty())
                            <p class="text-danger text-center">No project created yet.</p>
                        @else
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Edit</th>
                                        <th scope="col">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($projects as $project)
                                        <tr>
                                            <td>{{ $project->title }}</td>
                                            <td>{{ $project->description }}</td>
                                            <td><a href="{{ route('projects.edit', $project->id) }}" class="btn btn-sm btn-warning">Edit</a></td>
                                            <td><a href="{{ route('projects.delete', $project->id) }}" class="btn btn-sm btn-danger">Delete</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
