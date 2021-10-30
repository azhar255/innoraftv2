@extends('layouts.app')
@section('content')
<div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h6>Companies List</h6>
            <a href="{{url('company/create')}}" class="font-weight-bold text-xs pull-right btn bg-gradient-info" style="float:right" data-toggle="tooltip" data-original-title="Edit user">
              Create New
            </a>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Company Name</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Website</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created At</th>
                    <th colspan="4" class="text-secondary opacity-7"></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($company as $company_list)
                  <tr>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div>
                          <img src="<?php if($company_list->logo!=null) { echo asset('storage/images/'.$company_list->logo); } else { echo asset('storage/images/test.jpg'); }?>" class="avatar avatar-sm me-3" alt="user1">
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm">{{$company_list->name}}</h6>
                          <p class="text-xs text-secondary mb-0">{{$company_list->email}}</p>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0">{{$company_list->website}}</p>
                      {{-- <p class="text-xs text-secondary mb-0">Organization</p> --}}
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span class="badge badge-sm <?php if($company_list->status=="Active") { echo "bg-gradient-success";} else { echo "bg-gradient-secondary"; }  ?>">{{$company_list->status}}</span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">{{date("d-m-Y",strtotime($company_list->created_at))}}</span>
                    </td>
                    <td colspan="2" class="align-middle">
                      <a href="{{route('company.edit',$company_list->id)}}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                        Edit
                      </a> 
                      </td>
                      <td colspan="1" class="align-middle">
                      <form action="{{ route('company.destroy', $company_list->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="_method" value="DELETE" />
                        <button type="submit" class="text-secondary font-weight-bold text-xs">Delete</button>
                        </form>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              <div class="pull-right" style="float: right;">
                {{ $company->links('vendor.pagination.bootstrap-4')}}
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endsection
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