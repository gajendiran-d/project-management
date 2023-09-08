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
                    <div class="card-header">{{ __('Edit Task') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('tasks.update', $task->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <label for="title" class="col-md-4 col-form-label">Project</label>
                                <div class="col-md-8">
                                    <select name="project" class="form-control" required>
                                        <option value="">Select</option>
                                        @foreach ($projects as $project)
                                            <option value="{{ $project->id }}" @if ($project->id == $task->project_id) selected @endif>{{ $project->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="title" class="col-md-4 col-form-label">Title</label>
                                <div class="col-md-8">
                                    <input type="text" name="title" class="form-control" value="{{ $task->title }}"
                                        required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="description" class="col-md-4 col-form-label">Description</label>
                                <div class="col-md-8">
                                    <textarea name="description" class="form-control" required>{{ $task->description }}</textarea>
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
