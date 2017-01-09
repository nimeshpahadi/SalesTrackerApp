<?php
namespace App\SalesTracker\Services;

use App\SalesTracker\Repositories\ProductRepository;


/**
 * Created by PhpStorm.
 * User: prakash
 * Date: 11/27/16
 * Time: 5:03 AM
 */
class productService
{
    public $productRepository;

    /**
     * productService constructor.
     * @param ProductRepository $productRepository
     */

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function allproduct()
    {
        $data = $this->productRepository->productlist();
        return $data;
    }

    public function changeprice($request, $id)
    {
//        $formData = $request->all();
//        $price = trim($formData['price']);
        $data = $this->productRepository->changepriceId($request, $id);
        return $data;
    }

    public function storeproduct($request)
    {
        $data = $this->productRepository->store_product($request);
        return $data;
    }

    public function editproduct($request, $id)
    {
        $data = $this->productRepository->edit_product($request, $id);
        return $data;
    }

    public function deleteproduct($id)
    {
        $data = $this->productRepository->delete_product($id);
        return $data;
    }

    public function subcat_list()
    {
        $data = $this->productRepository->subcatlist();
        return $data;
    }

}