@extends('layouts.app')

@section('content')

<table class="table table-hover">
    <tbody>
        <tr style="height: 18px;">
            <td style="width: 21.4228%; height: 18px; border-color: #000000;">&nbsp;</td>
            <td style="width: 25.4878%; text-align: center; height: 18px;">第一局</td>
            <td style="width: 28.0894%; text-align: center; height: 18px;">第二局</td>
            <td style="width: 25%; text-align: center; height: 18px;">第三局</td>
        </tr>
        <tr style="height: 18px;">
            <td style="width: 21.4228%; text-align: center;height: 18px;">莊家 ：</td>
            <td style="width: 25.4878%; text-align: center; height: 18px;">&nbsp;</td>
            <td style="width: 28.0894%; text-align: center; height: 18px;">&nbsp;</td>
            <td style="width: 25%; text-align: center; height: 18px;">&nbsp;</td>
        </tr>
        <tr style="height: 10px;">
            <td style="width: 21.4228%; text-align: center;height: 10px;">閒家 ：</td>
            <td style="width: 25.4878%; text-align: center; height: 10px;">&nbsp;</td>
            <td style="width: 28.0894%; text-align: center; height: 10px;">&nbsp;</td>
            <td style="width: 25%; text-align: center; height: 10px;">&nbsp;</td>
        </tr>
    </tbody>
</table>
<hr />
<form action="{{url('game')}}" method="POST">
    {{csrf_field()}}
    <table class="table table-hover">
        <tbody>

            <tr style="height: 18px;">
                <td style="width: 50.3317%; height: 18px; text-align: center;">
                    <h1>莊家</h1>
                </td>
                <td style="width: 49.6683%; height: 18px; text-align: center;">
                    <h1>閒家</h1>
                </td>
            </tr>
            <!-- @if (session('status'))
            <div class="alert alert-success">
                <strong>{{ session('status') }}
            </div>
            @endif
            @if (session('error'))
            <div class="alert alert-danger">
                <strong>{{ session('error') }}
            </div>
            @endif -->
            <tr style="height: 18px;">
                <td style="width: 50.3317%; height: 18px; text-align: center;">

                    <select id="object1winlost">
                        <option value="{{$win}}" selected="selected">{{$win->itemname.' : '.$win->rate}}</option>
                        <option value="{{$lost}}">{{$lost->itemname.' : '.$lost->rate}}</option>
                    </select>

                    <input id="object1winlostamount" type="number" onchange="orders('object1winlost',this.id,1)" placeholder="請輸入金額" step="5" min="0">

                </td>
                <td style="width: 49.6683%; height: 18px; text-align: center;">

                    <select id="object2winlost">
                        <option value="{{$win}}" selected="selected">{{$win->itemname.' : '.$win->rate}}</option>
                        <option value="{{$lost}}">{{$lost->itemname.' : '.$lost->rate}}</option>
                    </select>

                    <input type="number" id="object2winlostamount" onchange="orders('object2winlost',this.id,2)" placeholder="請輸入金額" step="5" min="0">

                </td>
            </tr>

            <tr style="height: 18px;">
                <td style="width: 50.3317%; height: 18px; text-align: center;">

                    <select id="object1bigsmall">
                        <option value="{{$big}}" selected="selected">{{$big->itemname.' : '.$big->rate}}</option>
                        <option value="{{$small}}">{{$small->itemname.' : '.$small->rate}}</option>
                    </select>

                    <input type="number" id="object1bigsmallamount" onchange="orders('object1bigsmall',this.id,1)" placeholder="請輸入金額" step="5" min="0">
                </td>

                <td style="width: 49.6683%; height: 18px; text-align: center;">

                    <select id="object2bigsmall">
                        <option value="{{$big}}" selected="selected">{{$big->itemname.' : '.$big->rate}}</option>
                        <option value="{{$small}}">{{$small->itemname.' : '.$small->rate}}</option>
                    </select>

                    <input type="number" id="object2bigsmallamount" onchange="orders('object2bigsmall',this.id,2)" placeholder="請輸入金額" step="5" min="0">

                </td>
            </tr>

            <tr style="height: 18px;">
                <td style="width: 50.3317%; height: 18px; text-align: center;">

                    <select id="object1singledoble">
                        <option value="{{$single}}" selected="selected">{{$single->itemname.' : '.$single->rate}}</option>
                        <option value="{{$doble}}">{{$doble->itemname.' : '.$doble->rate}}</option>
                    </select>

                    <input type="number" id="object1singledobleamount" onchange="orders('object1singledoble',this.id,1)" placeholder="請輸入金額" step="5" min="0">

                </td>
                <td style="width: 49.6683%; height: 18px; text-align: center;">

                    <select id="object2singledoble">
                        <option value="{{$single}}" selected="selected">{{$single->itemname.' : '.$single->rate}}</option>
                        <option value="{{$doble}}">{{$doble->itemname.' : '.$doble->rate}}</option>
                    </select>

                    <input type="number" id="object2singledobleamount" onchange="orders('object2singledoble',this.id,2)" placeholder="請輸入金額" step="5" min="0">

                </td>
            </tr>

            <tr hidden="hidden" style="height: 18px;">
                <td style="width: 50.3317%; height: 18px; text-align: center;">

                    <select>
                        <option selected="selected">{{$win->itemname.' : '.$win->rate}}</option>
                        <option>{{$lost->itemname.' : '.$win->rate}}</option>
                    </select>

                    <input type="number" name="bet_object:1" step="5" min="0">

                </td>
                <td style="width: 49.6683%; height: 18px; text-align: center;">

                    <select>
                        <option selected="selected">{{$win->itemname.' : '.$win->rate}}</option>
                        <option>{{$lost->itemname.' : '.$win->rate}}</option>
                    </select>

                    <input type="number" name="bet_object:2" step="5" min="0">

                </td>
            </tr>
        </tbody>
    </table>
    <div style="text-align: center;">
        <a role="btn" class="btn btn-primary" onclick="action()"> 下單/開始</a>
        <a class="btn btn-danger" href="{{url('game')}}" role="btn">清空</a>
    </div>
</form>
@foreach ($items as $item)
<table>
    <tr>
        <td>
            注項名稱：{{$item->itemname.':'}} >
        </td>
        <td>
            賠率為：{{'rate :'.$item->rate}}
        </td>
    </tr>
</table>
@endforeach

@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
</script>

<script>
    var ordersarray = new Array();
    ordersarray[0] = new Array();
    ordersarray[1] = new Array();
    const order = new Map();

    function action() {
        var i = 0;
        for (let entry of order.values()) { // the same as of recipeMap.entries()
            var j = 0;
            ordersarray[i] = entry;
            for (let e of entry.values()) {
                ordersarray[i][j] = e

                j++;
            }
            i++
        }
        var array = new Array();
        for (var i = 0; i < order.size; i++) {

            if (ordersarray[i][4] == 1) {
                ordersarray[i][4] = '莊家'
            }
            if (ordersarray[i][4] == 2) {
                ordersarray[i][4] = '閒家'
            }
            array.push('項目：' + ordersarray[i][4] + ordersarray[i][0] + ' | ' +
                '賠率為：' + ordersarray[i][2] + '\n')
        }
        if (order.size > 0) {
            var yes = confirm(array + '\n' + '你確定嗎？')

            if (yes) {

                $.ajax({
                    type: "POST",
                    url: "{{url('game')}}",
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: order,
                    success: function(data) {
                        alert(data)
                    },
                    error: function(jqXHR) {
                    }
                })



            } else {

            }
        }


        // alert(array)


    }

    function orders(id, amountid, object) {
        var item = JSON.parse(document.getElementById(id).value)
        var amount = document.getElementById(amountid).value

        if (amount != 0) {
            const ord = new Map();
            ord.set('itemname', item['itemname'])
            ord.set('itemid', item["id"])
            ord.set('rate', item["rate"])
            ord.set('amount', amount)
            ord.set('object', object)
            order.set(id, ord)
        } else {
            if (order.has(id)) {
                order.delete(id)
            }
        }
    }
</script>