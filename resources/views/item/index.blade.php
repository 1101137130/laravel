@foreach ($items as $item)
<P>{{ $item->id.':'.$item->itemname.', rate:'.$item->rate}}
    <form action="item/{{$item->id}}" method="POST">
        {{csrf_field()}}
        {{ method_field('DELETE') }}
        <input type="submit" value="DELETE">
    </form>
</P>
@endforeach

@if (session('status'))
<div class="alert alert-success">
    <strong>{{ session('status') }}
</div>
@endif
<form action="/item" method="POST">
    {{csrf_field()}}
    <input type="text" placeholder="請輸入品項" name="itemname"></br>
    <input type="number" name="rate" placeholder="1.0000" step="0.0001" min="0.000" max="10000">
    <input type="submit" value="go">
</form>