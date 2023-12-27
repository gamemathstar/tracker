<?php

namespace App\Http\Controllers;

use App\Models\Commitment;
use App\Models\Deliverable;
use App\Models\Kpi;
use Illuminate\Http\Request;

class DeliverableController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware("auth");
    }

    public function store(Request $request)
    {
//        return $request;
        $request->validate([
            'commitment_id'=>"required",
            'deliverable_title'=>"required",
            'description'=>"required",
        ]);

        Deliverable::create($request->all());

        return redirect()->back()->with('success', 'Deliverable created successfully');
    }

    public function view(Request $request)
    {
        $deliverable = Deliverable::find($request->id);
        $commitment = Commitment::find($deliverable->commitment_id);
        return view('pages.sector.deliverable',compact('deliverable','commitment'));
    }

    public function addKPI(Request $request)
    {
//        return $request;
        $deliverable = Deliverable::find($request->deliverable_id);
        if($deliverable){
            $kpi = new Kpi();
            $kpi->deliverable_id = $request->deliverable_id;
            $kpi->kpi_name = $request->kpi_name;
            $kpi->measurement_unit = $request->measurement_unit;
            $kpi->target = $request->target;
            $kpi->actual_value = $request->actual_value;
            if($kpi->save()){
                return ['status'=>1,'message'=>'KPI added'];
            }else{
                return ['status'=>0,'message'=>'Failed to add KPI'];
            }
        }

        return ['status'=>0,'message'=>'Invalid Deliverable'];
    }
}
