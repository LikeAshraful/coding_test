@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Companies') }}</div>

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
                        <a href="{{route('company.create')}}" class="btn btn-primary">Create New</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Logo</th>
                                <th>Website</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($companies as $k => $company)
                                    <tr>
                                        <th>{{$k + 1}}</th>
                                        <th>{{$company->name}}</th>
                                        <th>{{$company->email}}</th>
                                        <th>
                                            <img src="{{ asset('/storage/' . $company->logo) }}" style="width: 50px;">
                                        </th>
                                        <th>{{$company->website}}</th>
                                        <th>
                                            <td style="display: flex;">
                                                <a href="" id="editCompany" class="company_modal btn btn-warning" data-toggle="modal" data-target='#companyEditModal' data-id="{{ $company->id }}">Edit</a>
                                                <form action="{{ route('company.delete',$company->id) }}" method="get">
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
                          {{ $companies->links() }}
                        </div>
                        {{-- modal for edit company  --}}
                        <div class="modal fade" id="companyEditModal">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title">Edit Company Info</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="add-company">

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
        $(document).on('click', '.company_modal', function() {
            var id = $(this).attr('data-id');
            $.get('companies/edit/'+id, function(data){
                $('#companyEditModal').find('.add-company').first().html(data);
            });
        });
    </script>
@endsection
