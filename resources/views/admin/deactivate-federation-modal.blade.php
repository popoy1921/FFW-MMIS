<div class="modal fade" id="cb-deactivate-federation-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cb-logout-modal-title">Deactivate Trade Federation</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="cb-modal-body" class="cb-form-fluid cb-form-resp">
                    Are you sure you want to change the status of this federation from Active to <b>Inactive</b>?
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button class="btn btn-primary"> 
                <form id="deactivate-federation-form" method="POST" action="{{ route('admin.trade-federations.update-status') }}">
                    @csrf
                    @method('patch')
                    <input class="deactivate-id" type="hidden" name="guid">
                    <input type="hidden" name="status_id" value='0'>
                    <span
                        onclick="event.preventDefault();
                        this.closest('form').submit();">
                        Confirm
                    </span>
                </form>
                </button>
            </div>
        </div>
    </div>
</div>