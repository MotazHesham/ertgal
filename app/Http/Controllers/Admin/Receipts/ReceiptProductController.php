<?php

namespace App\Http\Controllers\Admin\Receipts;

use App\Exports\ReceiptProductExport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ReceiptProduct;
use App\Models\Receipt_social;
use App\Models\Receipt_social_Product;
use Image;
use Maatwebsite\Excel\Facades\Excel;

class ReceiptProductController extends Controller
{
    public function index(Request $request){
        $name = null;
        $from_date = null;
        $to_date = null;

        $type = $request->type;

        $products = ReceiptProduct::orderBy('created_at','desc')->where('type',$type)->with('product_in_receitps.receipt_social');

        if ($request->name != null){
            $name = $request->name;
            $GLOBALS['name'] = $name;
            $products = ReceiptProduct::where(function($Q){
                $Q->where('name','like','%'.$GLOBALS['name'].'%')->orWhere('price','like','%'.$GLOBALS['name'].'%');
            })->where('type',$type)->orderBy('created_at','desc')->with('product_in_receitps.receipt_social');
        }

        if ($request->from_date != null && $request->to_date != null) {
            $from_date = strtotime($request->from_date);
            $to_date = strtotime($request->to_date);
            $GLOBALS['from_date'] = $from_date;
            $GLOBALS['to_date'] = $to_date;

            $products = ReceiptProduct::orderBy('created_at','desc')->where('type',$type)->whereHas('product_in_receitps',function($q){
                return $q->whereBetween('created_at',[date('Y-m-d H:i:s',$GLOBALS['from_date']),date('Y-m-d H:i:s',$GLOBALS['to_date'] + 86399)]);
            });

            if ($request->name != null){
                $name = $request->name;
                $GLOBALS['name'] = $name;
                $products = $products->where(function($Q){
                    $Q->where('name','like','%'.$GLOBALS['name'].'%')->orWhere('price','like','%'.$GLOBALS['name'].'%');
                });
            }
        }

        if ($request->has('download')) {
            return Excel::download(new ReceiptProductExport($products->get()), 'receipt_products.xlsx');
        }
        $products = $products->paginate(10);
        return view('admin.receipts.receipt_products.index', compact('products','name','type','from_date','to_date'));
    }

    public function store(Request $request){
        $product = new ReceiptProduct;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->type = $request->type;
        $product->commission = $request->commission;

        $photos = array();

        if($request->hasFile('photos')){
            foreach ($request->photos as $key => $photo) {
                $image_name = time() . '_' . $key . rand(1,20) . '.' .$photo->getClientOriginalExtension();
                $destinationPath = public_path('uploads/receipt_social/photos/'.$image_name);
                $img = Image::make($photo->getRealPath());
                $img->resize(700, 600, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath);
                array_push($photos, 'uploads/receipt_social/photos/'.$image_name);
            }
        }
        $product->photos = json_encode($photos);
        $product->save();
        return redirect()->route('receipt.product',$request->type);
    }

    public function update(Request $request){
        $product = ReceiptProduct::findOrFail($request->id);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->commission = $request->commission;
        $product->save();

        global $product_id;
        $product_id = $product->id;

        $raws = Receipt_social::with('receipt_social_products')->whereHas('receipt_social_products.product',function($q){
            $q->where('receipt_product_id',$GLOBALS['product_id']);
        })->get();

        foreach($raws as $receipt_social){
            $sum= 0;

            foreach($receipt_social->receipt_social_products as $row){
                $commission = $product->commission * $row->quantity;

                $row->commission = $commission;
                $row->save();

                $sum += $commission;
            }

            $receipt_social->commission = $sum ;
            $receipt_social->save();
        }
        return redirect()->route('receipt.product',$product->type);
    }

    public function edit_photos($id){
        $product = ReceiptProduct::findOrFail($id);
        return view('admin.receipts.receipt_products.edit_photos', compact('product'));
    }

    public function update_photos(Request $request){
        $product = ReceiptProduct::findOrFail($request->id);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->commission = $request->commission;
        if($request->has('previous_photos')){
            $photos = $request->previous_photos;
        }
        else{
            $photos = array();
        }

        if($request->hasFile('photos')){
            foreach ($request->photos as $key => $photo) {
                $image_name = time() . '_' . $key . rand(1,20) . '.' . $photo->getClientOriginalExtension();
                $destinationPath = public_path('uploads/receipt_social/photos/'.$image_name);
                $img = Image::make($photo->getRealPath());
                $img->resize(700, 600, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath);
                array_push($photos, 'uploads/receipt_social/photos/'.$image_name);
            }
        }
        $product->photos = json_encode($photos);
        $product->save();
        return redirect()->route('receipt.product',$product->type);
    }

    public function destroy($id){
        $product = ReceiptProduct::findOrFail($id);
        $type = $product->type;
        $product->delete();
        return redirect()->route('receipt.product',$type);
    }
}
