@extends('layouts.app')

@section('content')
<div class="container">
    <table class="table table-hover">
        <tbody>
            <tr>
                <td></td>
                <td style="width: 25.4878%; text-align: center;">第一局</td>
                <td style="width: 28.0894%; text-align: center;">第二局</td>
                <td style="width: 25%; text-align: center;">第三局</td>
            </tr>
            <tr>
                <td style="text-align: center;">莊家 ：</td>
                <td id="ob1one" style="text-align: center;"></td>
                <td id="ob1two" style="text-align: center;"></td>
                <td id="ob1three" style="text-align: center;"></td>
            </tr>
            <tr>
                <td style="text-align: center;">閒家 ：</td>
                <td id="ob2one" style="text-align: center;"></td>
                <td id="ob2two" style="text-align: center;"></td>
                <td id="ob2three" style="text-align: center;"></td>
            </tr>
            <tr>
                <td style="text-align: center;">賽果：</td>
                <td id="win1" style="text-align: center;"></td>
                <td id="win2" style="text-align: center;"></td>
                <td id="win3" style="text-align: center;"></td>
            </tr>
            <tr>
                <td style="text-align: center;">總賽果：</td>
                <td></td>
                <td id="finalresult" style="text-align: center;"></td>
                <td></td>

            </tr>
        </tbody>
    </table>

    <form action="{{url('game')}}" method="POST">
        {{csrf_field()}}
        <table class="table table-hover">
            <tbody>

                <tr>
                    <td style="text-align: center;">
                        <h1>莊家</h1>
                    </td>
                    <td style="text-align: center;">
                        <h1>閒家</h1>
                    </td>
                </tr>

                <tr>
                    <td style="text-align: center;">

                        <select class="form-control" id="object1winlost">
                            <option value="{{$win['itemname'].' '.$win['id'].' '.$win['rate']}}" selected="selected">{{$win['itemname'].' : '.$win['rate']}}</option>
                            <option value="{{$lost['itemname'].' '.$lost['id'].' '.$lost['rate']}}">{{$lost['itemname'].' : '.$lost['rate']}}</option>
                        </select>

                        <input id="object1winlostamount" class="form-control" type="number" onchange="dataToNap('object1winlost',this.id,1)" placeholder="請輸入金額" step="5" min="0">

                    </td>
                    <td style="text-align: center;">

                        <select class="form-control" id="object2winlost">
                            <option value="{{$win['itemname'].' '.$win['id'].' '.$win['rate']}}" selected="selected">{{$win['itemname'].' : '.$win['rate']}}</option>
                            <option value="{{$lost['itemname'].' '.$lost['id'].' '.$lost['rate']}}">{{$lost['itemname'].' : '.$lost['rate']}}</option>
                        </select>

                        <input type="number" class="form-control" id="object2winlostamount" onchange="dataToNap('object2winlost',this.id,2)" placeholder="請輸入金額" step="5" min="0">

                    </td>
                </tr>

                <tr>
                    <td style="text-align: center;">

                        <select class="form-control" id="object1bigsmall">
                            <option value="{{$big['itemname'].' '.$big['id'].' '.$big['rate']}}" selected="selected">{{$big['itemname'].' : '.$big['rate']}}</option>
                            <option value="{{$small['itemname'].' '.$small['id'].' '.$small['rate']}}">{{$small['itemname'].' : '.$small['rate']}}</option>
                        </select>

                        <input type="number" class="form-control" id="object1bigsmallamount" onchange="dataToNap('object1bigsmall',this.id,1)" placeholder="請輸入金額" step="5" min="0">
                    </td>

                    <td style="text-align: center;">

                        <select class="form-control" id="object2bigsmall">
                            <option value="{{$big['itemname'].' '.$big['id'].' '.$big['rate']}}" selected="selected">{{$big['itemname'].' : '.$big['rate']}}</option>
                            <option value="{{$small['itemname'].' '.$small['id'].' '.$small['rate']}}">{{$small['itemname'].' : '.$small['rate']}}</option>
                        </select>

                        <input type="number" class="form-control" id="object2bigsmallamount" onchange="dataToNap('object2bigsmall',this.id,2)" placeholder="請輸入金額" step="5" min="0">

                    </td>
                </tr>

                <tr>
                    <td style="text-align: center;">

                        <select class="form-control" id="object1singledouble">
                            <option value="{{$single['itemname'].' '.$single['id'].' '.$single['rate']}}" selected="selected">{{$single['itemname'].' : '.$single['rate']}}</option>
                            <option value="{{$double['itemname'].' '.$double['id'].' '.$double['rate']}}">{{$double['itemname'].' : '.$double['rate']}}</option>
                        </select>

                        <input type="number" class="form-control" id="object1singledoubleamount" onchange="dataToNap('object1singledouble',this.id,1)" placeholder="請輸入金額" step="5" min="0">

                    </td>
                    <td style="text-align: center;">

                        <select class="form-control" id="object2singledouble">
                            <option value="{{$single['itemname'].' '.$single['id'].' '.$single['rate']}}" selected="selected">{{$single['itemname'].' : '.$single['rate']}}</option>
                            <option value="{{$double['itemname'].' '.$double['id'].' '.$double['rate']}}">{{$double['itemname'].' : '.$double['rate']}}</option>
                        </select>

                        <input type="number" class="form-control" id="object2singledoubleamount" onchange="dataToNap('object2singledouble',this.id,2)" placeholder="請輸入金額" step="5" min="0">

                    </td>
                </tr>

                <!-- <tr hidden="hidden" >
                    <td style="text-align: center;">

                        <selectclass="form-control" >
                            <option selected="selected">{{$win['itemname'].' : '.$win['rate']}}</option>
                            <option>{{$lost['itemname'].' : '.$win['rate']}}</option>
                        </select>

                        <input type="number" class="form-control" name="bet_object:1" step="5" min="0">

                    </td>
                    <td style="text-align: center;">

                        <select class="form-control">
                            <option selected="selected">{{$win['itemname'].' : '.$win['rate']}}</option>
                            <option>{{$lost['itemname'].' : '.$win['rate']}}</option>
                        </select>

                        <input type="number" class="form-control" name="bet_object:2" step="5" min="0">

                    </td>
                </tr> -->
            </tbody>
        </table>
        <div style="text-align: center;">
            <a role="btn" class="btn btn-primary" onclick="action()"> 下單/開始</a>
            <a class="btn btn-danger" href="{{url('game')}}" role="btn">清空</a>
        </div>
    </form>
    <div style="text-align: center;">
        <table>
            @foreach ($items as $item)
            <tr>
                <td>
                    注項名稱：{{$item['itemname'].':'}} >
                </td>
                <td>
                    賠率為：{{'rate :'.$item['rate']}}
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
</script>


<script>
    const order = new Map(); //建立一個外部map來存放使用者選擇的資料

    function alertcontents() { //建立確認訊息來提供使用者作確認是否下注用
        var array = new Array();

        for (var i = 0; i < ordersarray.length; i++) {
            array.push('\n'+'項目：' + convertObjectToName(ordersarray[i][4]) + ordersarray[i][0] + ' | ' +
                '賠率為：' + ordersarray[i][2] )
        }
        return array;
    }

    function convertObjectToName(object) {
        if (object == 1) {
            return '莊家'
        }
        if (object == 2) {
            return '閒家'
        }
    }

    function mapToString() { //建立一個string來接map裡的資料 
        var ordersarray = new Array(); //因為map不能轉成json 所以不能傳道後台
        var i = 0;
        for (let entry of order.keys()) {
            var j = 0;
            ordersarray[i] = new Array();
            ordersarray[i][j] = new Array();

            for (let e of order.get(entry)) {
                ordersarray[i][j] = e[1]
                j++;
            }
            i++
        }
        return ordersarray
    }

    function ajaxBack(ordersarray) {

        $.ajax({
            type: "POST",
            url: "{{url('game')}}",
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                order: ordersarray
            },
            success: function(data) {
                $('#ob1one').html(data[0]['object1']['card']);
                $('#ob1two').html(data[1]['object1']['card']);
                $('#ob1three').html(data[2]['object1']['card']);
                $('#ob2one').html(data[0]['object2']['card']);
                $('#ob2two').html(data[1]['object2']['card']);
                $('#ob2three').html(data[2]['object2']['card']);
                $('#win1').html(data[0][0]['result']);
                $('#win2').html(data[1][0]['result']);
                $('#win3').html(data[2][0]['result']);
                $('#finalresult').html(data[3]['finalresult']);
                //   console.log(data)
            },
            error: function(jqXHR) {
                console.log(jqXHR)
            }
        })
    }

    function action() {
        ordersarray = mapToString();
        if (ordersarray.length > 0) {
            var array = alertcontents();
            
            var yes = confirm(array + '\n' + '你確定嗎？')
            if (yes) {
                ajaxBack(ordersarray);
            } else {
                location.reload();
            }
        } else {

            $testrun = 'true'
            ajaxBack($testrun);

        }
    }

    function dataToNap(id, amountid, object) {
        var item = document.getElementById(id).value
        var item = item.split(" ");

        var amount = document.getElementById(amountid).value
        //金額不為0則新增一個map 並放入 外部map-order
        //金額為0則判斷外部map有無此id 有則做刪除
        if (amount != 0) {
            const ord = new Map();
            ord.set('itemname', item[0])
            ord.set('itemid', item[1])
            ord.set('rate', item[2])
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