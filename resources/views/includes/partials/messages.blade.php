@php
    $message = '';
    $type = '';
    $dontHide = false;

    if(session()->has('dontHide')) {
        $dontHide = session()->get('dontHide');
    }
@endphp
@if ($errors->any())
    @php
        $type = 'danger';
    @endphp
    @foreach ($errors->all() as $error)
        @php
            $message .= $error . '<br/>';
        @endphp
    @endforeach
@elseif (session()->get('flash_success'))
    @php
        $type = 'success';
    @endphp
    @if(is_array(json_decode(session()->get('flash_success'), true)))
        @php
            $message = implode('', session()->get('flash_success')->all(':message<br/>'));
        @endphp
    @else
        @php
            $message = session()->get('flash_success');
        @endphp
    @endif
@elseif (session()->get('flash_warning'))
    @php
        $type = 'warning';
    @endphp
    @if(is_array(json_decode(session()->get('flash_warning'), true)))
        @php
            $message = implode('', session()->get('flash_warning')->all(':message<br/>'));
        @endphp
    @else
        @php
            $message = session()->get('flash_warning');
        @endphp
    @endif
@elseif (session()->get('flash_info'))
    @php
        $type = 'info';
    @endphp
    @if(is_array(json_decode(session()->get('flash_info'), true)))
        @php
            $message = implode('', session()->get('flash_info')->all(':message<br/>'));
        @endphp
    @else
        @php
            $message = session()->get('flash_info');
        @endphp
    @endif
@elseif (session()->get('flash_danger'))
    @php
        $type = 'danger';
    @endphp
    @if(is_array(json_decode(session()->get('flash_danger'), true)))
        @php
            $message = implode('', session()->get('flash_danger')->all(':message<br/>'));
        @endphp
    @else
        @php
            $message = session()->get('flash_danger');
        @endphp
    @endif
@elseif (session()->get('flash_message'))
    @php
        $type = 'info';
    @endphp
    @if(is_array(json_decode(session()->get('flash_message'), true)))
        @php
            $message = implode('', session()->get('flash_message')->all(':message<br/>'));
        @endphp
    @else
        @php
            $message = session()->get('flash_message');
        @endphp
    @endif
@endif

<!-- Flash Message Vue component -->
<flash message="{!! $message !!}" type="{{ $type }}" dont-hide="{{ $dontHide }}"></flash>