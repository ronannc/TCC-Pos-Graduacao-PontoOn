<?php

namespace App\Http\Controllers\Api;

use App\Models\TimeTable;
use App\Services\TimeTableService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TimeTablesController extends ResponseController
{
    protected $service;

    /**
     * TimeTablesController constructor.
     *
     * @param TimeTableService $service
     */
    public function __construct( TimeTableService $service )
    {
        $this->service = $service;
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->sendResponse( TimeTable::all(), 'Tabela de Horarios retornados com sucesso' );
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
            return $this->sendResponse( $response, 'Tabela de Horario cadastrada com sucesso' );
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
            return $this->sendResponse( $response, 'Tabela de Horario retornado com sucesso' );
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
            return $this->sendResponse( $response, 'Tabela de Horario atualizada com sucesso' );
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
            return $this->sendResponse( $response, 'Tabela de Horario excluida com sucesso' );
        }
    }
}
