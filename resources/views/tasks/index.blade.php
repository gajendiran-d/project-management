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
                    <div class="card-header">{{ __('Task List') }}</div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <select name="project" id="project" class="form-control" required>
                                    <option value="null">Select</option>
                                    @foreach ($projects as $project)
                                        <option value="{{ $project->id }}"
                                            @if ($project->id == $projectId) selected @endif>{{ $project->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6" align="right">
                                <a href="{{ route('tasks.create')}}" class="btn btn-success">Add</a>
                            </div>
                        </div>
                        @if (count($tasks) == 0)
                            <p class="text-danger text-center">No task created yet.</p>
                        @else
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Title</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Edit</th>
                                        <th scope="col">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tasks as $task)
                                        <tr>
                                            <td>{{ $task->title }}</td>
                                            <td>{{ $task->description }}</td>
                                            <td><a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-warning">Edit</a></td>
                                            <td><a href="{{ route('tasks.delete', $task->id) }}" class="btn btn-sm btn-danger">Delete</a></td>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script>
        $('#project').on('change', function(e) {
            var projectId = e.target.value;
            var url = "{{ route('tasks.index', ':projectId') }}";
            url = url.replace(':projectId', projectId);
            window.location.href = url;

        });
    </script>
@endsection
