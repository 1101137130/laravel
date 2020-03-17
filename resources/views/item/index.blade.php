@extends('layouts.app')

@section('content')
<div class="container">
    <table class="table table-hover" id="table">
        @foreach ($items as $item)
        <!-- <tr>
            <td>
                <input type="text" id="itemname">{{$item->itemname.':'}}
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
        </tr> -->
        @endforeach
    </table>
  
    <form action="{{url('item/create')}}" method="POST">
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

        <a type="btn" class="btn btn-primary" onclick="submit()"> 儲存</a>
    </form>
</div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
</script>

<script>
    window.onload = getData;
    var ItemEditarray = new Array();
    var EditCount =0;
    function getData() {

        $.ajax({
            type: "POST",
            url: "{{url('item')}}",
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                add_row(data);

            },
            error: function(jqXHR) {
                console.log('error')
            }
        })
    }

    function add_row(data) {
        for (var i = 0; i < data.length; i++) {

            var itemid = data[i][0];
            var itemname = data[i][1];
            var iterate = data[i][2];
            var td1 = '<td id="iname' + [i] + '"><div value=' + itemname + ' id=' + 'itemname' + itemid + '>項目：' + itemname + '</div></td>';
            var td2 = '<td id="iid' + [i] + '"><div value=' + iterate + ' id=' + itemid + '>賠率：' + iterate + '</div></td>';
            var td3 = '<td><a role="btn" class="btn btn-warning" onclick="openLabel(' + 'itemname' + itemid + ',' + itemid + ',' + i + ')">編輯</a>';
            var td4 = '<a role="btn" class="btn btn-danger" onclick="openLabel(' + itemname + ',' + itemid + ',' + i + ')">刪除</a></td>';
            var tr = $('<tr>').append(td1, td2, td3, td4);
            $('#table').append(tr);
        }

    }

    function openLabel(itemnameid, itemidid, i) {
        var itemid = document.getElementById(itemidid);
        
        delRow(itemnameid)
        delRow(itemid)
        var iname = '#iname' + i;
        var iid = '#iid' + i;
        $(iname).append('<input type="text" placeholder=' + itemnameid.attributes[0].nodeValue + ' value=' + itemnameid.attributes[0].nodeValue + ' id=' + itemnameid.attributes[1].nodeValue + '>');
        $(iid).append('<input type="text" placeholder=' + itemid.attributes[0].nodeValue + ' value=' + itemid.attributes[0].nodeValue + ' id=' + itemid.attributes[1].nodeValue + '>');
        
        
        console.log(itemnameid.id)

    }
    function submit(){
        
    }

    function add_EditContent(){
       
        ItemEditarray[EditCount] =new Array();

        EditCount++
    }

    function delRow(obj) {
        $(obj).remove();
    }

    function edit(id) {

    }
</script>