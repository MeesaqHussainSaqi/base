<?php
namespace App\Services;

abstract class BaseService
{
    protected string $orderBy = 'id';
    protected string $orderDirection = 'desc';
    public function SetGridResponse($data) 
    { 
        return [
            'results' => $data->items(),
            'pagination' => [
                'total'        => $data->total(),
                'per_page'     => $data->perPage(),
                'current_page' => $data->currentPage(),
                'last_page'    => $data->lastPage(),
                'order_by'     => $this->orderBy,
                'order_direction' => $this->orderDirection,
            ]
        ];
     } 
    
}
