<?php

namespace App\Http\Controllers\Api;

use App\Models\Companie;
use App\Services\CompanieService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CompaniesController extends ResponseController
{
    protected $service;

    /**
     * EmployeesController constructor.
     *
     * @param CompanieService $service
     */
    public function __construct( CompanieService $service )
    {
        $this->service = $service;
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->sendResponse( Companie::all(), 'Empresas retornadas com sucesso' );
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
            return $this->sendResponse( $response, 'Empresa cadastrada com sucesso' );
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
            return $this->sendError( $response[ 'message' ], $response, 500 );
        } else {
            return $this->sendResponse( $response, 'Empresa retornada com sucesso' );
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
            return $this->sendResponse( $response, 'Empresa atualizada com sucesso' );
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
            return $this->sendResponse( $response, 'Empresa excluida com sucesso' );
        }
    }
}
