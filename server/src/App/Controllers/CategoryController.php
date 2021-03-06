<?php
declare(strict_types=1);

namespace Robert2\API\Controllers;

use Robert2\API\Models\Category;

class CategoryController extends BaseController
{
    public function __construct($container)
    {
        parent::__construct($container);

        $this->model = new Category();
    }
}
