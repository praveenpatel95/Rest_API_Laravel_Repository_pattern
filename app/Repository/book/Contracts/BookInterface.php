<?php

namespace App\Repository\book\Contracts;

use App\Models\Book;
use App\Repository\RepositoryContract;
use Illuminate\Contracts\Support\Jsonable;

interface BookInterface extends RepositoryContract
{
    public function getByPaginate(int $page, int $perPage) : Jsonable;

    public function search($params) : Jsonable;

    public function groupByColumn($column) : array ;

}
