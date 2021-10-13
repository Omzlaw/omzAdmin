<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateOperatorGameAPIRequest;
use App\Http\Requests\API\UpdateOperatorGameAPIRequest;
use App\Models\OperatorGame;
use App\Repositories\OperatorGameRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class OperatorGameController
 * @package App\Http\Controllers\API
 */

class OperatorGameAPIController extends AppBaseController
{
    /** @var  OperatorGameRepository */
    private $operatorGameRepository;

    public function __construct(OperatorGameRepository $operatorGameRepo)
    {
        $this->operatorGameRepository = $operatorGameRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/operatorGames",
     *      summary="Get a listing of the OperatorGames.",
     *      tags={"OperatorGame"},
     *      description="Get all OperatorGames",
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
     *                  @SWG\Items(ref="#/definitions/OperatorGame")
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
        $operatorGames = $this->operatorGameRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($operatorGames->toArray(), 'Operator Games retrieved successfully');
    }

    /**
     * @param CreateOperatorGameAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/operatorGames",
     *      summary="Store a newly created OperatorGame in storage",
     *      tags={"OperatorGame"},
     *      description="Store OperatorGame",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="OperatorGame that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/OperatorGame")
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
     *                  ref="#/definitions/OperatorGame"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateOperatorGameAPIRequest $request)
    {
        $input = $request->all();

        $operatorGame = $this->operatorGameRepository->create($input);

        return $this->sendResponse($operatorGame->toArray(), 'Operator Game saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/operatorGames/{id}",
     *      summary="Display the specified OperatorGame",
     *      tags={"OperatorGame"},
     *      description="Get OperatorGame",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of OperatorGame",
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
     *                  ref="#/definitions/OperatorGame"
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
        /** @var OperatorGame $operatorGame */
        $operatorGame = $this->operatorGameRepository->find($id);

        if (empty($operatorGame)) {
            return $this->sendError('Operator Game not found');
        }

        return $this->sendResponse($operatorGame->toArray(), 'Operator Game retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateOperatorGameAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/operatorGames/{id}",
     *      summary="Update the specified OperatorGame in storage",
     *      tags={"OperatorGame"},
     *      description="Update OperatorGame",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of OperatorGame",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="OperatorGame that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/OperatorGame")
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
     *                  ref="#/definitions/OperatorGame"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateOperatorGameAPIRequest $request)
    {
        $input = $request->all();

        /** @var OperatorGame $operatorGame */
        $operatorGame = $this->operatorGameRepository->find($id);

        if (empty($operatorGame)) {
            return $this->sendError('Operator Game not found');
        }

        $operatorGame = $this->operatorGameRepository->update($input, $id);

        return $this->sendResponse($operatorGame->toArray(), 'OperatorGame updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/operatorGames/{id}",
     *      summary="Remove the specified OperatorGame from storage",
     *      tags={"OperatorGame"},
     *      description="Delete OperatorGame",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of OperatorGame",
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
        /** @var OperatorGame $operatorGame */
        $operatorGame = $this->operatorGameRepository->find($id);

        if (empty($operatorGame)) {
            return $this->sendError('Operator Game not found');
        }

        $operatorGame->delete();

        return $this->sendSuccess('Operator Game deleted successfully');
    }
}
