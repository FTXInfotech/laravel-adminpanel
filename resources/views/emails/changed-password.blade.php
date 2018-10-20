@extends('emails.layouts.app')

@section('content')
<div class="content">
    <td align="left">
        <table border="0" width="80%" align="center" cellpadding="0" cellspacing="0" class="container590">
            <tr>
                <td align="left" style="color: #888888; width:20px; font-size: 16px; line-height: 24px;">
                    <!-- section text ======-->

                    <p style="line-height: 24px; margin-bottom:15px;">
                        Hello!
                    </p>
                    
                    <p style="line-height: 24px; margin-bottom:20px;">
                        Your Password has successfully been changed to : {{ $password }}
                    </p>

                    <p style="line-height: 24px; margin-bottom:20px;">
                        If you did not change your password, try resetting your password using above password.
                    </p>

                    <p style="line-height: 24px">
                        Regards,</br>
                        @yield('title', app_name())
                    </p>

                    <br/>

                    @include('emails.layouts.footer')
                </td>
            </tr>
        </table>
    </td>
</div>
@endsection
                        