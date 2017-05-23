@extends('template.layout_sidebar')

@push('javascript')
    <script type="text/javascript">

        {{--
        //==============================================================================================================
        // Details: The scheduler works in the following manner:
        //
        //          (1) The scheduler is displayed in the web page with the day view showing. The scheduler supports
        //              day, week, month and agenda views. The scheduler is set to default to day view when the page is
        //              in initially displayed (see var scheduler = (function()) declaration below.
        //          (2) A user has the ability to double click or right click on a cell to launch the edit dialog
        //              window, which displays a list of employees who are available to work during the select
        //              date/time. Users can also select multiple cells, however double clicking is disabled for
        //              multi-cell selection. To select multiple cells the user must select the cells and right click
        //              the highlighted cells to launch the context menu.
        //                  (a) If a user double clicks a cell the following functions are called in the scheduler:
        //                          (1) createEditDialog - Creates the edit dialog window. Initializes all of the
        //                                                 controls shown on the window and prepares the window for
        //                                                 display. After the scheduler creates the window, the
        //                                                 scheduler maintains a reference to the window, unless
        //                                                 specifically destroyed. DO NOT destroy the edit dialog
        //                                                 winodow. Destroying and recreating the window caused the
        //                                                 windows to display irradically during testing.
        //
        //                          (2) editDialogOpen - Displays the dialog, queries the database for employees who
        //                                               can work during the selected time and displays the results in
        //                                               the grid for user selection. After a user makes his/her
        //                                               selections and presses [Save], the function calls a helper
        //                                               function to parse the grid and get the selected entries,
        //                                               package the entries into appointment objects, which are
        //                                               required by the scheduler, adds the appointments to the
        //                                               scheduler's underlying data array and refreshes the scheduler
        //                                               to shcw the user's selections.
        //
        //                                               The edit dialog supports a repeat weekly option, which allows a
        //                                               user to repeat a selection for the entire semester from the
        //                                               selected date/time(s) FORWARD. When the repeat option is
        //                                               selected the helper function that creates new appointments
        //                                               creates a new appointment option for each day of the repeat
        //                                               cycle. For instance, if a user selected to repeat an
        //                                               every Monday from 8:00-9:00, the function would create
        //                                               new appointments for every Monday from 8:00-9:00 to the end of
        //                                               the semester and add the new appointments to the scheduler's
        //                                               data array. The scheduler supports repeating appointments.
        //                                               however, it does so by adding string values to the
        //                                               appointment's repeat field, which allows the scheduler to
        //                                               replicate the entry across the date range. Using the
        //                                               scheduler's default method prevented the repeatable
        //                                               appointments from being captured by the middleware when a user
        //                                               saved his/her selections. As a workaround, new appointments
        //                                               were created and added directly to the scheduler's data array,
        //                                               which circumvented the scheduler's default functionality.
        //                                               Additionally, by default, if a user deleted a reoccuring
        //                                               appointment entry, then it deleted the ENTIRE list of
        //                                               appointments that were flagged as repeatable. Not using the
        //                                               scheduler's default functionality and adding the
        //                                               adding new appointments directly to the scheduler's data array
        //                                               fixed both issues.
        //
        //                          (3) editDialogClose - Clears the grid selections made by the user and closes the
        //                                                edit dialog window. The selections MUST be explicitly cleared
        //                                                since the edit dialog maintains a reference to the edit dialog
        //                                                window instead of creating a new edit dialog on each user
        //                                                double click or context menu selection.
        //                  (b) If a user right clicks a cell or multiple highlighted cells, then the following
        //                      functions are called:
        //                          (1) createContextMenu - Creates and initializes the context menu, which presents
        //                                                  the user with a list of options, such creating and deleting
        //                                                  appointments. The function disables the edit appointment
        //                                                  option.
        //                          (2) openContextMenu - Displays the context menu and captures the user's selection.
        //                              (a) If creating a new appointment option is selected, the the functions listed
        //                                  in Section A above are called.
        //                              (b) If the user selects to delete an existing appointment, the context menu
        //                                  click function calls a helper function (deleteAppointment()) and removes
        //                                  the appointment from the scheduler's underlying data array.
        //
        //                  (c) User presses [Save] - Performs an AJAX call that saves all of the new appointments
        //                                            listed in the scheduler are saved to the database. Appointments
        //                                            marked as deleted are removed from the databases. Existing entries
        //                                            are updated. The AJAX call returns the list of appointments and
        //                                            refreshes the scheduler with the list of appointments. This is
        //                                            necessary because the scheduler and middleware are dependant upon
        //                                            an appointment's entry_id field (primary key), which determines if
        //                                            the entry has been stored in the database.
        //
        //                  (d) User presses [Validate] - Needs to be implemented. Should validate the appointment
        //                                                entries in the scheduler and supply the user with a list of
        //                                                errors before the schedule can be approved for circulation.
        //
        // Notes: Comments are wrapped in Laravel comment blocks to prevent comments from being included in the
        //        rendered page.
        //
        // Design Considerations:
        //
        //  (1) Editing of appointments, specifically an appointment's date and time have been disabled. The reason
        //      being is that a user can potentially change the start and end times to values that are outside a user's
        //      availability to work, which would invalidate the entry. Since user's can work irregular hours, we cannot
        //      allow someone who is creating a schedule to enter random date values for user availabilities. The
        //      correct availability date/times from users are determined through AJAX calls to the middleware in the
        //      functions listed below, such as refreshGrid() and refreshScheduler(). See those functions for addtional
        //      information.
        //
        //  (2) jqxScheduler does not allow for the setting of the start day to begin at 30 minute increments. Therefore
        //      you must pick an integer number, such as 7 or 8.
        //
        // To Do:
        //
        //  IMMEDIATE CONCERNS:
        //  (1) Under grid()->create() function, change the "editable: true" parameter to false and add a mouse click
        //      event to select/deselect a row entry in the table. With the parameter set to true, a user can type in
        //      in the rows of the table, which should be non-editable.
        //
        //  (2) Complete the scheduler's enableEditDialog() function, which enables/disables the controls shown on the
        //      edit dialog. This is necessary to prevent the user from clicking the edit dialog's save button while the
        //      data is being retrieved through AJAX.
        //
        //  (3) Add a "Loading" notification (jqxLoader) in the edit dialog to signal the dialog is retrieving the data
        //      from the database (see refreshGrid() function). This is done the in saveData() method of the scheduler.
        //      See the saveData() method for reference. Adding a modal jqxLoader may negate item 2.
        //
        //  (4) Errors that are thrown during AJAX calls need to be routed to an errors page and logged.
        //
        //  (5) Add printing capabilities.
        //
        //  PENDING:
        //  (1) Validation logic, which should be completed on the middleware, needs to be added when a user presses
        //      the [Validate] button.
        //
        //
        //  POSSIBLE CONSIDERATIONS:
        //  (1) Consider having a user setting that allows a user to set scheduler's view. Currently the scheduler
        //      is set to display the dayView. A setting could be added to the database that allows a user to set the
        //      scheduler to day, week, month or agenda at start-up.
        //
        //
        //==============================================================================================================
        --}}


        {{--
        /**
         * Function: grid()
         *
         * Purpose: Creates a jqxGrid wrapper object that encapsulates the underlying jqxGrid's capabilities. The grid
         *          is used to display a list of available workers (users) that are available to work during a given
         *          time segment selected by the user. The displayed workers can be selected by the user, which is
         *          stored as an appoinment by the scheduler and displayed on the scheduler control.
         *
         *          The grid is added to the scheduler's edit dialog (editDialog object) and is shown when a user
         *          double clicks and EMPTY row or right clicks the mouse to create a new appointment. The edit dialog
         *          is discussed in the detail in the scheduler section.
         *
         * Parameters: None.
         */
         --}}
        var grid = (function ()
        {
            {{--
            //==========================================================================================================
            //Renderer that is used to format the certifications column in the grid. The certifications are returned as
            //a concatenated string value, such as "CPR,CCW,." The CONCAT call appends and extra "," at the end of the
            //last entry. The renderer removes the last "," and formats the entry with the correct display and spacing.
            //The renderer is instantiated in the grid's columns array declaration show below (see Certifications
            //column).
            //==========================================================================================================
            --}}
            var renderer = function(row)
            {
                {{--
                //======================================================================================================
                //Get a handle to the row that needs to be formatted.
                //======================================================================================================
                --}}
                var certs = $('#jqxgrid').jqxGrid('getrowdata', row).certifications;

                {{--
                //======================================================================================================
                //If a certification(s) exists for the user, then format it accordingly. The certifications are returned
                //from the database concatenated by commas (e.g. ","). So if the user has a certification(s), then
                //remove the trailing comma and return the formatted string so it can be displayed in the grid.
                //======================================================================================================
                --}}
                if(certs && certs.length >  0)
                {
                    return '<span style="margin: 4px; margin-top: 7px; float: left;">' +
                            certs.slice(0,certs.length-1).trim().split(',') +
                            '</span>';
                }

                return certs;
            }

            {{--
            //==========================================================================================================
            //Columns that are displayed by the grid (unless hidden). The user_id field is hidden since it is the
            //primary key for a user entry and should not be changed/edited.
            //==========================================================================================================
            --}}
            var columns =
            [
                {text: '', columntype: 'checkbox', datafield: 'selected', width: 20 },
                {text: 'User ID', datafield: 'user_id', width: 50, hidden: true},
                {text: 'Last Name', datafield: 'last_name', width: 100},
                {text: 'First Name', datafield: 'first_name', width: 100},
                {text: 'Certifications', datafield: 'certifications', cellsrenderer: renderer, width: 280}
            ];

            {{--
            //==========================================================================================================
            //Datafields that will be referenced by the grid when displaying data. The datafields MUST MATCH the column
            //declarations shown above or the grid with throw an error and fail to display.
            //==========================================================================================================
            --}}
            var datafields =
            [
                {name: 'selected', type: 'boolean'},
                {name: 'user_id', type: 'string'},
                {name: 'last_name', type: 'string'},
                {name: 'first_name', type: 'string'},
                {name: 'certifications', type: 'string'}
            ];

            {{--
            //==========================================================================================================
            //Source object used by the grid to display/render entries. The grid EXPECTS a JSON string to be supplied
            //as its data source (e.g. localData value). The localdata value is initially set to NULL. The parameter
            //is updated through AJAX (see refreshGrid() listed below). The grid EXPECTS to receive the data as a
            //JSON formatted object from the middleware.
            //==========================================================================================================
            --}}
            var source =
            {
                datafields: datafields,
                datatype: "json",
                localdata: null
            };

            {{--
            //==========================================================================================================
            //Create the data adapter that will be used by the grid to store and render data. The dataAdapter acts as
            //a controller for accessing the underlying data (consider MCV where the data (JSON object is the model,
            //the dataAdapter is the controller and the view is the grid).
            //==========================================================================================================
            --}}
            var dataAdapter = new $.jqx.dataAdapter(source);

            {{--
            /**
             * Function: create()
             *
             * Purpose: Initializes and creates the data grid for display and selection purposes.
             *
             * Parameters: None.
             */
            --}}
            function create()
            {
               $("#jqxgrid").jqxGrid
               (
                   {
                       width: 505,
                       height: 250,
                       source: dataAdapter,             {{-- reference to the dataAdapter declared above. --}}
                       sortable: true,
                       filterable: true,
                       columnsresize: true,
                       selectionmode: 'singlerow',      {{-- only allow single row selections. --}}
                       editable: true,                  {{-- see notes above about fixing this parameter. --}}
                       altrows: true,
                       columns: columns                 {{-- reference to the columns object declared above. --}}
                   }
               );

                {{--
                //======================================================================================================
                //Register/bind the cell edit event to capture when a user selects an entry (e.g. selects the checkbox
                //associated with the entry).
                //
                //NOTE: THIS NEEDS TO BE CHANGED to capture a user's mouse click on a single row. The click event should
                //      check or uncheck the entry accordingly (see IMMEDIATE CONERNS listed above).
                //======================================================================================================
                --}}
               $("#jqxgrid").bind('cellendedit', function (event)
               {
                    if (event.args.value)
                    {
                        $("#jqxgrid").jqxGrid('selectrow', event.args.rowindex);
                    }
                    else
                    {
                       $("#jqxgrid").jqxGrid('unselectrow', event.args.rowindex);
                    }
               });
            }

            {{--
            /**
             * Function: refreshGrid()
             *
             * Purpose: Function accepts a start/end time parameters and uses the parameters to search the database
             *          for workers who are available to work during the given time frame using AJAX. The result set
             *          is shown in the grid for user selection.
             *
             * Parameters: start - date/time value denoting the user selected start time
             *             end - date/time value denoting the user selected end time
             *
             * To Do: Need to add a "Loading" pop-up (jqxLoader) object to show the edit dialog is retrieving the data.
             */
            --}}
            function refreshGrid(start, end)
            {
                {{--
                //Could add a reference to jqxLoader here.
                --}}

                {{--
                //======================================================================================================
                //IMPORTANT: We must clear the grid before querying the database and displaying the results. The
                //scheduler's edit dialog maintains a reference to the edit dialog when it is first created by double
                //clicking on a cell/row within the scheduler or by right clicking and launching the context menu.
                //Therefore, if we don't clear the grid then the previous entries will be initally displayed before the
                //AJAX call refreshed the grid with new data.
                //======================================================================================================
                --}}
                $('#jqxgrid').jqxGrid('clear');

                {{--
                //======================================================================================================
                //Prepare the parameters that will be passed to the middleware to retrieve a list of user's who are
                //available to work during the user selected start and end times. The start and end times are obtained
                //from the scheduler cells selectd by the user.
                //
                //We must pass the schedule_id, which is the primary id of the schedule (HTML hidden field - see HTML
                //section below), a start time (start), an end time (end) and the token value, which is auto-generated
                //by Laraval. If we do not pass the token Laravel will not recognize the call.
                //======================================================================================================
                --}}
                var params =
                {
                    'schedule_id': $('input[name=schedule_id]').val(),
                    'start': start,
                    'end': end,
                    '_token': $('input[name=_token]').val()
                }

                {{--
                //======================================================================================================
                //Once we have configured our parameter list, we can use AJAX to call the middleware to retrieve the
                //data from the database.
                //======================================================================================================
                --}}
                $.ajax
                (
                    {
                        url : "/schedules/getAvailabilities",
                        type: "GET",
                        data: params,
                        {{--
                        //==============================================================================================
                        //Method will fire if the AJAX call completes successfully.
                        //==============================================================================================
                        --}}
                        success: function(data, textStatus, jqXHR)
                        {
                            if(data)
                            {
                                {{--
                                //======================================================================================
                                //So if data was returned from the database, then reset the grids data source to the
                                //incoming JSON object, create a new dataAdapter and use the grid's refresh meth
                                //('updatebounddata') to display the data.
                                //======================================================================================
                                --}}
                                source.localdata = data;
                                dataAdapter = new $.jqx.dataAdapter(source);
                                $("#jqxgrid").jqxGrid({source: dataAdapter});
                                $('#jqxgrid').jqxGrid('updatebounddata');

                                {{--
                                //======================================================================================
                                //Close the reference to the jqxLoader (if used).
                                //======================================================================================
                                --}}
                            }
                        },
                        {{--
                        //==============================================================================================
                        //Method will fire if the AJAX call fails to complete successfully.
                        //==============================================================================================
                        --}}
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert(errorThrown);

                            {{--
                            //==========================================================================================
                            //NEED TO ROUTE TO AN ERROR PAGE AND LOG THE ERROR
                            //
                            //Must close the reference to the jqxLoader (if used) in the error condition as well.
                            //==========================================================================================
                            --}}
                        }
                    }
                );
            }
            {{--
            //==========================================================================================================
            //Expose the methods that are provided by the grid object outside of calling $(#jqxgrid).
            //
            //IMPORTANT: The curly bracket "{" must be placed directly after the return statement. It cannot be placed
            //           on separate line. Javascript will throw an error if the curly bracket is on a separate line.
            //==========================================================================================================
            --}}
            return {
                init: function (start, end)
                {
                    create();
                },
                refresh: function (start, end)
                {
                    refreshGrid(start, end);
                }
            }
        }());


        {{--
        /**
         * Function: scheduler()
         *
         * Purpose: Creates a jqxScheduler wrapper object that encapsulates the underlying jqxScheduler's capabilities.
         *
         * Parameters: None
         */
        --}}
        var scheduler = (function()
        {
            var deletedEntries = new Array();   {{-- array that is used to keep track of appointments deleted by the
                                                     user. The array only maintains deleted appointments that are
                                                     existing entries in the database --}}
            var currentView = 'dayView';        {{-- set the default view to DAY VIEW. --}}
            var data = '{!! $entries !!}';      {{-- JSON object (if an existing schedule with data) returned from the
                                                     database --}}

            {{--
            //==========================================================================================================
            //Use Laravel's Carbon object to format the date correctly. Javascript's date constructor is limited and
            //will only allow you to create a date using milliseconds, a cryptic date string parameter or by supplying
            //the year, date and month. Carbon allows us to quickly grad the year, month, day values from the
            //incoming date objects.
            //==========================================================================================================
            --}}
            var startDate = new $.jqx.date
            (
                    {!!  Carbon\Carbon::parse($schedule->semester->start_date)->year !!},
                    {!!  Carbon\Carbon::parse($schedule->semester->start_date)->month !!},
                    {!!  Carbon\Carbon::parse($schedule->semester->start_date)->day !!}
            );

            var endDate = new $.jqx.date
            (
                    {!!  Carbon\Carbon::parse($schedule->semester->end_date)->year !!},
                    {!!  Carbon\Carbon::parse($schedule->semester->end_date)->month !!},
                    {!!  Carbon\Carbon::parse($schedule->semester->end_date)->day !!}
            );

            {{--
            //==========================================================================================================
            //Create the source object that will be used to store appoinment information (e.g. schedule entries). The
            //scheduler supports a predetermined set of datafields. The entry_id, start_date, start_time, end_date and
            //end_time fields were added to support the requirements of our application. The fields will be described
            //in detail in the sections below.
            //==========================================================================================================
            --}}
            var source =
            {
                dataType: "array",
                dataFields:
                        [
                            { name: 'id', type: 'string' },
                            { name: 'entry_id', type: 'string' },
                            { name: 'user_id', type: 'string' },
                            { name: 'subject', type: 'string' },
                            { name: 'calendar', type: 'string' },
                            { name: 'draggable', type: 'string' },
                            { name: 'color', type: 'string' },
                            { name: 'background', type: 'string' },
                            { name: 'resizable', type: 'string' },
                            { name: 'start', type: 'date' },
                            { name: 'end', type: 'date' },
                            { name: 'start_date', type: 'string' },
                            { name: 'start_time', type: 'string'},
                            { name: 'end_date', type: 'string' },
                            { name: 'end_time', type: 'string' }
                        ],
                id: 'id',
                localData: new Array()
            };

            var schedulerAdapter = new $.jqx.dataAdapter(source);

            {{--
            /**
             * Function: create()
             *
             * Purpose: Function creates the scheduler and initializes its underlying data structure.
             *
             * Parameters: None
             *
             * Return: None
             */
             --}}
            function create()
            {
                $("#scheduler").jqxScheduler
                (
                    {
                        date: startDate,
                        min: startDate,
                        max: endDate,
                        width: 925,
                        height: 800,
                        view: currentView,
                        source: schedulerAdapter,
                        showLegend: true,

                        resources:
                        {
                            colorScheme: "scheme05",
                            dataField: "calendar",
                            source:  new $.jqx.dataAdapter(source)
                        },

                        {{--
                        //==============================================================================================
                        //Enable the appointment data fields that will be used by the scheduler to display and track
                        //appointments (schedule entries)
                        //==============================================================================================
                        --}}
                        appointmentDataFields:
                        {
                            id: "id",
                            from: "start",
                            to: "end",
                            entry_id: "entry_id",
                            user_id: "user_id",
                            subject: "subject",
                            draggable: "draggable",
                            resizable: "resizable",
                            color: "color",
                            background: "background",
                            resourceId: "calendar"
                        },

                        {{--
                        //==============================================================================================
                        //Create the views that are to be displayed to the user for editing/viewing purposes. The views
                        //are restricted to show common work hours, Monday - Friday from 7:00 am to 5:00 pm.
                        //
                        //LIMITATION: jqxScheduler does not allow the time values to be set to 30 minutes, such as
                        //            7:30 am. Therefore, the work day has to begin at a integer value, such as at 7am
                        //            or 8 am.
                        //==============================================================================================
                        --}}
                        views:
                        [
                            {
                                type: "dayView",
                                showWeekends: false,
                                timeRuler: {hidden: false, scaleStartHour: MIN_TIME_INT, scaleEndHour: MAX_TIME_INT},
                                workTime: {fromDayOfWeek: 1, toDayOfWeek: 5, fromHour: MIN_TIME_INT, toHour: MAX_TIME_INT}
                            },
                            {
                                type: "weekView", showWeekends: false, timeRuler: {hidden: false},
                                showWeekends: false,
                                timeRuler: {hidden: false, scaleStartHour: MIN_TIME_INT, scaleEndHour: MAX_TIME_INT},
                                workTime: {fromDayOfWeek: 1, toDayOfWeek: 5, fromHour: MIN_TIME_INT, toHour: MAX_TIME_INT}
                            },
                            {
                                type: "monthView", showWeekends: false, timeRuler: {hidden: false},
                                showWeekends: false,
                                timeRuler: {hidden: false, scaleStartHour: MIN_TIME_INT, scaleEndHour: MAX_TIME_INT},
                                workTime: {fromDayOfWeek: 1, toDayOfWeek: 5, fromHour: MIN_TIME_INT, toHour: MAX_TIME_INT}
                            },
                            {
                                type: "agendaView", showWeekends: false, timeRuler: {hidden: false},
                                showWeekends: false,
                                timeRuler: {hidden: false, scaleStartHour: MIN_TIME_INT, scaleEndHour: MAX_TIME_INT},
                                workTime: {fromDayOfWeek: 1, toDayOfWeek: 5, fromHour: MIN_TIME_INT, toHour: MAX_TIME_INT}
                            }
                        ],

                        /**
                         * Function: contextMenuCreate()
                         *
                         * Purpose: Function provided by jqxScheduler that allows additional features to be added to the
                         *          the context menu, which is shown when a user right mouse clicks the scheduler.
                         *
                         * Parameters: menu -
                         *             settings -
                         */
                        contextMenuCreate: function (menu, settings)
                        {
                            settings.source.push({id: "deleteAppointment", label: "Delete Appointment"});
                        },

                        {{--
                        /**
                         * Function: contextMenuOpen()
                         *
                         * Purpose: Function exposed by the scheduler to allow manipulation of the context menu. The
                         *          function configures the context menu to allow users to select the options of
                         *          creating or deleting appointments. The delete option is only display if a user
                         *          right clicks on an existing appointment. The edit appointment option is disabled.
                         *          Function also adjusts based upon the view the user is currently view. For instance,
                         *          if a user is in the month view, then he/she cannot add new appointments, but can
                         *          deleted appointments.
                         *
                         * Parameters: menu - Handle to the scheduler's context menu
                         *             appointment - Appointment (if applicable) that is to be edited or deleted.
                         *                           Editing is disabled.
                         *             event - Event fired by the scheduler containing reference information about the
                         *                     event's attributes.
                         */
                         --}}
                        contextMenuOpen: function (menu, appointment, event)
                        {
                            {{--
                            //==========================================================================================
                            //Prevent editing of appointments.
                            //==========================================================================================
                            --}}
                            menu.jqxMenu("hideItem", "editAppointment");

                            {{--
                            //==========================================================================================
                            //If the month view is selected, the we must prevent the user from adding new appointments
                            //because we would need to enable the from and to date/time fields that would allow a user
                            //to possibly select date/times outside an allowed range. Therefore, only allow users to
                            //add new appointments in the day and week views.
                            //==========================================================================================
                            --}}
                            if(currentView == 'monthView')
                            {
                                menu.jqxMenu("hideItem", "createAppointment");

                                if(appointment)
                                {
                                    menu.jqxMenu("showItem", "deleteAppointment");
                                }
                                else
                                {
                                    menu.jqxMenu("hideItem", "deleteAppointment");
                                }
                            }
                            {{--
                            //==========================================================================================
                            //Prevent the user from adding or deleting appointments from the agenda view.
                            //==========================================================================================
                            --}}
                            else if(currentView == 'agendaView')
                            {
                                menu.jqxMenu("hideItem", "createAppointment");
                                menu.jqxMenu("hideItem", "deleteAppointment");
                            }
                            {{--
                            //==========================================================================================
                            //Otherwise, we are working out of the day or week view, so handle accordingly.
                            //==========================================================================================
                            --}}
                            else
                            {
                                if (!appointment)
                                {
                                    {{--
                                    //==================================================================================
                                    //Ensure the edit dialog is available. This is necessary because disabling the edit
                                    //dialog window causes the window to display irradically. This was added as a
                                    //workaround to address the issue.
                                    //==================================================================================
                                    --}}
                                    $("#scheduler").jqxScheduler({editDialog: true});

                                    menu.jqxMenu("showItem", "createAppointment");
                                    menu.jqxMenu("hideItem", "deleteAppointment");
                                }
                                else if (appointment)
                                {
                                    menu.jqxMenu("hideItem", "createAppointment");
                                    menu.jqxMenu("showItem", "deleteAppointment");
                                }
                            }
                        },

                        {{--
                        /**
                         * Function: contextMenuItemClick()
                         *
                         * Purpose: Function exposed by the scheduler to determine when a user clicks the context menu
                         *          and allows the application to respond accordingly to the user's request.
                         *
                         * Parameters: menu - Handle to the scheduler's context menu
                         *             appointment - Appointment (if applicable) that is to be edited or deleted.
                         *                           Editing is disabled.
                         *             event - Event fired by the scheduler containing reference information about the
                         *                     event's attributes.
                         */
                         --}}
                        contextMenuItemClick: function (menu, appointment, event)
                        {
                            var option = event.args.id;

                            {{--
                            //==========================================================================================
                            //Create a new schedule entry (appointment) by opening the edit dialog and allow the user to
                            //schedule a worker for a given date and time.
                            //==========================================================================================
                            --}}
                            if(option == "createAppointment")
                            {
                                if(appointment)
                                {
                                    $('#scheduler').jqxScheduler('ensureAppointmentVisible', appointment.id);
                                    $('#scheduler').jqxScheduler('openDialog');
                                }
                            }
                            {{--
                            //==========================================================================================
                            //Delete an schedule entry (appointment) from the scheduler's data array.
                            //==========================================================================================
                            --}}
                            else if(option == "deleteAppointment" && appointment)
                            {
                                deleteAppointment(appointment);
                                refreshScheduler();
                            }
                        },

                        {{--
                        /**
                         * Function: Function exposed by the scheduler to allow for the modification of the edit dialog
                         *           windows. The edit dialog window comes with several controls by default. However,
                         *           additional controls were added to meet the specifications of the application.
                         *
                         * Purpose: Creates and initializes the edit dialog window.
                         *
                         * Parameters: dialog - Handle to the scheduler's edit dialog window.
                         *             fields - Handle to the fields displayed in the edit dialog window.
                         *             editAppointment - Appointment (if applicable) that is to be edited or deleted.
                         *                               Editing is disabled.
                         */
                        --}}
                        editDialogCreate: function (dialog, fields, editAppointment)
                        {
                            {{--
                            //==========================================================================================
                            //Show/hide the necessary fields provided by default by the edit dialog window.
                            //==========================================================================================
                            --}}
                            fields.statusContainer.hide();
                            fields.timeZoneContainer.hide();
                            fields.colorContainer.hide();
                            fields.descriptionContainer.hide();
                            fields.subjectContainer.hide();
                            fields.locationContainer.hide();
                            fields.allDayContainer.hide();
                            fields.resourceContainer.hide();

                            fields.resourceLabel.html("Calendar");

                            fields.fromLabel.html("From:");
                            fields.toLabel.html("To:");

                            fields.from.jqxDateTimeInput({disabled: true});
                            fields.to.jqxDateTimeInput({disabled: true});
                            fields.from.jqxDateTimeInput({formatString: 'MM/dd/yyyy hh:mm:ss tt'});
                            fields.to.jqxDateTimeInput({formatString: 'MM/dd/yyyy hh:mm:ss tt'});

                            fields.repeatContainer.remove();
                            fields.saveButton.remove();
                            fields.deleteButton.remove();

                            {{--
                            //==========================================================================================
                            //Now, add our controls to the edit dialog window, such as the data grid and repeat option.
                            //==========================================================================================
                            --}}

                            $("#dialogscheduler").children().last().before
                            (
                                    "<div id=gridContainer>" +
                                    "   <div>" +
                                    "       <br/><br/><br/><br/>" +
                                    "       <label id='availabilities' style='margin-top:10px'>" +
                                    "        Availabilities:</label>" +
                                    "   </div>" +
                                    "   </div>" +
                                    "       <div id='jqxgrid'></div>" +
                                    "   </div>" +
                                    "</div>"
                            );

                            $('#availabilities').css
                            (
                                    {
                                        fontFamily: $("#dialogscheduler").css('font-family'),
                                        fontSize: $("#dialogscheduler").css('font-size'),
                                        fontWeight: "normal"
                                    }
                            );

                            var repeatCheckbox = $("<div id='repeat' style='margin-left:10px;" +
                                                   "float:left;'>Repeat Weekly</div>");

                            repeatCheckbox.jqxCheckBox({ height:25,
                                                         width:150,
                                                         theme: this.theme });

                            var saveButton = $("<button id='save' style='height:25px;width:55px;" +
                                               "margin-left:5px;float:right;'>Save</button>");
                            fields.buttons.append(repeatCheckbox);
                            fields.buttons.append(saveButton);

                            saveButton.jqxButton({ theme: this.theme });
                            saveButton.click(function ()
                            {
                                saveDialogSelections(dialog, fields, editAppointment);
                            });

                            grid.init();
                        },

                        {{--
                        /**
                         * Function: editDialogOpen()
                         *
                         * Purpose: Function exposed by the scheduler. The method is called when a user attempts to
                         *          add a new appointment by double clicking a cell or selecting create new appointment
                         *          from the context menu.
                         *
                         * Parameters: dialog - Handle to the scheduler's edit dialog window.
                         *             fields - Handle to the fields displayed in the edit dialog window.
                         *             editAppointment - Appointment (if applicable) that is to be edited or deleted.
                         *                               Editing is disabled.
                         */
                        --}}
                        editDialogOpen: function (dialog, fields, editAppointment)
                        {
                            fields.from.jqxDateTimeInput({formatString: 'MM/dd/yyyy hh:mm:ss tt'});
                            fields.to.jqxDateTimeInput({formatString: 'MM/dd/yyyy hh:mm:ss tt'});

                            if(!editAppointment)
                            {
                                $('#gridContainer').show();
                                $('#jqxgrid').show();
                                $('#repeat').show();

                                var selection = $('#scheduler').jqxScheduler('getSelection');
                                grid.refresh(selection.from.toString(), selection.to.toString());
                            }
                            else
                            {
                                $('#gridContainer').hide();
                                $('#jqxgrid').hide();
                                $('#repeat').hide();
                            }
                        },

                        {{--
                        /**
                         * Function: editDialogClose()
                         *
                         * Purpose: Function exposed by the scheduler, which is called when the edit dialog is closed.
                         *          Function clears any selections made by the user when the edit dialog was displayed.
                         *
                         * Parameters: dialog - Handle to the scheduler's edit dialog window.
                         *             fields - Handle to the fields displayed in the edit dialog window.
                         *             editAppointment - Appointment (if applicable) that is to be edited or deleted.
                         *                               Editing is disabled.
                         */
                        --}}
                        editDialogClose: function (dialog, fields, editAppointment)
                        {
                            $('#repeat').jqxCheckBox({checked:false});
                            $('#jqxgrid').jqxGrid('clear');
                        },
                        {{--
                        //==============================================================================================
                        //The ready() is overrriden to load the scheduler with schedule entries (appointments) returned
                        //from the data (if applicable) when the schedule is initally displayed.
                        //==============================================================================================
                        --}}
                        ready: function ()
                        {
                            {{--
                            //==========================================================================================
                            //If there is data returned from the database, then we need to load it the scheduler
                            //and refresh the scheduler so the user can see the results. This occurs when a user selects
                            //to update and existing scheduler. Schedule entries (appointments) are retrieved from the
                            //database and passed to the view, which are loaded into the scheduler through the
                            //loadJSONData() function.
                            //==========================================================================================
                            --}}
                            if(data)
                            {
                                loadJSONData(data);
                                refreshScheduler();
                            }
                        }
                    }
                );
            }

            /**
             * Function: cellDoubleClick()
             *
             * Purpose: Function capture when a user double clicks one of the scheduler's cells.
             *
             * Parameters: event -
             */
            $('#scheduler').on('cellDoubleClick', function (event)
            {
                if(currentView == 'monthView' || currentView == 'agendaView')
                {
                    $("#scheduler").jqxScheduler({editDialog: false});
                }
                else
                {
                    $("#scheduler").jqxScheduler({editDialog: true});
                    $("#scheduler").jqxScheduler('openDialog');
                }
            });

            {{--
            /**
             * Function: viewChange()
             *
             * Purpose: Function exposed by the scheduler that allows the application to determine with the user selects
             *          a different view, such as moving to day view to month view. The function enables/disables the
             *          edit dialog window based upon the view the user selected. The application is designed to prevent
             *          a user from attempting to create new appointments in the month or agenda view.
             *
             * Parameters: event - Event object encapsulating the change view event.
             */
             --}}
            $('#scheduler').on('viewChange', function (event)
            {
                currentView = event.args.newViewType;

                if(currentView === "monthView" || currentView == "agendaView")
                {
                    $("#scheduler").jqxScheduler({ editDialog: false});
                }
                else
                {
                    $("#scheduler").jqxScheduler({ editDialog: true});
                }
            });

            {{--
            /**
             * Function: appointmentClick()
             *
             * Purpose: Function exposed by the scheduler that allows a user to edit an existing appointment on a mouse
             *          click event. The function prevents users from editing appointments by disabling/hiding the edit
             *          dialog window.
             *
             * Parameters: event - Event object encapsulating the change view event.
             */
            --}}
           $('#scheduler').on('appointmentClick', function (event)
            {
                $("#scheduler").jqxScheduler({ editDialog: false});
            });

            {{--
            /**
             * Function: appointmentDoubleClick()
             *
             * Purpose: Function exposed by the scheduler that allows a user to edit an existing appointment on a mouse
             *          double click event. The function prevents users from editing appointments by disabling/hiding
             *          the edit dialog window.
             *
             * Parameters: event - Event object encapsulating the change view event.
             */
            --}}
            $('#scheduler').on('appointmentDoubleClick', function (event)
            {
                $("#scheduler").jqxScheduler({ editDialog: false});
            });

            {{--
            /**
             * Function: saveDialogSelections()
             *
             * Purpose: Function checks the grid in the edit dialog to see if the user selected any workers to work
             *          at a given date and time. The function uses the information contained in the selection(s) to
             *          create new appointments, which are added to the scheduler's underlying data array. The function
             *          works in the following manner:
             *
             *                  (1) A user selects a start and end time on the scheduler by double clicking a cell or
             *                      by highlighting a range of cells and right clicking to display the "Create
             *                      Appointment" option in the context menu, which displays the scheduler's edit dialog.
             *                  (2) The edit dialog contains a jqxGrid that is populated through an AJAX call when the
             *                      edit dialog is initally displayed (see grid.refresh()). The grid is refreshed
             *                      through an AJAX call that retrieves the users who are available to work at the
             *                      date/time selected by the user when he/she initially clicked on a cell within the
             *                      scheduler or selected a series of cells and launched the context menu.
             *                  (3) The grid in the edit dialog allows a user to select users to work at the given date
             *                      and time.
             *                  (4) The user selects the appropriate entries from the grid and presses the [Save] button
             *                      shown on the edit dialog. The [Save] button's onclick event calls the
             *                      saveDialogSelections() function.
             *                  (5) The saveDialogSelections() function gets the selected entries from the grid and uses
             *                      the information to create appointments (e.g. schedule entries) for scheduling the
             *                      selected users to work at the given date/time. The appointments are added to the
             *                      scheduler's underlying data array and the scheduler is refreshed to shown the
             *                      new appointments.
             *
             * Note: Function refreshes the scheduler.
             *
             * Parameters: dialog - Handle to the edit dialog.
             *             fields - Handle to the HTML fields comprising the edit dialog.
             *             appointment - Appointment that is to be edited even though editing has been disabled.
             *                           Currently the function will allow a user to edit the background color of a
             *                           given appointment, but nothing more (see Design Considerations listed above).
             */
            --}}
            function saveDialogSelections(dialog,fields,appointment)
            {
                var name = null;
                var count = 0;
                var user_id = 0;
                var stopDate = null;
                var rows = null;
                var fromDate = null;
                var toDate = null;
                var tmpFromDate = null;
                var tmpToDate = null;
                var backgroundColor = fields.color.val();

                if(appointment)
                {
                    appointment.background = backgroundColor;
                }
                else
                {
                    {{--
                    //==================================================================================================
                    //Get the rows selected by the user from the grid shown in the edit dialog.
                    //==================================================================================================
                    --}}
                    rows = $("#jqxgrid").jqxGrid('getrows');

                    {{--
                    //==================================================================================================
                    //If the user selected entries in the grid then we must extract the pertinent data from the
                    //selections, create new appointments based upon the selections and refresh the scheduler so the
                    //data will be displayed to the user.
                    //==================================================================================================
                    --}}
                    if (rows && rows.length > 0)
                    {
                        fromDate = $.jqx.dataFormat.formatdate
                        (
                                new Date(fields.from.jqxDateTimeInput('getDate')),
                                'MM/dd/yyyy hh:mm:ss tt'
                        );

                        toDate = $.jqx.dataFormat.formatdate
                        (
                                new Date(fields.to.jqxDateTimeInput('getDate')),
                                'MM/dd/yyyy hh:mm:ss tt'
                        );

                        count = source.localData.length;

                        for (var i = 0; i < rows.length; i++)
                        {
                            if (rows[i].selected)
                            {
                                name = rows[i].last_name + ", " + rows[i].first_name;
                                user_id = rows[i].user_id;

                                addAppointment(count++, name, -1, user_id, name,
                                        backgroundColor, fromDate, toDate);

                                if ($('#repeat').jqxCheckBox('checked'))
                                {
                                    tmpFromDate = advanceDate(fromDate, 7);
                                    tmpToDate = advanceDate(toDate, 7);
                                    stopDate = new Date(endDate.toString());

                                    while (tmpFromDate <= stopDate)
                                    {
                                        tmpFromDate = $.jqx.dataFormat.formatdate
                                        (
                                                tmpFromDate,
                                                'MM/dd/yyyy hh:mm:ss tt'
                                        );

                                        tmpToDate = $.jqx.dataFormat.formatdate
                                        (
                                                tmpToDate,
                                                'MM/dd/yyyy hh:mm:ss tt'
                                        );

                                        addAppointment
                                        (
                                                count++,
                                                name,
                                                -1,
                                                user_id,
                                                name,
                                                backgroundColor,
                                                tmpFromDate,
                                                tmpToDate
                                        );

                                        tmpFromDate = advanceDate(tmpFromDate, 7);
                                        tmpToDate = advanceDate(tmpToDate, 7);
                                    }
                                }
                            }
                        }
                    }
                }

                refreshScheduler();
                $('#scheduler').jqxScheduler('closeDialog');
            }

            {{--
            /**
             * Function: addAppointment()
             *
             * Purpose: Function is used to adds new Appointment objects to the scheduler's appointment array. The
             *          appointment array is used by the scheduler to track and visually/graphically display
             *          appointments in the UI control (jqxScheduler).
             *
             * Limitations: Function DOES NOT refresh the scheduler after the function is called. However, the scheduler
             *              can be refreshed by calling refreshScheduler(). See the refreshScheduler() for additional
             *              information.
             *
             * Parameters:  id - ID field used by the scheduler to uniquely identify an appointment.
             *              subject - String value that is used to represent an appointment in the scheduler's display,
             *                        such as "Smith, John" for a given date/time entry.
             *              entry_id - Primary key of the schedule entry returned from the database. If the schedule
             *                         entry has not been stored in the database (e.g. a new entry), the value is set to
             *                         -1.
             *              user_id - Primary key of the user (e.g. employee/worker) who is scheduled to work duing the
             *                        given appointment.
             *              calendar - String value used to represent the entry in calendar view.
             *              background - String value containing the background color assigned to the appointment. The
             *                           background color allows appointments to be displayed in various colors in the
             *                           scheduler's display.
             *              start_date - Javascript Date object that denotes when a given appointment's work hours are
             *                           are scheduled to begin.
             *              end_date - Javascript Date object that denotes when a given appointment's work hours are
             *                         are scheduled to end.
             *
             * Return: None
             */
             --}}
            function addAppointment(id, subject, entry_id, user_id, calendar,
                                    background, start_date, end_date)
            {
                var appointment =
                {
                    id: id,
                    subject: subject,
                    entry_id: entry_id,
                    user_id: user_id,
                    draggable: false,
                    resizeable: false,
                    calender: calendar,
                    background: background,
                    start: start_date,
                    end: end_date,
                    start_date: start_date.toString(),
                    end_date: end_date.toString()
                };

                {{--
                //======================================================================================================
                //Once we have created the appointment, we must add (push) the appointment to the scheduler's underlying
                //data array.
                //======================================================================================================
                --}}
                source.localData.push(appointment);
            }

            {{--
            /**
             * Function: deleteAppointment()
             *
             * Purpose: Deletes/removes a schedule entry (appointment) from the scheduler's underlying data array.
             *
             * Parameters: appointment - Schedule entry that is to be deleted.
             *
             * Return: None.
             */
             --}}
            function deleteAppointment(appointment)
            {
                {{--
                //======================================================================================================
                //Get a handle to the scheduler's data array, which contains schedule entries (e.g. appointments).
                //======================================================================================================
                --}}
                var data = source.localData;

                if (data.length > 0)
                {
                    {{--
                    //==================================================================================================
                    //Loop the data array to find the item we are looking to delete.
                    //==================================================================================================
                    --}}
                    for (var i = 0; i < data.length; i++)
                    {
                        if (data[i].id == appointment.id)
                        {
                            {{--
                            //==========================================================================================
                            //If the entry_id > 0 then the entry has previously been saved to the database, so need to
                            //flag it for deletion. Items with entry_id's < 0 can be removed from underlying data array
                            //without being flagged since they have not been saved to the database.
                            //==========================================================================================
                            --}}
                            if (data[i].entry_id > 0)
                            {
                                deletedEntries.push(data[i]);
                            }
                            {{--
                            //==========================================================================================
                            //Remove the item from the underlying data array so the item will not be displayed in the
                            //scheduler when the scheduler is refreshed.
                            //==========================================================================================
                            --}}
                            data.splice(i, 1);
                        }
                    }
                }
            }

            {{--
            /**
             * Function: advanceDate()
             *
             * Purpose: Helper function that accepts a Javascript Date object and advances the date N number of days
             *          as determined by the user
             *
             * Parameters: date - Javascript Date object that is to be advanced.
             *             numberOfDays - integer value representing the number of days the date will be advanced.
             *
             * Return: Javascript date object representing the advanced date.
             */
             --}}
            function advanceDate(date, numberOfDays)
            {
                var result = new Date(date);
                result.setDate(result.getDate() + numberOfDays);
                return result;
            }

            {{--
            /**
             * Function: loadJSONData()
             *
             * Purpose: Function accepts a JSON object containing appointments (e.g. schedule entries) and processes the
             *          data, which is displayed in the scheduler.
             *
             * Parameters: data - JSON object containing schedule entries.
             *
             * Return: None.
             */
            --}}
            function loadJSONData(data)
            {
                {{--
                //======================================================================================================
                //Make sure the incoming JSON object is valid (e.g. not null) before proceeding.
                //======================================================================================================
                --}}
                if(data)
                {
                    {{--
                    //==================================================================================================
                    //If valid, then convert the incoming JSON object into an array and process accordingly.
                    //==================================================================================================
                    --}}
                    var items = JSON.parse(data);
                    var count = 0;
                    source.localData = new Array();

                    {{--
                    //==================================================================================================
                    //Loop through the JSON object and create new schedule entries (appointments) to display in the
                    //scheduler.
                    //==================================================================================================
                    --}}
                    for(var i = 0; i < items.length; i++)
                    {
                        var entry = items[i];
                        var subject = entry.last_name + " " + entry.first_name;

                        {{--
                        //==============================================================================================
                        //The scheduler and middleware are dependant upon the dates being in the correct format, so
                        //format accordingly.
                        //==============================================================================================
                        --}}
                        var startDate = $.jqx.dataFormat.formatdate
                                        (
                                            new Date(entry.day.split(" ")[0] + " " + entry.start_time),
                                            'MM/dd/yyyy hh:mm:ss tt'
                                        );

                        var endDate = $.jqx.dataFormat.formatdate
                                      (
                                            new Date(entry.day.split(" ")[0] + " " + entry.end_time),
                                            'MM/dd/yyyy hh:mm:ss tt'
                                      );

                        {{--
                        //==============================================================================================
                        //Now add the new entry to the scheduler's underlying data array.
                        //==============================================================================================
                        --}}
                        addAppointment(count++, subject, entry.id, entry.user_id, subject,
                                       entry.background, startDate, endDate);
                    }
                }
            }

            {{--
            /**
             * Function: refreshScheduler()
             *
             * Purpose: Refreshes the scheduler when changes to the underlying schedule entries are made by the user,
             *          such as adding a new entry (appointment) or deleting an entry.
             *
             * Parameters: None.
             *
             * Notes: The scheduler's data source is recreated for each refresh request. This is required because the
             *        scheduler keeps a reference to the data array containing schedule entries (appointments) and will
             *        not release the reference. Also, certain properties of schedule entries must be reset for each
             *        change to the data array. This appears to be an anomaly associates with the scheduler. For some
             *        reason jqxScheduler will not automatically update the entries without performing the tasks listed
             *        in the function even though the attributes are contained in the individual array entries. If the
             *        tasks are not performed, then the scheduler will not prevent the user from dragging or resizing
             *        a schedule entry.
             *
             * Return: None.
             */
             --}}
            function refreshScheduler()
            {
                {{--
                //======================================================================================================
                //Get a handle to the schedulers data array containing appointments(schedule entries)
                //======================================================================================================
                --}}
                var data = source.localData;

                {{--
                //======================================================================================================
                //Create a new data adapter for the scheduler with the updated source, which contains a handle to the
                //schedule entries array.
                //======================================================================================================
                --}}
                $("#scheduler").jqxScheduler({source: new $.jqx.dataAdapter(source)});

                {{--
                //======================================================================================================
                //Notify the scheduler we are updating its schedule entries (appointments).
                //======================================================================================================
                --}}
                $("#scheduler").jqxScheduler('beginAppointmentsUpdate');

                {{--
                //======================================================================================================
                //Cycle each element in the data array and update its properties so the schedule will prevent certain
                //actions or display certain attributes.
                //======================================================================================================
                --}}
                for(var i=0;i<data.length;i++)
                {
                    $("#scheduler").jqxScheduler('setAppointmentProperty', data[i].id, 'resizable', false);
                    $("#scheduler").jqxScheduler('setAppointmentProperty', data[i].id, 'draggable', false);
                    $("#scheduler").jqxScheduler('setAppointmentProperty', data[i].id, 'background', data[i].background);
                }

                {{--
                //======================================================================================================
                //Let the schedule know we are finished updating the underlying schedule entries so the scheduler can
                //refresh the appointments shown on the control.
                //======================================================================================================
                --}}
                $("#scheduler").jqxScheduler('endAppointmentsUpdate');
            }
            {{--
            //==========================================================================================================
            //Generate handles to method calls that allow the user to get a handle to sections of the scheduler's
            //underlying functionality.
            //==========================================================================================================
            --}}
            return {
                init: function()
                {
                    create()
                },
                load: function(data)
                {
                    loadJSONData(data);
                },
                reset: function()
                {
                    deletedEntries = [];
                },
                refresh: function()
                {
                    refreshScheduler();
                },
                getDeletedAppointments: function ()
                {
                    return deletedEntries;
                },
                getAppointments: function()
                {
                    return source.localData;
                },
                enableEditDialog: function($enable)
                {
                    {{--
                    //==================================================================================================
                    //NEEDS TO BE IMPLEMENTED. SEE IMMEDIATE CONCERNS ABOVE.
                    //==================================================================================================
                    --}}
                }
            };
        }());

        {{--
        /**
         * Function: saveButton()
         *
         * Purpose: Encapsulates the save button's attributes and functions.
         *
         * Parameters: None
         */
        --}}
        var saveButton = (function()
        {
            function create()
            {
                $("#save").jqxButton
                (
                        {
                            width: 65,
                            height: 30
                        }
                );

                $('#save').on('click', function (event)
                {
                    saveData();
                });
            }

            return {
                init: function()
                {
                    create()
                }
            };
        }());

        {{--
        /**
         * Function: validateButton()
         *
         * Purpose: Encapsulates the validation button's attributes and functions.
         *
         * Parameters: None
         */
        --}}
        var validateButton = (function()
        {
            function create()
            {
                $("#validate").jqxButton
                (
                        {
                            width: 85,
                            height: 30
                        }
                );

                $('#validate').on('click', function (event)
                {
                    //To be implemented
                });
            }

            return {
                init: function()
                {
                    create()
                }
            };
        }());

        {{--
        /**
         * Function: saveData()
         *
         * Purpose: Gets a handle the scheduler's underlying data array and a handle to the deleted appointments array,
         *          converts the entries to JSON and ships them off to the middleware for processing. The function
         *          accepts the JSON object returned from the middleware, parses the object and adds the appointments
         *          to the scheduler and refreshes the scheduler
         *
         * Parameters: None
         */
        --}}
        function saveData()
        {
            {{--
            //==========================================================================================================
            //Show a wait indicator since it may take some time to process the request..
            //==========================================================================================================
            --}}
            $('#loader').jqxLoader('open');

            {{--
            //==========================================================================================================
            //Get handles to the scheduler's underlying data arrays.
            //==========================================================================================================
            --}}
            var appointments = scheduler.getAppointments();
            var deletedAppointments = scheduler.getDeletedAppointments();

            $('#save').jqxButton({disabled:true});
            $('#validate').jqxButton({disabled:true});

            {{--
            //==========================================================================================================
            //Only process if there are appointments displayed in the scheduler or if a user deleted an appointment(s).
            //==========================================================================================================
            --}}
            if(appointments.length > 0 || deletedAppointments.length > 0)
            {
                {{--
                //======================================================================================================
                //Prepare the JSON call by converting the data arrays into JSON objects.
                //======================================================================================================
                --}}
                var params =
                {
                    'schedule_id': $('input[name=schedule_id]').val(),
                    'appointments': JSON.stringify(appointments),
                    'deletedAppointments': JSON.stringify(deletedAppointments),
                    '_token': $('input[name=_token]').val()
                }

                {{--
                //======================================================================================================
                //Send the data to the middleware for processing and storage.
                //======================================================================================================
                --}}
                $.ajax
                (
                    {
                        url: "/schedules/saveAppointments",
                        type: "POST",
                        data: params,
                        success: function (data, textStatus, jqXHR)
                        {
                            if(data)
                            {
                                scheduler.reset();
                                scheduler.load(data);
                                scheduler.refresh();
                            }

                            $('#loader').jqxLoader('close');
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            $('#loader').jqxLoader('close');
                            alert(errorThrown);
                        }
                    }
                );
            }
            else
            {
                $('#loader').jqxLoader('close');
            }

            $('#save').jqxButton({disabled:false});
            $('#validate').jqxButton({disabled:false});
        }

        $(document).ready(function ()
        {
            scheduler.init();
            saveButton.init();
            validateButton.init();

            $("#loader").jqxLoader({width: 250, height:60, isModal: true, text: "Saving...Please wait" });
        });

    </script>
@endpush

@section('page')
    <div class="container" style="width: 100%; height: 650px; margin-top: 5px;" id="container">

        <div class="form-group">
            <div class="col-sm-12 control-label">
                <h3><b>Schedule</b> - {!! $schedule->description !!}</h3>
                <h5>Semester: {!! $schedule->semester->description !!}, Classroom: {!! $schedule->classroom->description !!}</h5>
            </div>
        </div>

        @if (count($errors) > 0)
            <div class="form-group col-sm-12">
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        {!! Form::open(array('route' => 'schedules.store', 'class' => 'form-horizontal', 'role' => 'form')) !!}

        <div class="form-group">
            {{ Form::hidden('schedule_id', $schedule->id) }}
        </div>

        <div class="form-group">
        </div>

        <div class="form-group col-sm-12">
            <div id="scheduler"></div>
        </div>

        <div class="form-group col-sm-12">
            <div id="loader"></div>
        </div>

        <div class="form-group padding-top-2">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="button" class="btn btn-primary"value="Save" id='save'/>
                <input type="button" value="Validate" id='validate'/>
            </div>
        </div>
        {{ Form::close() }}
    </div>
@stop