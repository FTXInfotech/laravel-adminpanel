@extends('backend.layouts.app')

@section('page-header')
    <h1>
        {{ app_name() }}
        <small>Notifications</small>
    </h1>
@endsection

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Notifications</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div><!-- /.box tools -->
        </div><!-- /.box-header -->
        <div class="box-body">
            <ul class="timeline notification-list">
                @foreach($notifications as $notification)
                @php
                    $currentTime     = \carbon\Carbon::now();
                    $notificationTime = $notification->created_at;
                @endphp 
                <li>
                    <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i> {{$notificationTime->diffForHumans($currentTime)}}</span>
                        <h3 class="timeline-header">
                            {{$notification->message}}
                        </h3>
                    </div>
                </li>
                @endforeach
            </ul>
        </div><!-- /.box-body -->
    </div><!--box box-info-->
@endsection