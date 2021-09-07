<?php

namespace App\Http\Controllers;

use App\Models\ApplicationRemark;
use App\Models\AppStatus;
use App\Models\Form;
use App\Models\FormField;
use App\Models\ManSha;
use App\Models\User;
use App\Notifications\EditRequestUser;
use App\Notifications\ManShaCreate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class DashboardController extends Controller
{
    public function Login(){
        return view('user-panel.login');

    }

    public function admin(){
        session([
            'page' => 'dashboard',
            'sub' => 'dashboard'
        ]);
        $users = User::all();
        $forms = Form::all();
        $apps = AppStatus::all();
        return view('pages.dashboard.index', compact('users','forms','apps'));
    }
    public function lab(){

    }
    public function reception(){


    }
    public function LogOut(){
        session()->flush();
        return redirect()->route('/')->with('msg','<div class="alert alert-primary" id="alert">
                            <button type="button" class="close" data-dismiss="alert">x</button>
                            <strong>Thank You! </strong> See you soon...
                        </div>');
    }

    public function ManSha(Request $request){
      $user = ManSha::create([
        'app_id' => $request->id,
        'name' => $request->name,
        'email' => $request->email,
        'type' => $request->type,
        'status' => 'pending',
       ]);
        $user->notify(new ManShaCreate($this->encode_personal_link($request->email)));
        return response()->json([
            'message' => 'Face verification link sent'
        ],200);
    }

    public function storeRemark(Request $request){
      $st =    ApplicationRemark::create([
            'app_id' => $request->id,
            'status' => -1,
            'remarks' => $request->remark
        ]);
        AppStatus::where('app_id',$request->id)->update([
            'status' => -1
        ]);
        $application = DB::table('applications as a')
            ->leftJoin('users as u','a.user_id','u.user_id')
            ->where('app_id',$request->id)
            ->select('u.email')
            ->first()->email;
        (new User)->forceFill([
            'email' => $application,
        ])->notify(new EditRequestUser($st));
        return response()->json([
            'remarks' => $st,
            'message' => 'Remark/Note Created'
        ]);
    }
    public static function encode_personal_link($email)
    {
        $yourPassbaseLink = "https://verify.passbase.com/user-id-check";

        $hash_map = array(
            'prefill_attributes' => array(
                'email' => $email,
                'country' => 'de'
            ),
        );

        $encodedAttributes = base64_encode(json_encode($hash_map));
        $encodedLink = $yourPassbaseLink."?p=".$encodedAttributes;
        return $encodedLink;
    }
    public function test(){
        $fields = DB::table('form_fields as f')
                 ->leftJoin('form_types as t','f.type_id','t.id')
                 ->select('f.*','t.type')
                 ->get();

        $t = [
            'Cats' => ['leopard' => 'Leopard'],
            'Dogs' => ['spaniel' => 'Spaniel'],
        ];
       // dd($t);
        return view('pages.form.test', compact('fields'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('user-panel.login');
        /*session([
            'page' => 'dashboard',
            'sub' => 'dashboard'
        ]);
        $users = User::all();
        $forms = Form::all();
        return view('pages.dashboard.index', compact('users','forms'));*/
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function applicationGet($app_id){
        $application = DB::table('forms as ff')
            ->leftJoin('form_fields as f','ff.id','f.form_id')
            ->leftJoin('form_types as t','f.type_id','t.id')
            ->leftJoin('applications as a','f.id','a.field_id')
            ->select(
                'form_id','a.app_id','type_id','label','ff.name as form_name','result','type'
            )
            ->where('a.app_id',$app_id)
            ->get();
        $remarks = ApplicationRemark::where('app_id',$app_id)->get();

        $st = AppStatus::where('app_id',$app_id)->first();

        $mansha = ManSha::where('app_id', $app_id)->get();
       return response()->json([
           'application_id' => $app_id,
           'manager' => $mansha->where('type',1),
           'share' => $mansha->where('type',2),
           'application_name' => $application[0]->form_name,
           'application_status' => $st->status,
           'results' => $application,
           'remarks' => $remarks,
       ],200);
    }
    public function applicationList(Request $request)
    {
        session([
            'page' => 'application',
            'sub' => 'application'
        ]);
        if ($request->ajax()) {
            $application = DB::table('applications as a')
                ->leftJoin('application_remarks as r','a.app_id','r.app_id')
                ->leftJoin('app_statuses as as','a.app_id','as.app_id')
                ->leftJoin('users as u','a.user_id','u.user_id')
                ->leftJoin('form_fields as ff','a.field_id','ff.id')
                ->leftJoin('forms as f','ff.form_id','f.id')
                ->select('f.name','u.email','a.result','a.app_id','a.created_at as ap_date','remarks','as.status as a_status')
                ->where('as.status','!=','-5')
                ->get()
                ->unique('app_id');

            $data = $application;
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function($data){
                    if ($data->a_status == 1){
                        $btn = '<button type="button" class="btn btn-sm btn-success">Approved</button>';

                    }elseif ($data->a_status == 0){
                        $btn = '<button type="button" class="btn btn-sm btn-primary">New</button>';
                    }
                    elseif ($data->a_status == -2){
                        $btn = '<button type="button" class="btn btn-sm btn-primary">Updated</button>';
                    }
                    else{
                        $btn = '<button type="button" class="btn btn-sm btn-warning">Edit Request</button>';

                    }

                    return $btn;
                })
                ->rawColumns(['status'])
                ->addColumn('action', function($data){

                    $btn = '<button class="edit btn btn-primary btn-sm" onclick="appView('.$data->app_id.')" >View</button>';

                    return $btn;
                })
                ->rawColumns(['action','status'])
                ->make(true);
        }

        return view('pages.application.index');
    }


}
