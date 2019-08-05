@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        @foreach($courses as $course)
            <div class="col-md-4">
                <div class="card card-widget widget-user">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-info-active">
                        <h3 class="widget-user-username">{{ $course->name }}</h3>
                        <h5 class="widget-user-desc">{{ $course->teacher->name }}</h5>
                    </div>
                    <div class="widget-user-image">
                        <img class="img-circle elevation-2" src="{{ $course->teacher->avatar }}" alt="User Avatar">
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">3,200</h5>
                                    <span class="description-text">STUDENTS</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <a href="" class="btn"><i class="icon far fa-2x fa-eye text-green"></i></a>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4">
                                <div class="description-block">
                                    <h5 class="description-header">35</h5>
                                    <span class="description-text">LEVEL</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
                <!-- /.col -->
            </div>
        @endforeach
    </div>
</div>
@endsection
