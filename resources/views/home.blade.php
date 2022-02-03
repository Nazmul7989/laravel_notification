@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                    @endif


                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <form action="{{ route('sendMail') }}" method="post">
                                        @csrf

                                        <input type="hidden" name="id" value="{{ $user->id }}">
                                        <button type="submit" class="btn btn-primary">Send Mail</button>

                                    </form>
                                </td>
                            </tr>

                        @endforeach
                        </tbody>
                    </table>


                    @auth
                            <h3>Sending Custom Mail</h3>

                            <form action="{{ route('customMail') }}" method="post">
                                @csrf


                                <div class="form-group">
                                    <input type="text" name="name" class="form-control" placeholder="Name" required>
                                </div>

                                <div class="form-group">
                                    <input type="text" name="price" class="form-control" placeholder="Price" required>
                                </div>

                                <div class="form-group">
                                    <input type="submit" value="Send" class="btn btn-primary">
                                </div>

                            </form>

                    @endauth








                </div>
            </div>
        </div>
    </div>
</div>
@endsection
