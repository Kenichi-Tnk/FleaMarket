<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\CategoryItem;
use App\Models\Condition;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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
            $item = Item::with('categories')->find($item_id);
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

    public function create(Request $request)
    {
        $form = $request->all();
        Log::info('Form Data:', $form);

        if ($request->hasFile('img_url')) {
            $file = $request->file('img_url');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('public/img', $filename);
            $form['img_url'] = 'img/' . $filename;
            Log::info('Image Path:', ['path' => $form['img_url']]);
        }

        $form['price'] = str_replace(',', '', $form['price']);
        $form['user_id'] = Auth::id();
        Log::info('Form Data with User ID:', $form);

        try {
            $newItem = Item::create($form);
            Log::info('New Item Created:', ['item' => $newItem]);

            if ($request->has('category_ids')) {
                $categoryIds = $request->input('category_ids');
                foreach ($categoryIds as $categoryId) {
                    \DB::table('category_item')->insert([
                        'item_id' => $newItem->id,
                        'category_id' => $categoryId,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    Log::info('Category Item Inserted:', ['item_id' => $newItem->id, 'category_id' => $categoryId]);
                }
            }
        } catch (\Exception $e) {
            Log::error('Error creating item:', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', '出品に失敗しました');
        }

        return redirect()->route('mypage')->with('success', '出品しました');
    }

    public function edit(Request $request, $item_id)
    {
        $form = $request->all();
        unset($form['_token']);
        Log::info('Form Data:', $form);

        if ($request->hasFile('img_url')) {
            $file = $request->file('img_url');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('public/img', $filename);
            $form['img_url'] = 'img/' . $filename;
            Log::info('Image Path:', ['path' => $form['img_url']]);
        }

        if (isset($form['price'])) {
            $form['price'] = str_replace(',', '', $form['price']);
        }
        $item = Item::find($item_id);
        $item->update($form);
        Log::info('Item Updated:', ['item' => $item]);

        \DB::table('category_item')->where('item_id', $item_id)->delete();
        if ($request->has('category_ids')) {
            $categoryIds = $request->input('category_ids');
            foreach ($categoryIds as $categoryId) {
                \DB::table('category_item')->insert([
                    'item_id' => $item->id,
                    'category_id' => $categoryId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                Log::info('Category Item Inserted:', ['item_id' => $item->id, 'category_id' => $categoryId]);
            }
        }

        return redirect()->route('mypage')->with('success', '変更しました');
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
        ];

        return view('sell', $data);
    }
}
