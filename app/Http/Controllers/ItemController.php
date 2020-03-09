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

    public function destroy(Request $request, Item $item)
    {
        try {
            $item->delete();
            $request->session()->flash('status', '刪除成功！');
            return redirect('item');
        } catch (Exception $e) {
            return $e;
        }
    }

    public function show($id)
    {
        $item = Item::find($id);
        return redirect('item');
    }

    public function edit($id)
    {
        $item = Item::find($id);
        return view('item.edit', [
            'item' => $item
        ]);
    }
    public function update(Request $request, Item $item)
    {
        $this->validate($request, [
            'itemname' => 'required|max:15',
            'rate' => 'required',
        ]);
        try {
            $item->update();
            $request->session()->flash('status', '更改成功！');
            return redirect('item');
        } catch (Exception $e) {
            return $e;
        }
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'itemname' => 'required|max:15',
            'rate' => 'required',
        ]);

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
