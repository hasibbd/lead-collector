@extends('app.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Form</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Form</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-6">
                        {!! Form::open(['url' => 'test/add']) !!}
                        {!! Form::token(); !!}
                        @foreach($fields as $f)

                        @switch($f->type)
                            @case('textarea')
                                {!!  Form::label($f->name, $f->label); !!}
                                {!! Form::textarea('placeOfDeath',null,['class'=>'form-control', 'rows' => 4, 'cols' => 40]) !!}
                                <br>

                                @break
                            @case('text')
                                {!!  Form::label($f->name, $f->label); !!}
                            {!! Form::text($f->name, null,['class' => 'form-control']); !!}
                            @break
                            @case('password')
                                {!!  Form::label($f->name, $f->label); !!}
                            {!! Form::password($f->name, ['class' => 'form-control']); !!}
                            @break
                            @case('radio')
                                {!!  Form::label($f->name, $f->label); !!}
                            <?php
                                $tring = explode (",", $f->option);
                                echo '<br>';
                                foreach ($tring as $t){
                                    echo  Form::radio($f->name, $t).' '.Form::label($f->name, $t);
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
                                    echo  Form::checkbox($f->name, $t).' '.Form::label($f->name, $t);
                                    echo '<br>';
                                }
                                ?>
                            @break
                            @case('file')
                                <br>
                                {!!  Form::label($f->name, $f->label); !!}
                                <br>
                            {!! Form::file($f->name); !!}
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

                            {!! Form::select($f->name, $info, null,  ['class' => 'form-control']); !!}
                            @break
                            @case('email')
                                {!!  Form::label($f->name, $f->label); !!}
                            {!! Form::email($f->name,  null, ['class' => 'form-control']); !!}
                            @break
                            @case('number')
                                {!!  Form::label($f->name, $f->label); !!}
                            {!! Form::number($f->name,null, ['class' => 'form-control']); !!}
                            @break
                            @case('date')
                                {!!  Form::label($f->name, $f->label); !!}
                            {!! Form::date($f->name,null, ['class' => 'form-control']); !!}

                            @break
                        @endswitch
                        @endforeach
                        <button class="btn btn-primary" type="submit">Save</button>
                        {!! Form::close() !!}

                    </div>
                    </div>
                </div>
        </section>
        <!-- /.content -->
    </div>
@endsection
