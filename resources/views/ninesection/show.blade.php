@extends('layouts.app')
@section('content')

<html>
<head>
    <meta charset="utf-8" />
    <title>Nine-Sections</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" />
</head>
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

</div>