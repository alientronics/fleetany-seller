<?php

namespace Alientronics\FleetanySeller\Controllers;

use App\Http\Controllers\Controller;
use Alientronics\FleetanySeller\Repositories\ServiceRepositoryEloquent;
use App\Entities\Service;
use Log;
use Lang;
use Prettus\Validator\Exceptions\ValidatorException;
use Illuminate\Support\Facades\Auth;
use App\Repositories\CompanyRepositoryEloquent;

class ServiceController extends Controller
{

    protected $serviceRepo;
    
    protected $fields = [
        'id',
        'name',
        'description',
        'price'
    ];
    
    public function __construct(ServiceRepositoryEloquent $serviceRepo)
    {
        parent::__construct();

        $this->middleware('auth');
        $this->serviceRepo = $serviceRepo;
    }

    public function index()
    {
        $filters = $this->helper->getFilters($this->request->all(), $this->fields, $this->request);
        
        $services = $this->serviceRepo->results($filters);
                
        return view("service.index", compact('services', 'filters'));
    }
    
    public function create()
    {
        $service = new Service();
        return view("service.edit", compact('service'));
    }

    public function store()
    {
        try {
            $this->serviceRepo->validator();
            $inputs = $this->request->all();
            $this->serviceRepo->create($inputs);
            return $this->redirect->to('service')->with('message', Lang::get(
                'general.succefullcreate',
                ['table'=> Lang::get('general.Service')]
            ));
        } catch (ValidatorException $e) {
            return $this->redirect->back()->withInput()
                   ->with('errors', $e->getMessageBag());
        }
    }

    public function edit($idService)
    {
        $service = $this->serviceRepo->find($idService);
        $this->helper->validateRecord($service);
        return view("service.edit", compact('service'));
    }
    
    public function update($idService)
    {
        try {
            $service = $this->serviceRepo->find($idService);
            $this->helper->validateRecord($service);
            $this->serviceRepo->validator();
            $this->serviceRepo->update($this->request->all(), $idService);
            $this->session->flash(
                'message',
                Lang::get(
                    'general.succefullupdate',
                    ['table'=> Lang::get('general.Service')]
                )
            );
            return $this->redirect->to('service');
        } catch (ValidatorException $e) {
            return $this->redirect->back()->withInput()
                    ->with('errors', $e->getMessageBag());
        }
    }
    
    public function destroy($idService)
    {
        $service = $this->serviceRepo->find($idService);
        if ($service) {
            $this->helper->validateRecord($service);
            Log::info('Delete field: '.$idService);
            $this->serviceRepo->delete($idService);
            return $this->redirect->to('service')->with('message', Lang::get("general.deletedregister"));
        } else {
            return $this->redirect->to('service')->with('message', Lang::get("general.deletedregistererror"));
        }
    }
}
