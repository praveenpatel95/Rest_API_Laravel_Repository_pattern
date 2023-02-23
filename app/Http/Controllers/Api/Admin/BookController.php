<?php

namespace App\Http\Controllers\Api\Admin;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Services\BookService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BookController extends Controller
{
    protected BookService $bookService;
    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    /**
     * Retrieves all books with pagination
     * @return JsonResponse
     */
    public function index(Request $request) : JsonResponse
    {
        return ApiResponse::success($this->bookService->getByPaginate($request->page, $request->perPage));
    }

    /**
     * Create new book in the storage
     * @param Request $request
     * @return JsonResponse
     */

    public function store(Request $request) : JsonResponse
    {
        return ApiResponse::success($this->bookService->create($request->all()));
    }

    /**
     * Update the book detail
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */

    public function update(Request $request, int $id) : JsonResponse
    {
        return ApiResponse::success($this->bookService->update($request->all(), $id));
    }

    /**
     * Delete book by id
     * @param int $id
     * @return JsonResponse
     */

    public function destroy(int $id) : JsonResponse
    {
        return ApiResponse::success($this->bookService->delete($id));
    }

    /**
     * get book by id
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id) : JsonResponse
    {
        return ApiResponse::success($this->bookService->getById($id));
    }
}
