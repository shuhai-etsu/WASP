@if (Auth::user()->hasRole(config('constants.role.ADMINISTRATOR')))
    <button target="#side-menu" type="button" id="hamburger" class="navbar-toggle" data-toggle="collapse" href="#side-menu">
        <i class="glyphicon glyphicon-menu-hamburger"></i>
    </button>

    <div role="navigation" class="sidebar" style="position:relative">
        <div class="navbar-collapse" id="side-menu">
            <ul class="nav">
                <li class="nav-header">
                    <a href="/notification"><i class="glyphicon glyphicon-envelope"></i> Notifications <span  class=" badge badge-info" style="float:right">4</span></a>
                </li>

                <li class="nav-header">
                    <a href="/warning"><i class="glyphicon glyphicon-exclamation-sign"></i> Warnings <span class="badge badge-info" style="float:right">1</span></a>
                </li>

                <li class="nav-header">
                    <a href="javascript:void(0);" data-toggle="collapse"><i class="glyphicon glyphicon-file"></i>Applications  <i class="glyphicon glyphicon-chevron-down"></i><span class="badge badge-info" style="float:right">{{ $sidebar_data['TotalAppCount'] }}</span></a>
                    <ul class="nav">
                        <li><a href="/application/type/{{config('constants.user_status.NEW')}}">New <span class="badge badge-info" style="float:right">{{ $sidebar_data['NewAppCount'] }}</span></a></li>
                        <li><a href="/application/type/{{config('constants.user_status.INTERVIEW')}}">Interviewing <span class="badge badge-info" style="float:right">{{ $sidebar_data['InterviewAppCount'] }}</span></a></li>
                        <li><a href="/application/type/{{config('constants.user_status.PENDING')}}">Pending <span class="badge badge-info" style="float:right">{{ $sidebar_data['PendingAppCount'] }}</span></a></li>
                        <li><a href="/application/type/{{config('constants.user_status.SHELVED')}}">Shelved<span class="badge badge-info" style="float:right">{{ $sidebar_data['DeferAppCount'] }}</span></a></li>
                    </ul>
                </li>

                <li class="nav-header">
                    <a href="#" data-toggle="collapse"><i class = "glyphicon glyphicon-briefcase"></i>Configurations <i class="glyphicon glyphicon-chevron-down"></i></a>
                    <ul class="nav">
                        <li><a href="/age_group_types">Age Group</a></li>
                        <li><a href="/certification_types">Certification</a></li>
                        <li><a href="/classrooms">Classroom</a></li>
                        <li><a href="/degree_types">Degree</a></li>
                        <li><a href="/financial_aid_types">Financial Aid</a></li>
                        <li><a href="/roles">Role</a></li>
                        <li><a href="/suffixes">Suffix</a></li>
                        <li><a href="/telephone_types">Telephone</a></li>
                    </ul>
                </li>
                <li class="nav-header">
                    <a href="#" data-toggle="collapse"><i class = "glyphicon glyphicon-stats"></i>Reports <i class="glyphicon glyphicon-chevron-down"></i></a>
                    <ul class="nav">
                       {{-- <li><a href="#">Applications</a></li>--}}
                        <li><a href="/availabilityReports/availabilities">Availabilities</a></li>
                        <li><a href="/certificationReports/userCertifications">Certifications</a></li>
                        <li><a href="/emergencyContactReports/missing">Emergency Contacts</a></li>
                        <li><a href="/financialAidReports/financialAidRecipients">Financial Aid</a></li>
                    </ul>
                </li>

                <li class="nav-header">
                    <a href="/schedules"><i class = " glyphicon glyphicon-calendar"></i>Scheduling</a>
                </li>

                <li class="nav-header">
                    <a href="/userSearch"><i class = "glyphicon glyphicon-user"></i>Users</a>
                </li>

                <li class="nav-header">
                    <a href="#" data-toggle="collapse"><i class = "glyphicon glyphicon-dashboard"></i> System <i class="glyphicon glyphicon-chevron-down"></i></a>
                    <ul class="nav">
                        <li><a href="/countries">Country Codes</a></li>
                        <li><a href="/states">State Codes</a></li>
                        <li><a href="/semesters">Semesters </a></li>
                      {{--  <li><a href="/security_privilege_types">Security Privileges</a></li> --}}
                     {{--   <li><a href="/logs">Logs</a></li>--}}
                      {{--  <li><a href="/work_status_types">Work Status</a></li> --}}
                    </ul>
                </li>
            </ul>
        </div>
    </div>
@elseif(Auth::user()->hasRole(config('constants.role.STUDENT_WORKER')))
    <button target="#side-menu" type="button" id="hamburger" class="navbar-toggle" data-toggle="collapse" href="#side-menu">
        <i class="glyphicon glyphicon-menu-hamburger"></i>
    </button>
    <div role="navigation" class="sidebar" style="position:relative">
        <div class="navbar-collapse" id="side-menu">
            <ul class="nav">
                <li class="nav-header">
                    <a href="/studentHome"><i class="glyphicon glyphicon-envelope"></i> Notifications <span class="badge badge-info">2</span></a>
                </li>
                <li class="nav-header">
                    <a href="/studentPersonalInformation">Personal Information</a>
                </li>
                <li class="nav-header">
                    <a href="/studentEmergencyContact">Emergency Contact</a>
                </li>
                <li class="nav-header">
                    <a href="/studentEducationHistory">Education</a>
                </li>
                <li class="nav-header">
                    <a href="/studentWorkExperience">Work Experience</a>
                </li>
                <li class="nav-header">
                    <a href="/studentAvailabilities">Availabilities</a>
                </li>
                {{--<li class="nav-header">--}}
                {{--<a href="/home"><i class="glyphicon glyphicon-home"></i> Dashboard</a>--}}
                {{--</li>--}}
                {{-- <li class="nav-header">
                     <a href="#" data-toggle="collapse">Availabilities <i class="glyphicon glyphicon-chevron-down"></i></a>
                     <ul class="nav">
                         <li><a href="/studentAvailabilities">View</a></li>
                         <li><a href="/studentAvailabilitiesException">Exception</a></li>
                         <li><a href="/studentAvailabilitiesChange">Request Change</a></li>
                     </ul>
                 </li>--}}
                <li class="nav-header">
                    <a href="/studentCertification">Certifications</a>

                </li>
                <li class="nav-header">
                    <a href="/studentSchedule">Schedule</a>
                </li>
            </ul>
        </div>
    </div>
@endif

