<?php

namespace App\Http\Controllers;

use App\Models\Output;
use App\Models\Outcome;
use App\Models\Periode;
use App\Models\ActivityLog;
use App\Models\IndikatorOutput;
use App\Models\IndikatorOutcome;
use App\Models\UltimateObjective;
use Illuminate\Support\Facades\Auth;
use App\Models\IntermediateObjective;
use App\Http\Requests\StoreOutputRequest;
use App\Http\Requests\StoreOutcomeRequest;
use App\Http\Requests\StorePeriodeRequest;
use App\Http\Requests\StoreIndikatorOutputRequest;
use App\Http\Requests\StoreIndikatorOutcomeRequest;
use App\Http\Requests\StoreIntermediateObjectiveRequest;


class InputForm4Controller extends Controller
{
    public $array_step = array('step_1', 'step_2', 'step_3', 'step_4', 'step_5', 'step_6');

    public function periode_get()
    {
        if (!in_array('step_1', $this->array_step)) {
            array_splice($this->array_step, 0, 0, 'step_1');
        } 
        return view('Renstra.form-input-4.input-4-periode', [
            'array_step' => $this->array_step,
            'periode_last' => Periode::all()->last(),
        ]);
    }
    public function addPeriode(StorePeriodeRequest $request)
    {
        
        $validate = $request->validate([
            'inputRoadmap' => 'required',
            'tahunAwal' => 'required|numeric|digits:4',
            // 'tahunAkhir' => 'required|numeric|digits:4',
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
        return redirect()->route('step_2')->with('success', 'Periode has been stored successfully');
    }

    public function intermediate_get()
    {
        if (!in_array('step_2', $this->array_step)) {
            array_splice($this->array_step, 0, 0, 'step_2');
        }
        array_splice($this->array_step, 0, 1);
        return view('Renstra.form-input-4.input-4-intermediate', [
            'periodes' => Periode::where('flag_column_keterangan', '=', 4)->get(),
            'ultimates' => UltimateObjective::all(),
            'array_step' => $this->array_step,
        ]);
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
        return redirect()->route('step_3')->with('success', 'Intermediate Objective has been stored successfully');
    }

    public function outcome_get()
    {
        if (!in_array('step_3', $this->array_step)) {
            array_splice($this->array_step, 0, 0, 'step_3');
        }
        array_splice($this->array_step, 0, 2);
        return view('Renstra.form-input-4.input-4-outcome', [
            'periodes' => Periode::where('flag_column_keterangan', '=', 4)->get(),
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
        return redirect()->route('step_4')->with('success', 'Outcome has been stored successfully');
    }

    public function ind_outcome_get()
    {
        if (!in_array('step_4', $this->array_step)) {
            array_splice($this->array_step, 0, 0, 'step_4');
        }
        array_splice($this->array_step, 0, 3);
        return view('Renstra.form-input-4.input-4-ind-outcome', [
            'periodes' => Periode::where('flag_column_keterangan', '=', 4)->get(),
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
        return redirect()->route('step_5')->with('success', 'Indikator for Output has been stored successfully');
    }

    public function output_get()
    {
        if (!in_array('step_5', $this->array_step)) {
            array_splice($this->array_step, 0, 0, 'step_5');
        }
        array_splice($this->array_step, 0, 4);
        return view('Renstra.form-input-4.input-4-output', [
            'periodes' => Periode::where('flag_column_keterangan', '=', 4)->get(),
            'outcomes' => Outcome::all(),
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
        return redirect()->route('step_6')->with('success', 'Output has been stored successfully');
    }

    public function ind_output_get()
    {
        if (!in_array('step_6', $this->array_step)) {
            array_splice($this->array_step, 0, 0, 'step_6');
        }
        array_splice($this->array_step, 0, 5);
        return view('Renstra.form-input-4.input-4-ind-output', [
            'periodes' => Periode::where('flag_column_keterangan', '=', 4)->get(),
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
        session()->forget('current_step');
        return redirect()->route('home')->with('success', 'Indikator for Output has been stored successfully');
    }
}
