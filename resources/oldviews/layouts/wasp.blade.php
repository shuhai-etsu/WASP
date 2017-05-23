<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="robots" content="noindex,nofollow">
    <title>WASP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">

    <link rel="shortcut icon" type="image/ico" href="https://waspdev.etsu.edu/csc/assets/images/favicon.ico">
    <link href="/css/base.css" media="screen" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="/jqwidgets/styles/jqx.base.css" type="text/css" />

    @yield('styles')


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="/jqwidgets/scripts/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="/jqwidgets/jqxcore.js"></script>
    <script type="text/javascript" src="/jqwidgets/jqxmenu.js"></script>

    <script type="text/javascript">

        $(document).ready(function ()
        {
            $("#jqxMenu").jqxMenu({width: '1000', height: '30px'});
            $("#jqxMenu").css('visibility', 'visible');
        });

    </script>

    @yield('javascript')

</head>
<body>
<!-- Header Start -->
<div id="logo">
    <div class="main">
        <div id="headerLogo">
            <a href="https://waspdev.etsu.edu/csc/" title="WASP Home">
                <img src="/images/header_logo_2014.png" alt="ETSU" width="298" height="72">
            </a>
        </div>
        <div id="headerTitle">
            <h3>Child Study Center</h3>
        </div>
        <div class="clear"></div>
    </div>
</div>

<!-- Header End -->
<!-- Navigation Start -->
<div class="nav-fixed">
    <nav id="nav-wrap">
        <div class="main">
            <div id="menu-icon">
                <div>Main Navigation</div>
            </div>
            <ul id="nav"></ul>
            <div class="clear"></div>
        </div>
    </nav>
</div>
<!-- Navigation End -->
<!--Main container start-->
<div class="container">
    <div class="row">
        <div id='jqxWidget' style='height: 30px;'>
            <div id='jqxMenu' style='visibility: hidden; margin-left: 0px;'>
                <ul>
                    <li>Users
                        <ul style='width: 250px;'>
                            <li><a href="/users/create">Add User</a></li>
                            <li type='separator'></li>
                            <li><a href="/users/showSearch">Search</a></li>
                            <li type='separator'></li>
                            <li><a href="/users/showAdvancedSearch">Advanced Search</a></li>
                            <li type='separator'></li>
                            <li><a href="/users/">View all Users</a></li>
                        </ul>
                    </li>
                    <li>Pick Lists
                        <ul style='width: 250px;'>
                            <li>Age Groups
                                <ul style='width: 220px;'>
                                    <li><a href="/age_group_types/create">Add Age Group</a></li>
                                    <li><a href="/age_group_types/">View all Age Groups</a></li>
                                </ul>
                            </li>
                            <li type='separator'></li>
                            <li>Buildings
                                <ul style='width: 220px;'>
                                    <li><a href="/buildings/create">Add Building</a></li>
                                    <li><a href="/buildings/">View all Buildings</a></li>
                                </ul>
                            </li>
                            <li type='separator'></li>
                            <li>Classrooms
                                <ul style='width: 220px;'>
                                    <li><a href="/classrooms/create">Add Classroom</a></li>
                                    <li><a href="/classrooms/">View all Classrooms</a></li>
                                </ul>
                            </li>
                            <li type='separator'></li>
                            <li>Degrees
                                <ul style='width: 220px;'>
                                    <li><a href="/degree_types/create">Add Degree</a></li>
                                    <li><a href="/degree_types/">View all Degrees</a></li>
                                </ul>
                            </li>
                            <li type='separator'></li>
                            <li>Financial Aid Types
                                <ul style='width: 220px;'>
                                    <li><a href="/financial_aid_types/create">Add Financial Aid Type</a></li>
                                    <li><a href="/financial_aid_types/">View all Financial Aid Types</a></li>
                                </ul>
                            </li>
                            <li type='separator'></li>
                            <li>Genders
                                <ul style='width: 220px;'>
                                    <li><a href="/genders/create">Add Gender</a></li>
                                    <li><a href="/genders/">View all Genders</a></li>
                                </ul>
                            </li>
                            <li type='separator'></li>
                            <li>Relationships
                                <ul style='width: 220px;'>
                                    <li><a href="/relationships/create">Add Relationship</a></li>
                                    <li><a href="/relationships/">View all Relationships</a></li>
                                </ul>
                            </li>
                            <li type='separator'></li>
                            <li>Roles
                                <ul style='width: 220px;'>
                                    <li><a href="/roles/create">Add Role</a></li>
                                    <li><a href="/roles/">View all Roles</a></li>
                                </ul>
                            </li>
                            <li type='separator'></li>
                            <li>Semesters
                                <ul style='width: 220px;'>
                                    <li><a href="/semesters/create">Add Semester</a></li>
                                    <li><a href="/semesters/">View all Semesters</a></li>
                                </ul>
                            </li>
                            <li type='separator'></li>
                            <li>Security Privileges
                                <ul style='width: 220px;'>
                                    <li><a href="/security_privilege_types/create">Add Security Privilege Type</a></li>
                                    <li><a href="/security_privilege_types/">View all Security Privilege Types</a></li>
                                </ul>
                            </li>
                            <li type='separator'></li>
                            <li>States
                                <ul style='width: 220px;'>
                                    <li><a href="/states/create">Add State</a></li>
                                    <li><a href="/states/">View all States</a></li>
                                </ul>
                            </li>
                            <li type='separator'></li>
                            <li>Suffixes
                                <ul style='width: 220px;'>
                                    <li><a href="/suffixes/create">Add Suffix</a></li>
                                    <li><a href="/suffixes/">View all Suffixes</a></li>
                                </ul>
                            </li>
                            <li type='separator'></li>
                            <li>Telephone Types
                                <ul style='width: 220px;'>
                                    <li><a href="/telephone_types/create">Add Telephone Type</a></li>
                                    <li><a href="/telephone_types/">View all Telephone Types</a></li>
                                </ul>
                            </li>
                            <li type='separator'></li>
                            <li>Weekdays
                                <ul style='width: 220px;'>
                                    <li><a href="/weekdays/create">Add Weekday</a></li>
                                    <li><a href="/weekdays/">View all Weekdays</a></li>
                                </ul>
                            </li>
                            <li type='separator'></li>
                            <li>Work Status Types
                                <ul style='width: 220px;'>
                                    <li><a href="/work_status_types/create">Add Work Status Type</a></li>
                                    <li><a href="/work_status_types/">View all Work Status Types</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>Schedules
                        <ul style='width: 250px;'>
                            <li><a href="/schedules/create">Create Schedule</a></li>
                            <li><a href="/schedules/">View all Schedules</a></li>
                        </ul>
                    </li>
                    <li>Assignments
                        <ul style='width: 250px;'>
                            <li>Classrooms
                            <ul style='width: 250px;'>
                                <li><a href="/classrooms/attendance">Attendance</a></li>
                                <li><a href="/classrooms/assignments">Assign User to Classroom(s)</a></li>
                            </ul>
                            <li type='separator'></li>
                            <li>Semesters
                                <ul style='width: 250px;'>
                                    <li><a href="/semesters/assignments">Assign Classroom to Semester</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>Reports
                        <ul style='width: 250px;'>
                            <li>Availabilities
                                <ul style='width: 220px;'>
                                    <li><a href="/availabilityReports/availabilities">Employee(s)</a></li>
                                    <li><a href="#">Gaps</a></li>
                                </ul>
                            </li>
                            <li type='separator'></li>
                            <li>Certifications
                                <ul style='width: 220px;'>
                                    <li><a href="/certificationReports/comingDueCertifications">Coming Due</a></li>
                                    <li><a href="/certificationReports/userCertifications">Employee(s)</a></li>
                                    <li><a href="/certificationReports/expiredCertifications">Expired</a></li>
                                </ul>
                            </li>
                            <li type='separator'></li>
                            <li>Emergency Contacts
                                <ul style='width: 220px;'>
                                    <li><a href="/emergencyContactReports/missing">Missing</a></li>
                                </ul>
                            </li>
                            <li type='separator'></li>
                            <li>Financial Aid
                                <ul style='width: 220px;'>
                                    <li><a href="/financialAidReports/financialAidRecipients">Recipients</a></li>
                                </ul>
                            </li>
                            <li type='separator'></li>
                            <li>Scheduling
                                <ul style='width: 220px;'>
                                    <li><a href="#">Scheduled Hours</a></li>
                                    <li><a href="#">Gaps</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    @yield('content')
</div>


<!-- Footer Start -->
<footer>
</footer>
<div id="lightboxBack"></div>
<!-- Footer End -->
</body>
</html>