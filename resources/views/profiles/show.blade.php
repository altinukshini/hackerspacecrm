@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>Member Profile</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Members</a></li>
		<li class="active"><a href="#"> {{ $user->username }}</a></li> 
	</ol>
</section>

<!-- Main content -->
<section class="content">
	<div class="row">
	  <!-- Profile Image -->
	  <div class="col-md-4">
		<div class="box box-widget widget-user-2">
			<div class="widget-user-header bg-blue">
              <div class="widget-user-image">
                <img class="img-circle" src="/dist/img/user1-128x128.jpg" alt="User Avatar">
              </div>
              <a class="btn btn-default btn-sm pull-right" data-toggle="modal" data-target="#editProfileModal">
                <i class="fa fa-edit"></i> Edit profile
              </a>
              <h3 class="widget-user-username">{{ $user->full_name }}</h3><!-- Button trigger modal -->
              <h5 class="widget-user-desc">{{ $user->username }} </h5>
              <h6 class="widget-user-desc">In space <i class="fa fa-circle text-success"></i></h6>            
            </div>
		  <div class="box-body">
		  	<p><b>Email:</b> <a class="pull-right">{{ $user->email }}</a></p>
		  	<p><b>Phone:</b> <a class="pull-right">{{ $user->profile->phone }}</a></p>
		  	<p>
		  		<b>Social media:</b> 
		  		<span class="pull-right" style="font-size:18px;">
		  			<a target="_blank" href="http://www.facebook.com/{{ $user->profile->facebook_username }}"><i class="fa fa-facebook margin-r-5"></i></a> 
		  			<a target="_blank" href="http://www.twitter.com/{{ $user->profile->twitter_username }}"><i class="fa fa-twitter margin-r-5"></i></a> 
		  			<a target="_blank" href="http://www.linkedin.com/{{ $user->profile->linkedin_username }}"><i class="fa fa-linkedin margin-r-5"></i></a> 
		  			<a target="_blank" href="http://www.github.com/{{ $user->profile->github_username }}"><i class="fa fa-github margin-r-5"></i></a> 
		  		</span>
		  	</p>
		  	<br>

		  	<ul class="list-group list-group-unbordered">
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
		  	</ul>
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
  					<p>{{ $user->profile->biography }}</p>
  					<hr>
				  	<strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>
				  	<p>
				  	  <?php $skills = explode(',',$user->profile->skills); ?>
				  	  @foreach ($skills as $skill)
				  		<span class="label label-primary">{{ $skill }}</span>
				  	  @endforeach
				  	</p>
					
	  			</div>
	  		</div>
	  	</div>
	  </div>
	</div><!-- /.row -->

	<div class="row">
		<div class="modal fade" tabindex="-1" role="dialog" id="editProfileModal">
			<div class="modal-dialog modal-lg">
		        <div class="modal-content">
		          <div class="modal-header">
		            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		              <span aria-hidden="true">×</span></button>
		            <h4 class="modal-title">Edit profile</h4>
		          </div>
		          <div class="modal-body">
		              <form class="form-horizontal">
		            	<div class="form-group">
		            	  <label for="inputName" class="col-sm-2 control-label">Name</label>
		            	  <div class="col-sm-10">
		            		<input type="email" class="form-control" id="inputName" placeholder="Name">
		            	  </div>
		            	</div>
		            	<div class="form-group">
		            	  <label for="inputEmail" class="col-sm-2 control-label">Email</label>
		            	  <div class="col-sm-10">
		            		<input type="email" class="form-control" id="inputEmail" placeholder="Email">
		            	  </div>
		            	</div>
		            	<div class="form-group">
		            	  <label for="inputName" class="col-sm-2 control-label">Name</label>
		            	  <div class="col-sm-10">
		            		<input type="text" class="form-control" id="inputName" placeholder="Name">
		            	  </div>
		            	</div>
		            	<div class="form-group">
		            	  <label for="inputExperience" class="col-sm-2 control-label">Experience</label>
		            	  <div class="col-sm-10">
		            		<textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
		            	  </div>
		            	</div>
		            	<div class="form-group">
		            	  <label for="inputSkills" class="col-sm-2 control-label">Skills</label>
		            	  <div class="col-sm-10">
		            		<input type="text" class="form-control" id="inputSkills" placeholder="Skills">
		            	  </div>
		            	</div>
		            	<div class="form-group">
		            	  <div class="col-sm-offset-2 col-sm-10">
		            		<div class="checkbox">
		            		  <label>
		            			<input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
		            		  </label>
		            		</div>
		            	  </div>
		            	</div>
		            	<div class="form-group">
		            	  <div class="col-sm-offset-2 col-sm-10">
		            		<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
		            	  </div>
		            	</div>
		              </form>
		          </div>
		        </div>
		        <!-- /.modal-content -->
		    </div>
		</div>
	</div>


	<div class="row">
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
				</div><!-- /.tab-pane -->

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
				</div><!-- /.tab-pane -->

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
				</div><!-- /.tab-pane -->

				<div class="tab-pane" id="payments">
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
				</div><!-- /.tab-pane -->

				<div class="tab-pane" id="mentor">
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
				</div><!-- /.tab-pane -->

			  </div><!-- /.tab-content -->
			</div><!-- /.nav-tabs-custom -->
		  </div><!-- /.col -->
	</div>

</section><!-- /.content -->

<script type="text/javascript">
	$('#myModal').on('shown.bs.modal', function () {
	  $('#myInput').focus()
	})
</script>

@stop