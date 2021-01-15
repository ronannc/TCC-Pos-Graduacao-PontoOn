<?php

namespace App\Http\Controllers\Api;

use App\Models\Employee;
use App\Services\EmployeeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EmployeesController extends ResponseController
{
    protected $service;

    /**
     * EmployeesController constructor.
     *
     * @param EmployeeService $service
     */
    public function __construct( EmployeeService $service )
    {
        $this->service = $service;
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->sendResponse( Employee::all(), 'Funcionarios retornados com sucesso' );
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store( Request $request ): JsonResponse
    {
        $response = $this->service->store( $request->all() );
        if ( isset( $response[ 'error' ] ) ) {
            return $this->sendError( $response[ 'message' ], $response, 500 );
        } else {
            return $this->sendResponse( $response, 'Funcionario cadastrado com sucesso' );
        }
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function show( $id ): JsonResponse
    {
        $response = $this->service->findOneOrFail( $id );
        if ( isset( $response[ 'error' ] ) ) {
            return $this->sendError( $response[ 'message' ]->getMessage(), $response, 500 );
        } else {
            return $this->sendResponse( $response, 'Funcionario retornado com sucesso' );
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function update( Request $request, $id ): JsonResponse
    {
        $response = $this->service->update( $request->all(), $id );
        if ( isset( $response[ 'error' ] ) ) {
            return $this->sendError( $response[ 'message' ], $response, 500 );
        } else {
            return $this->sendResponse( $response, 'Funcionario atualizado com sucesso' );
        }
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function destroy( $id ): JsonResponse
    {
        $response = $this->service->destroy( $id );
        if ( isset( $response[ 'error' ] ) ) {
            return $this->sendError( $response[ 'message' ], $response, 500 );
        } else {
            return $this->sendResponse( $response, 'Funcionario excluido com sucesso' );
        }
    }
}
