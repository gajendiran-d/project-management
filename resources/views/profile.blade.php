@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Profile') }}</div>

                    <div class="card-body">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif

                        @if ($message = Session::get('error'))
                            <div class="alert alert-danger alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif
                        <form method="post" action="{{ route('profile.update') }}" name="form" id="form">
                            @csrf
                            <input name="id" type="hidden" value="{{ $data['id'] }}">
                            <div class="mb-3">
                                <label for="name" class="col-md-4 col-form-label">{{ __('Name') }}</label>
                                <input type="text" class="form-control" name="name" value="{{ $data['name'] }}"
                                    maxlength="75" required>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="col-md-4 col-form-label">{{ __('Email Address') }}</label>
                                <input type="email" class="form-control" name="email" value="{{ $data['email'] }}"
                                    maxlength="75" required>
                            </div>
                            <div align="right">
                                <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
