<form id="deactivate-user-form" method="POST" action="{{ route('admin.federation-user-update') }}">
    @csrf
    @method('patch')
    <input class="deactivate-id" type="hidden" name="id">
    <input type="hidden" name="status_id" value='0'>
</form>