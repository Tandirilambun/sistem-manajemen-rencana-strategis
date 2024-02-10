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
use Illuminate\Support\Facades\DB;
use App\Models\IndikatorUseOfOutput;
use Illuminate\Support\Facades\Auth;
use App\Models\IndikatorIntermediate;
use App\Models\IntermediateObjective;
use App\Http\Requests\StoreOutputRequest;
use App\Http\Requests\StoreOutcomeRequest;
use App\Http\Requests\StorePeriodeRequest;
use App\Http\Requests\StoreUseOfOutputRequest;
use App\Http\Requests\UpdateRequestFormRequest;
use App\Http\Requests\StoreIndikatorOutputRequest;
use App\Http\Requests\StoreGeneralObjectiveRequest;
use App\Http\Requests\StoreIndikatorGeneralRequest;
use App\Http\Requests\StoreIndikatorOutcomeRequest;
use App\Http\Requests\StoreIndikatorUltimateRequest;
use App\Http\Requests\StoreUltimateObjectiveRequest;
use App\Http\Requests\StoreIndikatorUseOfOutputRequest;
use App\Http\Requests\StoreIndikatorIntermediateRequest;
use App\Http\Requests\StoreIntermediateObjectiveRequest;

class HomeController extends Controller
{

    public function index()
    {
        $periodes = Periode::all();
        return view('home', [
            'periodes' => $periodes,
        ]);
    }

    public function create()
    {
        $periodes = Periode::all();
        $generals = GeneralObjective::all();
        $ultimates = UltimateObjective::all();
        $intermediates = IntermediateObjective::all();
        $outcomes = Outcome::all();
        $use_of_outputs = UseOfOutput::all();
        $outputs = Output::all();
        return view('Renstra.create', [
            'generals' => $generals,
            'ultimates' => $ultimates,
            'intermediates' => $intermediates,
            'outcomes' => $outcomes,
            'use_of_outputs' => $use_of_outputs,
            'outputs' => $outputs,
            'periodes' => $periodes,
        ]);
    }

    public function addPeriode(StorePeriodeRequest $request)
    {
        $validate = $request->validate([
            'inputRoadmap' => 'required',
            'tahunAwal' => 'required|numeric|digits:4',
            'tahunAkhir' => 'required|numeric|digits:4',
            'flag_keterangan' => 'required|numeric',
        ]);
        Periode::create([
            'roadmap' => $validate['inputRoadmap'],
            'tahun_awal' => $validate['tahunAwal'],
            'tahun_akhir' => $validate['tahunAkhir'],
            'flag_column_keterangan' => $validate['flag_keterangan']
        ])->save();
        ActivityLog::create([
            'tipe_log' => 'insert',
            'details_log' => $request->inputRoadmap,
            'locations_log' => 'Periode Renstra',
            'id_user' => Auth::user()->id_user,
        ])->save();
        return redirect() -> back()->with('success', 'Periode has been stored successfully');
    }

    public function addGeneral(StoreGeneralObjectiveRequest $request)
    {
        GeneralObjective::create([
            'id_periode' => $request->selectPeriode,
            'strategi_general' => $request->input_general
        ])->save();
        ActivityLog::create([
            'tipe_log' => 'insert',
            'details_log' => $request->input_general,
            'locations_log' => 'General Objective',
            'id_user' => Auth::user()->id_user,
        ])->save();
        return redirect() -> back()->with('success', 'General Objective has been stored successfully');
    }

    public function addUltimate(StoreUltimateObjectiveRequest $request)
    {
        UltimateObjective::create([
            'id_general' => $request->selectGeneral,
            'id_periode' => $request->selectPeriode,
            'strategi_ultimate' => $request->input_ultimate,
        ])->save();
        ActivityLog::create([
            'tipe_log' => 'insert',
            'details_log' => $request->input_ultimate,
            'locations_log' => 'Ultimate Objective',
            'id_user' => Auth::user()->id_user,
        ])->save();
        return redirect() -> back()->with('success', 'Ultimate Objective has been stored successfully');
    }

    public function addIntermediate(StoreIntermediateObjectiveRequest $request)
    {
        IntermediateObjective::create([
            'id_ultimate' => $request->selectUltimate,
            'id_periode' => $request->selectPeriode,
            'strategi_intermediate' => $request->input_intermediate,
        ])->save();
        ActivityLog::create([
            'tipe_log' => 'insert',
            'details_log' => $request->input_intermediate,
            'locations_log' => 'Intermediate Objective',
            'id_user' => Auth::user()->id_user,
        ])->save();
        return redirect() -> back()->with('success', 'Intermediate Objective has been stored successfully');
    }

    public function addOutcome(StoreOutcomeRequest $request)
    {
        Outcome::create([
            'id_intermediate' => $request->selectIntermediate,
            'id_periode' => $request->selectPeriode,
            'strategi_outcome' => $request->input_outcome,
        ])->save();
        ActivityLog::create([
            'tipe_log' => 'insert',
            'details_log' => $request->input_outcome,
            'locations_log' => 'Outcome',
            'id_user' => Auth::user()->id_user,
        ])->save();
        return redirect() -> back()->with('success', 'Outcome has been stored successfully');
    }

    public function addUseOfOutput(StoreUseOfOutputRequest $request)
    {
        UseOfOutput::create([
            'id_outcome' => $request->selectOutcome,
            'id_periode' => $request->selectPeriode,
            'strategi_use_of_output' => $request->input_useofoutput,
        ])->save();
        ActivityLog::create([
            'tipe_log' => 'insert',
            'details_log' => $request->input_useOfoutput,
            'locations_log' => 'Use of Output',
            'id_user' => Auth::user()->id_user,
        ])->save();
        return redirect() -> back()->with('success', 'Use of Output has been stored successfully');
    }

    public function addOutput(StoreOutputRequest $request)
    {
        Output::create([
            'id_use_of_output' => $request->selectUseofoutput,
            'id_outcome' => $request->selectOutcome,
            'id_periode' => $request->selectPeriode,
            'strategi_output' => $request->input_output,
        ])->save();
        ActivityLog::create([
            'tipe_log' => 'insert',
            'details_log' => $request->input_output,
            'locations_log' => 'Output',
            'id_user' => Auth::user()->id_user,
        ])->save();
        return redirect() -> back()->with('success', 'Output has been stored successfully');
    }

    public function addIndGeneral(StoreIndikatorGeneralRequest $request)
    {
        IndikatorGeneral::create([
            'id_general' => $request->selectGeneral,
            'deskripsi_indikator_general' => $request->input_indikator_general
        ])->save();
        ActivityLog::create([
            'tipe_log' => 'insert',
            'details_log' => $request->input_indikator_general,
            'locations_log' => 'Indikator General Objective',
            'id_user' => Auth::user()->id_user
        ])->save();
        return redirect() -> back()->with('success', 'Indikator for General Objective has been stored successfully');
    }

    public function addIndUltimate(StoreIndikatorUltimateRequest $request)
    {
        IndikatorUltimate::create([
            'id_ultimate' => $request->selectUltimate,
            'deskripsi_indikator_ultimate' => $request->input_indikator_ultimate
        ])->save();
        ActivityLog::create([
            'tipe_log' => 'insert',
            'details_log' => $request->input_indikator_ultimate,
            'locations_log' => 'Indikator Ultimate Objective',
            'id_user' => Auth::user()->id_user,
        ])->save();
        return redirect() -> back()->with('success', 'Indikator for Ultimate Objective been stored successfully');
    }

    public function addIndIntermediate(StoreIndikatorIntermediateRequest $request)
    {
        IndikatorIntermediate::create([
            'id_intermediate' => $request->selectIntermediate,
            'deskripsi_indikator_intermediate' => $request->input_indikator_intermediate
        ])->save();
        ActivityLog::create([
            'tipe_log' => 'insert',
            'details_log' => $request->input_indikator_intermediate,
            'locations_log' => 'Indikator Intermediate Objective',
            'id_user' => Auth::user()->id_user,
        ])->save();
        return redirect() -> back()->with('success', 'Indikator for Intermediate Objective has been stored successfully');
    }

    public function addIndOutcome(StoreIndikatorOutcomeRequest $request)
    {
        IndikatorOutcome::create([
            'id_outcome' => $request->selectOutcome,
            'deskripsi_indikator_outcome' => $request->input_indikator_outcome
        ])->save();
        ActivityLog::create([
            'tipe_log' => 'insert',
            'details_log' => $request->input_indikator_outcome,
            'locations_log' => 'Indikator Outcome',
            'id_user' => Auth::user()->id_user,
        ])->save();
        return redirect() -> back()->with('success', 'Indikator for Output has been stored successfully');
    }

    public function addIndUseOfOutput(StoreIndikatorUseOfOutputRequest $request)
    {
        IndikatorUseOfOutput::create([
            'id_use_of_output' => $request->selectUseofoutput,
            'deskripsi_indikator_use_of_output' => $request->input_indikator_useofoutput
        ])->save();
        ActivityLog::create([
            'tipe_log' => 'insert',
            'details_log' => $request->input_indikator_useofoutput,
            'locations_log' => 'Indikator Use of Output',
            'id_user' => Auth::user()->id_user,
        ])->save();
        return redirect() -> back()->with('success', 'Indikator for Use Of Output has been stored successfully');
    }

    public function addIndOutput(StoreIndikatorOutputRequest $request)
    {
        IndikatorOutput::create([
            'id_output' => $request->selectOutput,
            'deskripsi_indikator_output' => $request->input_indikator_output
        ])->save();
        ActivityLog::create([
            'tipe_log' => 'insert',
            'details_log' => $request->input_indikator_output,
            'locations_log' => 'Indikator Output',
            'id_user' => Auth::user()->id_user,
        ])->save();
        return redirect() -> back()->with('success', 'Indikator for Output has been stored successfully');
    }

    public function requestForm(UpdateRequestFormRequest $request, RequestForm $requestForm)
    {
        if($request -> btn_acc == 'accepted'){
            RequestForm::where('id_request', $requestForm->id_request)
                ->update([
                    'request_status' => $request->btn_acc,
                    'id_reviewer' => Auth::user()->id_user,
                ]);
        }else if($request -> btn_acc == 'rejected'){
            RequestForm::where('id_request', $requestForm->id_request)
            ->update([
                'request_status' => $request->btn_acc,
                'id_reviewer' => Auth::user()->id_user,
                'reason_reject' => $request -> reject_reason
            ]);
        }
        return redirect()->back()->with('success', 'Request Status has been Changed');
    }

    public function getGeneral($periodeId){
        $gen = GeneralObjective::where('id_periode','=',$periodeId) -> pluck('strategi_general', 'id_general');
        return response() -> json($gen);
    }
    public function getUltimate($periodeId){
        $gen = UltimateObjective::where('id_periode','=',$periodeId) -> pluck('strategi_ultimate', 'id_ultimate');
        return response() -> json($gen);
    }
    public function getIntermediate($periodeId){
        $gen = IntermediateObjective::where('id_periode','=',$periodeId) -> pluck('strategi_intermediate', 'id_intermediate');
        return response() -> json($gen);
    }
    public function getOutcome($periodeId){
        $gen = Outcome::where('id_periode','=',$periodeId) -> pluck('strategi_outcome', 'id_outcome');
        return response() -> json($gen);
    }
    public function getUseOfOutput($periodeId){
        $gen = UseOfOutput::where('id_periode','=',$periodeId) -> pluck('strategi_use_of_output', 'id_use_of_output');
        return response() -> json($gen);
    }
    public function getOutput($periodeId){
        $gen = Output::where('id_periode','=',$periodeId) -> pluck('strategi_output', 'id_output');
        return response() -> json($gen);
    }
}
