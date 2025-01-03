@extends('layouts.app')

@section('title', 'Home')
@section('content')
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">@lang('Hello'), {{ auth()->guard('web')->user()->name }} </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        {{   __('Welcome to your Dashboard') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
