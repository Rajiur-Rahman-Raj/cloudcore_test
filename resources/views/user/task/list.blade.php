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
                        <form action="" method="get">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="hrader-search-input select-option w-100 mb-4">
                                        <input type="text" name="purchase_code" class="soValue optionSearch"
                                               id="searchInput"
                                               placeholder="purchase code" aria-label="Search"
                                               value="{{ old('purchase_code', request()->purchase_code) }}">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="hrader-search-input select-option w-100 mb-4">
                                        <div class="input-group flatpickr">
                                            <input type="date" placeholder="@lang('From Date')"
                                                   class="form-control from_date" name="from_date"
                                                   value="{{ old('from_date',request()->from_date) }}" data-input/>
                                            <div class="input-group-append" readonly="">
                                                <div class="form-control">
                                                    <a class="input-button cursor-pointer" title="clear" data-clear>
                                                        <i class="fas fa-times"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="hrader-search-input select-option w-100 mb-4 flatpickr">
                                        <div class="input-group">
                                            <input type="date" placeholder="@lang('To Date')"
                                                   class="form-control to_date" name="to_date"
                                                   value="{{ old('to_date',request()->to_date) }}" data-input/>
                                            <div class="input-group-append" readonly="">
                                                <div class="form-control">
                                                    <a class="input-button cursor-pointer" title="clear" data-clear>
                                                        <i class="fas fa-times"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="hrader-search-input select-option w-100 mb-4">
                                        <button class="cmn_btn w-100" type="submit">
                                            <i class="fal fa-search" aria-hidden="true"></i>
                                            @lang('Search')
                                        </button>
                                    </div>
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
                                        @if($task->status == 0)
                                            <span class="badge rounded-pill bg-warning text-white">@lang('Pending')</span>
                                        @elseif($task->status == 1)
                                            <span class="badge rounded-pill bg-primary text-white">@lang('In Progress')</span>
                                        @else
                                            <span class="badge rounded-pill bg-success text-white">@lang('Completed')</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle taskDropdownBtn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                <li><a class="dropdown-item" href="#">@lang('Edit')</a></li>
                                                <li><a class="dropdown-item deleteTask" data-route="{{ route('user.task.delete', $task->id) }}" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#taskDeleteModal">@lang('Delete')</a></li>
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

            $(document).on('click', '.deleteTask', function (){
               let dataRoute = $(this).data('route');
               $('.taskDeleteFrom').attr('action', dataRoute);
            });
        })

    </script>
@endpush
