@extends('home')

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
            <td style="width: 21.4228%; height: 18px;">莊家 ：</td>
            <td style="width: 25.4878%; text-align: center; height: 18px;">&nbsp;</td>
            <td style="width: 28.0894%; text-align: center; height: 18px;">&nbsp;</td>
            <td style="width: 25%; text-align: center; height: 18px;">&nbsp;</td>
        </tr>
        <tr style="height: 10px;">
            <td style="width: 21.4228%; height: 10px;">閒家 ：</td>
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

            <tr style="height: 18px;">
                <td style="width: 50.3317%; height: 18px; text-align: center;">

                    <select name="object1winlost">
                        <option value="{{$win->id}}" selected="selected">{{$win->itemname.' : '.$win->rate}}</option>
                        <option value="{{$lost->id}}">{{$lost->itemname.' : '.$lost->rate}}</option>
                    </select>

                    <input type="number" name="object1winlostamount" placeholder="請輸入金額" step="5" min="0">

                </td>
                <td style="width: 49.6683%; height: 18px; text-align: center;">

                    <select name="object2winlost">
                        <option value="{{$win->id}}" selected="selected">{{$win->itemname.' : '.$win->rate}}</option>
                        <option value="{{$lost->id}}">{{$lost->itemname.' : '.$lost->rate}}</option>
                    </select>

                    <input type="number" name="object2winlostamount" placeholder="請輸入金額" step="5" min="0">

                </td>
            </tr>

            <tr style="height: 18px;">
                <td style="width: 50.3317%; height: 18px; text-align: center;">

                    <select name="object1bigsmall">
                        <option value="{{$big}}" selected="selected">{{$big->itemname.' : '.$big->rate}}</option>
                        <option value="{{$small->id}}">{{$small->itemname.' : '.$small->rate}}</option>
                    </select>
                   
                    <input type="number" name="object1bigsmallamount" placeholder="請輸入金額" step="5" min="0">
                </td>

                <td style="width: 49.6683%; height: 18px; text-align: center;">

                    <select name="object2bigsmall">
                        <option value="{{$big->id}}" selected="selected">{{$big->itemname.' : '.$big->rate}}</option>
                        <option value="{{$small->id}}">{{$small->itemname.' : '.$small->rate}}</option>
                    </select>

                    <input type="number" name="object2bigsmallamount" placeholder="請輸入金額" step="5" min="0">

                </td>
            </tr>

            <tr style="height: 18px;">
                <td style="width: 50.3317%; height: 18px; text-align: center;">

                    <select name="object1singledoble">
                        <option value="{{$single->id}}" selected="selected">{{$single->itemname.' : '.$single->rate}}</option>
                        <option value="{{$doble->id}}">{{$doble->itemname.' : '.$doble->rate}}</option>
                    </select>

                    <input type="number" name="object1singledobleamount" placeholder="請輸入金額" step="5" min="0">

                </td>
                <td style="width: 49.6683%; height: 18px; text-align: center;">

                    <select name="object2singledoble">
                        <option value="{{$single->id}}" selected="selected">{{$single->itemname.' : '.$single->rate}}</option>
                        <option value="{{$doble->id}}">{{$doble->itemname.' : '.$doble->rate}}</option>
                    </select>

                    <input type="number" name="object2singledobleamount" placeholder="請輸入金額" step="5" min="0">

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


    <input style="text-align: center;" type="submit" value="下單">
    <a style="text-align: center;" href="{{url('game')}}" role="btn">清空</a>
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