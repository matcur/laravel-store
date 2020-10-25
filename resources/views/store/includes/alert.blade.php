@if(session('success'))
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@if($errors->count())
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <div class="alert alert-success" role="alert">
                    {{ $errors->first() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endif
