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
                    <div class="card-header">{{ __('Assign Team') }}</div>
                    <div class="card-body">
                        <form action="{{ route('teams.assign') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label for="title" class="col-md-4 col-form-label">Project</label>
                                <div class="col-md-8">
                                    <select name="project" id="project" class="form-control" required>
                                        <option value="null">Select</option>
                                        @foreach ($projects as $project)
                                            <option value="{{ $project->id }}" @if ($project->id == $projectId) selected @endif>{{ $project->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="admin" class="col-md-4 col-form-label">Admin</label>
                                <div class="col-md-8">
                                    <select name="admin" class="form-control" required>
                                        <option value="">Select</option>
                                        @foreach ($teams as $team)
                                            <option value="{{ $team->id }}" @if ($team->id == $adminId) selected @endif>{{ $team->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="member" class="col-md-4 col-form-label">Team Members</label>
                                <div class="col-md-8">
                                    <select name="members[]" multiple class="form-control">
                                        @foreach ($teams as $team)
                                            <option value="{{ $team->id }}" @if (in_array($team->id, $memberId)) selected @endif>{{ $team->name }}</option>
                                        @endforeach
                                    </select>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script>
        $('#project').on('change', function(e) {
            var projectId = e.target.value;
            var url = "{{ route('teams.index', ':projectId') }}";
            url = url.replace(':projectId', projectId);
            window.location.href = url;

        });
    </script>
@endsection

