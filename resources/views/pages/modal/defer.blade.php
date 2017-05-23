{{--/**
 * Bootstrap modal that is shown when admin chooses to defer the application
 * Created by PhpStorm.
 * User: sauhardad
 * Date: 1/29/17
 * Time: 8:47 PM
 */--}}

<div class="modal fade" id="defer_modal" tabindex="-1" role="dialog" aria-labelledby="defer_modal_label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="modal-title" id="defer_modal_label">Defer Application</h3>
            </div>

            <div class="modal-body" style="padding:10%;">
                <div class="form-group">
                    <label for="no_semesters" class="control-label col-sm-6">Number of semesters to defer:</label>
                    <div class="col-sm-3">
                        <select id="no_semesters">
                            <option>One</option>
                            <option>Two</option>
                            <option>Three</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="modal-footer">
                <a href="{{isset($action_route)? $action_route:'#'}}" class="btn btn-primary" data-dismiss="{{isset($action_route)? '':'modal'}}">Save</a>
                <button type = "button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
