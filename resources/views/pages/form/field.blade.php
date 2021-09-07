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
                    <div class="col-12">
                        <div class="card">
                             <div class="card-header">
                                <form id="field_submit">
                                <div class="row">
                                    <div class="col-2">
                                        <label for="inlineFormCustomSelectPref">Type</label>
                                        <input type="hidden" name="id" value="{{$id}}">
                                        <select class="custom-select" id="type" name="type" required>
                                            <option selected disabled>Choose...</option>
                                           @foreach($types as $t)
                                            <option value="{{$t->id}}">{{strtoupper($t->type)}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <label for="name">Label Name</label>
                                        <input type="text" id="label" name="label" class="form-control" placeholder="Field Label Name" required>
                                    </div>
                                    <div class="col-7">
                                        <label for="option">Option/Note Details</label>
                                        <input type="text" id="option" name="option" class="form-control" placeholder="Option will be comma separated">
                                    </div>

                                    </div>
                                <div class="row pt-1">
                                    <div class="col text-right">
                                        <button type="submit" class="btn btn-sm btn-primary">Add</button>
                                    </div>
                                </div>
                                </form>
                             </div>
                            <div class="card-body">
                               <div class="table-field">
                                   <table class="table table-bordered table-responsive-sm w-100  table-sm" id="field_list">
                                       <thead>
                                       <tr>
                                           <th>Type</th>
                                           <th>Label</th>
                                           <th>Name</th>
                                           <th width="400px">Option</th>
                                           <th width="150px">Action</th>
                                       </tr>
                                       </thead>
                                       <tbody>
                                       @foreach($fields as $f)
                                           <tr>
                                               <td>{{$f->type}}</td>
                                               <td>{{$f->label}}</td>
                                               <td>{{$f->name}}</td>
                                               <td>{{$f->option}}</td>
                                               <td>
                                                   <button class="btn btn-sm btn-danger" onclick="removeField({{$f->id}})">Remove</button>
                                                   <button class="btn btn-sm btn-warning" onclick="editField({{ json_encode($f, true)}})">Edit</button>
                                               </td>
                                           </tr>
                                       @endforeach
                                       </tbody>
                                   </table>
                               </div>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
        </section>
        <!-- /.content -->
    </div>
    @include('.pages.form.f-modal')
@endsection
