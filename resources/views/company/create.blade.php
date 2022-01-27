@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('New Company') }}</div>

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
                    <form class="m-t-40" action="{{ route('company.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Name</label>
                                <input type="text" name="name" value="" class="form-control form-control-line" placeholder="Name" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Email</label>
                                <input type="email" name="email" value="" class="form-control form-control-line"
                                    placeholder="Email">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label>Logo</label>
                                <span style="font-size: 13px">(minimum size 100x100)</span>
                                <input type="file" name="logo" class="form-control form-control-line" value="{{ old('logo') }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label>Website</label>
                                <input type="url" name="website" value="" class="form-control form-control-line"
                                    placeholder="Website">
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
