@extends('layouts.app')
@php
    $counter = 0
@endphp
@section('content')

    <h1 class='text-center'>Users Table</h1>


    {{-- Table Striped can add the zebra stripes to the table --}}
    <table class="table table-striped table-bordered caption-top">
        <caption>List of Users</caption>
        <thead class='align-bottom'>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Admin Since</th>
            <th scope="col">Actions</th>
        </thead>
        <tbody>
            
            
            @forelse ($users as $user)
            <tr>
                
                <td>{{ $counter+=1 }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ optional($user->admin_since)->diffForHumans() ?? 'Never' }}</td>
                <td>
                    <form action = "{{ route('user.admin.toggle', ['user' => $user->id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">{{ $user->isAdmin() ? 'Remove' : 'Make' }}Admin</button>
                    </form>
                </td>
                
                
            </tr>
                
                
            @empty
                <tr>
                    <td cols=6>No Product Available</td>
                </tr>
                
            @endforelse
            
        </tbody>
    </table>
@endsection