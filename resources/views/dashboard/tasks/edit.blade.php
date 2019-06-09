@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.tasks')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li><a href="{{ route('dashboard.tasks.index') }}"> @lang('site.tasks')</a></li>
                <li class="active">@lang('site.edit')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header">
                    <h3 class="box-title">@lang('site.edit')</h3>
                </div><!-- end of box header -->

                <div class="box-body">

                    @include('partials._errors')

                    <form action="{{ route('dashboard.tasks.update', $tasks->id) }}" method="post">

                        {{ csrf_field() }}
                        {{ method_field('put') }}

                        <div class="form-group">
                            <label>@lang('site.name')</label>
                            <input type="text" name="name" class="form-control" value="{{ $tasks->name}}">
                        </div>
                            <div class="form-group">
                            <label>@lang('site.title')</label>
                                <input type="text" name="title" class="form-control" value= "{{$tasks->title}}">
                            </div>
                            <div class="form-group">
                            <label>@lang('site.email')</label>
                                <input type="email" name="email" class="form-control" value= "{{$tasks->title}}">
                            </div>
                            <div class="form-group">
                            <label>@lang('site.phone')</label>
                                <input type="text" name="phone" class="form-control" value= "{{$tasks->phone}}">
                            </div>
                            <div class="form-group">
                            <label>@lang('site.credit')</label>
                                <input type="number" name="credit" class="form-control" value= "{{$tasks->credit}}">
                            </div>
                            <div class="form-group">
                            <label>@lang('site.total')</label>
                                <input type="number" name="total" class="form-control" value= "{{$tasks->total}}">
                            </div>
                            

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> @lang('site.edit')</button>
                        </div>

                    </form><!-- end of form -->

                </div><!-- end of box body -->

            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection
