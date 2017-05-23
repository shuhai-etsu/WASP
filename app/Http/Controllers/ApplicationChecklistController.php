<?php

namespace App\Http\Controllers;

use App\ChecklistItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class: ApplicationChecklistController
 *
 * Purpose: Class handles HTTP requests (e.g. GET, PUT, DELETE, etc.) for storing, updating, deleting and displaying
 *          data associated with student application checklist. Please see routes.php to see the routes associated with this class.
 *
 * Notes: Creates, updates and deletes use type hinted request objects to validate incoming data. By type hinting the
 *        request object, Laravel will validate the incoming request data BEFORE executing the store(), update() and
 *        destroy methods using the validation rules defined in the type hinted request object. If validation fails,
 *        the user is automatically re-routed to the previous page. Otherwise, the request object is passed to
 *        the store() method and the entry is stored in the database.
 *
 *        The class's create(), show(), index(), and edit() methods merely show views for data presentation or
 *        data entry. Create, update and delete operations are handled by the store(), update() and delete() methods.
 *
 *        Laravel supports REST and includes several services by default, such as store(), update(), delete(), index(),
 *        etc., which can be referenced in the routes file by using the notation
 *        Route::resource('[RESOURCE NAME]', '[CONTROLLER NAME']); in the routes file.
 *
 *
 *
 * Requirement(s):
 *
 *      Document                            Section
 *      ----------------------------------------------------------------------------------------------------------------
 *
 *
 * @package App\Http\Controllers
 */

class ApplicationChecklistController extends DefaultController
{
    /**
     * Method: index()
     *
     * Purpose: Creates a view that displays a list of applications submitted.
     * @todo Authorize user before displaying the page
     * @todo use a flag in the database to differentiate between new, pending and interviewed applications. Pass a query parameter into this function to display the types of application
     *
     * @param: int $application_type The type of applications to display
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('pages.application.checklist.overview')
            ->with('items', ChecklistItem::orderBy('id')->where('id','>',1)->get());
    }

    /**
     * Method: create()
     *
     * Purpose: Creates a view that allows a user to fill out an application. On submit,
     *          the view calls the class's store() method to validate and store the new user in the database.
     *          Please see the store() method for additional information.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
 /*   public function create()
    {
        return view('pages/application.application')
            ->with('suffixes', Suffix::orderBy('id')->pluck('description'))
            ->with('states', State::orderBy('id')->pluck('description'))
            ->with('telephone_types', TelephoneType::orderBy('id')->pluck('description'))
            ->with('countries', Country::orderBy('id')->pluck('description'))
            ->with('degree_types', DegreeType::orderBy('id')->pluck('description'))
            ->with('fin_aid_types',FinancialAidType::orderBy('id')->pluck('description'))
            ->with('semesters', Semester::orderBy('id')->pluck('description', 'id'))
            ->with('weekdays', Weekday::orderBy('id')->pluck('description', 'id'));
    }*/


    /**
     * Method: show()
     *
     * Purpose: Creates a view of a specific checklist item that is stored in the database.
     *
     *
     * @param $id ID (e.g. primary key) of the checklist item the user wishes to view.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View Return a view containing application
     * information.
     */
    public function show($id)
    {
        //list of checklist items
        //@todo this needs to be generated from the database
        $list=[2=>'drug',3=>'health',4=>'phone',5=>'responsibilities'];
        return view('pages.application.checklist.'.$list[$id]);

    }

    /**
     * Method approve()
     *
     * Purpose: Invoked when the potential student worker approves or signs a particular document identified by the
     * $id passed. Stores this information along with the date signed in the user_checklist_items table
     */
    public function approve($id)
    {

    }

}
