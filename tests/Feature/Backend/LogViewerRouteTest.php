<?php

namespace Tests\Feature\Backend;

use Tests\BrowserKitTestCase;

/**
 * Class LogViewerRouteTest.
 */
class LogViewerRouteTest extends BrowserKitTestCase
{
    /** @test **/
    public function admin_users_can_see_logviewer_dashboard()
    {
        $this->actingAs($this->admin)
            ->visit('/admin/log-viewer')
            ->see('LogViewer');
    }

    /** @test **/
    public function admin_users_can_see_logviewer_list()
    {
        $this->actingAs($this->admin)
            ->visit('/admin/log-viewer/logs')
            ->see('Logs');
    }

    /* @test **/
    /*public function admin_users_can_see_logviewer_single_date()
    {
        $this->actingAs($this->admin)
            ->visit('/admin/log-viewer/logs/'.date('Y-m-d'))
            ->see('Log ['.date('Y-m-d').']');
    }*/

    /* @test **/
    /*public function admin_users_can_see_logviewer_single_date_type()
    {
        $this->actingAs($this->admin)
             ->visit('/admin/log-viewer/logs/'.date('Y-m-d').'/error')
             ->see('Log ['.date('Y-m-d').']');
    }*/
}
