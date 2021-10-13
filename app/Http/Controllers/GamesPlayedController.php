<?php

namespace App\Http\Controllers;

use App\DataTables\GamesPlayedDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateGamesPlayedRequest;
use App\Http\Requests\UpdateGamesPlayedRequest;
use App\Repositories\GamesPlayedRepository;

use Laracasts\Flash\Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class GamesPlayedController extends AppBaseController
{
    /** @var  GamesPlayedRepository */
    private $gamesPlayedRepository;

    public function __construct(GamesPlayedRepository $gamesPlayedRepo)
    {
        $this->gamesPlayedRepository = $gamesPlayedRepo;
    }

    /**
     * Display a listing of the GamesPlayed.
     *
     * @param GamesPlayedDataTable $gamesPlayedDataTable
     * @return Response
     */
    public function index(GamesPlayedDataTable $gamesPlayedDataTable)
    {
        return $gamesPlayedDataTable->render('games_played.index');
    }

    /**
     * Show the form for creating a new GamesPlayed.
     *
     * @return Response
     */
    public function create()
    {
        return view('games_played.create');
    }

    /**
     * Store a newly created GamesPlayed in storage.
     *
     * @param CreateGamesPlayedRequest $request
     *
     * @return Response
     */
    public function store(CreateGamesPlayedRequest $request)
    {
        $input = $request->all();

        $gamesPlayed = $this->gamesPlayedRepository->create($input);

        Flash::success('Games Played saved successfully.');
        create_activity('create', 'Games Played');

        return redirect(route('gamesPlayed.index'));
    }

    /**
     * Display the specified GamesPlayed.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $gamesPlayed = $this->gamesPlayedRepository->find($id);

        if (empty($gamesPlayed)) {
            Flash::error('Games Played not found');

            return redirect(route('gamesPlayed.index'));
        }

        return view('games_played.show')->with('gamesPlayed', $gamesPlayed);
    }

    /**
     * Show the form for editing the specified GamesPlayed.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $gamesPlayed = $this->gamesPlayedRepository->find($id);

        if (empty($gamesPlayed)) {
            Flash::error('Games Played not found');

            return redirect(route('gamesPlayed.index'));
        }

        return view('games_played.edit')->with('gamesPlayed', $gamesPlayed);
    }

    /**
     * Update the specified GamesPlayed in storage.
     *
     * @param  int              $id
     * @param UpdateGamesPlayedRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateGamesPlayedRequest $request)
    {
        $gamesPlayed = $this->gamesPlayedRepository->find($id);

        if (empty($gamesPlayed)) {
            Flash::error('Games Played not found');

            return redirect(route('gamesPlayed.index'));
        }

        $gamesPlayed = $this->gamesPlayedRepository->update($request->all(), $id);

        Flash::success('Games Played updated successfully.');
        create_activity('update', 'Games Played');

        return redirect(route('gamesPlayed.index'));
    }

    /**
     * Remove the specified GamesPlayed from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $gamesPlayed = $this->gamesPlayedRepository->find($id);

        if (empty($gamesPlayed)) {
            Flash::error('Games Played not found');

            return redirect(route('gamesPlayed.index'));
        }

        $this->gamesPlayedRepository->delete($id);

        Flash::success('Games Played deleted successfully.');
        create_activity('delete', 'Games Played');

        return redirect(route('gamesPlayed.index'));
    }
}
