<?php

namespace App\Http\Controllers;

use App\Models\Output;
use App\Models\Outcome;
use App\Models\Periode;
use App\Models\ActivityLog;
use App\Models\UseOfOutput;
use App\Models\IndikatorOutput;
use App\Models\GeneralObjective;
use App\Models\IndikatorGeneral;
use App\Models\IndikatorOutcome;
use App\Models\IndikatorUltimate;
use App\Models\UltimateObjective;
use App\Models\IndikatorUseOfOutput;
use Illuminate\Support\Facades\Auth;
use App\Models\IndikatorIntermediate;
use App\Models\IntermediateObjective;
use App\Http\Requests\StoreOutputRequest;
use App\Http\Requests\StoreOutcomeRequest;
use App\Http\Requests\StorePeriodeRequest;
use App\Http\Requests\StoreUseOfOutputRequest;
use App\Http\Requests\StoreIndikatorOutputRequest;
use App\Http\Requests\StoreGeneralObjectiveRequest;
use App\Http\Requests\StoreIndikatorGeneralRequest;
use App\Http\Requests\StoreIndikatorOutcomeRequest;
use App\Http\Requests\StoreIndikatorUltimateRequest;
use App\Http\Requests\StoreUltimateObjectiveRequest;
use App\Http\Requests\StoreIndikatorUseOfOutputRequest;
use App\Http\Requests\StoreIndikatorIntermediateRequest;
use App\Http\Requests\StoreIntermediateObjectiveRequest;

class InputFormController extends Controller
{
    public $array_step = array(
        'step-1', 'step-2', 'step-3', 'step-4', 'step-5', 'step-6', 'step-7',
        'step-8', 'step-9', 'step-10', 'step-11', 'step-12', 'step-13'
    );
    public function periode_get()
    {
        if (!in_array('step-1', $this->array_step)) {
            array_splice($this->array_step, 0, 0, 'step-1');
        }
        return view('Renstra.form-input.input-periode', [
            'array_step' => $this->array_step,
            'periode_last' => Periode::all()->last(),
        ]);
    }
    public function addPeriode(StorePeriodeRequest $request)
    {
        $validate = $request->validate([
            'inputRoadmap' => 'required',
            'tahunAwal' => 'required|numeric|digits:4',
            'flag_keterangan' => 'required|numeric',
        ]);
        Periode::create([
            'roadmap' => $validate['inputRoadmap'],
            'tahun_awal' => $validate['tahunAwal'],
            'tahun_akhir' => $validate['tahunAwal'] + 4,
            'flag_column_keterangan' => $validate['flag_keterangan']
        ])->save();
        ActivityLog::create([
            'tipe_log' => 'insert',
            'details_log' => $request->inputRoadmap,
            'locations_log' => 'Periode Renstra',
            'id_user' => Auth::user()->id_user,
        ])->save();
        return redirect()->route('step-2')->with('success', 'Periode has been stored successfully');
    }
    public function general_get()
    {
        if (!in_array('step-2', $this->array_step)) {
            array_splice($this->array_step, 0, 0, 'step-2');
        }
        array_splice($this->array_step, 0, 1);
        return view('Renstra.form-input.input-general', [
            'periodes' =>  Periode::where('flag_column_keterangan', '=', 8)->get(),
            'array_step' => $this->array_step,
        ]);
    }
    public function addGeneral(StoreGeneralObjectiveRequest $request)
    {
        foreach ($request->input_general as $item_general) {
            GeneralObjective::create([
                'id_periode' => $request->selectPeriode,
                'strategi_general' => $item_general
            ])->save();
            ActivityLog::create([
                'tipe_log' => 'insert',
                'details_log' => $item_general,
                'locations_log' => 'General Objective',
                'id_user' => Auth::user()->id_user,
            ])->save();
        }
        return redirect()->route('step-3')->with('success', 'General Objective has been stored successfully');
    }
    
    public function ind_general_get()
    {
        if (!in_array('step-3', $this->array_step)) {
            array_splice($this->array_step, 0, 0, 'step-3');
        }
        array_splice($this->array_step, 0, 2);
        return view('Renstra.form-input.input-ind-general', [
            'periodes' => Periode::where('flag_column_keterangan', '=', 8)->get(),
            'generals' => GeneralObjective::all(),
            'array_step' => $this->array_step,
        ]);
    }

    public function addIndGeneral(StoreIndikatorGeneralRequest $request)
    {
        foreach ($request->input_indikator_general as $item_indikator_general) {
            IndikatorGeneral::create([
                'id_general' => $request->selectGeneral,
                'deskripsi_indikator_general' => $item_indikator_general
            ])->save();
            ActivityLog::create([
                'tipe_log' => 'insert',
                'details_log' => $item_indikator_general,
                'locations_log' => 'Indikator General Objective',
                'id_user' => Auth::user()->id_user
            ])->save();
        }
        return redirect()->route('step-4')->with('success', 'Indikator for General Objective has been stored successfully');
    }

    public function ultimate_get()
    {
        if (!in_array('step-4', $this->array_step)) {
            array_splice($this->array_step, 0, 0, 'step-4');
        }
        array_splice($this->array_step, 0, 3);
        return view('Renstra.form-input.input-ultimate', [
            'periodes' => Periode::where('flag_column_keterangan', '=', 8)->get(),
            'generals' => GeneralObjective::all(),
            'ultimates' => UltimateObjective::all(),
            'array_step' => $this->array_step,
        ]);
    }

    public function addUltimate(StoreUltimateObjectiveRequest $request)
    {
        foreach ($request->input_ultimate as $item_ultimate) {
            UltimateObjective::create([
                'id_general' => $request->selectGeneral,
                'id_periode' => $request->selectPeriode,
                'strategi_ultimate' => $item_ultimate,
            ])->save();
            ActivityLog::create([
                'tipe_log' => 'insert',
                'details_log' => $item_ultimate,
                'locations_log' => 'Ultimate Objective',
                'id_user' => Auth::user()->id_user,
            ])->save();
        }
        return redirect()->route('step-5')->with('success', 'Ultimate Objective has been stored successfully');
    }

    public function ind_ultimate_get()
    {
        if (!in_array('step-5', $this->array_step)) {
            array_splice($this->array_step, 0, 0, 'step-5');
        }
        array_splice($this->array_step, 0, 4);
        return view('Renstra.form-input.input-ind-ultimate', [
            'periodes' => Periode::where('flag_column_keterangan', '=', 8)->get(),
            'ultimates' => UltimateObjective::all(),
            'array_step' => $this->array_step,
        ]);
    }

    public function addIndUltimate(StoreIndikatorUltimateRequest $request)
    {
        foreach ($request->input_indikator_ultimate as $item_indikator_ultimate) {
            IndikatorUltimate::create([
                'id_ultimate' => $request->selectUltimate,
                'deskripsi_indikator_ultimate' => $item_indikator_ultimate
            ])->save();
            ActivityLog::create([
                'tipe_log' => 'insert',
                'details_log' => $item_indikator_ultimate,
                'locations_log' => 'Indikator Ultimate Objective',
                'id_user' => Auth::user()->id_user,
            ])->save();
        }
        return redirect()->route('step-6')->with('success', 'Indikator for Ultimate Objective been stored successfully');
    }

    public function intermediate_get()
    {
        if (!in_array('step-6', $this->array_step)) {
            array_splice($this->array_step, 0, 0, 'step-6');
        }
        array_splice($this->array_step, 0, 5);
        return view('Renstra.form-input.input-intermediate', [
            'periodes' => Periode::where('flag_column_keterangan', '=', 8)->get(),
            'ultimates' => UltimateObjective::all(),
            'array_step' => $this->array_step,
        ]);
    }
    public function addIntermediate(StoreIntermediateObjectiveRequest $request)
    {
        foreach ($request->input_intermediate as $item_intermediate) {
            IntermediateObjective::create([
                'id_ultimate' => $request->selectUltimate,
                'id_periode' => $request->selectPeriode,
                'strategi_intermediate' => $item_intermediate,
            ])->save();
            ActivityLog::create([
                'tipe_log' => 'insert',
                'details_log' => $item_intermediate,
                'locations_log' => 'Intermediate Objective',
                'id_user' => Auth::user()->id_user,
            ])->save();
        }
        return redirect()->route('step-7')->with('success', 'Intermediate Objective has been stored successfully');
    }
    public function ind_intermediate_get()
    {
        if (!in_array('step-7', $this->array_step)) {
            array_splice($this->array_step, 0, 0, 'step-7');
        }
        array_splice($this->array_step, 0, 6);
        return view('Renstra.form-input.input-ind-intermediate', [
            'periodes' => Periode::where('flag_column_keterangan', '=', 8)->get(),
            'intermediates' => IntermediateObjective::all(),
            'array_step' => $this->array_step,
        ]);
    }

    public function addIndIntermediate(StoreIndikatorIntermediateRequest $request)
    {
        foreach ($request->input_indikator_intermediate as $item_indikator_intermediate) {
            IndikatorIntermediate::create([
                'id_intermediate' => $request->selectIntermediate,
                'deskripsi_indikator_intermediate' => $item_indikator_intermediate
            ])->save();
            ActivityLog::create([
                'tipe_log' => 'insert',
                'details_log' => $item_indikator_intermediate,
                'locations_log' => 'Indikator Intermediate Objective',
                'id_user' => Auth::user()->id_user,
            ])->save();
        }
        return redirect()->route('step-8')->with('success', 'Indikator for Intermediate Objective has been stored successfully');
    }

    public function outcome_get()
    {
        if (!in_array('step-8', $this->array_step)) {
            array_splice($this->array_step, 0, 0, 'step-8');
        }
        array_splice($this->array_step, 0, 7);
        return view('Renstra.form-input.input-outcome', [
            'periodes' => Periode::where('flag_column_keterangan', '=', 8)->get(),
            'intermediates' => IntermediateObjective::all(),
            'array_step' => $this->array_step,
        ]);
    }

    public function addOutcome(StoreOutcomeRequest $request)
    {
        foreach ($request->input_outcome as $item_outcome) {
            Outcome::create([
                'id_intermediate' => $request->selectIntermediate,
                'id_periode' => $request->selectPeriode,
                'strategi_outcome' => $item_outcome,
            ])->save();
            ActivityLog::create([
                'tipe_log' => 'insert',
                'details_log' => $item_outcome,
                'locations_log' => 'Outcome',
                'id_user' => Auth::user()->id_user,
            ])->save();
        }
        return redirect()->route('step-9')->with('success', 'Outcome has been stored successfully');
    }

    public function ind_outcome_get()
    {
        if (!in_array('step-9', $this->array_step)) {
            array_splice($this->array_step, 0, 0, 'step-9');
        }
        array_splice($this->array_step, 0, 8);
        return view('Renstra.form-input.input-ind-outcome', [
            'periodes' => Periode::where('flag_column_keterangan', '=', 8)->get(),
            'outcomes' => Outcome::all(),
            'array_step' => $this->array_step,
        ]);
    }

    public function addIndOutcome(StoreIndikatorOutcomeRequest $request)
    {
        foreach ($request->input_indikator_outcome as $item_indikator_outcome) {
            IndikatorOutcome::create([
                'id_outcome' => $request->selectOutcome,
                'deskripsi_indikator_outcome' => $item_indikator_outcome
            ])->save();
            ActivityLog::create([
                'tipe_log' => 'insert',
                'details_log' => $item_indikator_outcome,
                'locations_log' => 'Indikator Outcome',
                'id_user' => Auth::user()->id_user,
            ])->save();
        }
        return redirect()->route('step-10')->with('success', 'Indikator for Output has been stored successfully');
    }

    public function use_of_output_get()
    {
        if (!in_array('step-10', $this->array_step)) {
            array_splice($this->array_step, 0, 0, 'step-10');
        }
        array_splice($this->array_step, 0, 9);
        return view('Renstra.form-input.input-use-of-output', [
            'periodes' => Periode::where('flag_column_keterangan', '=', 8)->get(),
            'outcomes' => Outcome::all(),
            'array_step' => $this->array_step,
        ]);
    }

    public function addUseOfOutput(StoreUseOfOutputRequest $request)
    {
        foreach ($request->input_useofoutput as $item_useofoutput) {
            UseOfOutput::create([
                'id_outcome' => $request->selectOutcome,
                'id_periode' => $request->selectPeriode,
                'strategi_use_of_output' => $item_useofoutput,
            ])->save();
            ActivityLog::create([
                'tipe_log' => 'insert',
                'details_log' => $item_useofoutput,
                'locations_log' => 'Use of Output',
                'id_user' => Auth::user()->id_user,
            ])->save();
        }
        return redirect()->route('step-11')->with('success', 'Use of Output has been stored successfully');
    }

    public function ind_use_of_output_get()
    {
        if (!in_array('step-11', $this->array_step)) {
            array_splice($this->array_step, 0, 0, 'step-11');
        }
        array_splice($this->array_step, 0, 10);
        return view('Renstra.form-input.input-ind-use-of-output', [
            'periodes' => Periode::where('flag_column_keterangan', '=', 8)->get(),
            'use_of_outputs' => UseOfOutput::all(),
            'array_step' => $this->array_step,
        ]);
    }

    public function addIndUseOfOutput(StoreIndikatorUseOfOutputRequest $request)
    {
        foreach ($request->input_indikator_useofoutput as $item_indikator_useofoutput) {
            IndikatorUseOfOutput::create([
                'id_use_of_output' => $request->selectUseofoutput,
                'deskripsi_indikator_use_of_output' => $item_indikator_useofoutput
            ])->save();
            ActivityLog::create([
                'tipe_log' => 'insert',
                'details_log' => $item_indikator_useofoutput,
                'locations_log' => 'Indikator Use of Output',
                'id_user' => Auth::user()->id_user,
            ])->save();
        }
        return redirect()->route('step-12')->with('success', 'Indikator for Use Of Output has been stored successfully');
    }

    public function output_get()
    {
        if (!in_array('step-12', $this->array_step)) {
            array_splice($this->array_step, 0, 0, 'step-12');
        }
        array_splice($this->array_step, 0, 11);
        return view('Renstra.form-input.input-output', [
            'periodes' => Periode::where('flag_column_keterangan', '=', 8)->get(),
            'use_of_outputs' => UseOfOutput::all(),
            'array_step' => $this->array_step,
        ]);
    }

    public function addOutput(StoreOutputRequest $request)
    {
        foreach ($request->input_output as $item_output) {
            Output::create([
                'id_use_of_output' => $request->selectUseofoutput,
                'id_outcome' => $request->selectOutcome,
                'id_periode' => $request->selectPeriode,
                'strategi_output' => $item_output,
            ])->save();
            ActivityLog::create([
                'tipe_log' => 'insert',
                'details_log' => $item_output,
                'locations_log' => 'Output',
                'id_user' => Auth::user()->id_user,
            ])->save();
        }
        return redirect()->route('step-13')->with('success', 'Output has been stored successfully');
    }

    public function ind_output_get()
    {
        if (!in_array('step-13', $this->array_step)) {
            array_splice($this->array_step, 0, 0, 'step-13');
        }
        array_splice($this->array_step, 0, 12);
        return view('Renstra.form-input.input-ind-output', [
            'periodes' => Periode::where('flag_column_keterangan', '=', 8)->get(),
            'outputs' => Output::all(),
            'array_step' => $this->array_step,
        ]);
    }

    public function addIndOutput(StoreIndikatorOutputRequest $request)
    {
        foreach ($request->input_indikator_output as $item_indikator_output) {
            IndikatorOutput::create([
                'id_output' => $request->selectOutput,
                'deskripsi_indikator_output' => $item_indikator_output
            ])->save();
            ActivityLog::create([
                'tipe_log' => 'insert',
                'details_log' => $item_indikator_output,
                'locations_log' => 'Indikator Output',
                'id_user' => Auth::user()->id_user,
            ])->save();
        }
        return redirect()->route('home')->with('success', 'Indikator for Output has been stored successfully');
    }
}
