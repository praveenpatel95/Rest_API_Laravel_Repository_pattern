<?php

namespace App\Services;

use App\Helpers\ValidationHelper;
use App\Models\Book;
use App\Repository\book\Contracts\BookInterface;
use Illuminate\Contracts\Support\Jsonable;
use Ramsey\Collection\Collection;

class BookService
{
    protected BookInterface $bookRepository;

    public function __construct(BookInterface $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function getByPaginate(int $page, int $perPage): Jsonable
    {
        return $this->bookRepository->getByPaginate($page, $perPage);
    }

    public function create(array $data): Book
    {
        $this->validateData($data, $type = 'create');
        $data['image'] = $this->imageUpload($data);
        return $this->bookRepository->create($data);
    }

    public function update(array $data, int $id): Book
    {
        $this->validateData($data, $type = 'update');
        if (!empty($data['image'])) {
            $data['image'] = $this->imageUpload($data);
        }
        return $this->bookRepository->updateById($id, $data);
    }

    public function delete(int $id): void
    {
        $this->bookRepository->deleteById($id);
    }

    public function getById(int $id): Book
    {
        return $this->bookRepository->getById($id);
    }

    public function validateData(array $data, string $type)
    {
        $validationRules = [
            'title' => 'required|max:255',
            'author' => 'required|max:50',
            'genre' => 'required|max:50',
            'description' => 'required',
            'isbn' => 'required|max:20',
            'published' => 'required|date',
            'publisher' => 'required|max:100',

        ];
        if ($type == 'create') {
            $validationRules['image'] = 'required|mimes:jpeg,jpg,png,gif';
        }
        ValidationHelper::validate($data, $validationRules);
    }

    public function imageUpload($data)
    {
        if (isset($data['image'])) {
            if (file_exists($data['image'])) {
                $file = $data['image'];
                $filename = $data['isbn'] . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('books', $filename);
                return $path;
            }
        }
        return null;
    }

    //Simple Search by equivalent
    public function search($params): Jsonable
    {
        return $this->bookRepository->search($params);
    }

    public function getFilters() : array
    {
        $data = [];
        $data['authors'] = $this->bookRepository->groupByColumn('author');
        $data['genre'] = $this->bookRepository->groupByColumn('genre');
        $data['publisher'] = $this->bookRepository->groupByColumn('publisher');
        return $data;
    }

}
