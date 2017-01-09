<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/28/16
 * Time: 1:27 PM
 */

namespace App\SalesTracker\Services\Api;


use App\SalesTracker\Repositories\Api\ProductApiRepository;
use App\SalesTracker\Repositories\Api\User\UserApiRepository;

class ProductApiService extends BaseService
{
    /**
     * @var ProductApiRepository
     */
    public $apiRepository;
    /**
     * @var UserApiRepository
     */
    public $user;

    /**
     * ProductApiService constructor.
     * @param ProductApiRepository $apiRepository
     * @param UserApiRepository $user
     */
    public function __construct(ProductApiRepository $apiRepository, UserApiRepository $user)
    {
        $this->apiRepository = $apiRepository;
        $this->user          = $user;
    }

    /**
     * @param $request
     * @return array
     */
    public function getServiceProduct($request)
    {
        if(!$this->validateToken($this->user, $request['api_token'])) {

            return $this->tokenMessage();
        }

        $productList = $this->apiRepository->getAllProduct();

        $product                 = [];
        $product["status"]       = "true";
        $product["token_status"] = "true";

        foreach ($productList as $list) {

            $product["products"][] = [

                "id"           => $list->id,
                "category"     => $list->category,
                "sub_category" => $list->sub_category,
                "name"         => $list->name,
                "code"         => $list->code,
                "description"  => $list->description,
                "price"        => $list->price,
                "image"        => $list->image

            ];
        }

        return $product;
    }
}