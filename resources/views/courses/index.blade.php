@extends('layouts.master')

@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h3 class="card-title mx-auto w-100">@lang('course/actions.index')</h3>
                <a href="{{ route('course.create') }}" class="btn btn-success">@lang('course/actions.new')</a>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                    <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                        <thead>
                            <tr role="row">
                                <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="">@lang('course/fields.id')</th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">@lang('course/fields.name')</th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">@lang('course/fields.description')</th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">@lang('course/fields.teacher')</th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label=""></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($courses as $course)
                            <tr role="row" class="odd">
                                <td class="sorting_1">{{ $course->id }}</td>
                                <td>{{ $course->name }}</td>
                                <td>{{ $course->description }}</td>
                                <td>{{ $course->teacher->name }}</td>
                                <td>
                                    <a href="{{ route('course.edit', $course->id) }}" class="btn btn-primary float-left">@lang('course/actions.edit')</a>
                                    {{ Form::open(['url' => route('course.destroy', $course->id), 'method' => 'DELETE']) }}
                                        <input type="submit" value="@lang('course/actions.delete')" class="btn btn-danger float-right">
                                    {{ Form::close() }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th rowspan="1" colspan="1">@lang('course/fields.id')</th>
                                <th rowspan="1" colspan="1">@lang('course/fields.name')</th>
                                <th rowspan="1" colspan="1">@lang('course/fields.description')</th>
                                <th rowspan="1" colspan="1">@lang('course/fields.teacher')</th>
                                <th rowspan="1" colspan="1"></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.card-body -->
</div>
<!-- /.card -->

</div>

@endsection
