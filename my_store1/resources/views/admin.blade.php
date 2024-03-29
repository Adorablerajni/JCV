@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><strong>Admin</strong> Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @php    
                    $user = Auth::user();

                    $id = Auth::id();
                    @endphp
                    You are logged in! {{  $user->login_name }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
</html>