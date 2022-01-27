@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('New Employee') }}</div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form class="m-t-40" action="{{ route('employee.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>First Name</label>
                                <input type="text" name="f_name" value="" class="form-control form-control-line" placeholder="First Name" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Last Name</label>
                                <input type="text" name="l_name" value="" class="form-control form-control-line" placeholder="Last Name" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Email</label>
                                <input type="email" name="email" value="" class="form-control form-control-line"
                                    placeholder="Email">
                            </div>

                            <div class="form-group col-md-6">
                                <label>Phone No</label>
                                <input type="text" name="phone_no" value="" class="form-control form-control-line"
                                    placeholder="Phone Number">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="company">Select Company</label>
                                <select name="company" id="company"  class="form-control form-control-line">
                                    @foreach ($companies as $company)
                                        <option value="{{$company->id}}">{{$company->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Password</label>
                                <input type="password" name="password" value="" class="form-control form-control-line"
                                    placeholder="Password">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
