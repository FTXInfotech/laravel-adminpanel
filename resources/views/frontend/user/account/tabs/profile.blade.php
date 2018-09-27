<table class="table table-striped table-hover">
    
    <tr>
        <th>{{ trans('labels.frontend.user.profile.first_name') }}</th>
        <td>{{ !empty($logged_in_user->first_name) ? $logged_in_user->first_name : '' }}</td>
    </tr>
    <tr>
        <th>{{ trans('labels.frontend.user.profile.last_name') }}</th>
        <td>{{ !empty($logged_in_user->last_name) ? $logged_in_user->last_name : '' }}</td>
    </tr>
    <tr>
        <th>{{ trans('labels.frontend.user.profile.email') }}</th>
        <td>{{ !empty($logged_in_user->email) ? $logged_in_user->email : '' }}</td>
    </tr>
    <tr>
        <th>{{ trans('labels.frontend.user.profile.created_at') }}</th>
        <td>{{ $logged_in_user->created_at }} ({{ $logged_in_user->created_at->diffForHumans() }})</td>
    </tr>
    <tr>
        <th>{{ trans('labels.frontend.user.profile.last_updated') }}</th>
        <td>{{ $logged_in_user->updated_at }} ({{ $logged_in_user->updated_at->diffForHumans() }})</td>
    </tr>
</table>