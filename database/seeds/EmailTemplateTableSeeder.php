<?php

use Carbon\Carbon as Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmailTemplateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (env('DB_CONNECTION') == 'mysql') {
            DB::table(config('module.email_templates.table'))->truncate();
        }

        $data = [
            [
                'title'   => 'User Registration',
                'type_id' => '1',
                'subject' => 'You have succesfully registerd',
                'body'    => '<center>
<table id="bodyTable" border="0" width="100%" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td id="bodyCell" align="center" valign="top">
<table id="templateContainer" border="0" width="600" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td align="left" valign="top">
<table id="templateBody" border="0" width="600" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="bodyContainer" style="padding-top: 9px; padding-bottom: 9px;" valign="top">
<table class="mcnBoxedTextBlock" border="0" width="100%" cellspacing="0" cellpadding="0">
<tbody class="mcnBoxedTextBlockOuter">
<tr>
<td class="mcnBoxedTextBlockInner" valign="top">
<table class="mcnBoxedTextContentContainer" border="0" width="600" cellspacing="0" cellpadding="0" align="left">
<tbody>
<tr>
<td style="padding: 9px 18px 9px 18px;">
<table class="mcnTextContentContainer" style="background-color: #ffffff;" border="0" width="100%" cellspacing="0" cellpadding="18">
<tbody>
<tr>
<td class="mcnTextContent" style="font-family: Helvetica Neue, Helvetica, Arial, sans-serif; text-align: left; padding: 36px; word-break: break-word;" valign="top">
<div style="text-align: left; word-wrap: break-word;">Thank you for joining [app_name]! To finish signing up, you just need to confirm your account. <br /> <br />To confirm your email, please click this link:&nbsp;[confirmation_link] <br /> <br />Welcome and thanks! <br />[app_name] Team
<div class="footer" style="font-size: 0.7em; padding: 0px; font-family: Helvetica Neue, Helvetica, Arial, sans-serif; text-align: right; color: #777777; line-height: 14px; margin-top: 36px;">&copy; [app_name]</div>
</div>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<!-- // END BODY --></td>
</tr>
</tbody>
</table>
<!-- // END TEMPLATE --></td>
</tr>
</tbody>
</table>
</center>',
                'status'     => '1',
                'created_by' => '1',
                'updated_by' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'title'   => 'Create User',
                'type_id' => '2',
                'subject' => 'Congratulations! your account has been created',
                'body'    => '<center>
<table id="bodyTable" border="0" width="100%" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td id="bodyCell" align="center" valign="top">
<table id="templateContainer" border="0" width="600" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td align="left" valign="top">
<table id="templateBody" border="0" width="600" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="bodyContainer" style="padding-top: 9px; padding-bottom: 9px;" valign="top">
<table class="mcnBoxedTextBlock" border="0" width="100%" cellspacing="0" cellpadding="0">
<tbody class="mcnBoxedTextBlockOuter">
<tr>
<td class="mcnBoxedTextBlockInner" valign="top">
<table class="mcnBoxedTextContentContainer" border="0" width="600" cellspacing="0" cellpadding="0" align="left">
<tbody>
<tr>
<td style="padding: 9px 18px 9px 18px;">
<table class="mcnTextContentContainer" style="background-color: #ffffff;" border="0" width="100%" cellspacing="0" cellpadding="18">
<tbody>
<tr>
<td class="mcnTextContent" style="font-family: Helvetica Neue, Helvetica, Arial, sans-serif; text-align: left; padding: 36px; word-break: break-word;" valign="top">
<div style="text-align: left; word-wrap: break-word;">Congratulations! your account has been created</div>
<div style="text-align: left; word-wrap: break-word;">&nbsp;</div>
<div style="text-align: left; word-wrap: break-word;">&nbsp;</div>
<div style="text-align: left; word-wrap: break-word;">Your credentials are as below</div>
<div style="text-align: left; word-wrap: break-word;">&nbsp;</div>
<div style="text-align: left; word-wrap: break-word;">Email - [email]</div>
<div style="text-align: left; word-wrap: break-word;">Password - [password]</div>
<div style="text-align: left; word-wrap: break-word;">&nbsp;</div>
<div style="text-align: left; word-wrap: break-word;"><br />Welcome and thanks! <br />[app_name] Team
<div class="footer" style="font-size: 0.7em; padding: 0px; font-family: Helvetica Neue, Helvetica, Arial, sans-serif; text-align: right; color: #777777; line-height: 14px; margin-top: 36px;">&copy; [app_name]</div>
</div>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<!-- // END BODY --></td>
</tr>
</tbody>
</table>
<!-- // END TEMPLATE --></td>
</tr>
</tbody>
</table>
</center>',
                'status'     => '1',
                'created_by' => '1',
                'updated_by' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'title'   => 'Activate / Deactivate User',
                'type_id' => '3',
                'subject' => 'Your account has been [status]',
                'body'    => '<center>
<table id="bodyTable" border="0" width="100%" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td id="bodyCell" align="center" valign="top">
<table id="templateContainer" border="0" width="600" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td align="left" valign="top">
<table id="templateBody" border="0" width="600" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="bodyContainer" style="padding-top: 9px; padding-bottom: 9px;" valign="top">
<table class="mcnBoxedTextBlock" border="0" width="100%" cellspacing="0" cellpadding="0">
<tbody class="mcnBoxedTextBlockOuter">
<tr>
<td class="mcnBoxedTextBlockInner" valign="top">
<table class="mcnBoxedTextContentContainer" border="0" width="600" cellspacing="0" cellpadding="0" align="left">
<tbody>
<tr>
<td style="padding: 9px 18px 9px 18px;">
<table class="mcnTextContentContainer" style="background-color: #ffffff;" border="0" width="100%" cellspacing="0" cellpadding="18">
<tbody>
<tr>
<td class="mcnTextContent" style="font-family: Helvetica Neue, Helvetica, Arial, sans-serif; text-align: left; padding: 36px; word-break: break-word;" valign="top">
<div style="text-align: left; word-wrap: break-word;">Your account has been [status].<br /> <br />Welcome and thanks! <br />[app_name] Team
<div class="footer" style="font-size: 0.7em; padding: 0px; font-family: Helvetica Neue, Helvetica, Arial, sans-serif; text-align: right; color: #777777; line-height: 14px; margin-top: 36px;">&copy; [app_name]</div>
</div>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<!-- // END BODY --></td>
</tr>
</tbody>
</table>
<!-- // END TEMPLATE --></td>
</tr>
</tbody>
</table>
</center>',
                'status'     => '1',
                'created_by' => '1',
                'updated_by' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'title'   => 'Change Password',
                'type_id' => '4',
                'subject' => 'Your passwprd has been changed successfully',
                'body'    => '<center>
<table id="bodyTable" border="0" width="100%" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td id="bodyCell" align="center" valign="top">
<table id="templateContainer" border="0" width="600" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td align="left" valign="top">
<table id="templateBody" border="0" width="600" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="bodyContainer" style="padding-top: 9px; padding-bottom: 9px;" valign="top">
<table class="mcnBoxedTextBlock" border="0" width="100%" cellspacing="0" cellpadding="0">
<tbody class="mcnBoxedTextBlockOuter">
<tr>
<td class="mcnBoxedTextBlockInner" valign="top">
<table class="mcnBoxedTextContentContainer" border="0" width="600" cellspacing="0" cellpadding="0" align="left">
<tbody>
<tr>
<td style="padding: 9px 18px 9px 18px;">
<table class="mcnTextContentContainer" style="background-color: #ffffff;" border="0" width="100%" cellspacing="0" cellpadding="18">
<tbody>
<tr>
<td class="mcnTextContent" style="font-family: Helvetica Neue, Helvetica, Arial, sans-serif; text-align: left; padding: 36px; word-break: break-word;" valign="top">
<div style="text-align: left; word-wrap: break-word;">Your password has been changed successfully.</div>
<div style="text-align: left; word-wrap: break-word;">&nbsp;</div>
<div style="text-align: left; word-wrap: break-word;">New password : [password]<br /> <br />Welcome and thanks! <br />[app_name] Team
<div class="footer" style="font-size: 0.7em; padding: 0px; font-family: Helvetica Neue, Helvetica, Arial, sans-serif; text-align: right; color: #777777; line-height: 14px; margin-top: 36px;">&copy; [app_name]</div>
</div>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<!-- // END BODY --></td>
</tr>
</tbody>
</table>
<!-- // END TEMPLATE --></td>
</tr>
</tbody>
</table>
</center>',
                'status'     => '1',
                'created_by' => '1',
                'updated_by' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table(config('module.email_templates.table'))->insert($data);
    }
}
