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
                        You are receiving this email because we received a password reset request for your account.
                    </p>
                    <table border="0" align="center" width="180" cellpadding="0" cellspacing="0" bgcolor="5caad2" style="margin-bottom:20px;     background: #003bd7; border-radius: 5px;">

                        <tr>
                            <td height="10" style="font-size: 10px; line-height: 10px;">&nbsp;</td>
                        </tr>

                        <tr>
                            <td align="center" style="color: #ffffff; font-size: 14px; line-height: 22px;letter-spacing: 1px;font-weight: bold;">
                                <!-- main section button -->
                                <div style="line-height: 22px;">
                                    <a href="{{ $reset_password_url }}" style="color: #ffffff; text-decoration: none;">Reset Password</a>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td height="10" style="font-size: 10px; line-height: 10px;">&nbsp;</td>
                        </tr>

                    </table>

                    <p style="line-height: 24px; margin-bottom:20px;">
                        If you did not request a password reset, no further action is required.
                    </p>

                    <p style="line-height: 24px">
                        Regards,</br>
                        @yield('title', app_name())
                    </p>

                    <br/>

                    <p class="small" style="line-height: 24px; margin-bottom:20px;">
                        If you’re having trouble clicking the "Reset Password" button, copy and paste the URL below into your web browser:
                    </p>

                    <p class="small" style="line-height: 24px; margin-bottom:20px;">
                        <a href="{{ $reset_password_url }}" target="_blank" class="lap">
                            {{ $reset_password_url}}
                        </a>
                    </p>

                    @include('emails.layouts.footer')
                </td>
            </tr>
        </table>
    </td>
</div>
@endsection
                        