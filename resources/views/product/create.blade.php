@extends('layouts.app', ['title' => __('Categories')])

@section('content')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Category Management') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('category.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('product.store') }}" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            
                            <h6 class="heading-small text-muted mb-4">{{ __('Category information') }}</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                    <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-description">{{ __('Description') }}</label>
                                    <input type="text" name="description" id="input-description" class="form-control form-control-alternative{{ $errors->has('description') ? ' is-invalid' : '' }}" placeholder="{{ __('Description') }}" value="{{ old('Description') }}" required>

                                    @if ($errors->has('description'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('price') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-price">{{ __('Price') }}</label>
                                    <input type="number" name="price" id="input-price" class="form-control form-control-alternative{{ $errors->has('price') ? ' is-invalid' : '' }}" placeholder="{{ __('Price') }}" value="{{ old('Price') }}" required>

                                    @if ($errors->has('price'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('price') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('image_url') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-image_url">{{ __('Image') }}</label>
                                    <input type="file" name="image_url" id="input-image_url" class="form-control form-control-alternative{{ $errors->has('image_url') ? ' is-invalid' : '' }}" placeholder="{{ __('Image') }}" value="{{ old('Image') }}" required>

                                    @if ($errors->has('image_url'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('image_url') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('category_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-category_id">{{ __('Parent Category') }}</label>
                                    <select name="category_id" id="input-category_id" class="form-control form-control-alternative{{ $errors->has('category_id') ? ' is-invalid' : '' }}" placeholder="{{ __('Parent Category') }}" value="{{ old('category_id') }}">
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('category_id'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('category_id') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        @include('layouts.footers.auth')
    </div>
@endsection