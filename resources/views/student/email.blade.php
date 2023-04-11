<div class="wrapper">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Salam Alaykom,</div>
                <div class="card-body">
                    @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                    @endif
                    {!! $messages !!}
                </div>
            </div>
        </div>
    </div>
</div>