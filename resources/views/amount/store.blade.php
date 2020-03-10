@extends('layouts.app')

@section('content')
@if (session('status'))
<div class="alert alert-success">
    <strong>{{ session('status') }}
</div>
@endif
<section class="conrainer">
    <form action="{{url('amount')}}" method="POST">
        {{csrf_field()}}

        @if ($errors->has('itemname'))
        <span class="help-block">
            <strong>{{$errors->first('itemname')}}</strong></br>
        </span>
        @endif
        金額：<input type="text" placeholder="請輸入需要儲值金額" name="amount">
        <input type="submit" value="儲存">
    </form>
</section>

@endsection