@extends('layouts.master')

@section('content')
<div class="col-md-12">
    {{ Form::open(['url' => route('courses.update', $course->id), 'method' => 'PUT']) }}
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
                <textarea id="description" name="description" class="form-control" rows="4" maxlength="150">{{ old('description', $course->description) }}</textarea>
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
            <div class="col-12">
                <a href="{{ route('courses.index') }}" class="btn btn-secondary">@lang('general.cancel')</a>
                <input type="submit" value="@lang('course/actions.update')" class="btn btn-primary float-right">
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    {{ Form::close() }}
</div>

<div class="col-md-12">
    <div id="accordion">
        <!-- we are adding the .class so bootstrap.js collapse plugin detects it -->
        <div class="card card-primary">
            <div class="card-header d-flex p-0">
                <h4 class="card-title p-3">
                    <a data-toggle="collapse" aria-expanded="true" data-parent="#accordion" href="#lessons">
                        Lessons
                    </a>
                </h4>
                <ul class="nav nav-pills ml-auto p-2">
                    <li class="nav-item">
                        @can('edit_lessons')
                            <a href="{{ route('lessons.create', $course->id) }}" class="btn btn-primary">@lang('general.new')</a>
                        @endcan
                    </li>
                </ul>
            </div>
            <div id="lessons" class="panel-collapse collapse show">
                <div class="card-body">
                    <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                                <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="">@lang('lesson/fields.id')</th>
                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">@lang('lesson/fields.title')</th>
                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label=""></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($lessons as $lesson)
                                    <tr role="row" class="odd">
                                        <td class="sorting_1">{{ $lesson->id }}</td>
                                        <td>{{ $lesson->title }}</td>
                                        <td>
                                            <a href="{{ route('lessons.edit', $lesson->id) }}" class="btn btn-primary float-left">@lang('course/actions.edit')</a>
                                            @if($lesson->status == \App\Enums\LessonStatus::DISABLED)
                                                {{ Form::open(['url' => route('lessons.update', $lesson->id), 'method' => 'PUT']) }}
                                                    <input type="hidden" name="status" value="{{ \App\Enums\LessonStatus::ENABLED }}">
                                                    <button type="submit" value="" class="btn btn-success float-right">@lang('lesson/actions.restore')</button>
                                                {{ Form::close() }}
                                            @endif
                                            {{ Form::open(['url' => route('lessons.destroy', $lesson->id), 'method' => 'DELETE']) }}
                                                <button type="submit" value="" class="btn btn-danger float-right">@lang('lesson/actions.delete')</button>
                                            {{ Form::close() }}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="">@lang('lesson/fields.id')</th>
                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">@lang('lesson/fields.title')</th>
                                    <th rowspan="1" colspan="1"></th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- /.content -->
@endsection

@section('scripts')
<script src="{{ asset('js/jquery-3.1.1.slim.min.js') }}"></script>
<script src="{{ asset('js/remaining_characters.js') }}"></script>
<script type="text/javascript">
    $("#description").remainingCharacters({
      label: {
        tag: 'p',
        id: null,
        class: 'badge badge-primary',
        invalidClass: 'is-invalid'
      },
      text: '{n} characters remaining'
    });

</script>
@endsection