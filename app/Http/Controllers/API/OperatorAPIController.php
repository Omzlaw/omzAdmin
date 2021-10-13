<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateOperatorAPIRequest;
use App\Http\Requests\API\UpdateOperatorAPIRequest;
use App\Models\Operator;
use App\Repositories\OperatorRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class OperatorController
 * @package App\Http\Controllers\API
 */

class OperatorAPIController extends AppBaseController
{
    /** @var  OperatorRepository */
    private $operatorRepository;

    public function __construct(OperatorRepository $operatorRepo)
    {
        $this->operatorRepository = $operatorRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/operators",
     *      summary="Get a listing of the Operators.",
     *      tags={"Operator"},
     *      description="Get all Operators",
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
     *                  @SWG\Items(ref="#/definitions/Operator")
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
        $operators = $this->operatorRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($operators->toArray(), 'Operators retrieved successfully');
    }

    /**
     * @param CreateOperatorAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/operators",
     *      summary="Store a newly created Operator in storage",
     *      tags={"Operator"},
     *      description="Store Operator",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Operator that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Operator")
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
     *                  ref="#/definitions/Operator"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateOperatorAPIRequest $request)
    {
        $input = $request->all();

        $operator = $this->operatorRepository->create($input);

        return $this->sendResponse($operator->toArray(), 'Operator saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/operators/{id}",
     *      summary="Display the specified Operator",
     *      tags={"Operator"},
     *      description="Get Operator",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Operator",
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
     *                  ref="#/definitions/Operator"
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
        /** @var Operator $operator */
        $operator = $this->operatorRepository->find($id);

        if (empty($operator)) {
            return $this->sendError('Operator not found');
        }

        return $this->sendResponse($operator->toArray(), 'Operator retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateOperatorAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/operators/{id}",
     *      summary="Update the specified Operator in storage",
     *      tags={"Operator"},
     *      description="Update Operator",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Operator",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Operator that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Operator")
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
     *                  ref="#/definitions/Operator"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateOperatorAPIRequest $request)
    {
        $input = $request->all();

        /** @var Operator $operator */
        $operator = $this->operatorRepository->find($id);

        if (empty($operator)) {
            return $this->sendError('Operator not found');
        }

        $operator = $this->operatorRepository->update($input, $id);

        return $this->sendResponse($operator->toArray(), 'Operator updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/operators/{id}",
     *      summary="Remove the specified Operator from storage",
     *      tags={"Operator"},
     *      description="Delete Operator",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Operator",
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
        /** @var Operator $operator */
        $operator = $this->operatorRepository->find($id);

        if (empty($operator)) {
            return $this->sendError('Operator not found');
        }

        $operator->delete();

        return $this->sendSuccess('Operator deleted successfully');
    }
}
