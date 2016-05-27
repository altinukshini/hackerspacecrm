@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>Member profile</h1>
	<ol class="breadcrumb">
		<li><a href="{{ url('members') }}"><i class="fa fa-users"></i> Members</a></li>
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
						<img class="img-circle" src="/dist/img/user1-128x128.jpg" alt="User Avatar">
					</div>
					@if (hasPermission('profile_update') || Auth::user()->id == $user->id)
						<a class="btn btn-default btn-sm pull-right" data-toggle="modal" data-target="#editProfileModal">
							<i class="fa fa-edit"></i> Edit account
						</a>
					@endif
					<h3 class="widget-user-username">{{ $user->full_name }}</h3><!-- Button trigger modal -->
					<h5 class="widget-user-desc">{{ $user->username }} </h5>
					<h6 class="widget-user-desc">In space <i class="fa fa-circle text-success"></i></h6>            
				</div>
				<div class="box-body">
					<p><b><i class="fa fa-envelope margin-r-5"></i>Email:</b> <a class="pull-right">{{ $user->email }}</a></p>
					@if($user->profile->website != '')
						<p><b><i class="fa fa-globe margin-r-5"></i>Website:</b> <a class="pull-right" target="_blank" href="{{ $user->profile->website }}">{{ $user->profile->website }}</a></p>
					@endif
					@if($user->profile->address != '')
						<p><b><i class="fa fa-map-marker margin-r-5"></i>Address:</b> <a class="pull-right">{{ $user->profile->address }}</a></p>
					@endif
					@if($user->profile->phone != '')
						<p><b><i class="fa fa-phone margin-r-5"></i>Phone:</b> <a class="pull-right">{{ $user->profile->phone }}</a></p>
					@endif
					<p>
						<b><i class="fa fa-link margin-r-5"></i>Social media:</b> 
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
							<strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong><br />
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
						<h3 class="box-title">About</h3>
					</div><!-- /.box-header -->

					<!-- About Box -->
					<div class="box-body">
						<strong><i class="fa fa-file-text-o margin-r-5"></i> Bio</strong>
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
						<h4 class="modal-title">Edit account</h4>
					</div>
					<div class="modal-body">
						<div class="nav-tabs-custom">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#accountTab" id="accountTabButton" data-toggle="tab">Account</a></li>
								<li><a href="#profileTab" id="profileTabButton" data-toggle="tab">Profile</a></li>
							</ul>

							<div class="tab-content">
								<div class="active tab-pane" id="accountTab">
									<div class="row">
										<div class="col-md-6">
											<form role="form" method="POST" action="{{ url('users/'.$user->username) }}">
												{!! method_field('PATCH') !!}
												{!! csrf_field() !!}
												<div class="form-group{{ $errors->has('full_name') ? ' has-error' : ' has-feedback' }}">
													<label for="full_name">Full Name*</label>
													<input type="text" class="form-control" placeholder="Name Surname" name="full_name" value="{{ old('full_name') ? old('full_name') : $user->full_name }}" required>
													@if ($errors->has('full_name'))
													<span class="help-block">
														<strong>{{ $errors->first('full_name') }}</strong>
													</span>
													@endif
												</div>
												<div class="form-group{{ $errors->has('email') ? ' has-error' : ' has-feedback' }}">
													<label for="email">Email*</label>
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
													<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
												</div>
											</form>
										</div>
										<div class="col-md-6">
											<!-- <h4>Change password</h4> -->
											<form role="form" id="editPasswordForm" method="POST" action="{{ url('users/'.$user->username.'/password') }}">
												{!! method_field('PATCH') !!}
												{!! csrf_field() !!}
												<div class="form-group{{ $errors->has('password') ? ' has-error' : ' has-feedback' }}">
													<label for="password">New password*</label>
													<div class="input-group">
														<span class="input-group-addon"><i class="fa fa-lock"></i></span>
														<input type="password" class="form-control" name="password" value="{{ old('password') }}" required>
													</div>
													@if ($errors->has('password'))
													<span class="help-block">
														<strong>{{ $errors->first('password') }}</strong>
													</span>
													@endif
												</div>
												<div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : ' has-feedback' }}">
													<label for="password_confirmation">Confirm new password*</label>
													<div class="input-group">
														<span class="input-group-addon"><i class="fa fa-lock"></i></span>
														<input type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}" required>
													</div>
													@if ($errors->has('password_confirmation'))
													<span class="help-block">
														<strong>{{ $errors->first('password_confirmation') }}</strong>
													</span>
													@endif
												</div>
												<div class="form-group">
													<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Change</button>
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
													<label for="birthday">Birthday*</label>
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
													<label for="gender">Gender*</label>
													<br />
													<input type="radio" class="minimal" id="gender" name="gender" value="male" {{ old('gender') == 'male' ? "checked" : ($user->profile->gender == 'male' ? 'checked' : "") }} /> Male 
													<input type="radio" class="minimal" id="gender" name="gender" value="female" {{ old('gender') == 'female' ? "checked" : ($user->profile->gender == 'female' ? 'checked' : "") }} /> Female 
													<input type="radio" class="minimal" id="gender" name="gender" value="other" {{ old('gender') == 'other' ? "checked" : ($user->profile->gender == 'other' ? 'checked' : "") }} /> Other 

													@if ($errors->has('gender'))
													<span class="help-block">
														<strong>{{ $errors->first('gender') }}</strong>
													</span>
													@endif
												</div>
												<div class="form-group{{ $errors->has('socialid') ? ' has-error' : ' has-feedback' }}">
													<label for="socialid">Social ID</label>
													<input type="text" class="form-control" placeholder="1234567890" name="socialid" value="{{ old('socialid') ? old('socialid') : $user->profile->socialid }}" />
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
														<input type="text" class="form-control" placeholder="+1 555 555 555" name="phone" value="{{ old('phone') ? old('phone') : $user->profile->phone }}"/>
													</div>
													@if ($errors->has('phone'))
													<span class="help-block">
														<strong>{{ $errors->first('phone') }}</strong>
													</span>
													@endif
												</div>
												<div class="form-group{{ $errors->has('address') ? ' has-error' : ' has-feedback' }}">
													<label for="address">Address</label>
													<div class="input-group">
														<span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
														<input type="text" class="form-control" placeholder="Example st, City" name="address" value="{{ old('address') ? old('address') : $user->profile->address }}" />
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
													<label for="website">Website</label>
													<div class="input-group">
														<span class="input-group-addon"><i class="fa fa-globe"></i></span>
														<input type="text" class="form-control" placeholder="http://www.example.com" name="website" value="{{ old('website') ? old('website') : $user->profile->website }}" />
													</div>
													<p>Provide full URL. Exc: http://example.com</p>

													@if ($errors->has('website'))
													<span class="help-block">
														<strong>{{ $errors->first('website') }}</strong>
													</span>
													@endif
												</div>
												<br />
												<label>Social media:</label>
												<div class="form-group{{ $errors->has('github_username') ? ' has-error' : ' has-feedback' }}">
													<div class="input-group">
														<span class="input-group-addon"><i class="fa fa-github"></i></span>
														<input type="text" class="form-control" placeholder="username" name="github_username" value="{{ old('github_username') ? old('github_username') : $user->profile->github_username }}" />
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
														<input type="text" class="form-control" placeholder="username" name="facebook_username" value="{{ old('facebook_username') ? old('facebook_username') : $user->profile->facebook_username }}" />
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
														<input type="text" class="form-control" placeholder="username" name="twitter_username" value="{{ old('twitter_username') ? old('twitter_username') : $user->profile->twitter_username }}" />
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
														<input type="text" class="form-control" placeholder="username" name="linkedin_username" value="{{ old('linkedin_username') ? old('linkedin_username') : $user->profile->linkedin_username }}" />
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
													<label for="skills">Skills</label>
													
													<div class="input-group">
														<span class="input-group-addon"><i class="fa fa-tasks"></i></span>
														<input type="text" class="form-control" placeholder="skill1, skill2, skill3" name="skills" value="{{ old('skills') ? old('skills') : $user->profile->skills }}" />
													</div>
													<p>Separate each skill with a comma. Exc: skill1, skill2, skill3</p>

													@if ($errors->has('skills'))
													<span class="help-block">
														<strong>{{ $errors->first('skills') }}</strong>
													</span>
													@endif
												</div>
												<div class="form-group {{ $errors->has('biography') ? ' has-error' : ' has-feedback' }}">
													<label for="biography">Biography</label>
													
													<div class="box-body pad">
														<textarea class="form-control wysitextarea" id="biography" rows="15" placeholder="Enter text here" type="text" name="biography" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required/>{{ old('biography') ? old('biography') : $user->profile->biography }}</textarea>
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
													<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
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

	<!-- <div class="row">
		<div class="col-md-12">
			<div class="nav-tabs-custom">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#plan" data-toggle="tab">Plan</a></li>
					<li><a href="#role" data-toggle="tab">Role</a></li>
					<li><a href="#keys" data-toggle="tab">Keys</a></li>
					<li><a href="#payments" data-toggle="tab">Payments</a></li>
					<li><a href="#mentor" data-toggle="tab">Mentor</a></li>
				</ul>

				<div class="tab-content">

					<div class="active tab-pane" id="plan">
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
						consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
						cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
						proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
					</div>

					<div class="tab-pane" id="role">
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
						consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
						cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
						proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
						consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
						cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
						proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
					</div>

					<div class="tab-pane" id="keys">
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
						consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
						cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
						proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
						consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
						cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
						proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
						consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
						cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
						proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
					</div>

					<div class="tab-pane" id="payments">
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
						consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
						cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
						proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
					</div>

					<div class="tab-pane" id="mentor">
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
						consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
						cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
						proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
					</div>

				</div>
			</div>
		</div>
	</div> -->

</section><!-- /.content -->

@stop