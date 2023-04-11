@extends
@section('content')
<div class="wrapper">
    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
    @endif
    <div style="max-width: 320px; margin: 0 auto; padding: 20px; background: #fff;">
        <h3>Message Admin :</h3>
        <div>{{ $info['message'] }}</div>
    </div>
</div>
@endsection