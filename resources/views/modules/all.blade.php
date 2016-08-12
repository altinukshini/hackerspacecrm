@extends('layouts.app')


@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>{{ trans('hackerspacecrm.pages.titles.settings') }}</h1>
    </section>

    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">All modules</h3>
            </div>
            <div class="box-body">
                @can('user_create')
                    <a class="btn btn-success btn-md" data-toggle="modal" data-target="#addnewuser">
                        <i class="fa fa-plus"></i> {{ trans('hackerspacecrm.forms.buttons.addnew') }}
                    </a>
                @endcan
                <br style="clear:both;">
                <br style="clear:both;">
                @can('user_view')
                    <table class="data-table table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th width="15%">Version</th>
                                <th width="15%">Enabled</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($modules)): ?>
                            <?php foreach ($modules as $module): ?>
                            <tr>
                                <td>
                                    <a href="{{ url('/', [$module->getLowerName()]) }}">
                                        {{ $module->name }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ url('/', [$module->getLowerName()]) }}">
                                        {{ str_replace('v', '', $module->version) }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ url('/', [$module->getLowerName()]) }}">
                                        <span class="label label-{{$module->enabled() ? 'success' : 'danger'}}">
                                            {{ $module->enabled() ? 'enabled' : 'disabled' }}
                                        </span>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Version</th>
                            <th>Enabled</th>
                        </tr>
                        </tfoot>
                    </table>
                @endcan
            </div><!-- /.box-body -->
        </div><!-- /.box -->

    </section><!-- /.content -->
@stop