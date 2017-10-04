<li class="header">{{ sprintf(trans_choice('strings.backend.general.you_have.notifications', $unreadNotificationCount), $unreadNotificationCount) }}</li>
<li> 
    <!--Inner Menu: contains the notifications -->
    <ul class="menu"> 
        @foreach($notifications->toArray() as $nK => $nV)
            <li class="{{$nV['is_read']?'read':'unread'}}"> 
                <!--start notification -->
                <a href="{!! route('admin.notification.index') !!}">                    
                    <i class="fa fa-exclamation-triangle text-{{$nV['type']}}"></i> {{$nV['message']}}
                </a>
            </li> 
        @endforeach        
        <!--end notification -->
    </ul>
</li>
<li class="footer"><a href="{!! route('admin.notification.index') !!}">
{{ trans('strings.backend.general.see_all.notifications') }}</a></li>
 
