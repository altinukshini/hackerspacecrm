@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Settings</h1>
</section>

<section class="content">
    <div class="alert alert-help">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <b>Do not write php code!!!</b> <br />Please make sure you only use the required variables specified under the textarea.<br /><br />
        <b>Variables you can use:</b> $crm->crmname, $crm->description, $crm->orgname, $crm->orgdescription, $crm->orgaddress, $crm->url, $crm->locale, $crm->theme, $crm->new_user_role.
        <br><br><b>Syntax examples for displaying a variable:</b> @{{ $crm->crmname }} ; @{{ $edit_link }}
    </div>
    <div class="row">
        @foreach ($emailTemplates as $template)
            <div class="col-md-6">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ $template->title }} ({{ $template->slug }})</h3>
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
                                <textarea class="textarea wysitextarea" name="email_body" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ old('email_body') ? old('email_body') : $template->email_body }}</textarea>

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
</section>

@stop