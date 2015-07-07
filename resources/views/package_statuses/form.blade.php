@extends('layouts.admin.model.form')

@section('icon', 'info-circle')

@section('title')
    {{ $status->id ? 'Edit' : 'Create' }} Package Status
@stop

@section('subtitle')
    <ol class="breadcrumb">
        <li>
            <a href="/package-statuses">Package Statuses</a>
        </li>
        <li class="active">
            <strong>{{ $status->id ? 'Edit' : 'Create' }}</strong>
        </li>
    </ol>
@stop

@section('form')
    <form data-parsley-validate action="/package-statuses/{{ ($status->id) ? 'update/' . $status->id : 'store' }}" method="post" class="form-horizontal">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="company_id" value="{{ ($status->id) ? $status->company_id : Auth::user()->company_id }}">
        <div class="form-group">
            <label class="control-label col-sm-2">Name</label>
            <div class="col-sm-4">
                <input required type="text" name="name" placeholder="e.g. Processing" class="form-control" value="{{ Input::old('name', $status->name) }}">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-4 col-sm-offset-2">
                <a class="btn btn-white" href="/package-statuses">Cancel</a>
                <button class="btn btn-primary" type="submit">Save changes</button>
            </div>
        </div>
    </form>
@stop
