<?php

namespace Alientronics\FleetanySeller\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Alientronics\FleetanySeller\Repositories\ServiceRepository;
use App\Entities\Service;
use Illuminate\Support\Facades\Auth;

class ServiceRepositoryEloquent extends BaseRepository implements ServiceRepository
{

    protected $rules = [
        'name'      => 'min:3|required',
        'description' => 'min:3|required',
        'price'      => 'min:3|required',
        ];

    public function model()
    {
        return Service::class;
    }

    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
    public function results($filters = [])
    {
        $services = $this->scopeQuery(function ($query) use ($filters) {

            $query = $query->select('services.*');
            
            if (!empty($filters['name'])) {
                $query = $query->where('name', 'like', '%'.$filters['name'].'%');
            }
            if (!empty($filters['description'])) {
                $query = $query->where('description', 'like', '%'.$filters['description'].'%');
            }
            if (!empty($filters['price'])) {
                $query = $query->where('price', 'like', '%'.$filters['price'].'%');
            }

            $query = $query->where('company_id', Auth::user()['company_id']);
            $query = $query->orderBy($filters['sort'], $filters['order']);
            
            return $query;
        })->paginate($filters['paginate']);
        
        return $services;
    }
}
