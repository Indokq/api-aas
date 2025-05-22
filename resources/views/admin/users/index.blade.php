@extends('layouts.app')

@section('title', 'User Management')

@section('content')
    <div class="container mt-5">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="fas fa-users me-2"></i>User Management</span>
                <a href="{{ route('users.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus-circle me-1"></i>Add New User
                </a>
            </div>
            <div class="card-body">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->roles->first()->name ?? 'No role' }}</td>
                                <td class="text-center">
                                    <a href="{{ route('users.edit', $user) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit me-1"></i>Edit
                                    </a>

                                    @if(auth()->id() !== $user->id)
                                        <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline"
                                            onsubmit="return confirm('Are you sure you want to delete this user?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash me-1"></i>Delete
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">No users found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection