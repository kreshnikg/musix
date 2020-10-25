<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Component;

class SidebarItem extends Component
{
    public $link;

    public $title;

    public $icon;

    public $active;

    public $newTab;

    public $visible = false;

    public $externalUrl = false;

    /**
     * SidebarItem constructor.
     * @param $link
     * @param $title
     * @param $icon
     * @param bool|null $forSupervisor
     * @param bool $newTab
     * @param bool $externalUrl
     */
    public function __construct($link, $title, $icon, $forSupervisor = null,$newTab = false, $externalUrl = false)
    {
        if($forSupervisor == null) {
            if(Auth::user()->role_id == 1) {
                $this->visible = true;
            }
        } else {
            $this->visible = true;
        }
        $this->link = $externalUrl ? $link : "/dashboard$link";
        $this->title = $title;
        $this->icon = $icon;
        $this->newTab = $newTab;
        if ("/" . Route::current()->uri == "/dashboard$link")
            $this->active = true;
        else
            $this->active = false;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        if($this->visible)
            return view('components.sidebar-item');
    }
}
