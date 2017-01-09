<?php
namespace App\SalesTracker\Repositories;

use App\SalesTracker\Entities\Product\Product;
use Illuminate\Contracts\Logging\Log;
use League\Flysystem\Exception;

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
     * ProductRepository constructor.
     * @param Product $product
     */
    public function __construct(Product $product, Log $log)
    {


        $this->product = $product;
        $this->log = $log;
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

            $imagename = time() . '.' . $request->image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $request->image->move($destinationPath, $imagename);
            $data->image = $imagename;
            $data->save();
            $this->log->info("Product Created");

            return true;
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

            $imagename = time() . '.' . $request->image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $request->image->move($destinationPath, $imagename);
            $data->image = $imagename;
            $data->save();
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
            $data->delete();
            $this->log->info("Product Deleted ", ['id' => $id]);

            return true;
        } catch (Exception $e) {
            $this->log->info("Product Deletion Failed", ['id' => $id]);
            return false;
        }
    }
}