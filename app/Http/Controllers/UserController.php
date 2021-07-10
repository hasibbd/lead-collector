<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function login(){
        return view('user-panel.login');
    }
    public function register(){
        return view('user-panel.register');
    }
    public function forgot(){
        return view('user-panel.forgot');
    }
     public function recover(){
        return view('user-panel.recover');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        session([
           'page' => 'user',
           'sub' => 'user'
        ]);
        if ($request->ajax()) {
            $data = User::select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function($data){
                    if ($data->status == 1){
                        $btn = '<button type="button" class="btn btn-sm btn-success">Active</button>';

                    }else{
                        $btn = '<button type="button" class="btn btn-sm btn-danger">Disabled</button>';

                    }

                    return $btn;
                })
                ->addColumn('action', function($data){

                    $btn = '<button class="edit btn btn-primary btn-sm " onclick="user_status('.$data->id.')" >Status</button> <button class="edit btn btn-warning btn-sm" onclick="user_edit('.$data->id.')" >Edit</button>';

                    return $btn;
                })
                ->rawColumns(['action','status'])
                ->make(true);
        }

        return view('pages.user.index');
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       dd($this->getIp());
    }
    public function getIp(){
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
            if (array_key_exists($key, $_SERVER) === true){
                foreach (explode(',', $_SERVER[$key]) as $ip){
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                        return $ip;
                    }
                }
            }
        }
        return request()->ip(); // it will return server ip when no client ip found
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $info = User::where('id',$id)->first();
        return response()->json([
            'message' => 'User fetched successfully',
            'info' => $info
        ],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id)
    {
        $target = User::where('id',$id)->first();
        $info = User::where('id',$id)->update([
            'status' => !$target->status
        ]);
        return response()->json([
            'message' => 'User status updated successfully',
        ],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $info = User::where('id',$request->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone
        ]);
        return response()->json([
            'message' => 'user updated successfully',
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
        $info = User::destroy($id);
        return response()->json([
            'message' => 'User deleted successfully',
        ],200);
    }
}
