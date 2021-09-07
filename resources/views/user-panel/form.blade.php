<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | User Profile</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <!--Toaster-->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
</head>
<body class="hold-transition sidebar-mini">
<!-- Main content -->
<div class="container py-3">
   <div class="row">
       <div class="col-8 offset-2">
           <div class="card">
               <div class="card-header">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title">{{\App\Models\Form::where('id',$fields[0]->form_id)->first()->name}}</h5>
                    </div>
                    <div class="col text-right">
                        <a href="{{url('profile')}}" class="btn btn-primary">Back to profile</a>
                    </div>
                </div>
               </div>
               <div class="card-body">
                   <section class="content">
                       <div class="container-fluid">
                           <div class="row">
                               <div class="col">
                                   {!! Form::open(['url' => 'application','files' => true,'id'=>'app_submit']) !!}
                                   {!! Form::hidden('id', $fields[0]->form_id); !!}
                                   @foreach($fields as $f)

                                       @switch($f->type)
                                           @case('textarea')
                                           {!!  Form::label($f->name, $f->label); !!}
                                           {!! Form::textarea($f->id,null,['class'=>'form-control', 'rows' => 4, 'cols' => 40]) !!}
                                           <br>

                                           @break
                                           @case('text')
                                           {!!  Form::label($f->name, $f->label); !!}
                                           {!! Form::text($f->id, null,['class' => 'form-control']); !!}
                                           @break
                                           @case('password')
                                           {!!  Form::label($f->name, $f->label); !!}
                                           {!! Form::password($f->id, ['class' => 'form-control']); !!}
                                           @break
                                           @case('radio')
                                           {!!  Form::label($f->name, $f->label); !!}
                                           <?php
                                           $tring = explode (",", $f->option);
                                           echo '<br>';
                                           foreach ($tring as $t){
                                               echo  Form::radio($f->id, $t).' '.Form::label($f->name, $t);
                                               echo '<br>';
                                           }
                                           ?>
                                           @break
                                           @case('checkbox')
                                           {!!  Form::label($f->name, $f->label); !!}
                                           <?php
                                           $tring = explode (",", $f->option);
                                           echo '<br>';
                                           foreach ($tring as $t){
                                               echo  Form::checkbox($f->id, $t).' '.Form::label($f->name, $t);
                                               echo '<br>';
                                           }
                                           ?>
                                           @break
                                           @case('file')
                                           <br>
                                           {!!  Form::label($f->name, $f->label); !!}
                                           <br>
                                           {!! Form::file($f->id); !!}
                                           <br>
                                           @break
                                           @case('select')
                                           {!!  Form::label($f->name, $f->label); !!}
                                           <?php
                                           $tring = explode (",", $f->option);
                                           $info =[];
                                           foreach ($tring as $t){
                                               $info[$t] = $t;
                                           }
                                           ?>

                                           {!! Form::select($f->id, $info, null,  ['class' => 'form-control']); !!}
                                           @break
                                           @case('email')
                                           {!!  Form::label($f->name, $f->label); !!}
                                           {!! Form::email($f->id,  null, ['class' => 'form-control']); !!}
                                           @break
                                           @case('number')
                                           {!!  Form::label($f->name, $f->label); !!}
                                           {!! Form::number($f->id,null, ['class' => 'form-control']); !!}
                                           @break
                                           @case('date')
                                           {!!  Form::label($f->name, $f->label); !!}
                                           {!! Form::date($f->id,null, ['class' => 'form-control']); !!}

                                           @break
                                           @case('note')
                                             <h5 class="display-5">{{$f->label}}</h5>
                                             <p class="lead text-justify">{{$f->option}}</p>
                                           @break
                                       @endswitch
                                   @endforeach
                                   <br>
                                   {!! Form::checkbox('draft', 'yes', false) !!}  {!!  Form::label('draft', 'Save as a draft') !!}
                                   <div class="text-right">
                                       <button class="btn btn-primary mt-3" type="submit">Save</button>
                                   </div>
                                   {!! Form::close() !!}
                               </div>
                           </div>
                       </div>
                   </section>
               </div>
           </div>
       </div>
   </div>
</div>
<!-- ./wrapper -->
<!-- Button trigger modal -->



<!-- jQuery -->
<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
<!--Toaster-->
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist/js/demo.js')}}"></script>
<script src="{{asset('custom/js/store.js')}}"></script>
</body>
</html>
