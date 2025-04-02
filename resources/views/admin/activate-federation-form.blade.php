<form id="activate-federation-form" method="POST" action="{{ route('admin.trade-federations.update-status') }}">
    @csrf
    @method('patch')
    <input type="hidden" name="guid">
    <input type="hidden" name="status_id" value='1'>
</form>