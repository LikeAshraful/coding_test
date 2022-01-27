<form class="m-t-40" action="{{ route('employee.update', $employee->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="form-group col-md-6">
            <label>First Name</label>
            <input type="text" name="f_name" value="{{$employee->first_name}}" class="form-control form-control-line" placeholder="First Name" required>
        </div>
        <div class="form-group col-md-6">
            <label>Last Name</label>
            <input type="text" name="l_name" value="{{$employee->last_name}}" class="form-control form-control-line" placeholder="Last Name" required>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-6">
            <label>Email</label>
            <input type="email" name="email" value="{{$employee->email}}" class="form-control form-control-line"
                placeholder="Email">
        </div>

        <div class="form-group col-md-6">
            <label>Phone No</label>
            <input type="text" name="phone_no" value="{{$employee->phone}}" class="form-control form-control-line"
                placeholder="Phone No">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-6">
            <label for="company">Select Company</label>
            <select name="company" id="company"  class="form-control form-control-line">
                @foreach ($companies as $company)
                    <option value="{{$company->id}}" {{$company->id == $employee->company_id ? 'selected' : '' }}>{{$company->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group col-md-6">
            <label>Password</label>
            <input type="password" name="password"  class="form-control form-control-line"
                placeholder="Password">
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
