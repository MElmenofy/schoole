@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ __('main_trans.Grades_list') }}
@stop
@endsection
@section('page-header')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ __('main_trans.Grades_list') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">{{ __('main_trans.Grades_list') }}</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <!-- button model -->
                <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                    {{ trans('grades_trans.add_Grade') }}
                </button>
                <!-- /button model -->
                <br><br>

                <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ __('grades_trans.Name') }}</th>
                        <th>{{ __('grades_trans.Notes') }}</th>
                        <th>{{ __('grades_trans.Processes') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $i = 1; @endphp
                    @foreach($grades as $grade)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $grade->name }}</td>
                        <td>{{ $grade->notes }}</td>
                        <td>
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                      data-target="#edit{{ $grade->id }}"
                                      title="{{ trans('Grades_trans.Edit') }}"><i
                                    class="fa fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                      data-target="#delete{{ $grade->id }}"
                                      title="{{ trans('Grades_trans.Edit') }}"><i
                                    class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>


                    <!-- edit model -->
                    <div class="modal fade" id="edit{{ $grade->id }}" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                        id="exampleModalLabel">
                                        {{ trans('Grades_trans.edit_Grade') }}
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- add_form -->
                                    <form action="{{ route('grades.update', 'test') }}" method="POST">
                                        {{method_field('patch')}}
                                        @csrf
                                        <div class="row">
                                            <div class="col">
                                                <label for="Name"
                                                       class="mr-sm-2">{{ trans('grades_trans.stage_name_ar') }}
                                                    :</label>
                                                <input id="Name" type="text" name="name" value="{{ $grade->getTranslation('name', 'ar') }}" class="form-control">
                                                <input id="id" type="hidden" name="id" value="{{ $grade->id }}" class="form-control">
                                            </div>
                                            <div class="col">
                                                <label for="Name_en"
                                                       class="mr-sm-2">{{ trans('grades_trans.stage_name_en') }}
                                                    :</label>
                                                <input type="text" class="form-control" name="name_en" value="{{ $grade->getTranslation('name', 'en') }}" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label
                                                for="exampleFormControlTextarea1">{{ trans('grades_trans.Notes') }}
                                                :</label>
                                            <textarea class="form-control" name="notes" id="exampleFormControlTextarea1"
                                                      rows="3">{{ $grade->notes }}</textarea>
                                        </div>
                                        <br><br>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">{{ trans('grades_trans.Close') }}</button>
                                    <button type="submit"
                                            class="btn btn-success">{{ trans('grades_trans.Edit') }}</button>
                                </div>
                                </form>

                            </div>
                        </div>
                    </div>
                    <!-- /edit model -->

                    <!-- delete model -->
                    <div class="modal fade" id="delete{{ $grade->id }}" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                        id="exampleModalLabel">
                                        {{ trans('Grades_trans.delete_Grade') }}
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('grades.destroy','test')}}" method="post">
                                        {{method_field('Delete')}}
                                        @csrf
                                        {{ trans('Grades_trans.Warning_Grade') }}
                                        <input id="id" type="hidden" name="id" class="form-control"
                                               value="{{ $grade->id }}">
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">{{ trans('Grades_trans.Close') }}</button>
                                            <button type="submit"
                                                    class="btn btn-danger">{{ trans('Grades_trans.Delete') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /delete model -->

                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /row closed -->

<!-- add model -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                    id="exampleModalLabel">
                    {{ trans('grades_trans.add_Grade') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- add_form -->
                <form action="{{ route('grades.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="Name"
                                   class="mr-sm-2">{{ trans('grades_trans.stage_name_ar') }}
                                :</label>
                            <input id="Name" type="text" name="name" class="form-control">
                        </div>
                        <div class="col">
                            <label for="Name_en"
                                   class="mr-sm-2">{{ trans('grades_trans.stage_name_en') }}
                                :</label>
                            <input type="text" class="form-control" name="name_en" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label
                            for="exampleFormControlTextarea1">{{ trans('grades_trans.Notes') }}
                            :</label>
                        <textarea class="form-control" name="notes" id="exampleFormControlTextarea1"
                                  rows="3"></textarea>
                    </div>
                    <br><br>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{ trans('grades_trans.Close') }}</button>
                <button type="submit"
                        class="btn btn-success">{{ trans('grades_trans.submit') }}</button>
            </div>
            </form>

        </div>
    </div>
</div>
<!-- /add model -->



</div>
<!-- /add model -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
@endsection
