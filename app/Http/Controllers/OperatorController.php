<?php

namespace App\Http\Controllers;

use Response;
use App\Http\Requests;
use App\Models\Operator;
use Laracasts\Flash\Flash;
use App\Models\GamesPlayed;

use App\Models\OperatorGame;
use App\Models\MonitoringLog;
use Illuminate\Support\Facades\Auth;
use App\DataTables\OperatorDataTable;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use App\Repositories\OperatorRepository;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateOperatorRequest;
use App\Http\Requests\UpdateOperatorRequest;
use App\DataTables\OperatorMonitoringDataTable;

class OperatorController extends AppBaseController
{
    /** @var  OperatorRepository */
    private $operatorRepository;

    public function __construct(OperatorRepository $operatorRepo)
    {
        $this->operatorRepository = $operatorRepo;
    }

    /**
     * Display a listing of the Operator.
     *
     * @param OperatorDataTable $operatorDataTable
     * @return Response
     */
    public function index(OperatorDataTable $operatorDataTable)
    {
        return $operatorDataTable->render('operators.index');
    }

    public function domainMonitoring(OperatorMonitoringDataTable $operatorMonitoringDataTable)
    {
        Artisan::call('monitor:domain');
        return $operatorMonitoringDataTable->render('operators.monitor');
    }



    public function dashboard()
    {

        $operator = Operator::where('user_id', '=', Auth::user()->id)->first();
        $operator_games_count = OperatorGame::where('operator_id', '=', $operator->id)->count();
        $games_played_count = GamesPlayed::where('operator_id', '=', $operator->id)->count();
        $games_played = GamesPlayed::where('operator_id', '=', $operator->id)->select('amount')->get();
        $total_amount_generated = 0;
        foreach ($games_played as $game) {
            $total_amount_generated += $game->amount;
        }
        $tax_generated = $total_amount_generated * 0.075;
        return view('operators.dashboard', compact('operator', 'operator_games_count', 'tax_generated', 'games_played_count', 'total_amount_generated'));
    }

    /**
     * Show the form for creating a new Operator.
     *
     * @return Response
     */
    public function create()
    {
        return view('operators.create');
    }

    /**
     * Store a newly created Operator in storage.
     *
     * @param CreateOperatorRequest $request
     *
     * @return Response
     */
    public function store(CreateOperatorRequest $request)
    {
        $input = $request->all();

        $operator = $this->operatorRepository->create($this->saveProfilePicture($input));
        $operator = $this->operatorRepository->create($this->saveDocuments($input));

        Flash::success('Operator saved successfully.');
        create_activity('create', 'Operator');

        return redirect(route('operators.index'));
    }

    /**
     * Display the specified Operator.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $operator = $this->operatorRepository->find($id);

        if (empty($operator)) {
            Flash::error('Operator not found');

            return redirect(route('operators.index'));
        }

        return view('operators.show')->with('operator', $operator);
    }

    /**
     * Show the form for editing the specified Operator.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $operator = $this->operatorRepository->find($id);

        if (empty($operator)) {
            Flash::error('Operator not found');

            return redirect(route('operators.index'));
        }

        return view('operators.edit')->with('operator', $operator);
    }

    /**
     * Update the specified Operator in storage.
     *
     * @param  int              $id
     * @param UpdateOperatorRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOperatorRequest $request)
    {
        $operator = $this->operatorRepository->find($id);

        if (empty($operator)) {
            Flash::error('Operator not found');

            return redirect(route('operators.index'));
        }

        $operator = $this->operatorRepository->update($this->saveProfilePicture($request->all()), $id);
        $operator = $this->operatorRepository->update($this->saveDocuments($request->all()), $id);

        Flash::success('Operator updated successfully.');
        create_activity('update', 'Operator');

        return redirect(route('operators.index'));
    }

    /**
     * Remove the specified Operator from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $operator = $this->operatorRepository->find($id);

        if (empty($operator)) {
            Flash::error('Operator not found');

            return redirect(route('operators.index'));
        }

        $logo = str_replace('storage/', 'public/', $operator->logo);
        Storage::delete($logo);

        $documents = str_replace('storage/', 'public/', $operator->documents);
        Storage::delete($documents);

        $this->operatorRepository->delete($id);

        Flash::success('Operator deleted successfully.');
        create_activity('delete', 'Operator');

        return redirect(route('operators.index'));
    }

    public function saveProfilePicture($input)
    {
        if (isset($input['logo'])) {
            $file = $input['logo'];
            $applicant_name = $input['name'];

            $logo = $this->operatorUpload($file, $applicant_name, 'logo');
            $input['logo'] = $logo;
            return $input;
        }
        return $input;
    }

    public function saveDocuments($input)
    {
        $documents_array = [];
        if (isset($input['documents'])) {
            $documents = $input['documents'];
            $applicant_name = $input['name'];

            foreach ($documents as $doc) {
                $documents_array[] = $this->operatorUpload($doc, $applicant_name, 'document_' . now()->timestamp);
            }
            $input['documents'] = $documents_array;
            return $input;
        }
        return $input;
    }
}
