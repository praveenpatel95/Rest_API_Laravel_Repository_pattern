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

    /**
     * get book data with paginate
     * @param int $page
     * @param int $perPage
     * @return Jsonable
     */
    public function getByPaginate(int $page, int $perPage): Jsonable
    {
        return $this->bookRepository->getByPaginate($page, $perPage);
    }

    /**
     *  Create new book in the storage
     * @param array $data
     * @return Book
     */

    public function create(array $data): Book
    {
        $this->validateRequest($data, $type = 'create');
        $data['image'] = $this->imageUpload($data);
        return $this->bookRepository->create($data);
    }

    /**
     * Update book data in the storage
     * @param array $data
     * @param int $id
     * @return Book
     */
    public function update(array $data, int $id): Book
    {
        $this->validateRequest($data, $type = 'update');
        if (isset($data['image'])) {
            $data['image'] = $this->imageUpload($data);
        }
        return $this->bookRepository->updateById($id, $data);
    }

    /**
     * Delete book data by id from the storage
     * @param int $id
     * @return void
     */

    public function delete(int $id): void
    {
        $this->bookRepository->deleteById($id);
    }

    /**
     *  Get single book data by id
     * @param int $id
     * @return Book
     */
    public function getById(int $id): Book
    {
        return $this->bookRepository->getById($id);
    }

    /**
     *  Validate the request data
     * @param array $data
     * @param string $type
     * @return void
     * @throws \App\Exceptions\ValidationRequestException
     */
    public function validateRequest(array $data, string $type)
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

    /**
     * Store the image in books folder and return path
     * @param $data
     * @return mixed|null
     */
    public function imageUpload($data)
    {
        if (isset($data['image']) && file_exists($data['image'])) {
                $file = $data['image'];
                $filename = $data['isbn'] . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('books', $filename);
                return $path;
        }
        return null;
    }

    /**
     * Search books by request parameter
     * @param $params
     * @return Jsonable
     */
    public function search($params): Jsonable
    {
        return $this->bookRepository->search($params);
    }

    /**
     *  Filter books data
     * @return array
     */
    public function getFilters() : array
    {
        $data = [];
        $data['authors'] = $this->bookRepository->groupByColumn('author');
        $data['genre'] = $this->bookRepository->groupByColumn('genre');
        $data['publisher'] = $this->bookRepository->groupByColumn('publisher');
        return $data;
    }

}
