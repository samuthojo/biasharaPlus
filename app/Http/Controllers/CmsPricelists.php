<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Cms\CreatePriceList;
use App\Http\Requests\Cms\UpdatePriceList;
use Illuminate\Support\Facades\DB;
use App\Events\PriceListDeleted;

class CmsPricelists extends Controller
{
    public function index()
    {
      return view('priceLists', [
        'priceLists' => \App\PriceList::latest('created_at')->get(),
      ]);
    }

    public function store(CreatePriceList $request)
    {
      $priceList = $this->savePriceList($request);
      $priceLists = \App\PriceList::latest('created_at')->get();
      return view('tables.pricelists_table', compact('priceLists'));
    }

    private function savePriceList($request)
    {
      DB::beginTransaction();
      $priceList = null;
      try {
        $priceList = \App\PriceList::create($request->all());

        //now insert a price for this pricelist for each product
        $this->insertPrices($priceList->id);

        DB::commit();
      }
      catch(Throwable $e) {
        DB::rollBack();
        return response()->json(["message" => "Error, price-list not added"], 500);
      }

      return $priceList;
    }

    private function insertPrices($price_list_id)
    {
      $productIds = \App\Product::pluck('id');
      foreach($productIds as $product_id) {
        \App\Price::create(compact('product_id', 'price_list_id'));
      }
    }

    public function update(UpdatePriceList $request, $id)
    {
      \App\PriceList::where('id', $id)->update($request->all());
      $priceLists = \App\PriceList::latest('created_at')->get();
      return view('tables.pricelists_table', compact('priceLists'));
    }

    public function destroy($id)
    {
      $priceList = \App\PriceList::find($id);
      $priceList->delete();

      //Dispatch event to softly delete all this priceList's prices
      event(new PriceListDeleted($priceList));

      $priceLists = \App\PriceList::latest('created_at')->get();
      return view('tables.pricelists_table', compact('priceLists'));
    }
}
