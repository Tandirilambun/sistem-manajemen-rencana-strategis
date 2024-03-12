<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MPPController extends Controller
{
    public function show(Periode $periode)
    {
        $search = strtolower(str_replace(' ','%', request('search')));
        if (($periode->flag_column_keterangan) == 4) {
            $query_intermediate = Periode::with('intermediate_objective')
                ->where('id_periode', '=', $periode->id_periode)
                ->first();
            $query_outcome = DB::table('periode')
                ->select(
                    'periode.id_periode',
                    'outcome.id_outcome',
                    'outcome.strategi_outcome',
                    'indikator_outcome.deskripsi_indikator_outcome'
                )
                ->join('outcome', 'periode.id_periode', '=', 'outcome.id_periode')
                ->join('indikator_outcome', 'outcome.id_outcome', '=', 'indikator_outcome.id_outcome')
                ->whereRaw("(periode.id_periode = {$periode->id_periode} AND lower(outcome.strategi_outcome) LIKE '%{$search}%') OR (periode.id_periode = {$periode->id_periode} AND lower(indikator_outcome.deskripsi_indikator_outcome) LIKE '%{$search}%') ")
                ->groupBy(
                    'periode.id_periode',
                    'outcome.id_outcome',
                    'indikator_outcome.deskripsi_indikator_outcome'
                )
                ->get();
            $query_output = DB::table('periode')
                ->select(
                    'periode.id_periode',
                    'output.id_output',
                    'output.strategi_output',
                    'indikator_output.deskripsi_indikator_output'
                )
                ->join('output', 'periode.id_periode', '=', 'output.id_periode')
                ->join('indikator_output', 'output.id_output', '=', 'indikator_output.id_output')
                ->whereRaw("(periode.id_periode = {$periode->id_periode} AND lower(output.strategi_output) LIKE '%{$search}%') OR (periode.id_periode = {$periode->id_periode} AND lower(indikator_output.deskripsi_indikator_output) LIKE '%{$search}%') ")
                ->groupBy(
                    'periode.id_periode',
                    'output.id_output',
                    'indikator_output.deskripsi_indikator_output'
                )
                ->get();
            return view('Renstra.mpp.mpp', [
                'periode' => $periode,
                'query_intermediate' => $query_intermediate,
                'query_outcome' => $query_outcome,
                'query_output' => $query_output,
                'old_search' => request('search')
            ]);
        } else if (($periode->flag_column_keterangan) == 8) {
            $query_general = DB::table('periode')
                ->select(
                    'periode.id_periode',
                    'general_objective.id_general',
                    'general_objective.strategi_general',
                    'indikator_general.deskripsi_indikator_general'
                )
                ->join('general_objective', 'periode.id_periode', '=', 'general_objective.id_periode')
                ->join('indikator_general', 'general_objective.id_general', '=', 'indikator_general.id_general')
                ->whereRaw("(periode.id_periode = {$periode->id_periode} AND lower(general_objective.strategi_general) LIKE '%{$search}%') OR (periode.id_periode = {$periode->id_periode} AND lower(indikator_general.deskripsi_indikator_general) LIKE '%{$search}%') ")
                ->groupBy(
                    'periode.id_periode',
                    'general_objective.id_general',
                    'indikator_general.deskripsi_indikator_general'
                )
                ->get();
            $query_ultimate = DB::table('periode')
                ->select(
                    'periode.id_periode',
                    'ultimate_objective.id_ultimate',
                    'ultimate_objective.strategi_ultimate',
                    'indikator_ultimate.deskripsi_indikator_ultimate'
                )
                ->join('ultimate_objective', 'periode.id_periode', '=', 'ultimate_objective.id_periode')
                ->join('indikator_ultimate', 'ultimate_objective.id_ultimate', '=', 'indikator_ultimate.id_ultimate')
                ->whereRaw("(periode.id_periode = {$periode->id_periode} AND lower(ultimate_objective.strategi_ultimate) LIKE '%{$search}%') OR (periode.id_periode = {$periode->id_periode} AND lower(indikator_ultimate.deskripsi_indikator_ultimate) LIKE '%{$search}%') ")
                ->groupBy(
                    'periode.id_periode',
                    'ultimate_objective.id_ultimate',
                    'indikator_ultimate.deskripsi_indikator_ultimate'
                )
                ->get();
            $query_intermediate = DB::table('periode')
                ->select(
                    'periode.id_periode',
                    'intermediate_objective.id_intermediate',
                    'intermediate_objective.strategi_intermediate',
                    'indikator_intermediate.deskripsi_indikator_intermediate'
                )
                ->join('intermediate_objective', 'periode.id_periode', '=', 'intermediate_objective.id_periode')
                ->join('indikator_intermediate', 'intermediate_objective.id_intermediate', '=', 'indikator_intermediate.id_intermediate')
                ->whereRaw("(periode.id_periode = {$periode->id_periode} AND lower(intermediate_objective.strategi_intermediate) LIKE '%{$search}%') OR (periode.id_periode = {$periode->id_periode} AND lower(indikator_intermediate.deskripsi_indikator_intermediate) LIKE '%{$search}%') ")
                ->groupBy(
                    'periode.id_periode',
                    'intermediate_objective.id_intermediate',
                    'indikator_intermediate.deskripsi_indikator_intermediate'
                )
                ->get();
            $query_outcome = DB::table('periode')
                ->select(
                    'periode.id_periode',
                    'outcome.id_outcome',
                    'outcome.strategi_outcome',
                    'indikator_outcome.deskripsi_indikator_outcome'
                )
                ->join('outcome', 'periode.id_periode', '=', 'outcome.id_periode')
                ->join('indikator_outcome', 'outcome.id_outcome', '=', 'indikator_outcome.id_outcome')
                ->whereRaw("(periode.id_periode = {$periode->id_periode} AND lower(outcome.strategi_outcome) LIKE '%{$search}%') OR (periode.id_periode = {$periode->id_periode} AND lower(indikator_outcome.deskripsi_indikator_outcome) LIKE '%{$search}%') ")
                ->groupBy(
                    'periode.id_periode',
                    'outcome.id_outcome',
                    'indikator_outcome.deskripsi_indikator_outcome'
                )
                ->get();
            $query_use_of_output = DB::table('periode')
                ->select(
                    'periode.id_periode',
                    'use_of_output.id_use_of_output',
                    'use_of_output.strategi_use_of_output',
                    'indikator_use_of_output.deskripsi_indikator_use_of_output'
                )
                ->join('use_of_output', 'periode.id_periode', '=', 'use_of_output.id_periode')
                ->join('indikator_use_of_output', 'use_of_output.id_use_of_output', '=', 'indikator_use_of_output.id_use_of_output')
                ->whereRaw("(periode.id_periode = {$periode->id_periode} AND lower(use_of_output.strategi_use_of_output) LIKE '%{$search}%') OR (periode.id_periode = {$periode->id_periode} AND lower(indikator_use_of_output.deskripsi_indikator_use_of_output) LIKE '%{$search}%') ")
                ->groupBy(
                    'periode.id_periode',
                    'use_of_output.id_use_of_output',
                    'indikator_use_of_output.deskripsi_indikator_use_of_output'
                )
                ->get();
            $query_output = DB::table('periode')
                ->select(
                    'periode.id_periode',
                    'output.id_output',
                    'output.strategi_output',
                    'indikator_output.deskripsi_indikator_output'
                )
                ->join('output', 'periode.id_periode', '=', 'output.id_periode')
                ->join('indikator_output', 'output.id_output', '=', 'indikator_output.id_output')
                ->whereRaw("(periode.id_periode = {$periode->id_periode} AND lower(output.strategi_output) LIKE '%{$search}%') OR (periode.id_periode = {$periode->id_periode} AND lower(indikator_output.deskripsi_indikator_output) LIKE '%{$search}%') ")
                ->groupBy(
                    'periode.id_periode',
                    'output.id_output',
                    'indikator_output.deskripsi_indikator_output'
                )
                ->get();
            return view('Renstra.mpp.mpp', [
                'periode' => $periode,
                'query_general' => $query_general,
                'query_ultimate' => $query_ultimate,
                'query_intermediate' => $query_intermediate,
                'query_outcome' => $query_outcome,
                'query_use_of_output' => $query_use_of_output,
                'query_output' => $query_output,
                'old_search' => request('search')
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
