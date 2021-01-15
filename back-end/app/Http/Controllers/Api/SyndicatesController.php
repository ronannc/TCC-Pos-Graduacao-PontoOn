<?php

namespace App\Http\Controllers\Api;

use App\Models\Syndicate;
use App\Services\SyndicateService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SyndicatesController extends ResponseController
{
    protected $service;

    /**
     * SyndicatesController constructor.
     *
     * @param SyndicateService $service
     */
    public function __construct( SyndicateService $service )
    {
        $this->service = $service;
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->sendResponse( Syndicate::all(), 'Sindicatos retornados com sucesso' );
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
            return $this->sendResponse( $response, 'Sindicato cadastrada com sucesso' );
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
            return $this->sendResponse( $response, 'Sindicato retornado com sucesso' );
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
            return $this->sendResponse( $response, 'Sindicato atualizada com sucesso' );
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
            return $this->sendResponse( $response, 'Sindicato excluida com sucesso' );
        }
    }
}
