@extends('layouts.layout')

@section('title')
    Login
@endsection

@section('styles')
@endsection
@section('content')
<div class="d-flex justify-content-center">
    <div class="card mt-3 mb-3 col-md-4 ">
        <h3 class="text-center mb-4">{{ trans('backpack::base.login') }}</h3>
        <div class="card-body">
            <form class="col-md-12 p-t-10" role="form" method="POST" action="{{ route('auth.login') }}">
                {!! csrf_field() !!}

                <div class="form-group">
                    <label class="control-label" for="{{ $username }}">{{ config('backpack.base.authentication_column_name') }}</label>
                    <input type="text" class="form-control {{ $errors->has($username) ? ' is-invalid' : '' }}" name="{{ $username }}" value="{{ old($username) }}" id="{{ $username }}">
                    @if ($errors->has($username))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first($username) }}</strong>
                        </span>
                    @endif
                </div>

                &nbsp;

                <div class="form-group">
                    <label class="control-label" for="password">{{ trans('backpack::base.password') }}</label>
                    <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" id="password">
                    @if ($errors->has('password'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                &nbsp;

                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-primary">
                        {{ trans('backpack::base.login') }}
                    </button>
                </div>

                &nbsp;

                @if (config('backpack.base.registration_open'))
                    <div class="text-center">Don't have an account? <a href="{{ route('auth.register') }}"> Register Here</a></div>
                @endif
            </form>
        </div>
    </div>
</div>
    
@endsection
