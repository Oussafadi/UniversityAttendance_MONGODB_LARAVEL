@extends('layouts.app')
@section ('content')

<div class="wrapper">
    <div class="subscriber">
        <form action=" {{ route('subscribe_start')"}} method=" POST">
            @csrf
            <div class="form-group">
                <label for=""> Your Email</label>
                <input type="email" name="mail" placeholder="Enter your email" class="form-control">
                @error('mail')
                <span class="text-danger"> {{ message }} </span>
                @enderror
            </div>
            <div class="form-group">
                <button>Submit</button>
            </div>
        </form>
    </div>
</div>
@endsection