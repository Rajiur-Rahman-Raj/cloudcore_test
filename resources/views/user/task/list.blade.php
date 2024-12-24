@extends('layouts.app')
@section('title', 'Task List')

@push('extra_styles')
    <link rel="stylesheet" href="{{ asset('assets/css/flatpickr.min.css') }}"/>
@endpush

@section('content')
    <div class="container">
        <div class="row m-auto d-flex justify-content-center mt-5">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header border-0">
                        <h5>@lang('Task List')</h5>
                    </div>

                    <div class="card-body">
                        <form action="" method="get" class="mb-4">
                            <div class="row">
                                <div class="col-md-3">
                                    <input type="text" name="title" class="form-control"
                                           placeholder="task title"
                                           value="{{ old('title', request()->title) }}">
                                </div>

                                <div class="col-md-3">
                                    <div class="input-group flatpickr">
                                        <input type="date" placeholder="@lang('Due Date')"
                                               class="form-control" name="due_date"
                                               value="{{ old('due_date',request()->due_date) }}" data-input/>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <select name="status" class="form-control">
                                        <option
                                            value="all" {{ request()->get('status', 'all') == 'all' ? 'selected' : '' }}>@lang('All')</option>
                                        <option
                                            value="0" {{ request()->get('status') === '0' ? 'selected' : '' }}>@lang('Pending')</option>
                                        <option
                                            value="1" {{ request()->get('status') == '1' ? 'selected' : '' }}>@lang('In Progress')</option>
                                        <option
                                            value="2" {{ request()->get('status') == '2' ? 'selected' : '' }}>@lang('Completed')</option>
                                    </select>
                                </div>


                                <div class="col-md-3">
                                    <button class="btn btn-primary w-100" type="submit">
                                        <i class="fal fa-search" aria-hidden="true"></i>
                                        @lang('Search')
                                    </button>
                                </div>
                            </div>
                        </form>

                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">@lang('SL').</th>
                                <th scope="col">@lang('Title')</th>
                                <th scope="col">@lang('Details')</th>
                                <th scope="col">@lang('Due Date')</th>
                                <th scope="col">@lang('Status')</th>
                                <th scope="col">@lang('Action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($tasks as $key => $task)
                                <tr>
                                    <th>{{ $tasks->firstItem() + $key }}</th>
                                    <th scope="row">
                                        {{ $task->title }}
                                    </th>
                                    <td>
                                        {{ $task->details }}
                                    </td>
                                    <td>
                                        {{ customDate($task->due_date) }}
                                    </td>
                                    <td>
                                        {!! $task->status_badge !!}
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle taskDropdownBtn"
                                                    type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                <li>
                                                    <a class="dropdown-item"
                                                       href="{{ route('user.task.edit', $task->id) }}">@lang('Edit')</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item deleteTask"
                                                       data-route="{{ route('user.task.delete', $task->id) }}"
                                                       href="javascript:void(0)" data-bs-toggle="modal"
                                                       data-bs-target="#taskDeleteModal">@lang('Delete')</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="100%" class="text-center p-2 text-danger">
                                        @lang('No tasks found.')
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>

                        <div class="pagination_area">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-center">
                                    {{ $tasks->appends(request()->query())->links() }}
                                </ul>
                            </nav>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="taskDeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">@lang('Delete Confirmation')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @lang('Are you sure delete this task?')
                </div>
                <form action="" method="post" class="taskDeleteFrom">
                    @csrf
                    @method('delete')
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn-primary">@lang('Yes')</button>
                    </div>
                </form>

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

            $(document).on('click', '.deleteTask', function () {
                let dataRoute = $(this).data('route');
                $('.taskDeleteFrom').attr('action', dataRoute);
            });
        })

    </script>
@endpush
