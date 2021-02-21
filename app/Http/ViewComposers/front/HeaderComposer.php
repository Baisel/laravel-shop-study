<?php

namespace App\Http\ViewComposers\front;

use App\Models\ProductCategory;
use Illuminate\View\View;

/**
 * Class LayoutComposer
 * @package App\Http\ViewComposers\User\Worker
 */
class HeaderComposer
{
    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $view->with([
            'categories' => ProductCategory::get(),
        ]);
    }

}
