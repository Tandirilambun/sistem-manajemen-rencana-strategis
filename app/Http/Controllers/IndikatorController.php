<?php

namespace App\Http\Controllers;

use App\Models\Output;
use App\Models\Outcome;
use App\Models\Periode;
use App\Models\ActivityLog;
use App\Models\RequestForm;
use App\Models\UseOfOutput;
use Illuminate\Http\Request;
use App\Models\IndikatorOutput;
use App\Models\GeneralObjective;
use App\Models\IndikatorGeneral;
use App\Models\IndikatorOutcome;
use App\Models\IndikatorUltimate;
use App\Models\UltimateObjective;
use App\Models\IndikatorUseOfOutput;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\IndikatorIntermediate;
use App\Models\IntermediateObjective;
use App\Models\CapaianIndikatorOutput;
use App\Models\CapaianIndikatorGeneral;
use App\Models\CapaianIndikatorOutcome;
use App\Models\CapaianIndikatorUltimate;
use App\Models\CapaianIndikatorUseOfOutput;
use App\Models\CapaianIndikatorIntermediate;
use App\Http\Requests\StoreCapaianIndikatorOutputRequest;
use App\Http\Requests\StoreCapaianIndikatorGeneralRequest;
use App\Http\Requests\StoreCapaianIndikatorOutcomeRequest;
use App\Http\Requests\UpdateCapaianIndikatorOutputRequest;
use App\Http\Requests\StoreCapaianIndikatorUltimateRequest;
use App\Http\Requests\UpdateCapaianIndikatorGeneralRequest;
use App\Http\Requests\UpdateCapaianIndikatorOutcomeRequest;
use App\Http\Requests\UpdateCapaianIndikatorUltimateRequest;
use App\Http\Requests\StoreCapaianIndikatorUseOfOutputRequest;
use App\Http\Requests\StoreCapaianIndikatorIntermediateRequest;
use App\Http\Requests\UpdateCapaianIndikatorUseOfOutputRequest;
use App\Http\Requests\UpdateCapaianIndikatorIntermediateRequest;

class IndikatorController extends Controller
{

    public function showCapaianGeneral(string $id, GeneralObjective $generalObjective, IndikatorGeneral $indikatorGeneral)
    {
        $parent_general = $indikatorGeneral->general_objective;
        $find_periode = GeneralObjective::find($parent_general->id_general)->id_periode;
        $parent_periode = Periode::find($find_periode)->roadmap ?? 'null';
        $capaians_general = IndikatorGeneral::find($indikatorGeneral->id_indikator_general)->capaian_general->sortBy(['id_capaian_general', 'asc']);
        $avg_capaians_general = round($capaians_general->avg('capaian_general'));
        $indikator_page = "indikator_general";
        return view('Renstra.indikator', compact('id', 'generalObjective'), [
            'indikatorGeneral' => $indikatorGeneral,
            'parent_general' => $parent_general,
            'parent_periode' => $parent_periode,
            'capaians_general' => $capaians_general,
            'avg_capaians_general' => $avg_capaians_general,
            'indikator_page' => $indikator_page
        ]);
    }

    public function showCapaianUltimate(string $id, UltimateObjective $ultimateObjective, IndikatorUltimate $indikatorUltimate)
    {
        $parent_ultimate = $indikatorUltimate->ultimate_objective;
        $parent_general = $parent_ultimate->general_objective->strategi_general ?? 'null';
        $capaians_ultimate = IndikatorUltimate::find($indikatorUltimate->id_indikator_ultimate)->capaian_ultimate->sortBy(['id_capaian_ultimate', 'asc']);
        $avg_capaians_ultimate = round($capaians_ultimate->avg('capaian_ultimate'));
        $indikator_page = "indikator_ultimate";
        return view('Renstra.indikator', compact('id', 'ultimateObjective'), [
            'indikatorUltimate' => $indikatorUltimate,
            'parent_ultimate' => $parent_ultimate,
            'parent_general' => $parent_general,
            'avg_capaians_ultimate' => $avg_capaians_ultimate,
            'capaians_ultimate' => $capaians_ultimate,
            'indikator_page' => $indikator_page,
        ]);
    }

    public function showCapaianIntermediate(string $id, IntermediateObjective $intermediateObjective, IndikatorIntermediate $indikatorIntermediate)
    {
        $parent_intermediate = $indikatorIntermediate->intermediate_objective;
        $parent_ultimate = $parent_intermediate->ultimate_objective->strategi_ultimate ?? 'null';
        $capaians_intermediate = IndikatorIntermediate::find($indikatorIntermediate->id_indikator_intermediate)->capaian_intermediate->sortBy(['id_capaian_intermediate', 'asc']);
        $avg_capaians_intermediate = round($capaians_intermediate->avg('capaian_intermediate'));
        $indikator_page = "indikator_intermediate";
        return view('Renstra.indikator', compact('id', 'intermediateObjective'), [
            'indikatorIntermediate' => $indikatorIntermediate,
            'parent_intermediate' => $parent_intermediate,
            'parent_ultimate' => $parent_ultimate,
            'capaians_intermediate' => $capaians_intermediate,
            'avg_capaians_intermediate' => $avg_capaians_intermediate,
            'indikator_page' => $indikator_page,
        ]);
    }

    public function showCapaianOutcome(string $id, Outcome $outcome, IndikatorOutcome $indikatorOutcome)
    {
        $parent_outcome = $indikatorOutcome->outcome;
        $parent_intermediate = $parent_outcome->intermediate_objective->strategi_intermediate ?? 'null';
        $capaians_outcome = IndikatorOutcome::find($indikatorOutcome->id_indikator_outcome)->capaian_outcome->sortBy(['id_capaian_outcome', 'asc']);
        $avg_capaians_outcome = round($capaians_outcome->avg('capaian_outcome'));
        $indikator_page = "indikator_outcome";
        return view('Renstra.indikator', compact('id', 'outcome'), [
            'parent_intermediate' => $parent_intermediate,
            'parent_outcome' => $parent_outcome,
            'capaians_outcome' => $capaians_outcome,
            'avg_capaians_outcome' => $avg_capaians_outcome,
            'indikatorOutcome' => $indikatorOutcome,
            'indikator_page' => $indikator_page
        ]);
    }

    public function showCapaianUseOfOutput(string $id, UseOfOutput $useOfOutput, IndikatorUseOfOutput $indikatorUseOfOutput)
    {
        $parent_use_of_output = $indikatorUseOfOutput->use_of_output;
        $parent_outcome = $parent_use_of_output->outcome->strategi_outcome ?? 'null';
        $capaians_use_of_output = IndikatorUseOfOutput::find($indikatorUseOfOutput->id_indikator_use_of_output)->capaian_use_of_output->sortBy(['id_capaian_use_of_output', 'asc']);
        $avg_capaians_use_of_output = round($capaians_use_of_output->avg('capaian_use_of_output'));
        $indikator_page = "indikator_useofoutput";
        return view('Renstra.indikator', compact('id', 'useOfOutput'), [
            'indikatorUseOfOutput' => $indikatorUseOfOutput,
            'parent_use_of_output' => $parent_use_of_output,
            'parent_outcome' => $parent_outcome,
            'capaians_use_of_output' => $capaians_use_of_output,
            'avg_capaians_use_of_output' => $avg_capaians_use_of_output,
            'indikator_page' => $indikator_page,
        ]);
    }

    public function showCapaianOutput(string $id, Output $output, IndikatorOutput $indikatorOutput)
    {
        $parent_output = $indikatorOutput->output;
        $parent = $parent_output->use_of_output->strategi_use_of_output ?? $parent_output->outcome->strategi_outcome ?? 'null';
        $capaians_output = IndikatorOutput::find($indikatorOutput->id_indikator_output)->capaian_output->sortBy(['id_capaian_output', 'asc']);
        $avg_capaians_output = round($capaians_output->avg('capaian_output'));
        $indikator_page = "indikator_output";
        return view('Renstra.indikator', compact('id', 'output'), [
            'parent_output' => $parent_output,
            'capaians_output' => $capaians_output,
            'avg_capaians_output' => $avg_capaians_output,
            'indikatorOutput' => $indikatorOutput,
            'indikator_page' => $indikator_page,
        ]);
    }

    public function addCapaianGeneral(StoreCapaianIndikatorGeneralRequest $request)
    {
        $capaian = (int)$request->hasil_capaian;
        CapaianIndikatorGeneral::create([
            'id_indikator_general' => $request->desc_indikator,
            'tahun_general' => $request->tahun_capaian,
            'keterangan_hasil_general' => $request->input_hasil,
            'capaian_general' => $capaian
        ])->save();
        ActivityLog::create([
            'details_log' => $request->tahun_capaian,
            'tipe_log' => 'insert',
            'locations_log' => 'Capaian Indikator General Objective',
            'id_user' => Auth::user()->id_user,
        ])->save();
        return redirect()->back()->with('success', 'Capaian for General Objective Indikator has been added successfully');
    }

    public function addCapaianUltimate(StoreCapaianIndikatorUltimateRequest $request)
    {
        $capaian = (int)$request->hasil_capaian;
        CapaianIndikatorUltimate::create([
            'id_indikator_ultimate' => $request->desc_indikator,
            'tahun_ultimate' => $request->tahun_capaian,
            'keterangan_hasil_ultimate' => $request->input_hasil,
            'capaian_ultimate' => $capaian
        ])->save();
        ActivityLog::create([
            'details_log' => $request->tahun_capaian,
            'tipe_log' => 'insert',
            'locations_log' => 'Capaian Indikator Ultimate Objective',
            'id_user' => Auth::user()->id_user,
        ])->save();
        return redirect()->back()->with('success', 'Capaian for Ultimate Objective Indikator has been added successfully');
    }

    public function addCapaianIntermediate(StoreCapaianIndikatorIntermediateRequest $request)
    {
        $capaian = (int)$request->hasil_capaian;
        CapaianIndikatorIntermediate::create([
            'id_indikator_intermediate' => $request->desc_indikator,
            'tahun_intermediate'  => $request->tahun_capaian,
            'keterangan_hasil_intermediate' => $request->input_hasil,
            'capaian_intermediate' => $capaian
        ])->save();
        ActivityLog::create([
            'details_log' => $request->tahun_capaian,
            'tipe_log' => 'insert',
            'locations_log' => 'Capaian Indikator Intermediate Objective',
            'id_user' => Auth::user()->id_user,
        ])->save();
        return redirect()->back()->with('success', 'Capaian for Intermediate Objective Indikator has been added successfully');
    }

    public function addCapaianOutcome(StoreCapaianIndikatorOutcomeRequest $request)
    {
        $capaian = (int)$request->hasil_capaian;
        CapaianIndikatorOutcome::create([
            'id_indikator_outcome' => $request->desc_indikator,
            'tahun_outcome'  => $request->tahun_capaian,
            'keterangan_hasil_outcome' => $request->input_hasil,
            'capaian_outcome' => $capaian
        ])->save();
        ActivityLog::create([
            'details_log' => $request->tahun_capaian,
            'tipe_log' => 'insert',
            'locations_log' => 'Capaian Indikator Outcome',
            'id_user' => Auth::user()->id_user,
        ])->save();
        return redirect()->back()->with('success', 'Capaian for Outcome Indikator has been added successfully');
    }

    public function addCapaianUseOfOutput(StoreCapaianIndikatorUseOfOutputRequest $request)
    {
        $capaian = (int)$request->hasil_capaian;
        CapaianIndikatorUseOfOutput::create([
            'id_indikator_use_of_output' => $request->desc_indikator,
            'tahun_use_of_output'  => $request->tahun_capaian,
            'keterangan_hasil_use_of_output' => $request->input_hasil,
            'capaian_use_of_output' => $capaian
        ])->save();
        ActivityLog::create([
            'details_log' => $request->tahun_capaian,
            'tipe_log' => 'insert',
            'locations_log' => 'Capaian Indikator Use Of Output',
            'id_user' => Auth::user()->id_user,
        ])->save();
        return redirect()->back()->with('success', 'Capaian for Use Of Output Indikator has been added successfully');
    }

    public function addCapaianOutput(StoreCapaianIndikatorOutputRequest $request)
    {
        $capaian = (int)$request->hasil_capaian;
        CapaianIndikatorOutput::create([
            'id_indikator_output' => $request->desc_indikator,
            'tahun_output' => $request->tahun_capaian,
            'keterangan_hasil_output' => $request->input_hasil,
            'capaian_output' => $capaian
        ])->save();
        ActivityLog::create([
            'details_log' => $request->tahun_capaian,
            'tipe_log' => 'insert',
            'locations_log' => 'Capaian Indikator Output',
            'id_user' => Auth::user()->id_user,
        ])->save();
        return redirect()->back()->with('success', 'Capaian for Output Indikator has been added successfully');
    }

    //delete method
    public function delCapaianGeneral(CapaianIndikatorGeneral $capaianIndikatorGeneral, Request $request)
    {
        if (!Gate::allows('staff')) {
            CapaianIndikatorGeneral::destroy($capaianIndikatorGeneral->id_capaian_general);
            ActivityLog::create([
                'details_log' => $capaianIndikatorGeneral->tahun_general,
                'tipe_log' => 'delete',
                'locations_log' => 'Capaian Indikator General Objective',
                'id_user' => Auth::user()->id_user,
            ])->save();
            return redirect()->back()->with('success', 'Capaian for General Objective Indikator has been deleted successfully');
        } else if (Gate::allows('staff')) {
            RequestForm::create([
                'id_user' => Auth::user()->id_user,
                'request_type' => 'delete',
                'request_item' => "{$request->desc_indikator} pada tahun {$capaianIndikatorGeneral->tahun_general}",
                'message' => $request->message_capaian_general,
                'request_status' => 'pending',
                'req_loc' => 'Capaian Indikator General Objective',
            ]);
            return redirect()->back()->with('success', 'Request has been sent');
        }
    }

    public function delCapaianUltimate(CapaianIndikatorUltimate $capaianIndikatorUltimate, Request $request)
    {
        if (!Gate::allows('staff')) {
            CapaianIndikatorUltimate::destroy($capaianIndikatorUltimate->id_capaian_ultimate);
            ActivityLog::create([
                'details_log' => $capaianIndikatorUltimate->tahun_ultimate,
                'tipe_log' => 'delete',
                'locations_log' => 'Capaian Indikator Ultimate Objective',
                'id_user' => Auth::user()->id_user,
            ])->save();
            return redirect()->back()->with('success', 'Capaian for Ultimate Objective Indikator has been deleted successfully');
        } else if (Gate::allows('staff')) {
            RequestForm::create([
                'id_user' => Auth::user()->id_user,
                'request_type' => 'delete',
                'request_item' => "{$request->desc_indikator} pada tahun {$capaianIndikatorUltimate->tahun_ultimate}",
                'message' => $request->message_capaian_ultimate,
                'request_status' => 'pending',
                'req_loc' => 'Capaian Indikator Ultimate Objective',
            ]);
            return redirect()->back()->with('success', 'Request has been sent');
        }
    }

    public function delCapaianIntermediate(CapaianIndikatorIntermediate $capaianIndikatorIntermediate, Request $request)
    {
        if (!Gate::allows('staff')) {
            CapaianIndikatorIntermediate::destroy($capaianIndikatorIntermediate->id_capaian_intermediate);
            ActivityLog::create([
                'details_log' => $capaianIndikatorIntermediate->tahun_intermediate,
                'tipe_log' => 'delete',
                'locations_log' => 'Capaian Indikator Intermediate Objective',
                'id_user' => Auth::user()->id_user,
            ])->save();
            return redirect()->back()->with('success', 'Capaian for Intermediate Objective Indikator has been deleted successfully');
        } else if (Gate::allows('staff')) {
            RequestForm::create([
                'id_user' => Auth::user()->id_user,
                'request_type' => 'delete',
                'request_item' => "{$request->desc_indikator} pada tahun {$capaianIndikatorIntermediate->tahun_intermediate}",
                'message' => $request->message_capaian_intermediate,
                'request_status' => 'pending',
                'req_loc' => 'Capaian Indikator Intermediate Objective',
            ]);
            return redirect()->back()->with('success', 'Request has been sent');
        }
    }

    public function delCapaianOutcome(CapaianIndikatorOutcome $capaianIndikatorOutcome, Request $request)
    {
        if (!Gate::allows('staff')) {
            CapaianIndikatorOutcome::destroy($capaianIndikatorOutcome->id_capaian_outcome);
            ActivityLog::create([
                'details_log' => $capaianIndikatorOutcome->tahun_outcome,
                'tipe_log' => 'delete',
                'locations_log' => 'Capaian Indikator Outcome',
                'id_user' => Auth::user()->id_user,
            ])->save();
            return redirect()->back()->with('success', 'Capaian for Outcome Indikator has been deleted successfully');
        } else if (Gate::allows('staff')) {
            RequestForm::create([
                'id_user' => Auth::user()->id_user,
                'request_type' => 'delete',
                'request_item' => "{$request->desc_indikator} pada tahun {$capaianIndikatorOutcome->tahun_outcome}",
                'message' => $request->message_capaian_outcome,
                'request_status' => 'pending',
                'req_loc' => 'Capaian Indikator Outcome',
            ]);
            return redirect()->back()->with('success', 'Request has been sent');
        }
    }

    public function delCapaianUseOfOutput(CapaianIndikatorUseOfOutput $capaianIndikatorUseOfOutput, Request $request)
    {
        if (!Gate::allows('staff')) {
            CapaianIndikatorUseOfOutput::destroy($capaianIndikatorUseOfOutput->id_capaian_use_of_output);
            ActivityLog::create([
                'details_log' => $capaianIndikatorUseOfOutput->tahun_use_of_output,
                'tipe_log' => 'delete',
                'locations_log' => 'Capaian Indikator Use of Output',
                'id_user' => Auth::user()->id_user,
            ])->save();
            return redirect()->back()->with('success', 'Capaian for Use Of Output Indikator has been deleted successfully');
        } else if (Gate::allows('staff')) {
            RequestForm::create([
                'id_user' => Auth::user()->id_user,
                'request_type' => 'delete',
                'request_item' => "{$request->desc_indikator} pada tahun {$capaianIndikatorUseOfOutput->tahun_use_of_output}",
                'message' => $request->message_capaian_use_of_output,
                'request_status' => 'pending',
                'req_loc' => 'Capaian Indikator Use Of Output',
            ]);
            return redirect()->back()->with('success', 'Request has been sent');   
        }
    }

    public function delCapaianOutput(CapaianIndikatorOutput $capaianIndikatorOutput, Request $request)
    {
        if (!Gate::allows('staff')) {
            CapaianIndikatorOutput::destroy($capaianIndikatorOutput->id_capaian_output);
            ActivityLog::create([
                'details_log' => $capaianIndikatorOutput->tahun_output,
                'tipe_log' => 'delete',
                'locations_log' => 'Capaian Indikator Output',
                'id_user' => Auth::user()->id_user,
            ])->save();
            return redirect()->back()->with('success', 'Capaian for Output Indikator has been deleted successfully');
        } else if (Gate::allows('staff')) {
            RequestForm::create([
                'id_user' => Auth::user()->id_user,
                'request_type' => 'delete',
                'request_item' => "{$request->desc_indikator} pada tahun {$capaianIndikatorOutput->tahun_output}",
                'message' => $request->message_capaian_output,
                'request_status' => 'pending',
                'req_loc' => 'Capaian Indikator Output',
            ]);
            return redirect()->back()->with('success', 'Request has been sent');
        }
    }

    //update Method
    public function updateCapaianGeneral(UpdateCapaianIndikatorGeneralRequest $request, CapaianIndikatorGeneral $capaianIndikatorGeneral)
    {
        if (!Gate::allows('staff')) {
            $capaian = (int)$request->hasil_capaian;
            CapaianIndikatorGeneral::where('id_capaian_general', $capaianIndikatorGeneral->id_capaian_general)->update([
                'tahun_general' => $request->tahun_capaian,
                'keterangan_hasil_general' => $request->input_hasil,
                'capaian_general' => $capaian
            ]);
            ActivityLog::create([
                'tipe_log' => 'update',
                'details_log' => $capaianIndikatorGeneral->tahun_general,
                'after_change' => $request->input_hasil,
                'locations_log' => 'Indikator General Objective',
                'id_user' => Auth::user()->id_user,
            ])->save();
            return redirect()->back()->with('success', 'Capaian for General Objective Indikator has been updated successfully');
        } else if (Gate::allows('staff')) {
            RequestForm::create([
                'id_user' => Auth::user()->id_user,
                'request_type' => 'update',
                'request_item' => "{$request->desc_indikator} pada tahun {$capaianIndikatorGeneral->tahun_general}",
                'message' => $request->message_capaian_general,
                'request_status' => 'pending',
                'req_loc' => 'Capaian Indikator General Objective',
            ]);
            return redirect()->back()->with('success', 'Request has been sent');
        }
    }
    public function updateCapaianUltimate(UpdateCapaianIndikatorUltimateRequest $request, CapaianIndikatorUltimate $capaianIndikatorUltimate)
    {
        if (!Gate::allows('staff')) {
            $capaian = (int)$request->hasil_capaian;
            CapaianIndikatorUltimate::where('id_capaian_ultimate', $capaianIndikatorUltimate->id_capaian_ultimate)->update([
                'tahun_ultimate' => $request->tahun_capaian,
                'keterangan_hasil_ultimate' => $request->input_hasil,
                'capaian_ultimate' => $capaian
            ]);
            ActivityLog::create([
                'tipe_log' => 'update',
                'details_log' => $capaianIndikatorUltimate->tahun_ultimate,
                'after_change' => $request->input_hasil,
                'locations_log' => 'Indikator Ultimate Objective',
                'id_user' => Auth::user()->id_user,
            ])->save();
            return redirect()->back()->with('success', 'Capaian for Ultimate Objective Indikator has been updated successfully');
        } else if (Gate::allows('staff')) {
            RequestForm::create([
                'id_user' => Auth::user()->id_user,
                'request_type' => 'update',
                'request_item' => "{$request->desc_indikator} pada tahun {$capaianIndikatorUltimate->tahun_ultimate}",
                'message' => $request->message_capaian_ultimate,
                'request_status' => 'pending',
                'req_loc' => 'Capaian Indikator Ultimate Objective',
            ]);
            return redirect()->back()->with('success', 'Request has been sent');
        }
    }
    public function updateCapaianIntermediate(UpdateCapaianIndikatorIntermediateRequest $request, CapaianIndikatorIntermediate $capaianIndikatorIntermediate)
    {
        if (!Gate::allows('staff')) {
            $capaian = (int)$request->hasil_capaian;
            CapaianIndikatorIntermediate::where('id_capaian_intermediate', $capaianIndikatorIntermediate->id_capaian_intermediate)->update([
                'tahun_intermediate'  => $request->tahun_capaian,
                'keterangan_hasil_intermediate' => $request->input_hasil,
                'capaian_intermediate' => $capaian
            ]);
            ActivityLog::create([
                'tipe_log' => 'update',
                'details_log' => $capaianIndikatorIntermediate->tahun_intermediate,
                'after_change' => $request->input_hasil,
                'locations_log' => 'Indikator Intermediate Objective',
                'id_user' => Auth::user()->id_user,
            ])->save();
            return redirect()->back()->with('success', 'Capaian for Intermediate Objective Indikator has been updated successfully');
        } else if (Gate::allows('staff')) {
            RequestForm::create([
                'id_user' => Auth::user()->id_user,
                'request_type' => 'update',
                'request_item' => "{$request->desc_indikator} pada tahun {$capaianIndikatorIntermediate->tahun_intermediate}",
                'message' => $request->message_capaian_intermediate,
                'request_status' => 'pending',
                'req_loc' => 'Capaian Indikator Intermediate Objective',
            ]);
            return redirect()->back()->with('success', 'Request has been sent');
        }
    }
    public function updateCapaianOutcome(UpdateCapaianIndikatorOutcomeRequest $request, CapaianIndikatorOutcome $capaianIndikatorOutcome)
    {
        if (!Gate::allows('staff')) {
            $capaian = (int)$request->hasil_capaian;
            CapaianIndikatorOutcome::where('id_capaian_outcome', $capaianIndikatorOutcome->id_capaian_outcome)->update([
                'tahun_outcome'  => $request->tahun_capaian,
                'keterangan_hasil_outcome' => $request->input_hasil,
                'capaian_outcome' => $capaian
            ]);
            ActivityLog::create([
                'tipe_log' => 'update',
                'details_log' => $capaianIndikatorOutcome->tahun_outcome,
                'after_change' => $request->input_hasil,
                'locations_log' => 'Indikator Outcome',
                'id_user' => Auth::user()->id_user,
            ])->save();
            return redirect()->back()->with('success', 'Capaian for Outcome Indikator has been updated successfully');
        } else if (Gate::allows('staff')) {
            RequestForm::create([
                'id_user' => Auth::user()->id_user,
                'request_type' => 'update',
                'request_item' => "{$request->desc_indikator} pada tahun {$capaianIndikatorOutcome->tahun_outcome}",
                'message' => $request->message_capaian_outcome,
                'request_status' => 'pending',
                'req_loc' => 'Capaian Indikator Outcome',
            ]);
            return redirect()->back()->with('success', 'Request has been sent');
        }
    }
    public function updateCapaianUseOfOutput(UpdateCapaianIndikatorUseOfOutputRequest $request, CapaianIndikatorUseOfOutput $capaianIndikatorUseOfOutput)
    {
        if (!Gate::allows('staff')) {
            $capaian = (int)$request->hasil_capaian;
            CapaianIndikatorUseOfOutput::where('id_capaian_use_of_output', $capaianIndikatorUseOfOutput->id_capaian_use_of_output)->update([
                'tahun_use_of_output'  => $request->tahun_capaian,
                'keterangan_hasil_use_of_output' => $request->input_hasil,
                'capaian_use_of_output' => $capaian
            ]);
            ActivityLog::create([
                'tipe_log' => 'update',
                'details_log' => $capaianIndikatorUseOfOutput->tahun_use_of_output,
                'after_change' => $request->input_hasil,
                'locations_log' => 'Indikator Use Of Output',
                'id_user' => Auth::user()->id_user,
            ])->save();
            return redirect()->back()->with('success', 'Capaian for Use Of Output Indikator has been updated successfully');
        } else if (Gate::allows('staff')) {
            RequestForm::create([
                'id_user' => Auth::user()->id_user,
                'request_type' => 'update',
                'request_item' => "{$request->desc_indikator} pada tahun {$capaianIndikatorUseOfOutput->tahun_use_of_output}",
                'message' => $request->message_capaian_use_of_output,
                'request_status' => 'pending',
                'req_loc' => 'Capaian Indikator Use Of Output',
            ]);
            return redirect()->back()->with('success', 'Request has been sent');
        }
    }
    public function updateCapaianOutput(UpdateCapaianIndikatorOutputRequest $request, CapaianIndikatorOutput $capaianIndikatorOutput)
    {
        if (!Gate::allows('staff')) {
            $capaian = (int)$request->hasil_capaian;
            CapaianIndikatorOutput::where('id_capaian_output', $capaianIndikatorOutput->id_capaian_output)->update([
                'tahun_output' => $request->tahun_capaian,
                'keterangan_hasil_output' => $request->input_hasil,
                'capaian_output' => $capaian
            ]);
            ActivityLog::create([
                'tipe_log' => 'update',
                'details_log' => $capaianIndikatorOutput->tahun_output,
                'after_change' => $request->input_hasil,
                'locations_log' => 'Indikator Output',
                'id_user' => Auth::user()->id_user,
            ])->save();
            return redirect()->back()->with('success', 'Capaian for Output Indikator has been updated successfully');
        } else if (Gate::allows('staff')) {
            RequestForm::create([
                'id_user' => Auth::user()->id_user,
                'request_type' => 'update',
                'request_item' => "{$request->desc_indikator} pada tahun {$capaianIndikatorOutput->tahun_output}",
                'message' => $request->message_capaian_output,
                'request_status' => 'pending',
                'req_loc' => 'Capaian Indikator Output',
            ]);
            return redirect()->back()->with('success', 'Request has been sent');
        }
    }
}
