<?php

namespace Tests\Browser\Pages\Dashboard;

use Laravel\Dusk\Browser;
use Tests\Browser\Pages\Page;

class SongsEditPage extends Page
{
    protected $songId;

    public function __construct($songId)
    {
        $this->songId = $songId;
    }

    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return "/dashboard/songs/$this->songId/edit";
    }

    /**
     * Assert that the browser is on the page.
     *
     * @param  Browser  $browser
     * @return void
     */
    public function assert(Browser $browser)
    {
        $browser->assertPathIs($this->url());
    }

    /**
     * Get the element shortcuts for the page.
     *
     * @return array
     */
    public function elements()
    {
        return [
            '@element' => '#selector',
        ];
    }
}
