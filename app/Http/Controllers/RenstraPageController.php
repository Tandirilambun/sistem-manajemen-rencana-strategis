<?php

namespace App\Http\Controllers;

use App\Models\Outcome;
use App\Models\Periode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RenstraPageController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $periode_jump = Periode::all();
        $strategi = Periode::find($id);
        $general_query = DB::table('general_objective')
            ->select(
                'general_objective.id_general',
                'general_objective.id_periode',
                'general_objective.strategi_general',
                DB::raw('coalesce(avg(capaian_general.capaian_general),0) as avg_capaian')
            )
            ->leftJoin('indikator_general', 'general_objective.id_general', '=', 'indikator_general.id_general')
            ->leftJoin('capaian_general', 'indikator_general.id_indikator_general', '=', 'capaian_general.id_indikator_general')
            ->where('general_objective.id_periode', '=', $id)
            ->groupBy('general_objective.id_general')
            ->get();

        $ultimate_query = DB::table('ultimate_objective')
            ->select(
                'ultimate_objective.id_ultimate',
                'ultimate_objective.id_periode',
                'ultimate_objective.strategi_ultimate',
                DB::raw('coalesce(avg(capaian_ultimate.capaian_ultimate),0) as avg_capaian')
            )
            ->leftJoin('indikator_ultimate', 'ultimate_objective.id_ultimate', '=', 'indikator_ultimate.id_ultimate')
            ->leftJoin('capaian_ultimate', 'indikator_ultimate.id_indikator_ultimate', '=', 'capaian_ultimate.id_indikator_ultimate')
            ->where('ultimate_objective.id_periode', '=', $id)
            ->groupBy('ultimate_objective.id_ultimate')
            ->get();
        if($strategi -> flag_column_keterangan == 4){
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
                ->where('intermediate_objective.id_periode', '=', $id)
                ->groupBy('intermediate_objective.id_intermediate')
                ->get();
        }else{
            $intermediate_query = DB::table('intermediate_objective')
                ->select(
                    'intermediate_objective.id_intermediate',
                    'intermediate_objective.id_periode',
                    'intermediate_objective.strategi_intermediate',
                    DB::raw('coalesce(avg(capaian_intermediate.capaian_intermediate),0) as avg_capaian')
                )
                ->leftJoin('indikator_intermediate', 'intermediate_objective.id_intermediate', '=', 'indikator_intermediate.id_intermediate')
                ->leftJoin('capaian_intermediate', 'indikator_intermediate.id_indikator_intermediate', '=', 'capaian_intermediate.id_indikator_intermediate')
                ->where('intermediate_objective.id_periode', '=', $id)
                ->groupBy('intermediate_objective.id_intermediate')
                ->get();
        }
        $outcome_query = DB::table('outcome')
            ->select(
                'outcome.id_outcome',
                'outcome.id_periode',
                'outcome.strategi_outcome',
                DB::raw('coalesce(avg(capaian_outcome.capaian_outcome),0) as avg_capaian')
            )
            ->leftJoin('indikator_outcome', 'outcome.id_outcome', '=', 'indikator_outcome.id_outcome')
            ->leftJoin('capaian_outcome', 'indikator_outcome.id_indikator_outcome', '=', 'capaian_outcome.id_indikator_outcome')
            ->where('outcome.id_periode', '=', $id)
            ->groupBy('outcome.id_outcome')
            ->get();

        $use_of_output_query = DB::table('use_of_output')
            ->select(
                'use_of_output.id_use_of_output',
                'use_of_output.id_periode',
                'use_of_output.strategi_use_of_output',
                DB::raw('coalesce(avg(capaian_use_of_output.capaian_use_of_output),0) as avg_capaian')
            )
            ->leftJoin('indikator_use_of_output', 'use_of_output.id_use_of_output', '=', 'indikator_use_of_output.id_use_of_output')
            ->leftJoin('capaian_use_of_output', 'indikator_use_of_output.id_indikator_use_of_output', '=', 'capaian_use_of_output.id_indikator_use_of_output')
            ->where('use_of_output.id_periode', '=', $id)
            ->groupBy('use_of_output.id_use_of_output')
            ->get();

        $output_query = DB::table('output')
            ->select(
                'output.id_output',
                'output.id_periode',
                'output.strategi_output',
                DB::raw('coalesce(avg(capaian_output.capaian_output),0) as avg_capaian')
            )
            ->leftJoin('indikator_output', 'output.id_output', '=', 'indikator_output.id_output')
            ->leftJoin('capaian_output', 'indikator_output.id_indikator_output', '=', 'capaian_output.id_indikator_output')
            ->where('output.id_periode', '=', $id)
            ->groupBy('output.id_output')
            ->get();
        
        return view('Renstra.renstrapage', compact('id'),[
            'strategi' => $strategi,
            'general_query' => $general_query,
            'ultimate_query' => $ultimate_query,
            'intermediate_query' => $intermediate_query,
            'outcome_query' => $outcome_query,
            'use_of_output_query' => $use_of_output_query,
            'output_query' => $output_query,
            'periode_jump' => $periode_jump,
        ]);
    }
}
