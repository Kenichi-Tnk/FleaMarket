<?php

namespace App\Http\Controllers;

use App\Http\Requests\SellRequest;
use App\Models\Category;
use App\Models\CategoryItem;
use App\Models\Condition;
use App\Models\Item;
use Illuminate\Support\Facades\Storage;

class SellController extends Controller
{
    public function index($item_id = null)
    {
        $conditions = Condition::all();
        $categories = Category::all();
        $selectedConditionId = null;
        $selectedCategoryId = null;

        if($item_id) {
            $item = Item::find($item_id);
            $selectedConditionId = $item->condition_id;
            $selectedCategoryId = $item->categories->first()->id;
        }

        $data = [
            'conditions' => $conditions,
            'categories' => $categories,
            'selectedConditionId' => $selectedConditionId,
            'item' => $item ?? null,
            'item_id' => $item_id ?? null,
        ];

        return view('sell', $data);
    }

    public function create(SellRequest $request)
    {
        $form = $request->all();

        if ($request->hasFile('img_url')) {
            $file = $request->file('img_url');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('public/img', $filename);
            $form['img_url'] = '/storage/img/' . $filename;
        }

        $form['price'] = str_replace(',', '', $form['price']);
        $newItem = Item::create($form);

        if ($request->has('category_ids')) {
            $categoryIds = $request->input('category_ids');
            foreach ($categoryIds as $categoryId) {
                \DB::table('category_items')->insert([
                    'item_id' => $newItem->id,
                    'category_id' => $categoryId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        return redirect()->back()->with('success', '出品しました');
    }

    public function edit(SellRequest $request, $item_id)
    {
        $form = $request->all();
        unset($form['_token']);

        if(isset($form['img_url'])) {
            $file = $request->file('img_url');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('public/img', $filename);
            $form['img_url'] = '/storage/img/' . $filename;
        }

        if(isset($form['price'])) {
            $form['price'] = str_replace(',', '', $form['price']);
        }
        $item = Item::find($item_id);
        $item->update($form);

        \DB::table('category_items')->where('item_id', $item_id)->delete();
        if ($request->has('category_ids')) {
            $categoryIds = $request->input('category_ids');
            foreach ($categoryIds as $categoryId) {
                \DB::table('category_items')->insert([
                    'item_id' => $item->id,
                    'category_id' => $categoryId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        return redirect()->back()->with('success', '変更しました');
    }

    public function showForm()
    {
        $conditions = Condition::all();
        $categories = Category::all();
        $selectedConditionId = null;

        $data = [
            'conditions' => $conditions,
            'categories' => $categories,
            'selectedConditionId' => $selectedConditionId,
            'item' => $item ?? null,
            'item_id' => $item_id ?? null,
        ];

        return view('sell', $data);
    }

}
