@extends('admin.layouts.general')

@section('content')

<div class="row g-3 mb-4 align-items-center justify-content-between">
    <div class="col-auto">
        <h1 class="app-page-title mb-0">Additional Reports</h1>
    </div>
    <div class="col-auto">
        <div class="page-utilities">
            <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                <div class="col-auto">
                    <a class="btn app-btn-secondary" href="/admin/export?d=addreport" target="_blank">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-download me-1"
                            fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                            <path fill-rule="evenodd"
                                d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                        </svg>
                        Download Excel
                    </a>
                </div>
                <div class="col-auto">
                    <a class="btn app-btn-secondary" data-bs-toggle="modal" data-bs-target="#add">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-square" viewBox="0 0 16 16">
                            <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                          </svg>
                        New Additional Report
                    </a>
                </div>
            </div>
            <!--//row-->
        </div>
        <!--//table-utilities-->
    </div>
    <!--//col-auto-->
</div>

<!-- Modal -->
<div class="modal fade" id="add" tabindex="-1" aria-labelledby="add" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Additonal Report</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="post" action="/admin/reports/add">
                @csrf
            <div class="form-group row">
                <label for="date" class="col-3">Date</label>
                <div class="col-9">
                    <input type="text" class="form-control" id="date" name="date">
                </div>
            </div>
            <div class="form-group row mt-2">
                <label for="type" class="col-3">Type</label>
                <div class="col-9">
                    <select name="type" id="type" class="form-control">
                        <option value="in">Incoming</option>
                        <option value="out">Outcoming</option>
                    </select>
                </div>
            </div>
            <div class="form-group row mt-2">
                <label for="amount" class="col-3">Amount</label>
                <div class="col-9">
                    <input type="number" class="form-control" id="amount" name="amount">
                </div>
            </div>
            <div class="form-group row mt-2">
                <label for="description" class="col-3">Description</label>
                <div class="col-9">
                    <textarea name="description" id="description" style="height:100px;" class="form-control"></textarea>
                </div>
            </div>

        </div>
        <div class="form-group m-2 row">
            <div class="col-8 mx-auto">
            <button type="submit" class="btn app-btn-primary w-100">Save</button>
        </div>
        </div>
        </form>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        
        </div>
      </div>
    </div>
  </div>


<div class="card mt-4">
    <div class="card-header">
       <div class="d-flex">
        <h4>All Additional Reports</h4>
       </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover datatable">
                <thead>
                    <th>Date</th>
                    <th>Type</th>
                    <th>Amount</th>
                    <th>Description</th>
                    <th>Added By</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    @foreach($reports as $u)
                    <tr>
                        <td>{{$u->date}}</td>
                        <td>@if($u->type == 'in') <span class="badge badge-success">INCOMING</span> @else <span class="badge badge-danger">OUTCOMING</span>@endif</td>
                        <td>{{rupiah($u->amount)}}</td>
                        <td>{{$u->description}}</td> 
                        <td>{{$u->add_by}}</td>
                        <td>
                            <a href="#edit_{{$u->id}}" data-bs-toggle="modal" data-bs-target="#edit_{{$u->id}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                            <a href="/admin/reports/{{$u->id}}/delete" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>


                    <!-- Modal -->
<div class="modal fade" id="edit_{{$u->id}}" tabindex="-1" aria-labelledby="edit_{{$u->id}}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Additonal Report Edit</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="post" action="/admin/reports/{{$u->id}}/edit">
                @csrf
            <div class="form-group row">
                <label for="date" class="col-3">Date</label>
                <div class="col-9">
                    <input type="date" class="form-control" id="date" name="date" value="{{$u->date}}">
                </div>
            </div>
            <div class="form-group row mt-2">
                <label for="type" class="col-3">Type</label>
                <div class="col-9">
                    <select name="type" id="type" class="form-control">
                        <option value="in" @if($u->type == 'in') selected @endif >Incoming</option>
                        <option value="out" @if($u->type == 'out') selected @endif>Outcoming</option>
                    </select>
                </div>
            </div>
            <div class="form-group row mt-2">
                <label for="amount" class="col-3">Amount</label>
                <div class="col-9">
                    <input type="number" class="form-control" id="amount" name="amount" value="{{$u->amount}}">
                </div>
            </div>
            <div class="form-group row mt-2">
                <label for="description" class="col-3">Description</label>
                <div class="col-9">
                    <textarea name="description" id="description" style="height:100px;" class="form-control summernote">{{$u->description}}</textarea>
                </div>
            </div>

        </div>
        <div class="form-group m-2 row">
            <div class="col-8 mx-auto">
            <button type="submit" class="btn app-btn-primary w-100">Save</button>
        </div>
        </div>
        </form>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        
        </div>
      </div>
    </div>
  </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@section('js')
<script 
<script>
    $(document).ready(function()
    {
        $('#date').datepicker({
            format:'d-mm-yyyy',
            autoclose:true
        });
    });
</script>
@endsection
@section('css')
<link rel="stylesheet" href="{{asset('assets/css/bootstrap-datepicker.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/jquery.timepicker.css')}}">
@endsection