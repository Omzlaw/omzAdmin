<?php

namespace App\Http\Controllers\API;

use Response;
use Dirape\Token\Token;
use App\Models\GamesPlayed;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Repositories\GamesPlayedRepository;
use App\Http\Requests\API\CreateGamesPlayedAPIRequest;
use App\Http\Requests\API\UpdateGamesPlayedAPIRequest;

/**
 * Class GamesPlayedController
 * @package App\Http\Controllers\API
 */

class GamesPlayedAPIController extends AppBaseController
{
    /** @var  GamesPlayedRepository */
    private $gamesPlayedRepository;

    public function __construct(GamesPlayedRepository $gamesPlayedRepo)
    {
        $this->gamesPlayedRepository = $gamesPlayedRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/gamesPlayed",
     *      summary="Get a listing of the GamesPlayeds.",
     *      tags={"GamesPlayed"},
     *      description="Get all GamesPlayeds",
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
     *                  @SWG\Items(ref="#/definitions/GamesPlayed")
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
        $gamesPlayed = $this->gamesPlayedRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($gamesPlayed->toArray(), 'Games Played retrieved successfully');
    }

    /**
     * @param CreateGamesPlayedAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/gamesPlayed",
     *      summary="Store a newly created GamesPlayed in storage",
     *      tags={"GamesPlayed"},
     *      description="Store GamesPlayed",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="GamesPlayed that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/GamesPlayed")
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
     *                  ref="#/definitions/GamesPlayed"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateGamesPlayedAPIRequest $request)
    {
        $input = $request->all();
        $input['token'] = (new Token())->Unique('games_played', 'api_token', 60);

        $gamesPlayed = $this->gamesPlayedRepository->create($input);

        return $this->sendResponse($gamesPlayed->toArray(), 'Games Played saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/gamesPlayed/{id}",
     *      summary="Display the specified GamesPlayed",
     *      tags={"GamesPlayed"},
     *      description="Get GamesPlayed",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of GamesPlayed",
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
     *                  ref="#/definitions/GamesPlayed"
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
        /** @var GamesPlayed $gamesPlayed */
        $gamesPlayed = $this->gamesPlayedRepository->find($id);

        if (empty($gamesPlayed)) {
            return $this->sendError('Games Played not found');
        }

        return $this->sendResponse($gamesPlayed->toArray(), 'Games Played retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateGamesPlayedAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/gamesPlayed/{id}",
     *      summary="Update the specified GamesPlayed in storage",
     *      tags={"GamesPlayed"},
     *      description="Update GamesPlayed",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of GamesPlayed",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="GamesPlayed that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/GamesPlayed")
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
     *                  ref="#/definitions/GamesPlayed"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateGamesPlayedAPIRequest $request)
    {
        $input = $request->all();

        /** @var GamesPlayed $gamesPlayed */
        $gamesPlayed = $this->gamesPlayedRepository->find($id);

        if (empty($gamesPlayed)) {
            return $this->sendError('Games Played not found');
        }

        if($input['token'] != $gamesPlayed->token) {
            return $this->sendError('Token is not valid');
        }

        $input['status'] = 1;
        $gamesPlayed = $this->gamesPlayedRepository->update($input, $id);

        return $this->sendResponse($gamesPlayed->toArray(), 'Games Played updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/gamesPlayed/{id}",
     *      summary="Remove the specified GamesPlayed from storage",
     *      tags={"GamesPlayed"},
     *      description="Delete GamesPlayed",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of GamesPlayed",
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
        /** @var GamesPlayed $gamesPlayed */
        $gamesPlayed = $this->gamesPlayedRepository->find($id);

        if (empty($gamesPlayed)) {
            return $this->sendError('Games Played not found');
        }

        $gamesPlayed->delete();

        return $this->sendSuccess('Games Played deleted successfully');
    }
}
