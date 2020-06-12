<div class="col">
    <div class="table-responsive">
        <table class="table table-hover">

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.name')</th>
                <td>{{ $customer->name }}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.email')</th>
                <td>{{ $customer->email }}</td>
            </tr>

            <tr>
                <th>Mobile</th>
                <td>{{$customer->mobile}}</td>
            </tr>

            <tr>
                <th>About</th>
                <td>{{$customer->about}}</td>
            </tr>

            <tr>
                <th>Company</th>
                <td>{{$customer->company->name}}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.status')</th>
                <td>
                    @if($customer->active)
                        <span class='badge badge-success'>@lang('labels.general.active')</span>
                    @else
                        <span class='badge badge-danger'>@lang('labels.general.inactive')</span>
                    @endif
                </td>
            </tr>

        </table>
    </div>
</div><!--table-responsive-->
