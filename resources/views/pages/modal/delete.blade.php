 <!-- modal -->
    <div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="delete_modal_label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h3 class="modal-title" id="delete_modal_label">Confirm Delete</h3>
                </div>
                <div class="modal-body">
                    <b>Are you sure you want to delete {{$item->name}}?</b><br/>
                </div>
                <div class="modal-footer">
                        {{ Form::open(['method' => 'DELETE',
                                       'route' => [$item->type.'.destroy', $item->id],
                                       'role'=>'form',
                                       'class'=>'modal-delete'
                                       ]) }}
                            {{Form::submit('Delete', array('class'=>'btn btn-danger'))}}
                            {{Form::button('Cancel', array('class'=>'btn btn-primary', 'data-dismiss' => 'modal'))}}
                        {{Form::close()}}
                </div>
            </div>
        </div>
    </div>