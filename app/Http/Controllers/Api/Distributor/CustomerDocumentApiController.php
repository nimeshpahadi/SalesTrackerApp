<?php
/**
 * Created by PhpStorm.
 * User: nimesh
 * Date: 4/9/17
 * Time: 10:41 AM
 */

namespace App\Http\Controllers\Api\Distributor;


use App\Http\Controllers\Controller;
use App\SalesTracker\Services\Api\Distributor\CustomerDocumentApiService;
use App\SalesTracker\Services\ApiValidation\DocumentValidation;
use Illuminate\Http\Request;

class CustomerDocumentApiController extends Controller
{
    /**
     * @var CustomerDocumentApiService
     */
    private $documentApiService;
    /**
     * @var DocumentValidation
     */
    private $documentValidation;

    /**
     * CustomerDocumentApiController constructor.
     * @param CustomerDocumentApiService $documentApiService
     * @param DocumentValidation $documentValidation
     */
    public function __construct(CustomerDocumentApiService $documentApiService, DocumentValidation $documentValidation)
    {
        $this->documentApiService = $documentApiService;
        $this->documentValidation = $documentValidation;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $data = $request->all();

        $t = $this->documentValidation->check($data);

        if ($t != null) {

            return $t;
        }

        $response = $this->documentApiService->create($data);

        return response()->json($response);
    }
}