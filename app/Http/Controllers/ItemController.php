<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Item;
use Exception;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $items = Item::all();
        return view('item.index', [
            'items' => $items
        ]);
    }

    public function delete(Request $request, Item $item)
    {
        try {
            $item->delete();
            $request->session()->flash('status', '刪除成功！');
            return redirect('item');
        } catch (Exception $e) {
            return $e;
        }
    }
    public function update(Request $request, Item $item)
    {
        try {
            $item->update();
            $request->session()->flash('status', '更改成功！');
            return redirect('item');
        } catch (Exception $e) {
            return $e;
        }
    }

    public function create(Request $request)
    {

        try {
            $item = Item::create($request->all());
            $request->session()->flash('status', '新增成功！');
            return redirect('item');
        } catch (Exception $e) {
            return $e;
        }

        return $item;
    }
}
