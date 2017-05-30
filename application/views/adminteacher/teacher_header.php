<!doctype html>
<html lang="en">
<head>
	<!-- <meta charset="utf-8" /> -->
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>ENSYFI</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <!-- Bootstrap core CSS     -->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" />

    <!--  Light Bootstrap Dashboard core CSS    -->
    <link href="<?php echo base_url(); ?>assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>

    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="<?php echo base_url(); ?>assets/css/demo.css" rel="stylesheet" />

    <!--     Fonts and icons     -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/stroke/css/pe-icon-7-stroke.css">
		<!--   Core JS Files and PerfectScrollbar library inside jquery.ui   -->
		<script src="<?php echo base_url(); ?>assets/js/jquery.min.js" type="text/javascript"></script>
		<script src="<?php echo base_url(); ?>assets/js/jquery-ui.min.js" type="text/javascript"></script>
		<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js" type="text/javascript"></script>
	<!--  Forms Validations Plugin -->
	<script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
	  <script src="<?php echo base_url(); ?>assets/js/jquery.datatables.js"></script>

<style>
.navbar{
margin-bottom:0px;}
.sidemenu{margin-top:78px;}

.caret{
		position: relative;
		top: -20px;
		float: right;
}

.alert button.close {
	position: relative;top:10px;
}
.error{
	color: red;
font-weight: 500;
}

</style>
</head>
<body>

<div class="wrapper">
	<nav class="navbar navbar-default">
			<div class="container-fluid">

				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">ENSYFI Dashboard </a>
				</div>
				<div class="collapse navbar-collapse">
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown dropdown-with-icons">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<div class="photo">
										<i class="pe-7s-user pe-7x" style="font-size:35px;"></i>
											</div>
								<p class="hidden-md hidden-lg">
									More
									<b class="caret"></b>
								</p>
							</a>
							<ul class="dropdown-menu dropdown-with-icons">
								<li>
									<a href="<?php echo base_url(); ?>teacherprofile/profilepic">
										<i class="pe-7s-tools"></i> Profile
									</a>
								</li>
								 <li>
                           <a href="<?php echo base_url(); ?>teacherprofile/profile">
                           <i class="pe-7s-tools"></i> Setting
                           </a>
                        </li>
								<li class="divider"></li>

								<li>
									<a href="<?php echo base_url(); ?>adminlogin/logout" class="text-danger">
										<i class="pe-7s-close-circle"></i>
										Log out
									</a>
								</li>
							</ul>
						</li>

					</ul>
				</div>
			</div>
		</nav>
    <div class="sidebar sidemenu" data-color="purple"  style="">

    	<div class="sidebar-wrapper">


            <ul class="nav">
                <li class="" id="dash">
                    <a href="<?php echo base_url(); ?>">
                        <i class="pe-7s-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

								<li id="atten">
										<a data-toggle="collapse" href="#attendmenu">
												<i class="pe-7s-note2"></i>
												<p>Attendance	</p>
												<b class="caret"></b>
										</a>
										<div class="collapse" id="attendmenu">
											<ul class="nav">
													<li id="atten1"><a href="<?php echo base_url();  ?>teacherattendence/home">Update Attendance</a></li>
													<li id="atten2"><a href="<?php echo base_url();  ?>teacherattendence/view">View Attendance</a></li>
													<!-- <li id="atten3"><a href="<?php echo base_url();  ?>teacherattendence/monthview">Month view</a></li> -->

											</ul>
									</div>
								</li>

								<li id="home">
										<a data-toggle="collapse" href="#homeworkmenu">
												<i class="pe-7s-flag"></i>
												<p>Home Work	</p>
												<b class="caret"></b>
										</a>
										<div class="collapse" id="homeworkmenu">
											<ul class="nav">
										<li id="home1"><a href="<?php echo base_url(); ?>homework/home">Home Work</a></li>
													<!-- <li><a href=""> Home Work</a></li>
													<li><a href=""> Class Test</a></li> -->

											</ul>
									</div>
								</li>
								<li id="exam">
										<a data-toggle="collapse" href="#examinationmenu">
												<i class="pe-7s-plugin"></i>
												<p>Examination Result</p>
												<b class="caret"></b>
										</a>
										<div class="collapse" id="examinationmenu">
											<ul class="nav">
								<li id="exam3"><a href="<?php echo base_url(); ?>examinationresult/exam_duty"> Exam Duty</a></li>
										<li id="exam1"><a href="<?php echo base_url(); ?>examinationresult/home">Add Exam Marks</a></li>
										<li id="exam2"><a href="<?php echo base_url(); ?>examinationresult/view_exam_name_marks">Edit Exam Marks</a></li>

											</ul>
									</div>
								</li>
								<li id="calendar">
										<a data-toggle="collapse" href="#calendermenu">
												<i class="pe-7s-gym"></i>
												<p>Calender	</p>
												<b class="caret"></b>
										</a>
										<div class="collapse" id="calendermenu">
											<ul class="nav">
												<li id="calendar1"><a href="<?php echo base_url(); ?>teacherevent/calender">Calender</a></li>
												<li id="calendar2"><a href="<?php echo base_url(); ?>teacherevent/home">List of Event</a></li>

											</ul>
									</div>
								</li>

								<li id="comm">
										<a data-toggle="collapse" href="#commmenu">
												<i class="pe-7s-comment"></i>
												<p>Communication</p>
												<b class="caret"></b>
										</a>
										<div class="collapse" id="commmenu">
											<ul class="nav">
										<li id="comm1"><a href="<?php echo base_url(); ?>teachercommunication/home">Apply Leaves </a></li>
                         <li id="comm2"><a href="<?php echo base_url(); ?>teachercommunication/view_circular">View Circulars</a></li>
											</ul>
									</div>
								</li>
								<li id="timetable">
										<a data-toggle="collapse" href="#timetablemenu">
												<i class="pe-7s-diskette"></i>
												<p>Time Table	</p>
													<b class="caret"></b>
										</a>
										<div class="collapse" id="timetablemenu">
											<ul class="nav">
										<li id="timetable1"><a href="<?php echo base_url(); ?>teachertimetable/home">Time Table</a></li>
										<li id="timetable2"><a href="<?php echo base_url(); ?>teachertimetable/reviewview">Reviews</a></li>
											</ul>
									</div>

								</li>
            </ul>
    	</div>
    </div>
