@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><strong>Admin</strong> Dashboard</div>

                <div class="card-body">
                    @if (session('user_role'))
                        <div class="alert alert-success" role="alert">
                            {{ session('user_role') }}
                        </div>
                    @endif
                    
                    
                    You are logged in! 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
</html>