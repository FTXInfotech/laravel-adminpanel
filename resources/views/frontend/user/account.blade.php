@extends('frontend.layouts.app')

@section('content')
    <div class="row">

        <div class="col-xs-12">

            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('navs.frontend.user.account') }}</div>

                <div class="panel-body">

                    <div role="tabpanel">

                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active" id="li-profile">
                                <a href="#profile" aria-controls="profile" role="tab" data-toggle="tab" class="tabs">{{ trans('navs.frontend.user.profile') }}</a>
                            </li>

                            <li role="presentation" id="li-edit">
                                <a href="#edit" aria-controls="edit" role="tab" data-toggle="tab" class="tabs">{{ trans('labels.frontend.user.profile.update_information') }}</a>
                            </li>

                            @if ($logged_in_user->canChangePassword())
                                <li role="presentation" id="li-password">
                                    <a href="#password" aria-controls="password" role="tab" data-toggle="tab" class="tabs">{{ trans('navs.frontend.user.change_password') }}</a>
                                </li>
                            @endif
                        </ul>

                        <div class="tab-content">

                            <div role="tabpanel" class="tab-pane mt-30 active" id="profile">
                                @include('frontend.user.account.tabs.profile')
                            </div><!--tab panel profile-->

                            <div role="tabpanel" class="tab-pane mt-30" id="edit">
                                @include('frontend.user.account.tabs.edit')
                            </div><!--tab panel profile-->

                            @if ($logged_in_user->canChangePassword())
                                <div role="tabpanel" class="tab-pane mt-30" id="password">
                                    @include('frontend.user.account.tabs.change-password')
                                </div><!--tab panel change password-->
                            @endif

                            @include('frontend.user.account.upload-photo-modal')

                        </div><!--tab content-->

                    </div><!--tab panel-->

                </div><!--panel body-->

            </div><!-- panel -->

        </div><!-- col-xs-12 -->

    </div><!-- row -->
@endsection

@section('after-scripts')

<script type="text/javascript">
    $(document).ready(function() {

        // To Use Select2
        Backend.Select2.init();

        if($.session.get("tab") == "edit")
        {
            $("#li-password").removeClass("active");
            $("#li-profile").removeClass("active");
            $("#li-edit").addClass("active");

            $("#profile").removeClass("active");
            $("#password").removeClass("active");
            $("#edit").addClass("active");
        }
        else if($.session.get("tab") == "password")
        {
            $("#li-password").addClass("active");
            $("#li-profile").removeClass("active");
            $("#li-edit").removeClass("active");

            $("#profile").removeClass("active");
            $("#password").addClass("active");
            $("#edit").removeClass("active");
        }

        $(".tabs").click(function() {
            var tab = $(this).attr("aria-controls");
            $.session.set("tab", tab);
        });
    });
</script>
@endsection