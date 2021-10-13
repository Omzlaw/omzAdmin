<?php

namespace App\Http\Controllers;

use Response;
use App\Models\User;
use App\Http\Requests;
use App\Models\Operator;
use App\Models\Applicant;

use App\Traits\FileUpload;
use Laracasts\Flash\Flash;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\DataTables\ApplicantDataTable;
use Illuminate\Support\Facades\Storage;
use App\Repositories\OperatorRepository;
use App\Repositories\ApplicantRepository;
use App\Notifications\GeneralNotification;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateApplicantRequest;
use App\Http\Requests\UpdateApplicantRequest;
use App\Repositories\OperatorDirectorRepository;
use App\Http\Requests\CreateOperatorDirectorRequest;
use App\Http\Requests\UpdateOperatorDirectorRequest;

class ApplicantController extends AppBaseController
{
    /** @var  ApplicantRepository */
    private $applicantRepository;
    private $userRepository;
    private $operatorRepository;
    private $operatorDirectorRepository;
    use FileUpload;

    public function __construct(ApplicantRepository $applicantRepo, UserRepository $userRepo, OperatorRepository $operatorRepo, OperatorDirectorRepository $operatorDirectorRepo)
    {
        $this->applicantRepository = $applicantRepo;
        $this->userRepository = $userRepo;
        $this->operatorRepo = $operatorRepo;
        $this->operatorDirectorRepository = $operatorDirectorRepo;
    }

    /**
     * Display a listing of the Applicant.
     *
     * @param ApplicantDataTable $applicantDataTable
     * @return Response
     */
    public function index(ApplicantDataTable $applicantDataTable)
    {
        return $applicantDataTable->render('applicants.index');
    }

    public function dashboard()
    {
        $applicant = Applicant::where('user_id', '=', Auth::user()->id)->first();
        return view('applicants.dashboard', compact('applicant'));
    }

    public function applicationEdit($id)
    {
        $applicant = $this->applicantRepository->find($id);

        if (empty($applicant)) {
            Flash::error('Applicant not found');

            return back();
        }

        return view('applicants.application_edit')->with('applicant', $applicant);
    }


    /**
     * Show the form for creating a new Applicant.
     *
     * @return Response
     */
    public function create()
    {
        return view('applicants.create');
    }

    public function apply()
    {
        return view('applicants.application');
    }

    public function applicationStore(CreateApplicantRequest $request)
    {
        $input = $request->all();
        $user_data = [];

        $input['accept_terms'] = 1;
        $input['application_status'] = 1;
        $applicant = $this->applicantRepository->create($input);


        $user_data['name'] = $input['name'];
        $user_data['email'] = $input['email'];
        $user_data['password'] = Hash::make($input['password']);

        $user = $this->userRepository->create($user_data);
        $applicant->user_id = $user->id;
        $applicant->save();
        $user->attachRole('applicant');
        Auth::login($user);

        $notification = "Your application has been saved and is pending approval";
        $user->notify(new GeneralNotification($notification));

        Flash::success('Application saved successfully.');
        create_activity('new', 'Application');

        return redirect(route('applicants.dashboard'));
    }

    /**
     * Store a newly created Applicant in storage.
     *
     * @param CreateApplicantRequest $request
     *
     * @return Response
     */


    public function applicationDirectorStore(CreateOperatorDirectorRequest $request)
    {

        $input = $request->all();

        $applicants_directors = $this->operatorDirectorRepository->create($input);

        $applicant_id = $input['applicant_id'];


        Flash::success('Director saved successfully.');
        create_activity('create', 'Operator Director');

        return redirect(route('application.edit', $applicant_id));
    }


    public function store(CreateApplicantRequest $request)
    {

        $input = $request->all();

        $applicant = $this->applicantRepository->create($this->saveProfilePicture($input));
        $applicant = $this->applicantRepository->create($this->saveDocuments($input));


        Flash::success('Applicant saved successfully.');
        create_activity('create', 'Applicant');

        return redirect(route('applicants.index'));
    }

    /**
     * Display the specified Applicant.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $applicant = $this->applicantRepository->find($id);

        if (empty($applicant)) {
            Flash::error('Applicant not found');

            return redirect(route('applicants.index'));
        }

        return view('applicants.show')->with('applicant', $applicant);
    }

    public function applicationShow($id)
    {
        $applicant = $this->applicantRepository->find($id);

        if (empty($applicant)) {
            Flash::error('Application not found');

            return redirect(route('applicants.dashboard'));
        }

        return view('applicants.application_details')->with('applicant', $applicant);
    }


    /**
     * Show the form for editing the specified Applicant.
     *
     * @param  int $id
     *
     * @return Response
     */


    public function applicationDirectorEdit($id, $applicant_id)
    {
        $operatorDirector = $this->operatorDirectorRepository->find($id);

        if (empty($operatorDirector)) {
            Flash::error('Operator Director not found');

            return redirect(route('application.edit', $applicant_id));
        }

        return view('applicants.application_director_edit', compact('applicant_id'))->with('operatorDirector', $operatorDirector);
    }

    public function edit($id)
    {
        $applicant = $this->applicantRepository->find($id);

        if (empty($applicant)) {
            Flash::error('Applicant not found');

            return redirect(route('applicants.index'));
        }

        return view('applicants.edit')->with('applicant', $applicant);
    }

    /**
     * Update the specified Applicant in storage.
     *
     * @param  int              $id
     * @param UpdateApplicantRequest $request
     *
     * @return Response
     */

    public function applicationDirectorUpdate($id, $applicant_id, UpdateOperatorDirectorRequest $request)
    {
        $operatorDirector = $this->operatorDirectorRepository->find($id);

        if (empty($operatorDirector)) {
            Flash::error('Operator Director not found');
            return redirect(route('application.edit', $applicant_id));
        }

        $operatorDirector = $this->operatorDirectorRepository->update($request->all(), $id);

        Flash::success('Operator Director updated successfully.');
        create_activity('update', 'Operator Director');

        return redirect(route('application.edit', $applicant_id));
    }


    public function update($id, UpdateApplicantRequest $request)
    {
        $applicant = $this->applicantRepository->find($id);

        if (empty($applicant)) {
            Flash::error('Applicant not found');

            return redirect(route('applicants.index'));
        }

        if ($applicant->final_submission != 1) {
            if ($request->application_status == 2) {
                Flash::error('Applicant has not completed his form');
                return redirect(route('applicants.index'));
            }
        }

        $applicant = $this->applicantRepository->update($this->saveProfilePicture($request->all()), $id);
        $applicant = $this->applicantRepository->update($this->saveDocuments($request->all()), $id);

        $user = User::find($applicant->user_id);
        if ($applicant->application_status == 2) {
            $operator = Operator::find($applicant->operator_id);
            if ($operator == null) {
                $operator = Operator::create($applicant->toArray());
                if (!$user->hasRole('operator')) {
                    $user->detachRole('applicant');
                    $user->attachRole('operator');
                    $user->save();
                    $notification = "Your application has been approved";
                    $user->notify(new GeneralNotification($notification));
                    $operator->save();
                    foreach ($applicant->directors as $director) {
                        $director['operator_id'] = $operator->id;
                        $director->save();
                    }
                }
            } else {
                if (!$user->hasRole('operator')) {
                    $user->detachRole('applicant');
                    $user->attachRole('operator');
                    $user->save();
                    $notification = "Your application has been approved";
                    $user->notify(new GeneralNotification($notification));
                    foreach ($applicant->directors as $director) {
                        $director['operator_id'] = $operator->id;
                        $director->save();
                    }
                }
            }
        } else {
            $operator = Operator::find($applicant->operator_id);
            if ($operator != null) {
                $operator['application_status'] = $applicant->application_status;
                $operator->save();
            }
            if ($user->hasRole('operator')) {
                $applicant['final_submission'] = 0;
                $applicant->save();
                $user->attachRole('applicant');
                $user->detachRole('operator');
                $user->save();
                $notification = "Your application has been disapproved. " . $applicant->prev_application_details;
                $user->notify(new GeneralNotification($notification));
                foreach ($applicant->directors as $director) {
                    $director['operator_id'] = null;
                    $director->save();
                }
            } else if ($user->hasRole('applicant')) {
                $applicant['final_submission'] = 0;
                $applicant->save();
                $notification = "Your application has been disapproved. " . $applicant->prev_application_details;;
                $user->notify(new GeneralNotification($notification));
            }
        }

        if (Auth::user()->hasRole('applicant')) {
            Flash::success('Application saved successfully.');
            create_activity('create', 'Applicant');
            return redirect(route('applicants.dashboard'));
        }


        Flash::success('Applicant updated successfully.');
        create_activity('update', 'Applicant');

        return redirect(route('applicants.index'));
    }

    public function finalSubmission($id)
    {

        $applicant = $this->applicantRepository->find($id);

        if (empty($applicant)) {
            Flash::error('Application not found');
            return redirect(route('applicants.dashboard'));
        }

        $applicant_directors_count = $applicant->directors()->count();
        if ($applicant_directors_count < 1) {
            Flash::error('Please add at least one director.');
            return redirect(route('applicants.dashboard'));
        }

        $applicant['final_submission'] = 1;
        $applicant->save();

        $user = User::find(1);
        $notification = 'Applicant ' . $applicant->name . ', has submitted his/her application';
        $user->notify(new GeneralNotification($notification));

        Flash::success('Your application has been submitted successfully.');
        return redirect(route('applicants.dashboard'));
    }
    /**
     * Remove the specified Applicant from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $applicant = $this->applicantRepository->find($id);

        if (empty($applicant)) {
            Flash::error('Applicant not found');

            return redirect(route('applicants.index'));
        }

        $logo = str_replace('storage/', 'public/', $applicant->logo);
        Storage::delete($logo);

        $documents = str_replace('storage/', 'public/', $applicant->documents);
        Storage::delete($documents);

        $this->applicantRepository->delete($id);

        Flash::success('Applicant deleted successfully.');
        create_activity('delete', 'Applicant');

        return redirect(route('applicants.index'));
    }



    public function applicationDirectorDestroy($id, $applicant_id)
    {
        $operatorDirector = $this->operatorDirectorRepository->find($id);

        if (empty($operatorDirector)) {
            Flash::error('Operator Director not found');
            return redirect(route('application.edit', $applicant_id));
        }

        $this->operatorDirectorRepository->delete($id);

        Flash::success('Operator Director deleted successfully.');
        create_activity('delete', 'Operator Director');

        return redirect(route('application.edit', $applicant_id));
    }


    public function saveProfilePicture($input)
    {
        if (isset($input['logo'])) {
            $file = $input['logo'];
            $applicant_name = $input['name'];

            $logo = $this->applicantUpload($file, $applicant_name, 'logo');
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
                $documents_array[] = $this->applicantUpload($doc, $applicant_name, 'document_' . now()->timestamp);
            }
            $input['documents'] = $documents_array;
            return $input;
        }
        return $input;
    }
}
