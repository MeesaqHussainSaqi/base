<?php
namespace App\Services;

abstract class BaseService
{
    protected string $orderBy = 'id';
    protected string $orderDirection = 'desc';
    public function SetGridResponse($data) 
    { 
        return [
            'results' => [
                'values' => $data->items()
            ],
            'pagination' => [
                'total'        => $data->total(),
                'page_size'     => $data->perPage(),
                'current_page' => $data->currentPage(),
                'last_page'    => $data->lastPage(),
                'order_by'     => $this->orderBy,
                'order_direction' => $this->orderDirection,
            ]
        ];
     } 
     public function SetSingleResponse($data) 
    { 
        return [
            'results' => (object)[
                'values' => $data
            ],
            'code' => 200,
            'message' => 'Record fetched successfully',
            'status' => 'success'
        ];
     } 
    
}
