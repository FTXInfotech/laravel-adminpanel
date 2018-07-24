<?php

namespace Tests\Feature\Backend;

use App\Models\Settings\Setting;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ManageSettingsTest extends TestCase
{
    protected $setting;

    public function setUp()
    {
        parent::setUp();

        $this->setting = Setting::find(1);
        $this->actingAs($this->admin);
    }

    /** @test */
    public function setting_page_shows_different_tabs()
    {
        $this->get(route('admin.settings.edit', $this->setting))
            ->assertSee(__('labels.backend.settings.seo'))
            ->assertSee(__('labels.backend.settings.companydetails'))
            ->assertSee(__('labels.backend.settings.mail'))
            ->assertSee(__('labels.backend.settings.footer'))
            ->assertSee(__('labels.backend.settings.terms'))
            ->assertSee(__('labels.backend.settings.google'));
    }

    /** @test */
    public function it_can_update_a_valid_site_logo()
    {
        $this->patch(route('admin.settings.update', $this->setting), [
            'logo' => UploadedFile::fake()->image('logo.jpg', 226, 48),
        ]);

        Storage::disk('public')->assertExists('img/logo/'.$this->setting->logo);
    }

    /** @test */
    public function it_throws_error_for_valid_site_logo()
    {
        $this->withExceptionHandling();

        $this->patch(route('admin.settings.update', $this->setting), [
            'logo' => UploadedFile::fake()->image('logo.jpg', 200, 500),
        ])
        ->assertSessionHasErrors('logo');
    }

    /** @test */
    public function it_can_update_site_favicon()
    {
        $this->patch(route('admin.settings.update', $this->setting), [
            'favicon' => UploadedFile::fake()->image('favicon.jpg', 16, 16),
        ]);

        Storage::disk('public')->assertExists('img/favicon/'.$this->setting->favicon);
    }

    /** @test */
    public function it_throws_error_for_valid_site_favicon()
    {
        $this->withExceptionHandling();

        $this->patch(route('admin.settings.update', $this->setting), [
            'favicon' => UploadedFile::fake()->image('favicon.jpg', 200, 500),
        ])
        ->assertSessionHasErrors('favicon');
    }
}
