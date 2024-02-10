<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\Output;
use App\Models\Outcome;
use App\Models\UseOfOutput;
use App\Models\GeneralObjective;
use App\Models\UltimateObjective;
use Illuminate\Support\Facades\DB;
use App\Models\IntermediateObjective;


class StrategiController extends Controller
{

    public function showIndikatorGeneral( string $id, GeneralObjective $generalObjective)
    {
        $indikators = $generalObjective->indikator_general;
        $parent_periode = $generalObjective->periode;
        $capaian_general_query = DB::table('indikator_general')
            ->select(
                'general_objective.id_general',
                'general_objective.strategi_general',
                DB::raw('avg(capaian_general.capaian_general) as avg_capaian')
            )
            ->join('general_objective', 'general_objective.id_general', '=', 'indikator_general.id_general')
            ->join('capaian_general', 'capaian_general.id_indikator_general', 'indikator_general.id_indikator_general')
            ->where('general_objective.id_general', '=', ($generalObjective->id_general))
            ->groupBy('general_objective.id_general')
            ->first();
        $list_indikator = array();
        foreach ($indikators as $indikator) {
            $capaian_per_indikator = DB::table('indikator_general')
                ->select(
                    'indikator_general.id_indikator_general',
                    'indikator_general.deskripsi_indikator_general',
                    'indikator_general.id_general',
                    DB::raw('avg(capaian_general.capaian_general) as avg_indikator')
                )
                ->join('capaian_general', 'capaian_general.id_indikator_general', '=', 'indikator_general.id_indikator_general')
                ->where('indikator_general.id_indikator_general', '=', ($indikator->id_indikator_general))
                ->groupBy('indikator_general.id_indikator_general')
                ->first();
            array_push($list_indikator, $capaian_per_indikator);
        }
        $avg_general = $capaian_general_query->avg_capaian ?? 0;
        $generals = GeneralObjective::all();

        $status = "status_general";
        // session()->flash('status_general', 'general');
        return view('Renstra.strategi', compact('id'),[
            'generalObjective' => $generalObjective,
            'indikators' => $indikators,
            'parent_periode' => $parent_periode,
            'capaian_general_query' => $capaian_general_query,
            'list_indikator' => $list_indikator,
            'avg_general' => $avg_general,
            'generals' => $generals,
            'status' => $status,
        ]);
    }
    public function showIndikatorUltimate(string $id, UltimateObjective $ultimateObjective)
    {
        $indikators = $ultimateObjective->indikator_ultimate;
        $parent_general = $ultimateObjective -> general_objective -> strategi_general ?? $ultimateObjective -> periode -> roadmap;
        $capaian_ultimate_query = DB::table('indikator_ultimate')
            ->select(
                'ultimate_objective.id_ultimate',
                'ultimate_objective.strategi_ultimate',
                DB::raw('avg(capaian_ultimate.capaian_ultimate) as avg_capaian')
            )
            ->join('ultimate_objective', 'ultimate_objective.id_ultimate', '=', 'indikator_ultimate.id_ultimate')
            ->join('capaian_ultimate', 'capaian_ultimate.id_indikator_ultimate', 'indikator_ultimate.id_indikator_ultimate')
            ->where('ultimate_objective.id_ultimate', '=', ($ultimateObjective->id_ultimate))
            ->groupBy('ultimate_objective.id_ultimate')
            ->first();
        $list_indikator = array();
        foreach ($indikators as $indikator) {
            $capaian_per_indikator = DB::table('indikator_ultimate')
                ->select(
                    'indikator_ultimate.id_indikator_ultimate',
                    'indikator_ultimate.deskripsi_indikator_ultimate',
                    'indikator_ultimate.id_ultimate',
                    DB::raw('avg(capaian_ultimate.capaian_ultimate) as avg_indikator')
                )
                ->join('capaian_ultimate', 'capaian_ultimate.id_indikator_ultimate', '=', 'indikator_ultimate.id_indikator_ultimate')
                ->where('indikator_ultimate.id_indikator_ultimate', '=', ($indikator->id_indikator_ultimate))
                ->groupBy('indikator_ultimate.id_indikator_ultimate')
                ->first();
            array_push($list_indikator, $capaian_per_indikator);
        }
        $avg_ultimate = $capaian_ultimate_query->avg_capaian ?? 0;
        $ultimates = UltimateObjective::all();
        // session()->flash('status_ultimate', 'ultimate');
        $status = "status_ultimate";
        return view('Renstra.strategi',compact('id'), [
            'ultimateObjective' => $ultimateObjective,
            'indikators' => $indikators,
            'parent_general' => $parent_general,
            'capaian_ultimate_query' => $capaian_ultimate_query,
            'list_indikator' => $list_indikator,
            'avg_ultimate' => $avg_ultimate,
            'ultimates' => $ultimates,
            'status' => $status,
        ]);
    }

    public function showIndikatorIntermediate(string $id, IntermediateObjective $intermediateObjective)
    {
        $indikators = $intermediateObjective->indikator_intermediate;
        $parent_ultimate = $intermediateObjective -> ultimate_objective -> strategi_ultimate ?? $intermediateObjective -> periode -> roadmap;
        $get_flag = $intermediateObjective -> periode -> flag_column_keterangan;
        if ($get_flag == 8) {
            $capaian_intermediate_query = DB::table('indikator_intermediate')
                ->select(
                    'intermediate_objective.id_intermediate',
                    'intermediate_objective.strategi_intermediate',
                    DB::raw('avg(capaian_intermediate.capaian_intermediate) as avg_capaian')
                )
                ->join('intermediate_objective', 'intermediate_objective.id_intermediate', '=', 'indikator_intermediate.id_intermediate')
                ->join('capaian_intermediate', 'capaian_intermediate.id_indikator_intermediate', 'indikator_intermediate.id_indikator_intermediate')
                ->where('intermediate_objective.id_intermediate', '=', ($intermediateObjective->id_intermediate))
                ->groupBy('intermediate_objective.id_intermediate')
                ->first();
            $list_indikator = array();
            foreach ($indikators as $indikator) {
                $capaian_per_indikator = DB::table('indikator_intermediate')
                    ->select(
                        'indikator_intermediate.id_indikator_intermediate',
                        'indikator_intermediate.deskripsi_indikator_intermediate',
                        'indikator_intermediate.id_intermediate',
                        DB::raw('avg(capaian_intermediate.capaian_intermediate) as avg_indikator')
                    )
                    ->join('capaian_intermediate', 'capaian_intermediate.id_indikator_intermediate', '=', 'indikator_intermediate.id_indikator_intermediate')
                    ->where('indikator_intermediate.id_indikator_intermediate', '=', ($indikator->id_indikator_intermediate))
                    ->groupBy('indikator_intermediate.id_indikator_intermediate')
                    ->first();
                array_push($list_indikator, $capaian_per_indikator);
            }
            $avg_intermediate = $capaian_intermediate_query->avg_capaian ?? 0;
            $intermediates = IntermediateObjective::all();
            $status = "status_intermediate";
            return view('Renstra.strategi', compact('id'),[
                'intermediateObjective' => $intermediateObjective,
                'indikators' => $indikators,
                'parent_ultimate' => $parent_ultimate,
                'capaian_intermediate_query' => $capaian_intermediate_query,
                'list_indikator' => $list_indikator,
                'avg_intermediate' => $avg_intermediate,
                'intermediates' => $intermediates,
                'status' => $status,
                'get_flag' => $get_flag
            ]);
        } else if ($get_flag == 4) {
            $capaian_intermediate_query = DB::table('intermediate_objective')
                ->select(
                    'outcome.id_outcome',
                    'outcome.strategi_outcome',
                    DB::raw('avg(capaian_outcome.capaian_outcome) as avg_capaian')
                )
                ->leftJoin('outcome', 'outcome.id_intermediate', '=', 'intermediate_objective.id_intermediate')
                ->leftJoin('indikator_outcome', 'indikator_outcome.id_outcome', '=', 'indikator_outcome.id_outcome')
                ->leftJoin('capaian_outcome', 'indikator_outcome.id_indikator_outcome', '=', 'capaian_outcome.id_indikator_outcome')
                ->where('intermediate_objective.id_intermediate', '=', $intermediateObjective->id_intermediate)
                ->groupBy('outcome.id_outcome')
                ->orderBy('outcome.id_outcome')
                ->get();
            $intermediate_query = DB::table('intermediate_objective')
                ->select(
                    'intermediate_objective.id_intermediate',
                    'intermediate_objective.id_periode',
                    'intermediate_objective.strategi_intermediate',
                    DB::raw('coalesce(avg(capaian_outcome.capaian_outcome),0) as avg_capaian')
                )
                ->leftJoin('outcome', 'outcome.id_intermediate', '=', 'intermediate_objective.id_intermediate')
                ->leftJoin('indikator_outcome', 'indikator_outcome.id_outcome', '=', 'outcome.id_outcome')
                ->leftJoin('capaian_outcome', 'indikator_outcome.id_indikator_outcome', '=', 'capaian_outcome.id_indikator_outcome')
                ->where('intermediate_objective.id_periode', '=', $intermediateObjective->id_intermediate)
                ->groupBy('intermediate_objective.id_intermediate')
                ->first();
            $avg_intermediate = $intermediate_query->avg_capaian ?? 0;
            $intermediates = IntermediateObjective::all();
            $status = "status_intermediate";
            return view('Renstra.strategi', compact('id'),[
                'intermediateObjective' => $intermediateObjective,
                'indikators' => $indikators,
                'parent_ultimate' => $parent_ultimate,
                'capaian_intermediate_query' => $capaian_intermediate_query,
                'avg_intermediate' => $avg_intermediate,
                'intermediates' => $intermediates,
                'status' => $status,
                'get_flag' => $get_flag
            ]);
        }
    }

    public function showIndikatorOutcome(string $id, Outcome $outcome)
    {
        $indikators = $outcome->indikator_outcome;
        $parent_intermediate = $outcome->intermediate_objective->strategi_intermediate ?? $outcome->periode->roadmap;
        $capaian_outcome_query = DB::table('indikator_outcome')
            ->select(
                'outcome.id_outcome',
                'outcome.strategi_outcome',
                DB::raw('avg(capaian_outcome.capaian_outcome) as avg_capaian')
            )
            ->join('outcome', 'outcome.id_outcome', '=', 'indikator_outcome.id_outcome')
            ->join('capaian_outcome', 'capaian_outcome.id_indikator_outcome', 'indikator_outcome.id_indikator_outcome')
            ->where('outcome.id_outcome', '=', ($outcome->id_outcome))
            ->groupBy('outcome.id_outcome')
            ->first();
        $list_indikator = array();
        foreach ($indikators as $indikator) {
            $capaian_per_indikator = DB::table('indikator_outcome')
                ->select(
                    'indikator_outcome.id_indikator_outcome',
                    'indikator_outcome.deskripsi_indikator_outcome',
                    'indikator_outcome.id_outcome',
                    DB::raw('avg(capaian_outcome.capaian_outcome) as avg_indikator')
                )
                ->join('capaian_outcome', 'capaian_outcome.id_indikator_outcome', '=', 'indikator_outcome.id_indikator_outcome')
                ->where('indikator_outcome.id_indikator_outcome', '=', ($indikator->id_indikator_outcome))
                ->groupBy('indikator_outcome.id_indikator_outcome')
                ->first();
            array_push($list_indikator, $capaian_per_indikator);
        }
        $avg_outcome = $capaian_outcome_query->avg_capaian ?? 0;
        $outcomes = Outcome::all();
        // session()->flash('status_outcome', 'outcome');
        $status = "status_outcome";
        return view('Renstra.strategi', compact('id'),[
            'outcome' => $outcome,
            'parent_intermediate' => $parent_intermediate,
            'capaian_outcome_query' => $capaian_outcome_query,
            'avg_outcome' => $avg_outcome,
            'indikators' => $indikators,
            'list_indikator' => $list_indikator,
            'outcomes' => $outcomes,
            'status' => $status
        ]);
    }

    public function showIndikatorUseofoutput(string $id, UseOfOutput $useOfOutput)
    {
        $indikators = $useOfOutput->indikator_use_of_output;
        $parent_outcome = $useOfOutput->use_of_output->strategi_use_of_output ?? $useOfOutput->periode->roadmap;
        $capaian_use_of_output_query = DB::table('indikator_use_of_output')
            ->select(
                'use_of_output.id_use_of_output',
                'use_of_output.strategi_use_of_output',
                DB::raw('avg(capaian_use_of_output.capaian_use_of_output) as avg_capaian')
            )
            ->join('use_of_output', 'use_of_output.id_use_of_output', '=', 'indikator_use_of_output.id_use_of_output')
            ->join('capaian_use_of_output', 'capaian_use_of_output.id_indikator_use_of_output', 'indikator_use_of_output.id_indikator_use_of_output')
            ->where('use_of_output.id_use_of_output', '=', ($useOfOutput->id_use_of_output))
            ->groupBy('use_of_output.id_use_of_output')
            ->first();
        $list_indikator = array();
        foreach ($indikators as $indikator) {
            $capaian_per_indikator = DB::table('indikator_use_of_output')
                ->select(
                    'indikator_use_of_output.id_indikator_use_of_output',
                    'indikator_use_of_output.deskripsi_indikator_use_of_output',
                    'indikator_use_of_output.id_use_of_output',
                    DB::raw('avg(capaian_use_of_output.capaian_use_of_output) as avg_indikator')
                )
                ->join('capaian_use_of_output', 'capaian_use_of_output.id_indikator_use_of_output', '=', 'indikator_use_of_output.id_indikator_use_of_output')
                ->where('indikator_use_of_output.id_indikator_use_of_output', '=', ($indikator->id_indikator_use_of_output))
                ->groupBy('indikator_use_of_output.id_indikator_use_of_output')
                ->first();
            array_push($list_indikator, $capaian_per_indikator);
        }
        $avg_use_of_output = $capaian_use_of_output_query->avg_capaian ?? 0;
        $use_of_outputs = UseOfOutput::all();
        // session()->flash('status_useofoutput', 'use of output');
        $status = "status_useofoutput";
        return view('Renstra.strategi', compact('id'), [
            'useOfOutput' => $useOfOutput,
            'parent_outcome' => $parent_outcome,
            'capaian_use_of_output_query' => $capaian_use_of_output_query,
            'avg_use_of_output' => $avg_use_of_output,
            'indikators' => $indikators,
            'list_indikator' => $list_indikator,
            'use_of_outputs' => $use_of_outputs,
            'status' => $status
        ]);
    }

    public function showIndikatorOutput(string $id, Output $output)
    {
        $indikators = $output->indikator_output;
        $parent_intermediate = $output -> use_of_output -> strategi_use_of_output ?? $output -> outcome -> strategi_outcome ?? $output-> periode -> roadmap;
        $capaian_output_query = DB::table('indikator_output')
            ->select(
                'output.id_output',
                'output.strategi_output',
                DB::raw('avg(capaian_output.capaian_output) as avg_capaian')
            )
            ->join('output', 'output.id_output', '=', 'indikator_output.id_output')
            ->join('capaian_output', 'capaian_output.id_indikator_output', 'indikator_output.id_indikator_output')
            ->where('output.id_output', '=', ($output->id_output))
            ->groupBy('output.id_output')
            ->first();
        $list_indikator = array();
        foreach ($indikators as $indikator) {
            $capaian_per_indikator = DB::table('indikator_output')
                ->select(
                    'indikator_output.id_indikator_output',
                    'indikator_output.deskripsi_indikator_output',
                    'indikator_output.id_output',
                    DB::raw('avg(capaian_output.capaian_output) as avg_indikator')
                )
                ->join('capaian_output', 'capaian_output.id_indikator_output', '=', 'indikator_output.id_indikator_output')
                ->where('indikator_output.id_indikator_output', '=', ($indikator->id_indikator_output))
                ->groupBy('indikator_output.id_indikator_output')
                ->first();
            array_push($list_indikator, $capaian_per_indikator);
        }
        $avg_output = $capaian_output_query->avg_capaian ?? 0;
        $outputs = Output::all();
        // session()->flash('status_output', 'output');
        $status = "status_output";
        return view('Renstra.strategi', compact('id'), [
            'output' => $output,
            'parent_intermediate' => $parent_intermediate,
            'capaian_output_query' => $capaian_output_query,
            'avg_output' => $avg_output,
            'indikators' => $indikators,
            'list_indikator' => $list_indikator,
            'outputs' => $outputs,
            'status' => $status,
        ]);
    }
}
