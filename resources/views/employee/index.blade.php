@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Employees') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="add_buttons">
                        <a href="{{route('employee.create')}}" class="btn btn-primary">Create New</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Company</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $k => $employee)
                                    <tr>
                                        <th>{{$k + 1}}</th>
                                        <th>{{$employee->first_name}} {{$employee->last_name}}</th>
                                        <th>{{$employee->email}}</th>
                                        <th>{{ $employee->phone }}</th>
                                        <th>{{$employee->company ? $employee->company->name : ''}}</th>
                                        <th>
                                            <td style="display: flex;">
                                                <a href="" id="editemployee" class="employee_modal btn btn-warning" data-toggle="modal" data-target='#employeeEditModal' data-id="{{ $employee->id }}">Edit</a>
                                                <form action="{{ route('employee.delete',$employee->id) }}" method="get">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger"
                                                            onclick="return confirm('Are you sure?');">Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </th>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="push-to-right">
                          {{ $employees->links() }}
                        </div>
                        {{-- modal for edit employee  --}}
                        <div class="modal fade" id="employeeEditModal">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title">Edit employee Info</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="add-employee">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script>
        $(document).on('click', '.employee_modal', function() {
            var id = $(this).attr('data-id');
            $.get('employees/edit/'+id, function(data){
                $('#employeeEditModal').find('.add-employee').first().html(data);
            });
        });
    </script>
@endsection
