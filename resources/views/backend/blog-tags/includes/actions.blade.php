
    <div class="btn-group" role="group" aria-label="@lang('labels.backend.access.users.user_actions')">
        <a href="{{ route('admin.blog-tags.edit', $tag) }}" data-toggle="tooltip" data-placement="top" title="@lang('buttons.general.crud.edit')" class="btn btn-primary">
            <i class="fas fa-edit"></i>
        </a>

        <div class="btn-group btn-group-sm" role="group">
            <button id="userActions" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @lang('labels.general.more')
            </button>
            <div class="dropdown-menu" aria-labelledby="companyActions">
                
                <a href="{{ route('admin.blog-tags.destroy', $tag) }}"
                   data-method="delete"
                   data-trans-button-cancel="@lang('buttons.general.cancel')"
                   data-trans-button-confirm="@lang('buttons.general.crud.delete')"
                   data-trans-title="@lang('strings.backend.general.are_you_sure')"
                       class="dropdown-item">@lang('buttons.general.crud.delete')</a>

                {{-- @switch($company->active)
                    @case(0)
                        <a href="{{ route('admin.company.mark', [$company, 1,]) }}" class="dropdown-item">@lang('buttons.backend.access.users.activate')</a>
                    @break

                    @case(1)
                        <a href="{{ route('admin.company.mark', [$company, 0]) }}" class="dropdown-item">@lang('buttons.backend.access.users.deactivate')</a>
                    @break
                @endswitch --}}
            </div>
        </div>
    </div>
