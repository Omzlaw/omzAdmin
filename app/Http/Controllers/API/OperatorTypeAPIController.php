<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateOperatorTypeAPIRequest;
use App\Http\Requests\API\UpdateOperatorTypeAPIRequest;
use App\Models\OperatorType;
use App\Repositories\OperatorTypeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class OperatorTypeController
 * @package App\Http\Controllers\API
 */

class OperatorTypeAPIController extends AppBaseController
{
    /** @var  OperatorTypeRepository */
    private $operatorTypeRepository;

    public function __construct(OperatorTypeRepository $operatorTypeRepo)
    {
        $this->operatorTypeRepository = $operatorTypeRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/operatorTypes",
     *      summary="Get a listing of the OperatorTypes.",
     *      tags={"OperatorType"},
     *      description="Get all OperatorTypes",
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
     *                  @SWG\Items(ref="#/definitions/OperatorType")
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
        $operatorTypes = $this->operatorTypeRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($operatorTypes->toArray(), 'Operator Types retrieved successfully');
    }

    /**
     * @param CreateOperatorTypeAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/operatorTypes",
     *      summary="Store a newly created OperatorType in storage",
     *      tags={"OperatorType"},
     *      description="Store OperatorType",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="OperatorType that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/OperatorType")
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
     *                  ref="#/definitions/OperatorType"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateOperatorTypeAPIRequest $request)
    {
        $input = $request->all();

        $operatorType = $this->operatorTypeRepository->create($input);

        return $this->sendResponse($operatorType->toArray(), 'Operator Type saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/operatorTypes/{id}",
     *      summary="Display the specified OperatorType",
     *      tags={"OperatorType"},
     *      description="Get OperatorType",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of OperatorType",
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
     *                  ref="#/definitions/OperatorType"
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
        /** @var OperatorType $operatorType */
        $operatorType = $this->operatorTypeRepository->find($id);

        if (empty($operatorType)) {
            return $this->sendError('Operator Type not found');
        }

        return $this->sendResponse($operatorType->toArray(), 'Operator Type retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateOperatorTypeAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/operatorTypes/{id}",
     *      summary="Update the specified OperatorType in storage",
     *      tags={"OperatorType"},
     *      description="Update OperatorType",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of OperatorType",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="OperatorType that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/OperatorType")
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
     *                  ref="#/definitions/OperatorType"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateOperatorTypeAPIRequest $request)
    {
        $input = $request->all();

        /** @var OperatorType $operatorType */
        $operatorType = $this->operatorTypeRepository->find($id);

        if (empty($operatorType)) {
            return $this->sendError('Operator Type not found');
        }

        $operatorType = $this->operatorTypeRepository->update($input, $id);

        return $this->sendResponse($operatorType->toArray(), 'OperatorType updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/operatorTypes/{id}",
     *      summary="Remove the specified OperatorType from storage",
     *      tags={"OperatorType"},
     *      description="Delete OperatorType",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of OperatorType",
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
        /** @var OperatorType $operatorType */
        $operatorType = $this->operatorTypeRepository->find($id);

        if (empty($operatorType)) {
            return $this->sendError('Operator Type not found');
        }

        $operatorType->delete();

        return $this->sendSuccess('Operator Type deleted successfully');
    }
}
