<!-- Menus (Visible only on large screens) -->
<div class="list-group d-none d-lg-inline col-lg-2 col-sm-12" id="trade-federation-large-menu-list">
    @if ($side_menu === 'details')
    <a data-name="details" class="list-group-item list-group-item-action active" href="#">Details</a>
    @else
    <a data-name="details" class="list-group-item list-group-item-action" href="{{ route('admin.trade-federation-details') . '?guid=' . $federation->guid }}">Details</a>
    @endif
    @if ($side_menu === 'region_destributions')
    <a data-name="details" class="list-group-item list-group-item-action active" href="#">Region Distribution</a>
    @else
    <a data-name="details" class="list-group-item list-group-item-action" href="{{ route('admin.trade-federation-region-destributions') . '?guid=' . $federation->guid }}">Region Distribution</a>
    @endif
    @if ($side_menu === 'officers')
    <a data-name="details" class="list-group-item list-group-item-action active" href="#">Officers</a>
    @else
    <a data-name="details" class="list-group-item list-group-item-action" href="{{ route('admin.trade-federation-officers') . '?guid=' . $federation->guid }}">Officers</a>
    @endif
    @if ($side_menu === 'cba_provisions')
    <a data-name="details" class="list-group-item list-group-item-action active" href="#">Table of Key CBA Provisions</a>
    @else
    <a data-name="details" class="list-group-item list-group-item-action" href="{{ route('admin.trade-federation-cba-provisions') . '?guid=' . $federation->guid }}">Table of Key CBA Provisions</a>
    @endif
    @if ($side_menu === 'point_persons')
    <a data-name="details" class="list-group-item list-group-item-action active" href="#">MMIS Point Persons</a>
    @else
    <a data-name="details" class="list-group-item list-group-item-action" href="{{ route('admin.federation-point-persons') . '?guid=' . $federation->guid }}">MMIS Point Persons</a>
    @endif
</div>

<!-- Menus (Visible only on small screens) -->
<div class="dropdown no-arrow mb-4 col-sm-12 d-block d-lg-none">
    <button class="btn btn-primary dropdown-toggle w-100" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span>Menus</span>
        <i class="fas fa-angle-down text-gray-600 ml-1"></i>
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="trade-federation-small-menu-list">
        @if ($side_menu === 'details')
        <a data-name="details" class="dropdown-item active" href="#">Details</a>
        @else
        <a data-name="details" class="dropdown-item" href="{{ route('admin.trade-federation-details') . '?guid=' . $federation->guid }}">Details</a>
        @endif
        @if ($side_menu === 'region_destributions')
        <a data-name="details" class="dropdown-item active" href="#">Region Distribution</a>
        @else
        <a data-name="details" class="dropdown-item" href="{{ route('admin.trade-federation-region-destributions') . '?guid=' . $federation->guid }}">Region Distribution</a>
        @endif
        @if ($side_menu === 'officers')
        <a data-name="details" class="dropdown-item active" href="#">Officers</a>
        @else
        <a data-name="details" class="dropdown-item" href="{{ route('admin.trade-federation-officers') . '?guid=' . $federation->guid }}">Officers</a>
        @endif
        @if ($side_menu === 'cba_provisions')
        <a data-name="details" class="dropdown-item active" href="#">Table of Key CBA Provisions</a>
        @else
        <a data-name="details" class="dropdown-item" href="{{ route('admin.trade-federation-cba-provisions') . '?guid=' . $federation->guid }}">Table of Key CBA Provisions</a>
        @endif
        @if ($side_menu === 'point_persons')
        <a data-name="details" class="dropdown-item active" href="#">MMIS Point Persons</a>
        @else
        <a data-name="details" class="dropdown-item" href="{{ route('admin.federation-point-persons') . '?guid=' . $federation->guid }}">MMIS Point Persons</a>
        @endif
    </div>
</div>