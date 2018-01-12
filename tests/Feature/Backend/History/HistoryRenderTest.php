<?php

namespace Tests\Feature\Backend\History;

use Tests\BrowserKitTestCase;

/**
 * Class HistoryRenderTest.
 */
class HistoryRenderTest extends BrowserKitTestCase
{
    /** @test **/
    public function admin_users_can_see_history_on_dashboard()
    {
        $this->actingAs($this->admin);

        history()
            ->withType('User')
            ->withText(trans('history.backend.users.created').$this->user->name)
            ->withEntity($this->user->id)
            ->withIcon('plus')
            ->withClass('bg-green')
            ->log();

        $this->visit('/admin/dashboard')
             ->see('<strong>'.$this->admin->name.'</strong> '.trans('history.backend.users.created').$this->user->name);
    }

    /** @test **/
    public function admin_users_can_see_history_on_user_show_page()
    {
        $this->actingAs($this->admin);

        history()
            ->withType('User')
            ->withText(trans('history.backend.users.created').$this->user->name)
            ->withEntity($this->user->id)
            ->withIcon('plus')
            ->withClass('bg-green')
            ->log();

        $this->visit('/admin/access/user/3')
             ->see('<strong>'.$this->admin->name.'</strong> '.trans('history.backend.users.created').$this->user->name);
    }
}
