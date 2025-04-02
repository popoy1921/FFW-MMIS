<form id="deactivate-federation-form" method="POST" action="{{ route('admin.trade-federations.update-status') }}">
    @csrf
    @method('patch')
    <input class="deactivate-id" type="hidden" name="guid">
    <input type="hidden" name="status_id" value='0'>
</form>