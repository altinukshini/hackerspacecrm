@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Settings</h1>
</section>

<section class="content">
    @if(empty($emailTemplates))
        <div class="alert alert-help">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {{ trans('hackerspacecrm.messages.notranslation') }}
        </div>
    @else
        <div class="alert alert-help">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {!! trans('hackerspacecrm.help.settings.emails') !!}
        </div>
        <div class="row">
            @foreach ($emailTemplates as $template)
                <div class="col-md-6">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ $template->title }} ({{ $template->slug }})</h3>
                            <a class="btn btn-xs btn-primary pull-right" data-toggle="modal" data-target="#translateemailtempalte">Translate</a>
                        </div>
                        <form role="form" action="{{ url('settings/emails/'.$template->id) }}" method="POST">
                            {!! csrf_field() !!}
                            {!! method_field('PATCH') !!}
                            <div class="box-body">
                                <p>{{ $template->description }}</p>
                                <br>
                                <div class="form-group {{ $errors->has('email_subject') ? ' has-error' : ' has-feedback' }}">
                                    <label for="email_subject">Email subject</label>
                                    <input type="text" class="form-control" id="email_subject" name="email_subject" value="{{ old('email_subject') ? old('email_subject') : $template->email_subject }}" required/>
                                    @if ($errors->has('email_subject'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email_subject') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('email_body') ? ' has-error' : ' has-feedback' }}">
                                    <label for="email_body">Email body</label>
                                    <textarea class="textarea" name="email_body" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ old('email_body') ? old('email_body') : $template->email_body }}</textarea>

                                    @if ($errors->has('email_body'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email_body') }}</strong>
                                    </span>
                                    @endif
                                    <div class="alert alert-help">
                                        {!! $template->syntax_help !!}
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    @can('setting_update')
        <div class="modal fade" tabindex="-1" role="dialog" id="translateemailtempalte">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Create translation</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <form role="form" action="" method="POST">
                                {!! csrf_field() !!}
                                {!! method_field('PATCH') !!}
                                <div class="box-body">
                                    <div class="form-group {{ $errors->has('locale') ? ' has-error' : ' has-feedback' }}">
                                        <label for="locale">Locale</label>
                                        <select class="form-control" name="locale" required>
                                            <option disabled selected>Select locale</option>
                                            @foreach (getAvailableAppLocaleArray() as $localekey => $localevalue)
                                                @if($localekey != getCurrentSessionAppLocale())
                                                    <option value="{{ $localekey }}" {{ old('locale') == $localekey ? "selected" : "" }}>{{ $localekey . ' - ' .$localevalue }}</option>
                                                @endif
                                            @endforeach
                                        </select>

                                        @if ($errors->has('locale'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('locale') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('description') ? ' has-error' : ' has-feedback' }}">
                                        <label for="description">Template description</label>
                                        <input type="text" class="form-control" id="description" name="description" value="" required/>
                                        @if ($errors->has('description'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('email_subject') ? ' has-error' : ' has-feedback' }}">
                                        <label for="email_subject">Email subject</label>
                                        <input type="text" class="form-control" id="email_subject" name="email_subject" value="" required/>
                                        @if ($errors->has('email_subject'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email_subject') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('email_body') ? ' has-error' : ' has-feedback' }}">
                                        <label for="email_body">Email body</label>
                                        <textarea class="textarea" name="email_body" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>

                                        @if ($errors->has('email_body'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email_body') }}</strong>
                                        </span>
                                        @endif
                                        <div class="alert alert-help">
                                            
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
        </div>
        @if ($errors->has('error_code') AND $errors->first('error_code') == 7)
            <script type="text/javascript">
                $('#translateemailtempalte').modal('show');
            </script>
        @endif
    @endif
</section>

@stop