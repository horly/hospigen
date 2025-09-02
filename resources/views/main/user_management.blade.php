@extends('base')
@section('title', __('dashboard.user_management'))
@section('content')

@include('global.loader')

<div class="page-wrapper compact-wrapper" id="pageWrapper">
    @include('main.header')

    <div class="container">
        <div class="page-body">
            <div class="container-fluid general-widget">
                <div class="page-title">
                    <div class="row">
                        <div class="col-sm-6 col-12">
                            <h2>{{ __('dashboard.user_management') }} </h2>
                            {{-- <p class="mb-0 text-title-gray">Welcome back! Let’s start from where you left.</p> --}}
                        </div>
                        <div class="col-sm-6 col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('app_main') }}"><i class="iconly-Home icli svg-color"></i></a></li>
                                <li class="breadcrumb-item">{{ __('dashboard.main_menu') }}</li>
                                <li class="breadcrumb-item active">{{ __('dashboard.user_management') }} </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('message.flash-message')

        <div class="card border">
            <div class="card-body">

                @if (Auth::user()->role->name === "admin" || Auth::user()->role->name === "superadmin")
                    <a class="btn btn-primary mb-4" role="button" href="{{ route('app_add_user', ['id' => 0]) }}">
                        <i class="fa-solid fa-circle-plus"></i>
                        {{ __('auth.add') }}
                    </a>
                @endif

                <table class="display" id="basic-2">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>{{ __('dashboard.name') }} </th>
                            <th>{{ __('auth.email') }} </th>
                            <th>{{ __('auth.role') }} </th>
                            <th>{{ __('dashboard.permissions') }} </th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }} </td>
                                <td>
                                    <div class="avatar-showcase">
                                        <div class="avatars">
                                            <div class="avatar-intial img-40 bg-light-primary"><span class="fs-5">{{ substr($user->name, 0, 1) }}</span></div>
                                            @if (Auth::user()->role->name === "superadmin")
                                                {{ $user->name }}
                                            @else
                                                @if ($user->role->name === "superadmin")
                                                    ***************
                                                @else
                                                    {{ $user->name }}
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if (Auth::user()->role->name === "superadmin")
                                         {{ $user->email }}
                                    @else
                                        @if ($user->role->name === "superadmin")
                                            ***************
                                        @else
                                            {{ $user->email }}
                                        @endif
                                    @endif
                                </td>
                                <td>
                                    @if ($user->role->name === "superadmin")
                                        <span class="badge rounded-pill badge-light-primary">
                                            {{ __('auth.' . $user->role->name) }}
                                        </span>
                                    @elseif ($user->role->name === "admin")
                                        <span class="badge rounded-pill badge-light-success">
                                            {{ __('auth.' . $user->role->name) }}
                                        </span>
                                    @else
                                        <span class="badge rounded-pill badge-light-secondary">
                                            {{ __('auth.' . $user->role->name) }}
                                        </span>
                                    @endif

                                </td>
                                <td>
                                    @inject('permissionChecker', 'App\Services\PermissionService')

                                    @php
                                        $iSpermission = $permissionChecker->userHasPermission($user->id);
                                        $valueP = 0;
                                        $iSpermission === true ? $valueP = 1 : $valueP = 0;
                                    @endphp

                                    @if ($user->role->name === "superadmin" || $user->role->name === "admin")
                                        <span class="badge rounded-pill badge-light-primary">
                                            <span class="d-flex">
                                                <i class="iconly-Setting icli" style="font-size: 1.5em"></i>
                                                <span class="ms-1">{{ __('dashboard.full_Access') }}</span>
                                            </span>
                                        </span>

                                    @elseif ($iSpermission == true)
                                        <span class="badge rounded-pill badge-light-primary" style="cursor: pointer" data-bs-toggle="modal" data-bs-target="#permission-modal" onclick="getPermission('{{ $user->id }}', '{{ $user->name }}','{{ $valueP }}')">
                                            <span class="d-flex">
                                                <i class="iconly-Setting icli" style="font-size: 1.5em"></i>
                                                <span class="ms-1">{{ __('dashboard.management') }}</span>
                                            </span>
                                        </span>
                                    @else
                                        <span class="badge rounded-pill badge-light-warning" style="cursor: pointer" data-bs-toggle="modal" data-bs-target="#permission-modal" onclick="getPermission('{{ $user->id }}', '{{ $user->name }}','{{ $valueP }}')">
                                            <span class="d-flex">
                                                <i class="iconly-Show icli" style="font-size: 1.5em"></i>
                                                <span class="ms-1">{{ __('dashboard.view_only') }}</span>
                                            </span>
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    @if (Auth::user()->role->name === "superadmin")
                                        @if($user->role->name === "user" || $user->role->name === "admin")
                                            <ul class="action">
                                                <li class="edit"> <a href="{{ route('app_add_user', ['id' => $user->id]) }}"><i class="icon-pencil-alt"></i></a></li>
                                                <li class="delete">
                                                    <a href="#" onclick="deleteElement('{{ $user->id }}', '{{ route('app_delete_user') }}', '{{ csrf_token() }}')">
                                                        <i class="icon-trash"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        @endif
                                    @else
                                        @if($user->role->name === "user" && $user->id !== Auth::user()->id)
                                            <ul class="action">
                                                <li class="edit"> <a href="{{ route('app_add_user', ['id' => $user->id]) }}"><i class="icon-pencil-alt"></i></a></li>
                                                <li class="delete">
                                                    <a href="#" onclick="deleteElement('{{ $user->id }}', '{{ route('app_delete_user') }}', '{{ csrf_token() }}')">
                                                        <i class="icon-trash"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        @endif
                                    @endif

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>

    </div>

</div>

<!-- Modal -->
<div class="modal fade" id="permission-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title fs-5" id="exampleModalLabel">{{ __('dashboard.user_authorization') }} </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="mgmt-form" action="{{ route('app_save_permission') }}" method="POST">
                @csrf

                <input type="hidden" name="id-user-mgmt" id="id-user-mgmt">

                <div class="mb-3">
                    <span class="badge rounded-pill badge-light-primary h6">
                        <span class="d-flex">
                            <i class="iconly-Profile icli" style="font-size: 1.5em"></i>
                            <span class="ms-1" id="user-mgmt-target"></span>
                        </span>
                    </span>
                </div>


                <div class="">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" name="mgmt-permission" id="mgmt-permission">
                        <label class="form-check-label" for="mgmt-permission">{{ __('dashboard.create') }} / {{ __('dashboard.update') }} / {{ __('dashboard.delation') }} ({{ __('dashboard.management') }}) </label>
                    </div>
                </div>

            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                <i class="fa-solid fa-circle-xmark"></i>
                {{ __('dashboard.cancel') }}
            </button>
            <button type="button" class="btn btn-primary save" id="save-mgmt-btn">
                <i class="fa-solid fa-floppy-disk"></i>
                {{ __('licence.save') }}
            </button>
            <button class="btn btn-primary btn-loading d-none" type="button" disabled>
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                {{ __('auth.loading') }}
            </button>
        </div>
        </div>
    </div>
</div>

@include('global.scipt')

<!-- datatable-->
<script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
<!-- page_datatable-->
<script src="{{ asset('assets/js/js-datatables/datatables/datatable.custom.js') }}"></script>
<!-- page_datatable-->
<script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js') }}"></script>
<!-- theme_customizer-->

<!-- Sweetalert js-->
<script src="{{ asset('assets/lib/sweet-alert/sweetalert.min.js') }}"></script>

@endsection
