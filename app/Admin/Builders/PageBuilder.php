<?php

namespace App\Admin\Builders;

use App\Models\AdminPage;
use App\Models\AdminPageOption;
use Illuminate\Support\Collection;

class PageBuilder
{
    private AdminPage $page;
    private Collection $elements;

    public function __construct(AdminPage $page)
    {
        $this->page = $page;
        $this->makeElements();
    }

    private function makeElements()
    {
        collect($this->page->pageOptions)
            ->each(function(AdminPageOption $option) {
            $this->elements[] = PageElementBuilder::make($option->name);
        });
    }
}
