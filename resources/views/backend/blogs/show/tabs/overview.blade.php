<div class="col">
    <div class="table-responsive">
        <table class="table table-hover">
            <tr>
                <th>Logo</th>
                <td><img src="{{ $company->logo }}" class="user-profile-image" /></td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.name')</th>
                <td>{{ $company->name }}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.email')</th>
                <td>{{ $company->email }}</td>
            </tr>

            <tr>
                <th>Website</th>
                <td>{{$company->website}}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.status')</th>
                <td>
                    @if($company->isActive())
                        <span class='badge badge-success'>@lang('labels.general.active')</span>
                    @else
                        <span class='badge badge-danger'>@lang('labels.general.inactive')</span>
                    @endif
                </td>
            </tr>

        </table>
    </div>
</div><!--table-responsive-->
