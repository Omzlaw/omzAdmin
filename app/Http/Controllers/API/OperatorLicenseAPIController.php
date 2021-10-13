<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateOperatorLicenseAPIRequest;
use App\Http\Requests\API\UpdateOperatorLicenseAPIRequest;
use App\Models\OperatorLicense;
use App\Repositories\OperatorLicenseRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class OperatorLicenseController
 * @package App\Http\Controllers\API
 */

class OperatorLicenseAPIController extends AppBaseController
{
    /** @var  OperatorLicenseRepository */
    private $operatorLicenseRepository;

    public function __construct(OperatorLicenseRepository $operatorLicenseRepo)
    {
        $this->operatorLicenseRepository = $operatorLicenseRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/operatorLicenses",
     *      summary="Get a listing of the OperatorLicenses.",
     *      tags={"OperatorLicense"},
     *      description="Get all OperatorLicenses",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/OperatorLicense")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $operatorLicenses = $this->operatorLicenseRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($operatorLicenses->toArray(), 'Operator Licenses retrieved successfully');
    }

    /**
     * @param CreateOperatorLicenseAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/operatorLicenses",
     *      summary="Store a newly created OperatorLicense in storage",
     *      tags={"OperatorLicense"},
     *      description="Store OperatorLicense",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="OperatorLicense that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/OperatorLicense")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/OperatorLicense"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateOperatorLicenseAPIRequest $request)
    {
        $input = $request->all();

        $operatorLicense = $this->operatorLicenseRepository->create($input);

        return $this->sendResponse($operatorLicense->toArray(), 'Operator License saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/operatorLicenses/{id}",
     *      summary="Display the specified OperatorLicense",
     *      tags={"OperatorLicense"},
     *      description="Get OperatorLicense",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of OperatorLicense",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/OperatorLicense"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var OperatorLicense $operatorLicense */
        $operatorLicense = $this->operatorLicenseRepository->find($id);

        if (empty($operatorLicense)) {
            return $this->sendError('Operator License not found');
        }

        return $this->sendResponse($operatorLicense->toArray(), 'Operator License retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateOperatorLicenseAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/operatorLicenses/{id}",
     *      summary="Update the specified OperatorLicense in storage",
     *      tags={"OperatorLicense"},
     *      description="Update OperatorLicense",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of OperatorLicense",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="OperatorLicense that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/OperatorLicense")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/OperatorLicense"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateOperatorLicenseAPIRequest $request)
    {
        $input = $request->all();

        /** @var OperatorLicense $operatorLicense */
        $operatorLicense = $this->operatorLicenseRepository->find($id);

        if (empty($operatorLicense)) {
            return $this->sendError('Operator License not found');
        }

        $operatorLicense = $this->operatorLicenseRepository->update($input, $id);

        return $this->sendResponse($operatorLicense->toArray(), 'OperatorLicense updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/operatorLicenses/{id}",
     *      summary="Remove the specified OperatorLicense from storage",
     *      tags={"OperatorLicense"},
     *      description="Delete OperatorLicense",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of OperatorLicense",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var OperatorLicense $operatorLicense */
        $operatorLicense = $this->operatorLicenseRepository->find($id);

        if (empty($operatorLicense)) {
            return $this->sendError('Operator License not found');
        }

        $operatorLicense->delete();

        return $this->sendSuccess('Operator License deleted successfully');
    }
}
