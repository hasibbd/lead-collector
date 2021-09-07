<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\ApplicationForm;
use App\Models\ApplicationRemark;
use App\Models\AppStatus;
use App\Models\Form;
use App\Models\FormField;
use App\Models\User;
use App\Notifications\ForgotRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\DocBlock\Tags\InvalidTag;
use Yajra\DataTables\DataTables;
use function Symfony\Component\Translation\t;

class UserController extends Controller
{
    public function profileUpdate(Request $request){
       if (is_null($request->password)){
           User::where('user_id',$request->user_id)->update([
              'email' => $request->email,
              'name' => $request->name,
           ]);
       }else{
           User::where('user_id',$request->user_id)->update([
               'email' => $request->email,
               'name' => $request->name,
               'password' => Hash::make($request->password),
           ]);
       }
       session([
          'email' => $request->email,
          'name' => $request->name
       ]);
        return response()->json([
            'message' => 'Profile updated successfully'
        ], 200);
    }
    public function application(Request $request){

        $target = FormField::where('form_id',$request->id)->get();
        $app_id = rand(1000000,9999999);
        foreach ($target as $t){
          if ($request->hasFile($t->id)){
              $file = $request->file($t->id);
              $fileEx = $file->getClientOriginalExtension();
              $fileName = date('Ymdhis_').rand(10000,99999).'.'.$fileEx;
              $path = public_path('uploads/files');
              $file->move($path, $fileName);
              $res = $fileName;

          }else{
              $res = $request[$t->id];
          }


          Application::create([
             'user_id' => session('user_id'),
             'app_id' => $app_id,
             'field_id' => $t->id,
             'result' => $res,
          ]);
        }
        if (isset($request->draft)){
            AppStatus::create([
                'app_id' => $app_id,
                'status' => -5
            ]);
        }else{
            AppStatus::create([
                'app_id' => $app_id
            ]);
        }


        return response()->json([
            'message' => 'Application submitted successfully'
        ], 200);
    }
    public function applicationUpdate(Request $request){
        Application::where('app_id',$request->app_id)->delete();
        $target = FormField::where('form_id',$request->id)->get();
        $app_id = $request->app_id;
        foreach ($target as $t){
          if ($request->hasFile($t->id)){
              $file = $request->file($t->id);
              $fileEx = $file->getClientOriginalExtension();
              $fileName = date('Ymdhis_').rand(10000,99999).'.'.$fileEx;
              $path = public_path('uploads/files');
              $file->move($path, $fileName);
              $res = $fileName;
          }else{
              $res = $request[$t->id];
          }


          Application::create([
             'user_id' => session('user_id'),
             'app_id' => $app_id,
             'field_id' => $t->id,
             'result' => $res,
          ]);
        }
        ApplicationRemark::where('app_id',$app_id)->update([
            'status' => 0
        ]);
        if (isset($request->draft)){
            AppStatus::where('app_id',$app_id)->update([
                'status' => 0
            ]);
        }else{
            AppStatus::where('app_id',$app_id)->update([
                'status' => -2
            ]);
        }

        return response()->json([
            'message' => 'Application updated successfully'
        ], 200);
    }
    public function apply($id){
        $fields = DB::table('form_fields as f')
            ->leftJoin('form_types as t','f.type_id','t.id')
            ->select('f.*','t.type')
            ->where('f.form_id',$id)
            ->get();
        return view('user-panel.form', compact('fields'));
    }
    public function editApply($id){
        $fields = DB::table('form_fields as f')
            ->leftJoin('form_types as t','f.type_id','t.id')
            ->leftJoin('applications as a','f.id','a.field_id')
            ->select('f.*','t.type','a.result','a.app_id')
            ->where('a.app_id',$id)
            ->get();
        $remarks = ApplicationRemark::where('app_id',$id)->get();
        return view('user-panel.form-edit', compact('fields','remarks'));
    }
    public function editDraft($id){
        $fields = DB::table('form_fields as f')
            ->leftJoin('form_types as t','f.type_id','t.id')
            ->leftJoin('applications as a','f.id','a.field_id')
            ->select('f.*','t.type','a.result','a.app_id')
            ->where('a.app_id',$id)
            ->get();
        $remarks = ApplicationRemark::where('app_id',$id)->get();
        return view('user-panel.form-draft', compact('fields','remarks'));
    }
    public function profile(){
        $application_type = Form::where('status',1)->latest()->get();
        $application = DB::table('applications as a')
            ->leftJoin('application_remarks as r','a.app_id','r.app_id')
            ->leftJoin('app_statuses as as','a.app_id','as.app_id')
            ->leftJoin('users as u','a.user_id','u.user_id')
            ->leftJoin('form_fields as ff','a.field_id','ff.id')
            ->leftJoin('forms as f','ff.form_id','f.id')
            ->select('f.name','u.email','a.result','a.app_id','a.created_at as ap_date','remarks','as.status as a_status')
            ->where('a.user_id',session('user_id'))
            ->get()->unique('app_id');


        return view('user-panel.profile',compact('application_type','application'));
    }
    public function login(){
        return view('user-panel.login');
    }
    public function register(){
        return view('user-panel.register');
    }
    public function forgot(){
        return view('user-panel.forgot');
    }
     public function recover($token){
        $target = User::where('reset_token',$token)->get();
        if ($target){
            session(['target_email'=>$target[0]->email]);
            return view('user-panel.recover');
        }else{
            session(['target_emal'=> '']);
        }

    }
    public function reset(Request $request){
        $target = User::where('email', session('target_email'))->update([
            'password'=> $request->password,
            'reset_token'=> null,
        ]);

            session(['target_emal'=> '']);
        return response()->json([
            'message' => 'Password reset successfully'
        ],200);

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
            $data = User::select('*')->where('is_admin','!=',1);
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        if ($request->password != $request->c_password){
            return response()->json([
                'message' => 'Password does not matched'
            ],400);
        }
        $target = User::where('email',$request->email)->orWhere('phone',$request->phone)->count();
        if ($target > 0){
            return response()->json([
                'message' => 'You are an user already'
            ],400);
        }
      User::create([
        'user_id' => rand(10000000,99999999),
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'password' => Hash::make($request->password),
        'ip' => $this->getIp(),
        'status' => 1
      ]);
        return response()->json([
            'message' => 'User created successfully'
        ],200);
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
        $target = User::where('email',$request->email)->orWhere('phone',$request->phone)->count();
        if ($target > 1){
            return response()->json([
                'message' => 'Information already used in other users'
            ],400);
        }
        $info = User::where('id',$request->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone
        ]);
        return response()->json([
            'message' => 'User updated successfully',
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
    public function forget(Request $request){
        $token = Str::random(32);
        $target =User::where('email',$request->email)->update([
           'reset_token' => $token
        ]);
        (new User)->forceFill([
            'email' => $request->email,
        ])->notify(new ForgotRequest($token));
    }
}
