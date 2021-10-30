@extends('layouts.app')
@section('content')
<div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h6>Employees List table</h6>
            <a href="{{url('employee/create')}}" class="font-weight-bold text-xs pull-right btn bg-gradient-info" style="float:right" data-toggle="tooltip" data-original-title="Edit user">
              Create New
            </a>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Employee Name</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Email</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Employed</th>
                    <th colspan="4" class="text-secondary opacity-7"></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($employees as $employee_detail)
                  <tr>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div>
                          <img src="<?php if($employee_detail->logo!=null) { echo asset('storage/images/'.$employee_detail->logo); } else { echo asset('storage/images/test.jpg'); }?>" class="avatar avatar-sm me-3" alt="user1">
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm">{{$employee_detail->fname." ".$employee_detail->lname}}</h6>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0">{{$employee_detail->email}}</p>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span class="badge badge-sm <?php if($employee_detail->status=="Active") { echo "bg-gradient-success";} else { echo "bg-gradient-secondary"; }  ?>">{{$employee_detail->status}}</span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">{{date("d-m-Y",strtotime($employee_detail->created_at))}}</span>
                    </td>
                    <td colspan="2">
                      <a class="text-secondary font-weight-bold text-xs" href="{{route('employee.edit',$employee_detail->id)}}">Edit</a>
                    </td>  
                  <td colspan="1">
                      <form action="{{ route('employee.destroy', $employee_detail->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="_method" value="DELETE" />
                        <button type="submit" class="text-secondary font-weight-bold text-xs">Delete</button>
                        </form>
                      {{-- <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                        Delete
                      </a> --}}
                    </td> 
                  </tr>
                  @endforeach
                </tbody>
              </table>
              <div class="pull-right" style="float: right;">
                {{ $employees->links('vendor.pagination.bootstrap-4')}}
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <style>
    button, input[type="submit"], input[type="reset"] {
	background: none;
	color: inherit;
	border: none;
	padding: 0;
	font: inherit;
	cursor: pointer;
	outline: inherit;
}
  </style>
  <script>
    document.onsubmit=function(){
        return confirm('Sure?');
    }
</script>
  @endsection