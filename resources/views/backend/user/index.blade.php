@extends('backend.layouts.master')

    @section('title','create quiz')
        
    @section('content')
    <div class="span9">
        <div class="content">
            @if (Session::has('message'))
                <div class="alert alert-success">
                    {{ Session::get('message') }}
                </div>
            @endif
            <div class="module">
                <div class="module-head">
                    <h3>All Users</h3>
                </div>
                <div class="module-body">
                    <table class="table table-striped">
                        <thead>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Occupation</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th></th>
                            <th></th>
                        </thead>
                        <tbody>
                            @if (count($users)>0)
                                @foreach ($users as $key => $user)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->visible_password }}</td>
                                        <td>{{ $user->occupation }}</td>
                                        <td>{{ $user->address }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>
                                            <a href="{{ route('user.show',[$user->id]) }}">
                                                <button class="btn btn-info">View</button>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('user.edit',[$user->id]) }}">
                                                <button class="btn btn-primary">Edit</button>
                                            </a>
                                        </td>
                                        <td>
                                            <form class="delete-form{{ $user->id }}" action="{{ route('user.destroy', [$user->id]) }}" method="POST">
                                                @csrf
                                                {{ method_field("DELETE") }}
                                                <input type="submit" value="Delete" class="btn btn-danger">
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <td>No user to display</td>
                            @endif
                        </tbody>
                    </table>
                    <div class="pagination pagination-centered">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
