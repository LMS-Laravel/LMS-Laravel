@extends('layouts.master')

@section('content')
<div class="col-md-12">
    {{ Form::open(['url' => route('course.update', $course->id), 'method' => 'PUT']) }}
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">@lang('course/fields.courses')</h3>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="name">@lang('course/fields.name')</label>
                <input type="text" id="name"  name="name" value="{{ old('name', $course->name) }}" class="form-control">
                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong class="text-danger">{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <label for="description">@lang('course/fields.description')</label>
                <textarea id="description" name="description" class="form-control" rows="4">{{ old('description', $course->description) }}</textarea>
                @if ($errors->has('description'))
                    <span class="help-block">
                        <strong class="text-danger">{{ $errors->first('description') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <label for="teacher_id">@lang('course/fields.teacher')</label>
                {{ Form::select('teacher_id', $users, old('teacher_id', $course->teacher_id), ['class' => 'form-control custom-select']) }}
                @if ($errors->has('teacher_id'))
                    <span class="help-block">
                        <strong class="text-danger">{{ $errors->first('teacher_id') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    <div class="col-12">
        <a href="#" class="btn btn-secondary">@lang('general.cancel')</a>
        <input type="submit" value="@lang('course/actions.update')" class="btn btn-primary float-right">
    </div>
    {{ Form::close() }}
</div>
</div>

</section>

<!-- /.content -->
@endsection


