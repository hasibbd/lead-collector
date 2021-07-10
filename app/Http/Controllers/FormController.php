<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\FormField;
use App\Models\FormType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class FormController extends Controller
{
    public function fieldStore(Request $request){
       FormField::create([
         'form_id' => $request->id,
           'type_id' => $request->type,
           'label' => $request->label,
           'name' => strtolower(str_replace(' ', '_', $request->label)),
           'option' => $request->option,
       ]);
        return response()->json([
            'message' => 'Field Created Successfully'
        ],200);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request)
    {
        session([
            'page' => 'form',
            'sub' => 'form'
        ]);
        if ($request->ajax()) {
            $data = Form::select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function($data){
                    if ($data->status == 1){
                        $btn = '<button type="button" class="btn btn-sm btn-success">Enable</button>';

                    }else{
                        $btn = '<button type="button" class="btn  btn-sm btn-danger">Disable</button>';
                    }

                    return $btn;
                })
                ->addColumn('action', function($data){

                    $btn = '<button class="edit btn btn-primary btn-sm" onclick="form_status('.$data->id.')">Status</button>
                            <a href="'.url('field/'.$data->id).'" class="edit btn btn-warning btn-sm">Fields</a>
                           <button class="edit btn btn-warning btn-sm" onclick="form_edit('.$data->id.')">Edit</button>
                           <button class="edit btn btn-danger btn-sm" onclick="form_delete('.$data->id.')">Delete</button>';

                    return $btn;
                })
                ->rawColumns(['action','status'])
                ->make(true);
        }

        return view('pages.form.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        Form::create([
            'type' => strtolower($request->type),
        ]);
        return response()->json([
            'message' => 'Type Created Successfully'
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $info = Form::where('id',$id)->first();
        return response()->json([
            'message' => 'Type fetched successfully',
            'info' => $info
        ],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $target = Form::where('id',$id)->first();
        $info = Form::where('id',$id)->update([
            'status' => !$target->status
        ]);
        return response()->json([
            'message' => 'Type status updated successfully',
        ],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $info = Form::where('id',$request->id)->update([
            'name' => $request->name
        ]);
        return response()->json([
            'message' => 'Type updated successfully',
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $info = Form::destroy($id);
        return response()->json([
            'message' => 'Type deleted successfully',
        ],200);
    }
    public function destroyField($id)
    {
        $info = FormField::destroy((int)$id);
        return response()->json([
            'message' => 'Field deleted successfully',
        ],200);
    }
    public function field($id){


        $fields = DB::table('form_fields as f')
                    ->leftJoin('form_types as t','f.type_id','t.id')
                    ->where('form_id',$id)
                    ->select('f.*','t.type')
                    ->get();

        $types = FormType::all();
        return view('pages.form.field', compact('fields','types','id'));

    }
}
