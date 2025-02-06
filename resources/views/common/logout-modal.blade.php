<div class="modal fade" id="cb-logout-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cb-logout-modal-title">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="cb-modal-body" class="cb-form-fluid cb-form-resp">
                    Select "Logout" below if you are ready to end your current session.
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button class="btn btn-primary"> 
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <span
                            onclick="event.preventDefault();
                            this.closest('form').submit();">
                            Logout
                        </span>
                    </form>
                </button>
            </div>
        </div>
    </div>
</div>