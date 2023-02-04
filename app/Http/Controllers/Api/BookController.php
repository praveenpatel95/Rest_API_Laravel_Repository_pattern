<?php

namespace App\Http\Controllers\Api;

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
     * Retirve search & filter books
     * @param Request $request
     * @return JsonResponse
     */
    public function search(Request $request) : JsonResponse
    {

        return ApiResponse::success($this->bookService
            ->search($request->all())
        );
    }

    public function getFilters() :JsonResponse
    {
        return ApiResponse::success($this->bookService->getFilters());
    }
}
