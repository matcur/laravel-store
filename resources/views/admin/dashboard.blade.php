@extends('admin.layouts.store')

@section('content')
    <div class="container">
        <div class="row justify-content-between">
            @include('admin.includes.left-menu')
            <div class="col-md-8">
                <div class="card card-body">
                    @foreach($dashboard->includes() as $include)
                        {{ $include }}
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
