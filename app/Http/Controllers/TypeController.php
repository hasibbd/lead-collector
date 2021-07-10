<?php

namespace App\Http\Controllers;

use App\Models\FormType;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        session([
            'page' => 'type',
            'sub' => 'type'
        ]);
        if ($request->ajax()) {
            $data = FormType::select('*');
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

                    $btn = '<button class="edit btn btn-primary btn-sm" onclick="type_status('.$data->id.')">Status</button>
                           <button class="edit btn btn-warning btn-sm" onclick="type_edit('.$data->id.')">Edit</button>
                           <button class="edit btn btn-danger btn-sm" onclick="type_delete('.$data->id.')">Delete</button>';

                    return $btn;
                })
                ->rawColumns(['action','status'])
                ->make(true);
        }

        return view('pages.type.index');
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
       FormType::create([
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
       $info = FormType::where('id',$id)->first();
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
        $target = FormType::where('id',$id)->first();
        $info = FormType::where('id',$id)->update([
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
        $info = FormType::where('id',$request->id)->update([
            'type' => $request->type
        ]);
        return response()->json([
            'message' => 'Type updated successfully',
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $info = FormType::destroy($id);
        return response()->json([
            'message' => 'Type deleted successfully',
        ],200);
    }
}
