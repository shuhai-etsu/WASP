<?php

namespace App\Http\Controllers;

use App\DocumentType;
use App\UserDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateDocumentRequest;    //Used for validating new age group types.
use App\Http\Requests\UpdateDocumentRequest;    //Used for validating existing age group types.


/**
 * Class: DocumentsController
 *
 * Purpose: Class handles HTTP requests (e.g. GET, PUT, DELETE, etc.) for storing, updating, deleting and displaying
 *          documents associated with student checklist. Please see routes.php to see the routes associated with this class.
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

class DocumentsController extends DefaultController
{
    /**
     * Method: index()
     *
     * Purpose: Creates a view that displays a list of documents submitted.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $user=Auth::user();
        return view('pages.application.checklist.documents.index')
                ->with('documents', UserDocument::where('user_id','=',Auth::id())->get());
    }

    /**
     * Method: create()
     *
     * Purpose: Creates a view that allows a user to upload documents. On submit,
     *          the view calls the class's store() method to validate and store the document.
     *          Please see the store() method for additional information.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('pages.application.checklist.documents.create')
            ->with('types',DocumentType::orderBy('id')->pluck('description'));
    }

    /**
     * Method: edit()
     *
     * Purpose: Creates a view displaying a given document's information for editing purposes. On submit, the view
     *          calls the class's update() method to validate and store the user's input. Please see the store()
     *          method in the class for additional information.
     *
     * @todo Log errors, route errors to error page
     *
     * @param $id ID (e.g. primary key) of the entry the user wishes to edit
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View View containing the entry's information for
     * editing purposes.
     */
    public function edit($id)
    {
        try
        {
            return view('pages.application.checklist.documents.edit')
                ->with('data', UserDocument::find($id))
                ->with('types',DocumentType::orderBy('id')->pluck('description'));
        }
        catch(Exception $exception)
        {
            //Log error and route to errors page
        }
    }

    /**
     * Method: store()
     *
     * Purpose: Attempts to store a newly uploaded document in the database.
     *          If the object validates successfully, the request object's data
     *          is used to create a new user in the database and the user is redirected
     *          to the success page.
     *
     * Notes: See notes above regarding type hinted request object.
     *
     *
     * @param Request $request Type hinted request object that validates the incoming data.
     *
     * @return Redirect Redirect the user to the documents list
     */
    public function store(CreateDocumentRequest $request)
    {
        try
        {
            $document= new UserDocument;
            $document->user_id=Auth::id();
            $document->name=$request->input('name');
            $document->type_id=$request->input('type')+1;
            $document->expiration_date=date('Y-m-d',strtotime($request->input('expiration_date')));
            $document->filename=$request->file('document_image')->store('images');
            $document->comment=$request->input('comment');
            $document->save();
            return redirect('documents');
        }
        catch(Exception $exception)
        {
            //Log error and route to errors page
        }
    }


    /**
     * Method: update()
     *
     * @param $id ID (e.g. primary key) of the entry in the database that is to be updated. Incoming data is validated
     *            through the UpdateDocumentRequest object. If the object validates successfully,
     *            the request object's data is used to update the entry's information in the database and
     *            the user is redirected to the age group type's index page
     *
     * @todo Add a check for preventing users from attempting to update the blank entry.
     * @todo Log errors, route errors to error page
     *
     * @param UpdateAgeGroupTypeRequest $request Type hinted request object that validates the incoming data.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector Redirects the user to the age
     * group types index page.
     */
    public function update($id, UpdateDocumentRequest $request)
    {
        try
        {
            $document= UserDocument::find($id);
            $document->name=$request->input('name');
            $document->type_id=$request->input('type')+1;
            $document->expiration_date=date('Y-m-d',strtotime($request->input('expiration_date')));
            $document->comment=$request->input('comment');
            $document->save();
            return redirect('documents');
        }
        catch(Exception $exception)
        {
            //Log error and route to errors page
        }
    }

    /**
     * Method: destroy()
     *
     * Purpose: Deletes a user document from the database.
     *
     * @todo Add a check for preventing users from attempting to delete the blank entry.
     * @todo Add validation to ensure authorization and entry exists. Maybe create Request class to handle deletion?
     * @todo Log errors, route errors to error page
     *
     *
     * @param $id ID (e.g. primary key) of the entry to delete from the database.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector Redirects the user to the
     * documents index page after the entry has been deleted.
     */
    public function destroy($id)
    {
        try
        {
            UserDocument::where('id', '=', $id)->delete();
            return redirect('documents');
        }
        catch(Exception $exception)
        {
            //Log error and route to the errors page
        }
    }
}
