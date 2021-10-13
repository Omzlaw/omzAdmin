<?php

namespace App\Http\Controllers;

use Response;
use App\Http\Requests;
use Laracasts\Flash\Flash;
use App\Models\OperatorScheme;
use App\DataTables\OperatorGameDataTable;

use App\Http\Controllers\AppBaseController;
use App\Repositories\OperatorGameRepository;
use App\Http\Requests\CreateOperatorGameRequest;
use App\Http\Requests\UpdateOperatorGameRequest;

class OperatorGameController extends AppBaseController
{
    /** @var  OperatorGameRepository */
    private $operatorGameRepository;

    public function __construct(OperatorGameRepository $operatorGameRepo)
    {
        $this->operatorGameRepository = $operatorGameRepo;
    }

    /**
     * Display a listing of the OperatorGame.
     *
     * @param OperatorGameDataTable $operatorGameDataTable
     * @return Response
     */
    public function index(OperatorGameDataTable $operatorGameDataTable)
    {
        return $operatorGameDataTable->render('operator_games.index');
    }

    /**
     * Show the form for creating a new OperatorGame.
     *
     * @return Response
     */
    public function create()
    {
        $operator_schemes = new OperatorScheme;
        return view('operator_games.create',compact('operator_schemes'));
    }

    /**
     * Store a newly created OperatorGame in storage.
     *
     * @param CreateOperatorGameRequest $request
     *
     * @return Response
     */
    public function store(CreateOperatorGameRequest $request)
    {
        $input = $request->all();

        $operatorGame = $this->operatorGameRepository->create($input);

        Flash::success('Operator Game saved successfully.');
        create_activity('create', 'Operator Game');

        return redirect(route('operatorGames.index'));
    }

    /**
     * Display the specified OperatorGame.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $operatorGame = $this->operatorGameRepository->find($id);

        if (empty($operatorGame)) {
            Flash::error('Operator Game not found');

            return redirect(route('operatorGames.index'));
        }

        return view('operator_games.show')->with('operatorGame', $operatorGame);
    }

    /**
     * Show the form for editing the specified OperatorGame.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $operatorGame = $this->operatorGameRepository->find($id);

        if (empty($operatorGame)) {
            Flash::error('Operator Game not found');

            return redirect(route('operatorGames.index'));
        }

        $operator_schemes = new OperatorScheme;
        return view('operator_games.edit',compact('operator_schemes'))->with('operatorGame', $operatorGame);
    }

    /**
     * Update the specified OperatorGame in storage.
     *
     * @param  int              $id
     * @param UpdateOperatorGameRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOperatorGameRequest $request)
    {
        $operatorGame = $this->operatorGameRepository->find($id);

        if (empty($operatorGame)) {
            Flash::error('Operator Game not found');

            return redirect(route('operatorGames.index'));
        }

        $operatorGame = $this->operatorGameRepository->update($request->all(), $id);

        Flash::success('Operator Game updated successfully.');
        create_activity('update', 'Operator Game');

        return redirect(route('operatorGames.index'));
    }

    /**
     * Remove the specified OperatorGame from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $operatorGame = $this->operatorGameRepository->find($id);

        if (empty($operatorGame)) {
            Flash::error('Operator Game not found');

            return redirect(route('operatorGames.index'));
        }

        $this->operatorGameRepository->delete($id);

        Flash::success('Operator Game deleted successfully.');
        create_activity('delete', 'Operator Game');

        return redirect(route('operatorGames.index'));
    }
}
