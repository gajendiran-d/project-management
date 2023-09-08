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
                    <div class="card-header">{{ __('Assigned Task') }}</div>
                    <div class="card-body">
                        @if (count($projects) == 0)
                            <p class="text-danger text-center">No task assigned yet.</p>
                        @else
                            <table class="table">
                                @foreach ($projects as $project)
                                    <tr>
                                        <th scope="col" colspan="3">{{$project->title}}</th>
                                    </tr>
                                    @foreach ($project['tasks'] as $task)
                                        <tr>
                                            <td>{{ $task->title }}</td>
                                            <td>{{ $task->description }}</td>
                                            @if ($task->is_completed == '0')
                                            <td><a href="{{ route('tasks.status', $task->id) }}" class="badge text-bg-warning">Mark as Completed</a></td>
                                            @else
                                            <td><span class="badge text-bg-success">Completed</span>
                                            </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                @endforeach
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
