@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>Settings</h1>
</section>

<section class="content">
  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Menus</h3>
    </div>
    <div class="box-body">
    	<button class="btn btn-success btn-md"><i class="fa fa-plus"></i> Add new</button>

      <div class="box-body table-responsive no-padding">
		<br style="clear:both;">
        <table class="table table-hover">
      	<tbody><tr>
      	  <th>ID</th>
      	  <th>icon</th>
      	  <th>Title</th>
      	  <th>URL</th>
      	  <th>p.id</th>
      	  <th>permission</th>
      	  <th>group</th>
      	  <th>order</th>
      	  <th>description</th>
      	  <th>action</th>
      	</tr>
      	<tr style="background-color:#ebebeb;">
      	  <td>1</td>
      	  <td><i class="fa fa-dashboard"></i></td>
      	  <td>Dashboard</td>
      	  <td>dashboard</td>
      	  <td>0</td>
      	  <td>member</td>
      	  <td>mainnavigation</td>
      	  <td>0</td>
      	  <td>Lorem ipsum</td>
      	  <td><a href="#"><i class="fa fa-edit text-blue margin-r-5"></i></a> <a href="#"><i class="fa fa-times-circle-o text-red margin-r-5"></i></a></td>
      	</tr>
      	<tr style="background-color:#ebebeb;">
      	  <td>2</td>
      	  <td><i class="fa fa-bar-chart"></i></td>
      	  <td>Reports</td>
      	  <td>reports</td>
      	  <td>0</td>
      	  <td>member</td>
      	  <td>mainnavigation</td>
      	  <td>0</td>
      	  <td>Lorem ipsum</td>
      	  <td><a href="#"><i class="fa fa-edit text-blue margin-r-5"></i></a> <a href="#"><i class="fa fa-times-circle-o text-red margin-r-5"></i></a></td>
      	</tr>
      	<tr>
      	  <td>3</td>
      	  <td><i class="fa fa-line-chart"></i></td>
      	  <td>Frequentation</td>
      	  <td>reports/frequentation</td>
      	  <td>2</td>
      	  <td>member</td>
      	  <td>mainnavigation</td>
      	  <td>1</td>
      	  <td>Lorem ipsum</td>
      	  <td><a href="#"><i class="fa fa-edit text-blue margin-r-5"></i></a> <a href="#"><i class="fa fa-times-circle-o text-red margin-r-5"></i></a></td>
      	</tr>
      	<tr>
      	  <td>4</td>
      	  <td><i class="fa fa-line-chart"></i></td>
      	  <td>Membership</td>
      	  <td>reports/membership</td>
      	  <td>2</td>
      	  <td>member</td>
      	  <td>mainnavigation</td>
      	  <td>2</td>
      	  <td>Lorem ipsum</td>
      	  <td><a href="#"><i class="fa fa-edit text-blue margin-r-5"></i></a> <a href="#"><i class="fa fa-times-circle-o text-red margin-r-5"></i></a></td>
      	</tr>
      	<tr>
      	  <td>5</td>
      	  <td><i class="fa fa-line-chart"></i></td>
      	  <td>Expenses</td>
      	  <td>reports/expenses</td>
      	  <td>2</td>
      	  <td>member</td>
      	  <td>mainnavigation</td>
      	  <td>3</td>
      	  <td>Lorem ipsum</td>
      	  <td><a href="#"><i class="fa fa-edit text-blue margin-r-5"></i></a> <a href="#"><i class="fa fa-times-circle-o text-red margin-r-5"></i></a></td>
      	</tr>

      	<tr style="background-color:#ebebeb;">
      	  <td>6</td>
      	  <td><i class="fa fa-rocket"></i></td>
      	  <td>Membership</td>
      	  <td>membership</td>
      	  <td>0</td>
      	  <td>member</td>
      	  <td>mainnavigation</td>
      	  <td>0</td>
      	  <td>Lorem ipsum</td>
      	  <td><a href="#"><i class="fa fa-edit text-blue margin-r-5"></i></a> <a href="#"><i class="fa fa-times-circle-o text-red margin-r-5"></i></a></td>
      	</tr>
      	<tr>
      	  <td>7</td>
      	  <td><i class="fa fa-mortar-board"></i></td>
      	  <td>Members</td>
      	  <td>members/all</td>
      	  <td>6</td>
      	  <td>member</td>
      	  <td>mainnavigation</td>
      	  <td>1</td>
      	  <td>Lorem ipsum</td>
      	  <td><a href="#"><i class="fa fa-edit text-blue margin-r-5"></i></a> <a href="#"><i class="fa fa-times-circle-o text-red margin-r-5"></i></a></td>
      	</tr>
      	<tr>
      	  <td>4</td>
      	  <td><i class="fa fa-child"></i></td>
      	  <td>Mentors</td>
      	  <td>membership/mentors</td>
      	  <td>6</td>
      	  <td>member</td>
      	  <td>mainnavigation</td>
      	  <td>2</td>
      	  <td>Lorem ipsum</td>
      	  <td><a href="#"><i class="fa fa-edit text-blue margin-r-5"></i></a> <a href="#"><i class="fa fa-times-circle-o text-red margin-r-5"></i></a></td>
      	</tr>
      	<tr>
      	  <td>5</td>
      	  <td><i class="fa fa-ticket"></i></td>
      	  <td>Plans</td>
      	  <td>membership/plans</td>
      	  <td>6</td>
      	  <td>member</td>
      	  <td>mainnavigation</td>
      	  <td>3</td>
      	  <td>Lorem ipsum</td>
      	  <td><a href="#"><i class="fa fa-edit text-blue margin-r-5"></i></a> <a href="#"><i class="fa fa-times-circle-o text-red margin-r-5"></i></a></td>
      	</tr>	

        </tbody></table>
      </div>
    </div><!-- /.box-body -->
  </div><!-- /.box -->
</section><!-- /.content -->

@stop