<html>

<head>
    <meta charset="utf-8" />
    <title>Client Side jQuery DataTables</title>
    <!--引用css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" />
</head>

<body>
    <table id="myDataTalbe" class="display">
        <thead>
            <!--必填-->
            <tr>
                <th>單號</th>
                <th>下注方</th>
                <th>注單狀態</th>
                <th>下注金額</th>
                <th>當下賠率</th>
            </tr>
        </thead>
    </table>


    <!--引用jQuery-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <!--引用dataTables.js-->
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript">
        // $(function() {
        //     //getdable()
        $('#myDataTalbe').DataTable({
            "ajax": {
                "type": "GET",
                "url": "{{url('getOrder')}}",
                "dataSrc": function(json) {
                    //Make your callback here.
                    
                    console.log( json.data) ;
                    return json.data
                }
            },
            "columns": [{
                    "data": "id"
                },
                {
                    "data": "bet_object"
                },
                {
                    "data": "status"
                },
                {
                    "data": "amount"
                },
                {
                    "data": "item_rate"
                },
               

            ]
        });
        // });
        // $(document).ready(function() {
        //     $('#myDataTalbe').DataTable({
        //         // "processing": true,
        //         // "serverSide": true,
        //         "ajax": {
        //             url: "{{url('getOrder')}}",
        //             type: "GET",
        //             "columns": [{
        //                     data: "id"
        //                 },
        //                 {
        //                     data: "bet_object"
        //                 },
        //                 {
        //                     data: "status"
        //                 },
        //                 {
        //                     data: "amount"
        //                 },
        //                 {
        //                     data: "item_rate"
        //                 }
        //             ]
        //         }
        //     });
        // });

        // function getdable() {

        //     $("#myDataTalbe").DataTable({
        //         "processing": true,
        //         "serverSide": true,
        //         "ajax": {
        //             "url": "{{url('getOrder')}}",
        //             "type": "GET"
        //         },
        //         "columns": [{
        //                 "data": "id"
        //             },
        //             {
        //                 "data": "bet_object"
        //             },
        //             {
        //                 "data": "status"
        //             },
        //             {
        //                 "data": "amount"
        //             },
        //             {
        //                 "data": "item_rate"
        //             },

        //         ]
        //     });
        // }

        function getOrder() {
            $.ajax({
                type: "GET",
                url: "{{url('getOrder')}}",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },

                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        // $('#tbody').append('<tr>');

                        // $('#tbody').append('<td>');
                        // $('#tbody').append(''+data[i]['id']+'');
                        // $('#tbody').append('</td>');

                        // $('#tbody').append('<td>');
                        // $('#tbody').append(''+data[i]['bet_object']+'');
                        // $('#tbody').append('</td>');

                        // $('#tbody').append('<td>');
                        // $('#tbody').append(''+data[i]['status']+'');
                        // $('#tbody').append('</td>');

                        // $('#tbody').append('<td>');
                        // $('#tbody').append(''+data[i]['amount']+'');
                        // $('#tbody').append('</td>');

                        // $('#tbody').append('<td>');
                        // $('#tbody').append(''+data[i]['item_rate']+'');
                        // $('#tbody').append('</td>');

                        // $('#tbody').append('</tr>');
                    }

                },
                error: function(jqXHR) {
                    console.log(jqXHR)
                }
            })
        }
    </script>
</body>

</html>