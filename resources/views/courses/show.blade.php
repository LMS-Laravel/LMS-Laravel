@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-5">
                                <h5>{{$course->name}}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @forelse ($lessons as $lesson)
                            <div id="accordion">
                                <div class="card card-primary">
                                    <div class="card-header d-flex p-0">
                                        <h4 class="card-title p-3">
                                            <a  href="{{route('lessons.show', $lesson->id)}}">
                                                {{ $lesson->title }}
                                            </a>
                                        </h4>
                                        <ul class="nav nav-pills ml-auto p-2">
                                            <li class="nav-item">
                                                <a class="btn btn-primary" href="{{route('lessons.show', $lesson->id)}}">@lang('general.show')</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p>@lang('lesson/lessons.not_have')</p>
                        @endforelse
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <chat :user="{{ auth()->user() }}" :resource="{{ $course->id }}" :type='"course"'></chat>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const subscribed = Boolean({!! $subscribed !!})
        if(!subscribed){
            Swal.fire({
                title: 'Do you want subscribe this course',
                inputAttributes: {
                    autocapitalize: 'true'
                },
                showCancelButton: true,
                confirmButtonText: 'Subscribe',
                showLoaderOnConfirm: true,
                preConfirm: (login) => {
                    return $.ajax({
                        type: "POST",
                        url: `/api/subscribe/{!! $course->id !!}`,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        cache: false,
                        success: function(response) {
                            swal(
                                "Sccess!",
                                "Your note has been saved!",
                                "success"
                            )
                        },
                        failure: function (response) {
                            swal(
                                "Internal Error",
                                "Oops, your note was not saved.", // had a missing comma
                                "error"
                            )
                        }
                    });
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.value) {
                    Swal.fire({
                        title: `Suscrito`,
                    })
                }
                if(result.dismiss) {
                    window.location.replace("{!! route('home') !!}");
                }
                console.log(result);
            })
        }

    </script>
@endsection
