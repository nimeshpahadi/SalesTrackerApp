<?php
namespace App\SalesTracker\Repositories;

use App\SalesTracker\Entities\Inventory\Warehouse_Product;
use App\SalesTracker\Entities\Product\Product;
use File;
use Illuminate\Contracts\Logging\Log;
//use Illuminate\Http\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\Exception;
//use PhpParser\Node\Scalar\MagicConst\File;
//use Symfony\Component\HttpFoundation\File\File;


/**
 * Created by PhpStorm.
 * User: prakash
 * Date: 11/27/16
 * Time: 5:06 AM
 */
class ProductRepository
{
    public $product;
    /**
     * @var Log
     */
    private $log;
    /**
     * @var Warehouse_Product
     */
    private $warehouse_Product;

    /**
     * ProductRepository constructor.
     * @param Product $product
     */
    public function __construct(Product $product, Log $log, Warehouse_Product $warehouse_Product)
    {


        $this->product = $product;
        $this->log = $log;
        $this->warehouse_Product = $warehouse_Product;
    }


    public function productlist()
    {
        $query = $this->product->select('*');
        return $query->get();

    }

    public function subcatlist()
    {
        $query = $this->product->select('*')->distinct()->groupBy('sub_category')->get();
        return $query;

    }

    public function changepriceId($request, $id)
    {
        try {
            $data = Product::find($id);
            $data->price = $request->price;
            $data->save();
            $this->log->info(" Product Price Changed ", ['id' => $id]);

            return true;
        } catch (Exception $e) {
            $this->log->error("Product Price Changing Failed", ['id' => $id]);

            return false;
        }
    }

    public function store_product($request)
    {
        try {
            $data = new Product();
            $data->category = $request->category;
            $data->sub_category = $request->sub_category;
            $data->name = $request->name;
            $data->code = $request->code;
            $data->description = $request->description;
            $data->price = $request->price;

            $imagename =  $data->category.'_'.$data->sub_category.'_'.$data->name.'_'.time(). '.' . $request->image->getClientOriginalExtension();
            $destinationPath = storage_path('/app/public/product');
            $request->image->move($destinationPath, $imagename);
            $data->image = $imagename;
            $data->save();
            $this->log->info("Product Created");

            return $data;
        } catch (Exception $e) {
            $this->log->error("Product Creation Failed");

            return false;
        }
    }

    public function edit_product($request, $id)
    {

        try {

            $data = Product::find($id);
            $data->category = $request->category;
            $data->sub_category = $request->sub_category;
            $data->name = $request->name;
            $data->code = $request->code;
            $data->description = $request->description;
            $data->price = $request->price;
                if (isset($data->image)) {
                    $image_name = $data->image;
                    $path = storage_path() . '/app/public/product/';
                    File::delete($path . $image_name);
                }
            $imagename =  $data->category.'_'.$data->sub_category.'_'.$data->name.'_'.time(). '.' . $request->image->getClientOriginalExtension();
            $destinationPath = storage_path('/app/public/product');
            $request->image->move($destinationPath, $imagename);
            $data->image = $imagename;
            $data->update();
            $this->log->info("Product Updated", ['id' => $id]);

            return true;
        } catch (Exception $e) {
            $this->log->error("Product Update Failed", ['id' => $id]);

            return false;
        }
    }

    public function delete_product($id)
    {
        try {
            $data = Product::find($id);
            $filename = $data['image'];
            $path = storage_path().'/app/public/product/';

            if (File::exists($path . $filename) && !File::delete($path . $filename)) {
                    $this->log->info("Product image not found ", ['id' => $id]);
            } else {
                $data->delete();
                $this->log->info("Product Deleted ", ['id' => $id]);
                return true;
            }

        }
        catch (Exception $e) {
            $this->log->info("Product Deletion Failed", ['id' => $id]);
            return false;
        }
    }


    public function getWareofProduct($id)
    {
        $query = $this->product->select('warehouses.id as wareid','warehouses.name as warename','warehouse_product.id as wpid')
                                    ->join('warehouse_product','warehouse_product.product_id','products.id')
                                    ->join('warehouses','warehouses.id','warehouse_product.warehouse_id')
                                    ->where('products.id',$id)
                                    ->groupBy('warehouses.id');
        return $query->get();
    }
}









