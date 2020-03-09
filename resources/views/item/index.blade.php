@extends('layouts.app')

@section('content')
<div class="container">
    <table class="table table-hover">
        @foreach ($items as $item)
        <tr>
            <td>
                {{$item->itemname.':'}}
            </td>
            <td>
                {{'rate :'.$item->rate}}
            </td>
            <td><a href="{{url('item/'.$item->id.'/edit')}}" role="btn" class="btn btn-warning">編輯</a></td>
            <td>
                <form action="{{url('item/'.$item->id)}}" method="POST">
                    {{csrf_field()}}
                    {{ method_field('DELETE') }}
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="submit" class="btn btn-danger" value="刪除">
                </form>
            </td>
        </tr>
        @endforeach
    </table>



    @if (session('status'))
    <div class="alert alert-success">
        <strong>{{ session('status') }}
    </div>
    @endif

    <form action="{{url('item')}}" method="POST">
        {{csrf_field()}}
        @if ($errors->has('itemname'))
        <span class="help-block">
            <strong>{{$errors->first('itemname')}}</strong></br>
        </span>
        @endif
        品項：<input type="text" placeholder="請輸入品項" name="itemname">
        @if ($errors->has('rate'))
        <span class="help-block">
            <strong>{{$errors->first('rate')}}</strong></br>
        </span>
        @endif
        賠率：<input type="number" name="rate" placeholder="請輸入賠率" step="0.0001" min="0.000" max="10000">
        <input type="submit" value="新增">
    </form>
</div>
@endsection