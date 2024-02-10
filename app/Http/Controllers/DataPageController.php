<?php

namespace App\Http\Controllers;


use App\Models\Output;
use App\Models\Outcome;
use App\Models\Periode;
use App\Models\ActivityLog;
use App\Models\UseOfOutput;
use Illuminate\Http\Request;
use App\Models\IndikatorOutput;
use App\Models\GeneralObjective;
use App\Models\IndikatorGeneral;
use App\Models\IndikatorOutcome;
use App\Models\IndikatorUltimate;
use App\Models\UltimateObjective;
use App\Http\Controllers\Controller;
use App\Models\IndikatorUseOfOutput;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\IndikatorIntermediate;
use App\Models\IntermediateObjective;
use App\Http\Requests\UpdateOutputRequest;
use App\Http\Requests\UpdateOutcomeRequest;
use App\Http\Requests\UpdateUseOfOutputRequest;
use App\Http\Requests\UpdateIndikatorOutputRequest;
use App\Http\Requests\UpdateGeneralObjectiveRequest;
use App\Http\Requests\UpdateIndikatorGeneralRequest;
use App\Http\Requests\UpdateIndikatorOutcomeRequest;
use App\Http\Requests\UpdateIndikatorUltimateRequest;
use App\Http\Requests\UpdateUltimateObjectiveRequest;
use App\Http\Requests\UpdateIndikatorUseOfOutputRequest;
use App\Http\Requests\UpdateIndikatorIntermediateRequest;
use App\Http\Requests\UpdateIntermediateObjectiveRequest;
use App\Models\RequestForm;

class DataPageController extends Controller
{
    public function index()
    {
        $periodes = Periode::all();
        $generals = GeneralObjective::all();
        $ultimates = UltimateObjective::all();
        $intermediates = IntermediateObjective::all();
        $outcomes = Outcome::all();
        $use_of_outputs = UseOfOutput::all();
        $outputs = Output::all();
        $general_strategi_query = GeneralObjective::with('periode') -> search(request('search')) ->get();
        $ultimate_strategi_query = UltimateObjective::with('periode')-> search(request('search')) ->get();
        $intermediate_strategi_query = IntermediateObjective::with('periode')-> search(request('search')) ->get();
        $outcome_strategi_query = Outcome::with('periode')-> search(request('search'))->get();
        $use_of_output_strategi_query = UseOfOutput::with('periode')-> search(request('search'))->get();
        $output_strategi_query = Output::with('periode')-> search(request('search'))->get();
        $general_indikator_query = IndikatorGeneral::with('general_objective')-> search(request('search')) ->orderBy('id_indikator_general', 'asc')->get();
        $ultimate_indikator_query = IndikatorUltimate::with('ultimate_objective')-> search(request('search'))->orderBy('id_indikator_ultimate', 'asc')->get();
        $intermediate_indikator_query = IndikatorIntermediate::with('intermediate_objective')-> search(request('search'))->orderBy('id_indikator_intermediate', 'asc')->get();
        $outcome_indikator_query = IndikatorOutcome::with('outcome')-> search(request('search'))->orderBy('id_indikator_outcome', 'asc')->get();
        $use_of_output_indikator_query = IndikatorUseOfOutput::with('use_of_output')-> search(request('search'))->orderBy('id_indikator_use_of_output', 'asc')->get();
        $output_indikator_query = IndikatorOutput::with('output')-> search(request('search'))->orderBy('id_indikator_output', 'asc')->get();
        return view('Renstra.data-page', [
            'periodes' => $periodes,
            'generals' => $generals,
            'ultimates' => $ultimates,
            'intermediates' => $intermediates,
            'outcomes' => $outcomes,
            'use_of_outputs' => $use_of_outputs,
            'outputs' => $outputs,
            'general_strategi_query' => $general_strategi_query,
            'ultimate_strategi_query' => $ultimate_strategi_query,
            'intermediate_strategi_query' => $intermediate_strategi_query,
            'outcome_strategi_query' => $outcome_strategi_query,
            'use_of_output_strategi_query' => $use_of_output_strategi_query,
            'output_strategi_query' => $output_strategi_query,
            'general_indikator_query' => $general_indikator_query,
            'ultimate_indikator_query' => $ultimate_indikator_query,
            'intermediate_indikator_query' => $intermediate_indikator_query,
            'outcome_indikator_query' => $outcome_indikator_query,
            'use_of_output_indikator_query' => $use_of_output_indikator_query,
            'output_indikator_query' => $output_indikator_query,
            'old_search' => request('search')
        ]);
    }

    //delete strategi method
    public function delGeneral(GeneralObjective $generalObjective)
    {
        if (!Gate::allows('staff')) {
            GeneralObjective::destroy($generalObjective->id_general);
            ActivityLog::create([
                'details_log' => $generalObjective->strategi_general,
                'tipe_log' => 'delete',
                'locations_log' => 'General Objective',
                'id_user' => Auth::user()->id_user,
            ])->save();
            return redirect()->back()->with('request_status', 'Strategi for General Objective has been Deleted successfully');
        } else if (Gate::allows('staff')) {
            RequestForm::create([
                'id_user' => Auth::user()->id_user,
                'request_type' => 'delete',
                'request_item' => $generalObjective->strategi_general,
                'message' => 'Please delete this item',
                'request_status' => 'pending',
                'req_loc' => 'Strategi General Objective',
            ]);
            return redirect()->back()->with('request_status', 'Request has been sent');
        }
    }

    public function delUltimate(UltimateObjective $ultimateObjective)
    {
        if (!Gate::allows('staff')) {
            UltimateObjective::destroy($ultimateObjective->id_ultimate);
            ActivityLog::create([
                'details_log' => $ultimateObjective->strategi_ultimate,
                'tipe_log' => 'delete',
                'locations_log' => 'Ultimate Objective',
                'id_user' => Auth::user()->id_user,
            ])->save();
            return redirect()->back()->with('request_status', 'Strategi for Ultimate Objective has been Deleted successfully');
        } else if (Gate::allows('staff')) {
            RequestForm::create([
                'id_user' => Auth::user()->id_user,
                'request_type' => 'delete',
                'request_item' => $ultimateObjective->strategi_ultimate,
                'message' => 'Please delete this item',
                'request_status' => 'pending',
                'req_loc' => 'Strategi Ultimate Objective',
            ]);
            return redirect()->back()->with('request_status', 'Request has been sent');
        }
    }

    public function delIntermediate(IntermediateObjective $intermediateObjective)
    {
        if (!Gate::allows('staff')) {
            IntermediateObjective::destroy($intermediateObjective->id_intermediate);
            ActivityLog::create([
                'details_log' => $intermediateObjective->strategi_intermediate,
                'tipe_log' => 'delete',
                'locations_log' => 'Intermediate Objective',
                'id_user' => Auth::user()->id_user,
            ])->save();
            return redirect()->back()->with('request_status', 'Strategi for Intermediate Objective has been Deleted successfully');
        } else if (Gate::allows('staff')) {
            RequestForm::create([
                'id_user' => Auth::user()->id_user,
                'request_type' => 'delete',
                'request_item' => $intermediateObjective->strategi_intermediate,
                'message' => 'Please delete this item',
                'request_status' => 'pending',
                'req_loc' => 'Strategi Intermediate Objective',
            ]);
            return redirect()->back()->with('request_status', 'Request has been sent');
        }
    }

    public function delOutcome(Outcome $outcome)
    {
        if (!Gate::allows('staff')) {
            Outcome::destroy($outcome->id_outcome);
            ActivityLog::create([
                'details_log' => $outcome->strategi_outcome,
                'tipe_log' => 'delete',
                'locations_log' => 'Outcome',
                'id_user' => Auth::user()->id_user,
            ])->save();
            return redirect()->back()->with('request_status', 'Strategi for Outcome has been Deleted successfully');
        } else if (Gate::allows('staff')) {
            RequestForm::create([
                'id_user' => Auth::user()->id_user,
                'request_type' => 'delete',
                'request_item' => $outcome->strategi_outcome,
                'message' => 'Please delete this item',
                'request_status' => 'pending',
                'req_loc' => 'Strategi Outcome',
            ]);
            return redirect()->back()->with('request_status', 'Request has been sent');
        }
    }

    public function delUseofoutput(UseOfOutput $useOfOutput)
    {
        if (!Gate::allows('staff')) {
            UseOfOutput::destroy($useOfOutput->id_use_of_output);
            ActivityLog::create([
                'details_log' => $useOfOutput->strategi_use_of_output,
                'tipe_log' => 'delete',
                'locations_log' => 'Use of Output',
                'id_user' => Auth::user()->id_user,
            ])->save();
            return redirect()->back()->with('request_status', 'Strategi for Use of Output has been deleted successfully');
        } else if (Gate::allows('staff')) {
            RequestForm::create([
                'id_user' => Auth::user()->id_user,
                'request_type' => 'delete',
                'request_item' => $useOfOutput->strategi_use_of_output,
                'message' => 'Please delete this item',
                'request_status' => 'pending',
                'req_loc' => 'Strategi Use Of Output',
            ]);
            return redirect()->back()->with('request_status', 'Request has been sent');
        }
    }

    public function delOutput(Output $output)
    {
        if (!Gate::allows('staff')) {
            Output::destroy($output->id_output);
            ActivityLog::create([
                'details_log' => $output->strategi_output,
                'tipe_log' => 'delete',
                'locations_log' =>  'Output',
                'id_user' => Auth::user()->id_user,
            ])->save();
            return redirect()->back()->with('request_status', 'Strategi for Output has been deleted successfully');
        } else if (Gate::allows('staff')) {
            RequestForm::create([
                'id_user' => Auth::user()->id_user,
                'request_type' => 'delete',
                'request_item' => $output->strategi_output,
                'message' => 'Please delete this item',
                'request_status' => 'pending',
                'req_loc' => 'Strategi Output',
            ]);
            return redirect()->back()->with('request_status', 'Request has been sent');
        }
    }

    //update strategi methods
    public function updateGeneral(UpdateGeneralObjectiveRequest $request, GeneralObjective $generalObjective)
    {
        if (!Gate::allows('staff')) {
            GeneralObjective::where('id_general', $generalObjective->id_general)
                ->update([
                    'id_periode' => $request->selectPeriode,
                    'strategi_general' => $request->input_general
                ]);
            ActivityLog::create([
                'tipe_log' => 'update',
                'details_log' => $generalObjective->strategi_general,
                'after_change' => $request->input_general,
                'locations_log' => 'Strategi General Objective',
                'id_user' => Auth::user()->id_user,
            ])->save();
            return redirect()->back()->with('request_status', 'Strategi for General Objective has been Updated successfully');
        } else if (Gate::allows('staff')) {
            RequestForm::create([
                'id_user' => Auth::user()->id_user,
                'request_type' => 'update',
                'request_item' => $generalObjective->strategi_general,
                'message' => $request->message_general,
                'request_status' => 'pending',
                'req_loc' => 'Strategi General Objective',
            ]);
            return redirect()->back()->with('request_status', 'Request has been sent');
        }
    }

    public function updateUltimate(UpdateUltimateObjectiveRequest $request, UltimateObjective $ultimateObjective)
    {
        if (!Gate::allows('staff')) {
            UltimateObjective::where('id_ultimate', $ultimateObjective->id_ultimate)
                ->update([
                    'id_periode' => $request->selectPeriode,
                    'id_general' => $request->selectGeneral,
                    'strategi_ultimate' => $request->input_ultimate
                ]);
            ActivityLog::create([
                'tipe_log' => 'update',
                'details_log' => $ultimateObjective->strategi_ultimate,
                'after_change' => $request->input_ultimate,
                'locations_log' => 'Strategi Ultimate Objective',
                'id_user' => Auth::user()->id_user,
            ])->save();
            return redirect()->back()->with('request_status', 'Strategi for Ultimate Objective has been Updated successfully');
        } else if (Gate::allows('staff')) {
            RequestForm::create([
                'id_user' => Auth::user()->id_user,
                'request_type' => 'update',
                'request_item' => $ultimateObjective->strategi_ultimate,
                'message' => $request->message_ultimate,
                'request_status' => 'pending',
                'req_loc' => 'Strategi Ultimate Objective',
            ]);
            return redirect()->back()->with('request_status', 'Request has been sent');
        }
    }

    public function updateIntermediate(UpdateIntermediateObjectiveRequest $request, IntermediateObjective $intermediateObjective)
    {
        if (!Gate::allows('staff')) {
            IntermediateObjective::where('id_intermediate', $intermediateObjective->id_intermediate)
                ->update([
                    'id_periode' => $request->selectPeriode,
                    'id_ultimate' => $request->selectUltimate,
                    'strategi_intermediate' => $request->input_intermediate
                ]);
            ActivityLog::create([
                'tipe_log' => 'update',
                'details_log' => $intermediateObjective->strategi_intermediate,
                'after_change' => $request->input_intermediate,
                'locations_log' => 'Strategi Intermediate Objective',
                'id_user' => Auth::user()->id_user,
            ])->save();
            return redirect()->back()->with('request_status', 'Strategi for Intermediate Objective has been Updated successfully');
        } else if (Gate::allows('staff')) {
            RequestForm::create([
                'id_user' => Auth::user()->id_user,
                'request_type' => 'update',
                'request_item' => $intermediateObjective->strategi_intermediate,
                'message' => $request->message_intermediate,
                'request_status' => 'pending',
                'req_loc' => 'Strategi Intermediate Objective',
            ]);
            return redirect()->back()->with('request_status', 'Request has been sent');
        }
    }

    public function updateOutcome(UpdateOutcomeRequest $request, Outcome $outcome)
    {
        if (!Gate::allows('staff')) {
            Outcome::where('id_outcome', $outcome->id_outcome)
                ->update([
                    'id_periode' => $request->selectPeriode,
                    'id_intermediate' => $request->selectIntermediate,
                    'strategi_outcome' => $request->input_outcome
                ]);
            ActivityLog::create([
                'tipe_log' => 'update',
                'details_log' => $outcome->strategi_outcome,
                'after_change' => $request->input_outcome,
                'locations_log' => 'Strategi Outcome',
                'id_user' => Auth::user()->id_user,
            ])->save();
            return redirect()->back()->with('request_status', 'Strategi for Outcome has been Updated successfully');
        } else if (Gate::allows('staff')) {
            RequestForm::create([
                'id_user' => Auth::user()->id_user,
                'request_type' => 'update',
                'request_item' => $outcome->strategi_outcome,
                'message' => $request->message_outcome,
                'request_status' => 'pending',
                'req_loc' => 'Strategi Outcome',
            ]);
            return redirect()->back()->with('request_status', 'Request has been sent');
        }
    }

    public function updateUseofoutput(UpdateUseOfOutputRequest $request, UseOfOutput $useOfOutput)
    {
        if (!Gate::allows('staff')) {
            UseOfOutput::where('id_use_of_output', $useOfOutput->id_use_of_output)
                ->update([
                    'id_periode' => $request->selectPeriode,
                    'id_outcome' => $request->selectOutcome,
                    'strategi_use_of_output' => $request->input_useofoutput
                ]);
            ActivityLog::create([
                'tipe_log' => 'update',
                'details_log' => $useOfOutput->strategi_use_of_output,
                'after_change' => $request->input_useofoutput,
                'locations_log' => 'Strategi Use of Output',
                'id_user' => Auth::user()->id_user,
            ])->save();
            return redirect()->back()->with('request_status', 'Strategi for Use of Output has been Updated successfully');
        } else if (Gate::allows('staff')) {
            RequestForm::create([
                'id_user' => Auth::user()->id_user,
                'request_type' => 'update',
                'request_item' => $useOfOutput->strategi_use_of_output,
                'message' => $request->message_useofoutput,
                'request_status' => 'pending',
                'req_loc' => 'Strategi Use of Output',
            ]);
            return redirect()->back()->with('request_status', 'Request has been sent');
        }
    }

    public function updateOutput(UpdateOutputRequest $request, Output $output)
    {
        if (!Gate::allows('staff')) {
            Output::where('id_output', $output->id_output)
                ->update([
                    'id_periode' => $request->selectPeriode,
                    'id_outcome' => $request->selectOutcome,
                    'id_use_of_output' => $request->selectUseofoutput,
                    'strategi_output' => $request->input_output
                ]);
            ActivityLog::create([
                'tipe_log' => 'update',
                'details_log' => $output->strategi_output,
                'after_change' => $request->input_output,
                'locations_log' => 'Strategi Output',
                'id_user' => Auth::user()->id_user,
            ])->save();
            return redirect()->back()->with('request_status', 'Strategi for Use of Output has been Updated successfully');
        } else if (Gate::allows('staff')) {
            RequestForm::create([
                'id_user' => Auth::user()->id_user,
                'request_type' => 'update',
                'request_item' => $output->strategi_output,
                'message' => $request->message_output,
                'request_status' => 'pending',
                'req_loc' => 'Strategi Output',
            ]);
            return redirect()->back()->with('request_status', 'Request has been sent');
        }
    }


    //delete indikator method
    public function delIndGeneral(IndikatorGeneral $indikatorGeneral)
    {
        if (!Gate::allows('staff')) {
            IndikatorGeneral::destroy($indikatorGeneral->id_indikator_general);
            ActivityLog::create([
                'details_log' => $indikatorGeneral->deskripsi_indikator_general,
                'tipe_log' => 'delete',
                'locations_log' => 'Indikator General Objective',
                'id_user' => Auth::user()->id_user,
            ])->save();
            return redirect()->back()->with('request_status', 'Indikator for General Objective has been deleted successfully');
        } else if (Gate::allows('staff')) {
            RequestForm::create([
                'id_user' => Auth::user()->id_user,
                'request_type' => 'delete',
                'request_item' => $indikatorGeneral->deskripsi_indikator_general,
                'message' => 'Please delete this item',
                'request_status' => 'pending',
                'req_loc' => 'Indikator General Objective',
            ]);
            return redirect()->back()->with('request_status', 'Request has been sent');
        }
    }

    public function delIndUltimate(IndikatorUltimate $indikatorUltimate)
    {
        if (!Gate::allows('staff')) {
            IndikatorUltimate::destroy($indikatorUltimate->id_indikator_ultimate);
            ActivityLog::create([
                'details_log' => $indikatorUltimate->deskripsi_indikator_ultimate,
                'tipe_log' => 'delete',
                'locations_log' => 'Indikator Ultimate Objective',
                'id_user' => Auth::user()->id_user,
            ])->save();
            return redirect()->back()->with('request_status', 'Indikator for Ultimate Objective has been deleted successfully');
        } else if (Gate::allows('staff')) {
            RequestForm::create([
                'id_user' => Auth::user()->id_user,
                'request_type' => 'delete',
                'request_item' => $indikatorUltimate->deskripsi_indikator_ultimate,
                'message' => 'Please delete this item',
                'request_status' => 'pending',
                'req_loc' => 'Indikator Ultimate Objective',
            ]);
            return redirect()->back()->with('request_status', 'Request has been sent');
        }
    }

    public function delIndIntermediate(IndikatorIntermediate $indikatorIntermediate)
    {
        if (!Gate::allows('staff')) {
            IndikatorIntermediate::destroy($indikatorIntermediate->id_indikator_intermediate);
            ActivityLog::create([
                'details_log' => $indikatorIntermediate->deskripsi_indikator_Intermediate,
                'tipe_log' => 'delete',
                'locations_log' => 'Indikator Intermediate Objective',
                'id_user' => Auth::user()->id_user,
            ])->save();
            return redirect()->back()->with('request_status', 'Indikator for Intermediate Objective has been deleted successfully');
        } else if (Gate::allows('staff')) {
            RequestForm::create([
                'id_user' => Auth::user()->id_user,
                'request_type' => 'delete',
                'request_item' => $indikatorIntermediate->deskripsi_indikator_intermediate,
                'message' => 'Please delete this item',
                'request_status' => 'pending',
                'req_loc' => 'Indikator Intermediate Objective',
            ]);
            return redirect()->back()->with('request_status', 'Request has been sent');
        }
    }

    public function delIndOutcome(IndikatorOutcome $indikatorOutcome)
    {
        if (!Gate::allows('staff')) {
            IndikatorOutcome::destroy($indikatorOutcome->id_indikator_outcome);
            ActivityLog::create([
                'details_log' => $indikatorOutcome->deskripsi_indikator_outcome,
                'tipe_log' => 'delete',
                'locations_log' => 'Indikator Outcome',
                'id_user' => Auth::user()->id_user,
            ])->save();
            return redirect()->back()->with('request_status', 'Indikator for Outcome has been deleted successfully');
        } else if (Gate::allows('staff')) {
            RequestForm::create([
                'id_user' => Auth::user()->id_user,
                'request_type' => 'delete',
                'request_item' => $indikatorOutcome->deskripsi_indikator_outcome,
                'message' => 'Please delete this item',
                'request_status' => 'pending',
                'req_loc' => 'Indikator Outcome',
            ]);
            return redirect()->back()->with('request_status', 'Request has been sent');
        }
    }

    public function delIndUseOfOutput(IndikatorUseOfOutput $indikatorUseOfOutput)
    {
        if (!Gate::allows('staff')) {
            IndikatorUseOfOutput::destroy($indikatorUseOfOutput->id_indikator_use_of_output);
            ActivityLog::create([
                'details_log' => $indikatorUseOfOutput->deskripsi_indikator_use_of_output,
                'tipe_log' => 'delete',
                'locations_log' => 'Indikator Use Of Output',
                'id_user' => Auth::user()->id_user,
            ])->save();
            return redirect()->back()->with('request_status', 'Indikator for Use Of Output has been deleted successfully');
        } else if (Gate::allows('staff')) {
            RequestForm::create([
                'id_user' => Auth::user()->id_user,
                'request_type' => 'delete',
                'request_item' => $indikatorUseOfOutput->deskripsi_indikator_use_of_output,
                'message' => 'Please delete this item',
                'request_status' => 'pending',
                'req_loc' => 'Indikator Use Of Output',
            ]);
            return redirect()->back()->with('request_status', 'Request has been sent');
        }
    }

    public function delIndOutput(IndikatorOutput $indikatorOutput)
    {
        if (!Gate::allows('staff')) {
            IndikatorOutput::destroy($indikatorOutput->id_indikator_output);
            ActivityLog::create([
                'details_log' => $indikatorOutput->deskripsi_indikator_output,
                'tipe_log' => 'delete',
                'locations_log' => 'Indikator Output',
                'id_user' => Auth::user()->id_user,
            ])->save();
            return redirect()->back()->with('request_status', 'Indikator for Output has been deleted successfully');
        } else if (Gate::allows('staff')) {
            RequestForm::create([
                'id_user' => Auth::user()->id_user,
                'request_type' => 'delete',
                'request_item' => $indikatorOutput->deskripsi_indikator_output,
                'message' => 'Please delete this item',
                'request_status' => 'pending',
                'req_loc' => 'Indikator Output',
            ]);
            return redirect()->back()->with('request_status', 'Request has been sent');
        }
    }

    //update indikator method
    public function updateIndGeneral(UpdateIndikatorGeneralRequest $request, IndikatorGeneral $indikatorGeneral)
    {
        if (!Gate::allows('staff')) {
            IndikatorGeneral::where('id_indikator_general', $indikatorGeneral->id_indikator_general)->update([
                'id_general' => $request->selectGeneral,
                'deskripsi_indikator_general' => $request->input_indikator_general
            ]);
            ActivityLog::create([
                'tipe_log' => 'update',
                'details_log' => $indikatorGeneral->deskripsi_indikator_general,
                'after_change' => $request->input_indikator_general,
                'locations_log' => 'Indikator General Objective',
                'id_user' => Auth::user()->id_user,
            ])->save();
            return redirect()->back()->with('request_status', 'Indikator for General Objective has been updated successfully');
        } else if (Gate::allows('staff')) {
            RequestForm::create([
                'id_user' => Auth::user()->id_user,
                'request_type' => 'update',
                'request_item' => $indikatorGeneral->deskripsi_indikator_general,
                'message' => $request->message_indikator_general,
                'request_status' => 'pending',
                'req_loc' => 'Indikator General Objective',
            ]);
            return redirect()->back()->with('request_status', 'Request has been sent');
        }
    }

    public function updateIndUltimate(UpdateIndikatorUltimateRequest $request, IndikatorUltimate $indikatorUltimate)
    {
        if (!Gate::allows('staff')) {
            IndikatorUltimate::where('id_indikator_ultimate', $indikatorUltimate->id_indikator_ultimate)->update([
                'id_ultimate' => $request->selectUltimate,
                'deskripsi_indikator_ultimate' => $request->input_indikator_ultimate
            ]);
            ActivityLog::create([
                'tipe_log' => 'update',
                'details_log' => $indikatorUltimate->deskripsi_indikator_ultimate,
                'after_change' => $request->input_indikator_ultimate,
                'locations_log' => 'Indikator Ultimate Objective',
                'id_user' => Auth::user()->id_user,
            ])->save();
            return redirect()->back()->with('request_status', 'Indikator for Ultimate Objective has been updated successfully');
        } else if (Gate::allows('staff')) {
            RequestForm::create([
                'id_user' => Auth::user()->id_user,
                'request_type' => 'update',
                'request_item' => $indikatorUltimate->deskripsi_indikator_ultimate,
                'message' => $request->message_indikator_ultimate,
                'request_status' => 'pending',
                'req_loc' => 'Indikator Ultimate Objective',
            ]);
            return redirect()->back()->with('request_status', 'Request has been sent');
        }
    }

    public function updateIndIntermediate(UpdateIndikatorIntermediateRequest $request, IndikatorIntermediate $indikatorIntermediate)
    {
        if (!Gate::allows('staff')) {
            IndikatorIntermediate::where('id_indikator_intermediate', $indikatorIntermediate->id_indikator_intermediate)->update([
                'id_intermediate' => $request->selectIntermediate,
                'deskripsi_indikator_intermediate' => $request->input_indikator_intermediate
            ]);
            ActivityLog::create([
                'tipe_log' => 'update',
                'details_log' => $indikatorIntermediate->deskripsi_indikator_intermediate,
                'after_change' => $request->input_indikator_intermediate,
                'locations_log' => 'Indikator Intermediate Objective',
                'id_user' => Auth::user()->id_user,
            ])->save();
            return redirect()->back()->with('request_status', 'Indikator for Intermediate Objective has been updated successfully');
        } else if (Gate::allows('staff')) {
            RequestForm::create([
                'id_user' => Auth::user()->id_user,
                'request_type' => 'update',
                'request_item' => $indikatorIntermediate->deskripsi_indikator_intermediate,
                'message' => $request->message_indikator_intermediate,
                'request_status' => 'pending',
                'req_loc' => 'Indikator Intermediate Objective',
            ]);
            return redirect()->back()->with('request_status', 'Request has been sent');
        }
    }

    public function updateIndOutcome(UpdateIndikatorOutcomeRequest $request, IndikatorOutcome $indikatorOutcome)
    {
        if (!Gate::allows('staff')) {
            IndikatorOutcome::where('id_indikator_outcome', $indikatorOutcome->id_indikator_outcome)->update([
                'id_outcome' => $request->selectOutcome,
                'deskripsi_indikator_outcome' => $request->input_indikator_outcome
            ]);
            ActivityLog::create([
                'tipe_log' => 'update',
                'details_log' => $indikatorOutcome->deskripsi_indikator_outcome,
                'after_change' => $request->input_indikator_outcome,
                'locations_log' => 'Indikator Outcome',
                'id_user' => Auth::user()->id_user,
            ])->save();
            return redirect()->back()->with('request_status', 'Indikator for Outcome has been updated successfully');
        } else if (Gate::allows('staff')) {
            RequestForm::create([
                'id_user' => Auth::user()->id_user,
                'request_type' => 'update',
                'request_item' => $indikatorOutcome->deskripsi_indikator_outcome,
                'message' => $request->message_indikator_outcome,
                'request_status' => 'pending',
                'req_loc' => 'Indikator Outcome',
            ]);
            return redirect()->back()->with('request_status', 'Request has been sent');
        }
    }

    public function updateIndUseOfOutput(UpdateIndikatorUseOfOutputRequest $request, IndikatorUseOfOutput $indikatorUseOfOutput)
    {
        if (!Gate::allows('staff')) {
            IndikatorUseOfOutput::where('id_indikator_use_of_output', $indikatorUseOfOutput->id_indikator_use_of_output)->update([
                'id_use_of_output' => $request->selectUseofoutput,
                'deskripsi_indikator_use_of_output' => $request->input_indikator_useofoutput
            ]);
            ActivityLog::create([
                'tipe_log' => 'update',
                'details_log' => $indikatorUseOfOutput->deskripsi_indikator_use_of_output,
                'after_change' => $request->input_indikator_useofoutput,
                'locations_log' => 'Indikator Use Of Output',
                'id_user' => Auth::user()->id_user,
            ])->save();
            return redirect()->back()->with('request_status', 'Indikator for Use Of Output has been updated successfully');
        } else if (Gate::allows('staff')) {
            RequestForm::create([
                'id_user' => Auth::user()->id_user,
                'request_type' => 'update',
                'request_item' => $indikatorUseOfOutput->deskripsi_indikator_use_of_output,
                'message' => $request->message_indikator_useofoutput,
                'request_status' => 'pending',
                'req_loc' => 'Indikator Use Of Output',
            ]);
            return redirect()->back()->with('request_status', 'Request has been sent');
        }
    }

    public function updateIndOutput(UpdateIndikatorOutputRequest $request, IndikatorOutput $indikatorOutput)
    {
        if (!Gate::allows('staff')) {
            IndikatorOutput::where('id_indikator_output', $indikatorOutput->id_indikator_output)->update([
                'id_output' => $request->selectoutput,
                'deskripsi_indikator_output' => $request->input_indikator_output
            ]);
            ActivityLog::create([
                'tipe_log' => 'update',
                'details_log' => $indikatorOutput->deskripsi_indikator_output,
                'after_change' => $request->input_indikator_output,
                'locations_log' => 'Indikator Output',
                'id_user' => Auth::user()->id_user,
            ])->save();
            return redirect()->back()->with('request_status', 'Indikator for Output has been updated successfully');
        } else if (Gate::allows('staff')) {
            RequestForm::create([
                'id_user' => Auth::user()->id_user,
                'request_type' => 'update',
                'request_item' => $indikatorOutput->deskripsi_indikator_output,
                'message' => $request->message_indikator_output,
                'request_status' => 'pending',
                'req_loc' => 'Indikator Output',
            ]);
            return redirect()->back()->with('request_status', 'Request has been sent');
        }
    }
}
