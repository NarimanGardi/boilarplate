@extends('backend.app')
@section('title', __('Manage User'))
@section('content')
<div class="page-content">
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">Manage Users</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <a href="{{ route('users.create') }}" class="btn btn-primary btn-icon-text mb-2 mb-md-0">
                <i class="btn-icon-prepend" data-feather="user"></i>
                Create New User
            </a>
        </div>
    </div>
    <div class="row g-4">
        <div class="col-12">
            <div class="card">
                <h5 class="card-header">Users Table</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Photo</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @forelse ($users as $user)
                            <tr>
                                <td><strong>{{$user->name}}</strong></td>
                                <td>{{$user->email}}</td>
                                <td>
                                    <div
                                    data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                    class="avatar avatar-xs pull-up" title="" data-bs-original-title="{{ $user->name }}">
                                        <img src="{{ $user->getFirstMediaUrl('avatar', 'thumb-38') ? $user->getFirstMediaUrl('avatar', 'thumb-38') : asset('backend/assets/images/user.png') }}" alt="Avatar" class="rounded-circle" />
                                    </div>
                                </td>
                                <td>
                                    @forelse($user->roles as $role)
                                        <span class="badge bg-label-primary me-1 ">
                                            {{ $role->name }}
                                        </span>
                                    @empty
                                        <span class="badge bg-label-danger me-1 ">
                                            No Role
                                        </span>
                                    @endforelse
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 " data-bs-toggle="dropdown"><i
                                                class="bx bx-dots-vertical-rounded"></i></button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('users.edit',$user->id) }}"><i
                                                    class="bx bx-edit-alt me-1"></i> Edit</a>
                                            <form action="{{ route('users.destroy',$user->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item show_confirm"><i
                                                        class="bx bx-trash me-1"></i> Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">No User Found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="m-3">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
