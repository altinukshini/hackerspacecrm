@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>{{ trans('hackerspacecrm.pages.titles.createprofile') }}</h1>
</section>

<!-- Main content -->
<section class="content">
	<div class="alert alert-help">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        {{ trans('hackerspacecrm.help.createprofile') }}
    </div>
	<div class="row">
		<div class="col-md-8">
			<div class="box box-default col-md-8">
				<div class="box-header with-border">
					<h3 class="box-title">{{ $user->full_name . ' (' .$user->username.')' }}</h3>
				</div>
				<div class="box-body">
					<form role="form" id="createProfileForm" method="POST" action="{{ url('profiles/'.$user->username) }}">
						{{ csrf_field() }}
						<div class="row">
							<div class="col-md-6">
								<div class="form-group{{ $errors->has('birthday') ? ' has-error' : ' has-feedback' }}">
									<label for="birthday">{{ trans('hackerspacecrm.forms.labels.birthday') }}*</label>
									<div class="input-group date">
									  <div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									  </div>
									  <input type="text" class="form-control pull-right datepicker" name="birthday" value="{{ old('birthday') }}" required/>
									</div>
									
									@if ($errors->has('birthday'))
									<span class="help-block">
										<strong>{{ $errors->first('birthday') }}</strong>
									</span>
									@endif
								</div>
								<div class="form-group{{ $errors->has('gender') ? ' has-error' : ' has-feedback' }}">
									<label for="gender">{{ trans('hackerspacecrm.forms.labels.gender') }}*</label>
									<br />
									<input type="radio" class="minimal" id="gender" name="gender" value="male" {{ old('gender') == 'male' ? 'checked' : '' }} /> {{ trans('hackerspacecrm.forms.checkboxes.male') }} 
									<input type="radio" class="minimal" id="gender" name="gender" value="female" {{ old('gender') == 'female' ? 'checked' : '' }} /> {{ trans('hackerspacecrm.forms.checkboxes.female') }}  
									<input type="radio" class="minimal" id="gender" name="gender" value="other" {{ old('gender') == 'other' ? 'checked' : '' }} /> {{ trans('hackerspacecrm.forms.checkboxes.other') }}  

									@if ($errors->has('gender'))
									<span class="help-block">
										<strong>{{ $errors->first('gender') }}</strong>
									</span>
									@endif
								</div>
								<div class="form-group{{ $errors->has('socialid') ? ' has-error' : ' has-feedback' }}">
									<label for="socialid">{{ trans('hackerspacecrm.forms.labels.socialid') }}*</label>
									<input type="text" class="form-control" placeholder="1234567890" name="socialid" value="{{ old('socialid') }}" required>
									@if ($errors->has('socialid'))
									<span class="help-block">
										<strong>{{ $errors->first('socialid') }}</strong>
									</span>
									@endif
								</div>
								<div class="form-group{{ $errors->has('phone') ? ' has-error' : ' has-feedback' }}">
									<label for="phone">Phone</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-phone"></i></span>
										<input type="text" class="form-control" placeholder="+1 555 555 555" name="phone" value="{{ old('phone') }}"/>
									</div>
									@if ($errors->has('phone'))
									<span class="help-block">
										<strong>{{ $errors->first('phone') }}</strong>
									</span>
									@endif
								</div>
								<div class="form-group{{ $errors->has('address') ? ' has-error' : ' has-feedback' }}">
									<label for="address">{{ trans('hackerspacecrm.forms.labels.address') }}</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
										<input type="text" class="form-control" placeholder="{{ trans('hackerspacecrm.forms.placeholders.exampleaddress') }} " name="address" value="{{ old('address') }}" />
									</div>
									@if ($errors->has('address'))
									<span class="help-block">
										<strong>{{ $errors->first('address') }}</strong>
									</span>
									@endif
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group{{ $errors->has('website') ? ' has-error' : ' has-feedback' }}">
									<label for="website">{{ trans('hackerspacecrm.forms.labels.website') }}</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-globe"></i></span>
										<input type="text" class="form-control" placeholder="{{ trans('hackerspacecrm.forms.placeholders.url') }} " name="website" value="{{ old('website') }}" />
									</div>
									<p>{{ trans('hackerspacecrm.forms.help.website') }} </p>

									@if ($errors->has('website'))
									<span class="help-block">
										<strong>{{ $errors->first('website') }}</strong>
									</span>
									@endif
								</div>
								<br />
								<label>{{ trans('hackerspacecrm.forms.labels.socialmedia') }}:</label>
								<div class="form-group{{ $errors->has('github_username') ? ' has-error' : ' has-feedback' }}">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-github"></i></span>
										<input type="text" class="form-control" placeholder="{{ trans('hackerspacecrm.forms.placeholders.username') }} " name="github_username" value="{{ old('github_username') }}" />
									</div>
									@if ($errors->has('github_username'))
									<span class="help-block">
										<strong>{{ $errors->first('github_username') }}</strong>
									</span>
									@endif
								</div>
								<div class="form-group{{ $errors->has('facebook_username') ? ' has-error' : ' has-feedback' }}">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-facebook-official"></i></span>
										<input type="text" class="form-control" placeholder="{{ trans('hackerspacecrm.forms.placeholders.username') }}" name="facebook_username" value="{{ old('facebook_username') }}" />
									</div>
									@if ($errors->has('facebook_username'))
									<span class="help-block">
										<strong>{{ $errors->first('facebook_username') }}</strong>
									</span>
									@endif
								</div>
								<div class="form-group{{ $errors->has('twitter_username') ? ' has-error' : ' has-feedback' }}">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-twitter"></i></span>
										<input type="text" class="form-control" placeholder="{{ trans('hackerspacecrm.forms.placeholders.username') }}" name="twitter_username" value="{{ old('twitter_username') }}" />
									</div>
									@if ($errors->has('twitter_username'))
									<span class="help-block">
										<strong>{{ $errors->first('twitter_username') }}</strong>
									</span>
									@endif
								</div>
								<div class="form-group{{ $errors->has('linkedin_username') ? ' has-error' : ' has-feedback' }}">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-linkedin"></i></span>
										<input type="text" class="form-control" placeholder="{{ trans('hackerspacecrm.forms.placeholders.username') }}" name="linkedin_username" value="{{ old('linkedin_username') }}" />
									</div>
									@if ($errors->has('linkedin_username'))
									<span class="help-block">
										<strong>{{ $errors->first('linkedin_username') }}</strong>
									</span>
									@endif
								</div>
							</div>
							<br style="clear:both;">
							<br style="clear:both;">
							<div class="col-md-12">
								<div class="form-group{{ $errors->has('skills') ? ' has-error' : ' has-feedback' }}">
									<label for="skills">{{ trans('hackerspacecrm.forms.labels.skills') }}</label>
									
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-tasks"></i></span>
										<input type="text" class="form-control" placeholder="skill1, skill2, skill3" name="skills" value="{{ old('skills') }}" />
									</div>
									<p>{{ trans('hackerspacecrm.forms.help.skills') }}</p>

									@if ($errors->has('skills'))
									<span class="help-block">
										<strong>{{ $errors->first('skills') }}</strong>
									</span>
									@endif
								</div>
								<div class="form-group {{ $errors->has('biography') ? ' has-error' : ' has-feedback' }}">
									<label for="biography">{{ trans('hackerspacecrm.forms.labels.biography') }}</label>
									
									<div class="box-body pad">
										<textarea class="form-control wysitextarea" id="biography" rows="15" placeholder="{{ trans('hackerspacecrm.forms.placeholders.entertexthere') }}" type="text" name="biography" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required/>{{ old('biography') }}</textarea>
									</div>
									@if ($errors->has('biography'))
									<span class="help-block">
										<strong>{{ $errors->first('biography') }}</strong>
									</span>
									@endif
								</div>
							</div>
							<br style="clear:both;">
							<div class="col-md-12">
								<div class="form-group">
									<button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> {{ trans('hackerspacecrm.forms.buttons.create') }}</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div> <!-- .row -->
</section>


@stop