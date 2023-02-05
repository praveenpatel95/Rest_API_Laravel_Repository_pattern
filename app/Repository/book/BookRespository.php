<?php

namespace App\Repository\book;

use App\Models\Book;
use App\Repository\BaseRepository;
use App\Repository\book\Contracts\BookInterface;
use Illuminate\Contracts\Support\Jsonable;


class BookRespository extends BaseRepository implements BookInterface
{
    public function model()
    {
        return Book::class;
    }

    public function getByPaginate(int $page, int $perPage): Jsonable
    {
        return $this->model->paginate($perPage,
            ['*'],
            'page',
            $page
        );
    }

    public function search($params): Jsonable
    {
        $q = $params['q'];
        $query = $this->model->where(function ($que) use ($q) {
            $que->where('title', 'like', "%$q%")
                ->orWhere('author', 'like', "%$q%")
                ->orWhere('isbn', 'like', "%$q%")
                ->orWhere('genre', 'like', "%$q%");
        });
        if(isset($params['authors'])){
            $query = $query->whereIn('author', explode(",", $params['authors']));
        }
        if(isset($params['genre'])){
            $query = $query->whereIn('genre', explode(",", $params['genre']));
        }
        if(isset($params['publisher'])){
            $query = $query->whereIn('publisher', explode(",", $params['publisher']));
        }

         return $query->paginate($params['perPage'],
            ['*'],
            'page',
             $params['page']
        );
    }

    public function groupByColumn($column) : array
    {
        return $this->model->groupBy($column)->pluck($column)->toArray();
    }

}
