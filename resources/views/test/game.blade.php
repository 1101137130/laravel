<select  class="form-control" id="object1winlost">
</select>
<input  id="ob1win" value="{{$item}}">
<input id="ob1lost" value="{{$lost['itemname']}}">

<input id="object1winlostamount" class="form-control" type="number" onchange="dataToNap('object1winlost',this.id,1)" placeholder="請輸入金額" step="5" min="0">



<script>
    var ob1win = document.getElementById('ob1win')
    var object1winlost = document.getElementById('object1winlost')
    //var ob2win = document.getElementById('ob2win')
    var ob1lost = document.getElementById('ob1lost')
    // var ob2lost = document.getElementById('ob2lost')
    // var ob1big = document.getElementById('ob1big')
    // var ob2big = document.getElementById('ob2big')
    // var ob1small = document.getElementById('ob1small')
    // var ob2small = document.getElementById('ob2small')
    // var ob1single = document.getElementById('ob1single')
    // var ob2single = document.getElementById('ob2single')
    // var ob1double = document.getElementById('ob1double')
    // var ob2double = document.getElementById('ob2double')
    var context = JSON.parse(ob1win.value)

    const order = new Map(); //建立一個外部map來存放使用者選擇的資料
    
    object1winlost.options.add(new Option(context.itemname+'：'+context.rate, context))

    function dataToNap(id, amountid, object) {
        var item = JSON.parse(document.getElementById(id).value)
        var amount = document.getElementById(amountid).value
        //金額不為0則新增一個map 並放入 外部map-order
        //金額為0則判斷外部map有無此id 有則做刪除
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
