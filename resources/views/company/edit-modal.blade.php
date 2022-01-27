<form class="m-t-40" action="{{ route('company.update', $company->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="form-group col-md-6">
            <label>Name</label>
            <input type="text" name="name" value="{{$company->name}}" class="form-control form-control-line" placeholder="Name" required>
        </div>
        <div class="form-group col-md-6">
            <label>Email</label>
            <input type="email" name="email" value="{{$company->email}}" class="form-control form-control-line"
                placeholder="Email">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-sm-6">
            <label>Logo</label>
            <span style="font-size: 13px">(minimum size 100x100)</span>
            <input type="file" name="logo" class="form-control form-control-line" value="{{ old('logo') }}">
            @if($company->logo)
                <img src="{{ asset('/storage/' . $company->logo) }}" style="width: 50px;">
            @endif
        </div>

        <div class="form-group col-md-6">
            <label>Website</label>
            <input type="url" name="website" value="{{$company->website}}" class="form-control form-control-line"
                placeholder="Website">
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
