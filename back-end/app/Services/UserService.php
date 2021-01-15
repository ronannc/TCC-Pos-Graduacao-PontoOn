<?php

namespace Ponto\Services;

use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Ponto\Models\Company;
use Ponto\Models\Permission;
use Ponto\Models\RoleTemplate;
use Ponto\Models\User;
use Ponto\Models\UsersWorks;
use Ponto\Models\Utils;
use Ponto\Models\Work;
use Ponto\Notifications\ExceptionNotification;
use Ponto\Notifications\InfoNotification;
use Ponto\Repositories\Contracts\UserRepository;

class UserService {
	protected $repository;

	public function __construct( UserRepository $repository ) {
		$this->repository = $repository;
	}

	/**
	 * Retorna um array com os arrays extras para as views.
	 *
	 * @param $id
	 *
	 * @return array
	 */
	public function getExtraData(): array {
		return [
			'roles'       => RoleTemplate::all(),
			'permissions' => Permission::all(),
			'work'        => Utils::getMyWorks(),
			'companies'   => Company::all(),
		];
	}

	public function store( array $data ) {
		try {
			$this->validaCriacaoUsuario( $data );
			$password              = $data['password'];
			$data['password']      = bcrypt( $password );
			$data['password_rest'] = md5( $password );

			return DB::transaction( function () use ( $data ) {
				$store = $this->repository->save( $data );

				$store->companies()->sync( $data['company_id'] );
				if ( isset( $data['neighbor_work_id'] ) ) {
					foreach ( $data['neighbor_work_id'] as $work ) {
						UsersWorks::create( [
							'user_id'         => $store['id'],
							'work_id'         => $work,
							'company_id_work' => Work::find( Utils::compositePrimaryKeyFind( $work ) )['company_id']
						] );
					}
				}
                
                if ($data['roles'] != null) {
                    $store->assignRole($data['roles']);
                }

				$store->givePermissionTo( $data['permissions'] );

				return $store;
			} );
		} catch ( Exception $exception ) {
			return Utils::returnException($exception);
		}
	}

	private function validaCriacaoUsuario( $data ) {
		$user = $this->repository->getUserOnlyCompanySave( $data );
		if ( $user ) {
			throw new Exception( 'Usuário de mesma matricula encontrado na empresa.', Response::HTTP_BAD_REQUEST );
		}

	}

	private function validaUpdateUsuario( $data, User $user ) {
		$user = $this->repository->getUserOnlyCompanyUpdate( $data, $user );
		if ( $user ) {
			throw new Exception( 'Usuário de mesma matricula encontrado na empresa.', Response::HTTP_BAD_REQUEST );
		}

	}

	public function update( array $data, User $user ) {
		try {

			$this->validaUpdateUsuario( $data, $user );
			if(isset($data['password']) && $data['password'] != null){
				$password = $data['password'];
				$data['password'] = bcrypt($password);
				$data['password_rest'] = md5($password);
			}else{
				unset($data['password']);
				unset($data['password_rest']);
			}

			$user->roles()->detach();
			$update = $this->repository->update( $user, $data );
            if ($data['roles'] != null) {
                $update->assignRole($data['roles']);
            }

            $update->syncPermissions($data['permissions']);

			UsersWorks::where('user_id', $user['id'])->where('company_id_work', session()->get('company_id'))->delete();

			if (isset($data['neighbor_work_id'])) {
				foreach ($data['neighbor_work_id'] as $work) {
					UsersWorks::create([
						'user_id' => $user['id'],
						'work_id' => $work,
						'company_id_work' => session()->get('company_id')
					]);
				}
			}

			$update->companies()->sync( $data['company_id'] );

			return $update;
		} catch ( Exception $exception ) {
			return Utils::returnException($exception);
		}
	}

	public function changeUserStatus( $id ) {
		try {
			$this->repository->changeUserStatus( $id );

			return true;
		} catch ( Exception $exception ) {
			return Utils::returnException($exception);
		}
	}

	public function storeAssociate( array $data ) {
		try {
			$this->repository->storeAssociate( $data );

			return true;
		} catch ( Exception $exception ) {
			return Utils::returnException($exception);
		}
	}

	public function removeAssociate( $id ) {
		try {
			$this->repository->removeAssociate( $id );

			return true;
		} catch ( Exception $exception ) {
			return Utils::returnException($exception);
		}
	}

	public function destroyUser( $id ) {
		try {
			$this->repository->destroyUser( $id );

			return true;
		} catch ( Exception $exception ) {
			return Utils::returnException($exception);
		}
	}

	public function createUserByEmployee( $employee ) {
		return $this->repository->createUserByEmployee( $employee );
	}
}
