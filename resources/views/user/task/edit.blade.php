@extends('layouts.app')

@section('title', 'Edit Task')

@push('extra_styles')
    <link rel="stylesheet" href="{{ asset('assets/css/flatpickr.min.css') }}"/>
@endpush

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit Task') }}</div>

                    <div class="card-body">
                        <form action="{{ route('user.task.update', $task->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="title" class="form-label">@lang('Title')</label>
                                <input type="text" name="title"
                                       class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $task->title) }}">
                                @error('title')
                                <div class="form-text text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="details" class="form-label">@lang('Details')</label>
                                <textarea type="text" name="details" class="form-control @error('details') is-invalid @enderror" rows="5" cols="10">{{ old('details', $task->details) }}</textarea>
                                @error('details')
                                <div class="form-text text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="due_date" class="form-label">@lang('Due Date')</label>
                                <div class="input-group flatpickr">
                                    <input type="date" placeholder="@lang('due date')"
                                           class="form-control due_date @error('due_date') is-invalid @enderror" name="due_date"
                                           value="{{ old('due_date', $task->due_date) }}" data-input/>
                                </div>
                                @error('due_date')
                                <div class="form-text text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label">@lang('Status')</label>
                                <select name="status" class="form-control @error('status') is-invalid @enderror">
                                    <option value="0" {{ old('status', $task->status) == 0 ? 'selected' : '' }}>@lang('Pending')</option>
                                    <option value="1" {{ old('status', $task->status) == 1 ? 'selected' : '' }}>@lang('In Progress')</option>
                                    <option value="2" {{ old('status', $task->status) == 2 ? 'selected' : '' }}>@lang('Completed')</option>
                                </select>
                                @error('status')
                                <div class="form-text text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">@lang('Submit')</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js-lib')
    <script src="{{ asset('assets/js/flatpickr.js') }}"></script>
@endpush

@push('script')
    <script>
        'use strict'
        $(document).ready(function () {
            $(".flatpickr").flatpickr({
                wrap: true,
                altInput: true,
                dateFormat: "Y-m-d H:i",
            });
        })

    </script>
@endpush
