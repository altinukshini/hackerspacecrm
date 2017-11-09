@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>{{ trans('hackerspacecrm.pages.titles.memberprofile') }}</h1>
	<ol class="breadcrumb">
		<li><a href="{{ url('members') }}"><i class="fa fa-users"></i> {{ trans('hackerspacecrm.models.members') }}</a></li>
		<li class="active"><a href="#"> {{ $user->username }}</a></li> 
	</ol>
</section>

<!-- Main content -->
<section class="content">
	<div class="row">
		<!-- Profile Image -->
		<div class="col-md-4">
			<div class="box box-widget widget-user-2">
				<div class="widget-user-header bg-{{ $user->profile->gender == 'male' ? 'blue' : ($user->profile->gender == 'female' ? 'red' : 'purple') }}">
					<div class="widget-user-image">
						<img class="" src="{{ get_gravatar($user->email, 128) }}" alt="User Avatar">
					</div>
					@if (hasPermission('profile_update') || Auth::user()->id == $user->id)
						<a class="btn btn-default btn-sm pull-right" data-toggle="modal" data-target="#editProfileModal">
							<i class="fa fa-edit"></i> {{ trans('hackerspacecrm.forms.labels.editaccount') }}
						</a>
					@endif
					<h3 class="widget-user-username">{{ $user->full_name }}</h3><!-- Button trigger modal -->
					<h5 class="widget-user-desc">{{ $user->username }} </h5>          
				</div>
				<div class="box-body">
					<p><b><i class="fa fa-envelope margin-r-5"></i>{{ trans('hackerspacecrm.forms.labels.email') }}:</b> <a class="pull-right">{{ $user->email }}</a></p>
					@if($user->profile->website != '')
						<p><b><i class="fa fa-globe margin-r-5"></i>{{ trans('hackerspacecrm.forms.labels.website') }}:</b> <a class="pull-right" target="_blank" href="{{ $user->profile->website }}">{{ $user->profile->website }}</a></p>
					@endif
					@if($user->profile->address != '')
						<p><b><i class="fa fa-map-marker margin-r-5"></i>{{ trans('hackerspacecrm.forms.labels.address') }}:</b> <a class="pull-right">{{ $user->profile->address }}</a></p>
					@endif
					@if($user->profile->phone != '')
						<p><b><i class="fa fa-phone margin-r-5"></i>{{ trans('hackerspacecrm.forms.labels.phone') }}:</b> <a class="pull-right">{{ $user->profile->phone }}</a></p>
					@endif
					<p>
						<b><i class="fa fa-link margin-r-5"></i>{{ trans('hackerspacecrm.forms.labels.socialmedia') }}:</b> 
						<span class="pull-right" style="font-size:18px;">
							@if($user->profile->facebook_username != '') <a target="_blank" href="http://www.facebook.com/{{ $user->profile->facebook_username }}"><i class="fa fa-facebook margin-r-5"></i></a>@endif
							@if($user->profile->twitter_username != '') <a target="_blank" href="http://www.twitter.com/{{ $user->profile->twitter_username }}"><i class="fa fa-twitter margin-r-5"></i></a>@endif 
							@if($user->profile->linkedin_username != '') <a target="_blank" href="http://www.linkedin.com/{{ $user->profile->linkedin_username }}"><i class="fa fa-linkedin margin-r-5"></i></a>@endif 
							@if($user->profile->github_username != '') <a target="_blank" href="http://www.github.com/{{ $user->profile->github_username }}"><i class="fa fa-github margin-r-5"></i></a>@endif 
						</span>
					</p>
					<hr>
					@if($user->profile->skills != '')
						<p>
							<strong><i class="fa fa-pencil margin-r-5"></i> {{ trans('hackerspacecrm.forms.labels.skills') }}</strong><br />
						</p>
						<p>
							<?php $skills = explode(',',$user->profile->skills); ?>
							@foreach ($skills as $skill)
							<span class="label label-primary">{{ $skill }}</span>
							@endforeach
						</p>
						<hr>
					@endif

					<!-- <ul class="list-group list-group-unbordered">
						<li class="list-group-item">
							<b>Membership status:</b> <span class="badge bg-green pull-right">Active</span> <span class="badge bg-grey pull-right">Inactive</span> <span class="badge bg-red pull-right">Banned</span> <span class="badge bg-yellow pull-right">Pending</span>
						</li>
						<li class="list-group-item">
							<b>Member since:</b> <span class="pull-right">2016-01-01</span>
						</li>
						<li class="list-group-item">
							<b>Membership:</b> <span class="pull-right">Regular Hacker</span>
						</li>
						<li class="list-group-item">
							<b>Roles:</b> <span class="pull-right">Director, Voting, Member</span>
						</li>
						<li class="list-group-item">
							<b>Roles:</b> <span class="pull-right">Director, Voting, Member</span>
						</li>
					</ul> -->
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div><!-- /.col -->

		<div class="col-md-8">
			<div class="box box-primary">
				<div class="box-body">
					<div class="box-header with-border">
						<h3 class="box-title">{{ trans('hackerspacecrm.pages.subtitles.about') }}</h3>
					</div><!-- /.box-header -->

					<!-- About Box -->
					<div class="box-body">
						<strong><i class="fa fa-file-text-o margin-r-5"></i> {{ trans('hackerspacecrm.forms.labels.biography') }}</strong>
						<p>{!! $user->profile->biography !!}</p>					
					</div>
				</div>
			</div>
		</div>
	</div><!-- /.row -->

	@if (hasPermission('profile_update') || Auth::user()->id == $user->id)
	<div class="row">
		<div class="modal fade" tabindex="-1" role="dialog" id="editProfileModal">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span></button>
						<h4 class="modal-title">{{ trans('hackerspacecrm.pages.titles.editaccount') }}</h4>
					</div>
					<div class="modal-body">
						<div class="nav-tabs-custom">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#accountTab" id="accountTabButton" data-toggle="tab">{{ trans('hackerspacecrm.forms.labels.account') }}</a></li>
								<li><a href="#profileTab" id="profileTabButton" data-toggle="tab">{{ trans('hackerspacecrm.forms.labels.profile') }}</a></li>
							</ul>

							<div class="tab-content">
								<div class="active tab-pane" id="accountTab">
									<div class="row">
										<div class="col-md-6">
											<form role="form" method="POST" action="{{ url('users/'.$user->username) }}">
												{!! method_field('PATCH') !!}
												{!! csrf_field() !!}
												<div class="form-group{{ $errors->has('full_name') ? ' has-error' : ' has-feedback' }}">
													<label for="full_name">{{ trans('hackerspacecrm.forms.labels.fullname') }}*</label>
													<input type="text" class="form-control" placeholder="{{ trans('hackerspacecrm.forms.placeholders.namesurname') }}" name="full_name" value="{{ old('full_name') ? old('full_name') : $user->full_name }}" required>
													@if ($errors->has('full_name'))
													<span class="help-block">
														<strong>{{ $errors->first('full_name') }}</strong>
													</span>
													@endif
												</div>
												<div class="form-group{{ $errors->has('email') ? ' has-error' : ' has-feedback' }}">
													<label for="email">{{ trans('hackerspacecrm.forms.labels.email') }}*</label>
													<div class="input-group">
														<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
														<input type="email" class="form-control" placeholder="user@email.com" name="email" value="{{ old('email') ? old('email') : $user->email }}" required>
													</div>
													@if ($errors->has('email'))
													<span class="help-block">
														<strong>{{ $errors->first('email') }}</strong>
													</span>
													@endif
												</div>
												<div class="form-group">
													<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> {{ trans('hackerspacecrm.forms.buttons.save') }}</button>
												</div>
											</form>
										</div>
										<div class="col-md-6">
											<!-- <h4>Change password</h4> -->
											<form role="form" id="editPasswordForm" method="POST" action="{{ url('users/'.$user->username.'/password') }}">
												{!! method_field('PATCH') !!}
												{!! csrf_field() !!}
												<div class="form-group{{ $errors->has('password') ? ' has-error' : ' has-feedback' }}">
													<label for="password">{{ trans('hackerspacecrm.forms.labels.newpassword') }}*</label>
													<div class="input-group">
														<span class="input-group-addon"><i class="fa fa-lock"></i></span>
														<input type="password" class="form-control" name="password" value="" required>
													</div>
													@if ($errors->has('password'))
													<span class="help-block">
														<strong>{{ $errors->first('password') }}</strong>
													</span>
													@endif
												</div>
												<div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : ' has-feedback' }}">
													<label for="password_confirmation">{{ trans('hackerspacecrm.forms.labels.confirmnewpassword') }}*</label>
													<div class="input-group">
														<span class="input-group-addon"><i class="fa fa-lock"></i></span>
														<input type="password" class="form-control" name="password_confirmation" value="" required>
													</div>
													@if ($errors->has('password_confirmation'))
													<span class="help-block">
														<strong>{{ $errors->first('password_confirmation') }}</strong>
													</span>
													@endif
												</div>
												<div class="form-group">
													<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> {{ trans('hackerspacecrm.forms.buttons.change') }}</button>
												</div>
											</form>
										</div>
									</div>
								</div>
								<div class="tab-pane" id="profileTab">
									<form role="form" method="POST" action="{{ url('profiles/'.$user->username) }}">
										{!! method_field('PATCH') !!}
										{!! csrf_field() !!}
										<div class="row">
											<div class="col-md-6">
												<div class="form-group{{ $errors->has('birthday') ? ' has-error' : ' has-feedback' }}">
													<label for="birthday">{{ trans('hackerspacecrm.forms.labels.birthday') }}*</label>
													<div class="input-group date">
													  <div class="input-group-addon">
														<i class="fa fa-calendar"></i>
													  </div>
													  <input type="text" class="form-control pull-right datepicker" name="birthday" value="{{ old('birthday') ? old('birthday') : $user->profile->birthday }}" required/>
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
													<input type="radio" class="minimal" id="gender" name="gender" value="male" {{ old('gender') == 'male' ? "checked" : ($user->profile->gender == 'male' ? 'checked' : "") }} /> {{ trans('hackerspacecrm.forms.checkboxes.male') }} 
													<input type="radio" class="minimal" id="gender" name="gender" value="female" {{ old('gender') == 'female' ? "checked" : ($user->profile->gender == 'female' ? 'checked' : "") }} /> {{ trans('hackerspacecrm.forms.checkboxes.female') }} 
													<input type="radio" class="minimal" id="gender" name="gender" value="other" {{ old('gender') == 'other' ? "checked" : ($user->profile->gender == 'other' ? 'checked' : "") }} /> {{ trans('hackerspacecrm.forms.checkboxes.other') }} 

													@if ($errors->has('gender'))
													<span class="help-block">
														<strong>{{ $errors->first('gender') }}</strong>
													</span>
													@endif
												</div>
												<div class="form-group{{ $errors->has('socialid') ? ' has-error' : ' has-feedback' }}">
													<label for="socialid">{{ trans('hackerspacecrm.forms.labels.socialid') }}</label>
													<input type="text" class="form-control" placeholder="1234567890" name="socialid" value="{{ old('socialid') ? old('socialid') : $user->profile->socialid }}" />
													@if ($errors->has('socialid'))
													<span class="help-block">
														<strong>{{ $errors->first('socialid') }}</strong>
													</span>
													@endif
												</div>
												<div class="form-group{{ $errors->has('phone') ? ' has-error' : ' has-feedback' }}">
													<label for="phone">{{ trans('hackerspacecrm.forms.labels.phone') }}</label>
													<div class="input-group">
														<span class="input-group-addon"><i class="fa fa-phone"></i></span>
														<input type="text" class="form-control" placeholder="+1 555 555 555" name="phone" value="{{ old('phone') ? old('phone') : $user->profile->phone }}"/>
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
														<input type="text" class="form-control" placeholder="{{ trans('hackerspacecrm.forms.placeholders.exampleaddress') }}" name="address" value="{{ old('address') ? old('address') : $user->profile->address }}" />
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
														<input type="text" class="form-control" placeholder="{{ trans('hackerspacecrm.forms.placeholders.url') }}" name="website" value="{{ old('website') ? old('website') : $user->profile->website }}" />
													</div>
													<p>{{ trans('hackerspacecrm.forms.help.website') }}</p>

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
														<input type="text" class="form-control" placeholder="{{ trans('hackerspacecrm.forms.placeholders.username') }}" name="github_username" value="{{ old('github_username') ? old('github_username') : $user->profile->github_username }}" />
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
														<input type="text" class="form-control" placeholder="{{ trans('hackerspacecrm.forms.placeholders.username') }}" name="facebook_username" value="{{ old('facebook_username') ? old('facebook_username') : $user->profile->facebook_username }}" />
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
														<input type="text" class="form-control" placeholder="{{ trans('hackerspacecrm.forms.placeholders.username') }}" name="twitter_username" value="{{ old('twitter_username') ? old('twitter_username') : $user->profile->twitter_username }}" />
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
														<input type="text" class="form-control" placeholder="{{ trans('hackerspacecrm.forms.placeholders.username') }}" name="linkedin_username" value="{{ old('linkedin_username') ? old('linkedin_username') : $user->profile->linkedin_username }}" />
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
														<input type="text" class="form-control" placeholder="{{ trans('hackerspacecrm.forms.placeholders.skills') }}" name="skills" value="{{ old('skills') ? old('skills') : $user->profile->skills }}" />
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
														<textarea class="form-control wysitextarea" id="biography" rows="15" placeholder="{{ trans('hackerspacecrm.forms.placeholders.entertexthere') }}" type="text" name="biography" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required/>{{ old('biography') ? old('biography') : $user->profile->biography }}</textarea>
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
													<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> {{ trans('hackerspacecrm.forms.buttons.save') }}</button>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
		</div>
	</div>
	<!-- If edit menu request has error, open editmenu modal -->
	@if ($errors->has('error_code') AND $errors->first('error_code') == '6')
	<script type="text/javascript">
		$('#editProfileModal').modal('show');
	</script>
	@endif
	@endif

</section><!-- /.content -->

@stop
