<form id="remove-officer-form" method="POST" action="{{ route('admin.federation-officer.update') }}">
    @csrf
    @method('patch')
    <input type="hidden" name="guid">
    <input type="hidden" name="deleted" value='1'>
</form>