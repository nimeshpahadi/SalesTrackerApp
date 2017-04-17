<?php
/**
 * Created by PhpStorm.
 * User: nimesh
 * Date: 4/9/17
 * Time: 10:44 AM
 */

namespace App\SalesTracker\Services\Api\Distributor;


use App\SalesTracker\Repositories\Api\BaseRepository;
use App\SalesTracker\Repositories\Api\Distributor\CustomerDocumentApiRepository;
use App\SalesTracker\Repositories\Api\User\UserApiRepository;
use App\SalesTracker\Services\Api\BaseService;
use Illuminate\Support\Facades\File;

class CustomerDocumentApiService extends BaseService
{
    /**
     * @var CustomerDocumentApiRepository
     */
    private $documentApiRepository;
    /**
     * @var UserApiRepository
     */
    private $user;
    /**
     * @var BaseRepository
     */
    private $baseRepository;

    /**
     * CustomerDocumentApiService constructor.
     * @param CustomerDocumentApiRepository $documentApiRepository
     * @param UserApiRepository $user
     * @param BaseRepository $baseRepository
     */
    public function __construct(CustomerDocumentApiRepository $documentApiRepository,
                                UserApiRepository $user, BaseRepository $baseRepository)
    {
        $this->documentApiRepository = $documentApiRepository;
        $this->user = $user;
        $this->baseRepository = $baseRepository;
    }

    /**
     * @param $request
     * @return array
     */
    public function create($request)
    {
        if (!$this->validateToken($this->user, $request['api_token'])) {

            return $this->tokenMessage();
        }

        $fileName = $request['customer_id'] . '_' . rand(0, 10000) . '.' . $request['document_name']->getClientOriginalExtension();

        $destinationPath = storage_path('app/public/customer/').$request['customer_id'].'_'.'customer';

        if (!File::exists($destinationPath))
        {
            File::makeDirectory($destinationPath, 0775, true, true);
        }

        $request['document_name']->move($destinationPath, $fileName);

        $request['document_name'] = $fileName;

        $this->storeData($this->baseRepository, $request);

        if ($this->documentApiRepository->create($request)) {

            $response = [
                "status"       => "true",
                "token_status" => "true",
                "message"      => "customer document created !!!"
            ];

            return $response;
        }

        $response = [
            "status"       => "false",
            "token_status" => "true",
            "message"      => "oops !!! something went wrong"
        ];

        return $response;

    }

    /**
     * @param $request
     * @param $id
     * @return array
     */
    public function getCustomerDocument($request, $id)
    {
        if (!$this->validateToken($this->user, $request['api_token']))
        {
            return $this->tokenMessage();
        }

        $documentData = $this->documentApiRepository->getCustomerDocument($id);

        $destinationPath = asset('/storage/customer/');

        $document = [];

        foreach ($documentData as $data)
        {
            $document[] = [
                'document_type' => $data->document_type,
                'document_name' => $destinationPath.'/'.$id.'_'.'customer'.'/'.$data->document_name
            ];
        }

        return $document;
    }
}