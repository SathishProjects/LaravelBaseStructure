<?php
/**
 * Common resource CRUD response handler
 *
 * @name       CrudResponseHandler
 * @version    1.0
 * @author     Contus Team <developers@contus.in>
 * @copyright  Copyright (C) 2016 Contus. All rights reserved.
 * @license    GNU General Public License http://www.gnu.org/copyleft/gpl.html
 */
namespace Contus\Base\Traits;

use Request;
use Exception;
use BadMethodCallException;
use Contus\Base\Contracts\ResourceInterface;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

trait CrudResponseHandler {
    use ResponseHandler;
    /**
     * Return the model collection with pagination
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return $this->handleResourceMethod ( __FUNCTION__, func_get_args () );
    }
    /**
     * Prepare model creation dependent data
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return $this->handleResourceMethod ( __FUNCTION__, func_get_args () );
    }
    /**
     * update the model record
     *
     * @return \Illuminate\Http\Response
     */
    public function update() {
        return $this->handleResourceMethod ( __FUNCTION__, func_get_args () );
    }
    /**
     * Create new model record
     *
     * @return boolean
     */
    public function store() {
        return $this->handleResourceMethod ( ((Request::has ( 'id' )) ? static::RESOURCE_METHOD_UPDATE : __FUNCTION__), func_get_args () );
    }
    /**
     * Return request model record
     * 
     * @param int $id
     * @return object
     */
    public function show($id) {
        return $this->handleResourceMethod ( __FUNCTION__, [$id]);
    }
    /**
     * Return request model record with dependent data for editing
     *
     * @param int $id
     * @return array
     */
    public function edit($id) {
        return $this->handleResourceMethod ( __FUNCTION__, [$id] );
    }
    /**
     * destroy the model record
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy() {
        return $this->handleResourceMethod ( __FUNCTION__, func_get_args () );
    }
    /**
     * handle bulk action request
     *
     * @return \Illuminate\Http\Response
     */
    public function action() {
        return $this->handleResourceMethod ( __FUNCTION__, func_get_args () );
    }
    /**
     * Handle various resource methods
     *
     * @param string $method            
     * @param array $parameters            
     * @return \Illuminate\Http\Response
     * @throws BadMethodCallException
     */
    protected function handleResourceMethod($method, array $parameters = []) {
        $response = false;
        if ($this->isResourceMethod ( $method ) && $this->repository instanceof ResourceInterface) {
            try {
          $response = $this->repository->$method(...$parameters);
                switch ($method) {
                    case static::RESOURCE_METHOD_CREATE :
                    case static::RESOURCE_METHOD_INDEX :
                    case static::RESOURCE_METHOD_SHOW :
                    case static::RESOURCE_METHOD_EDIT :
                        $response = $this->getSuccessJsonResponse ( $response );
                        break;
                    case static::RESOURCE_METHOD_STORE :
                        $response = ($response) ? $this->getSuccessJsonResponse ( [ ], trans ( 'messages.create_success' ) ) : $this->getErrorJsonResponse ( [ ], trans ('messages.create_error' ) );
                        break;
                    case static::RESOURCE_METHOD_UPDATE :
                        $response = ($response) ? $this->getSuccessJsonResponse ( [ ], trans ('messages.update_success' ) ) : $this->getErrorJsonResponse ( [ ], trans ('messages.update_error' ) );
                        break;
                    case static::RESOURCE_METHOD_DESTROY :
                        $response = ($response) ? $this->getSuccessJsonResponse ( [ ], trans ( 'messages.delete_success' ) ) : $this->getErrorJsonResponse ( [ ], trans ('messages.delete_error' ) );
                        break;
                    case static::RESOURCE_METHOD_ACTION :
                        $response = ($response) ? $this->getSuccessJsonResponse ( [ ], trans ( 'messages.bulk_action_success' ) ) : $this->getErrorJsonResponse ( [ ], trans ( 'messages.bulk_action_error' ) );
                        break;
                    default :
                        $response = false;
                        break;
                }
            } catch ( ModelNotFoundException $exception ) {
                $this->logger->error ( $exception->getMessage () );
                $response = $this->getErrorJsonResponse ( [ ], trans ( 'base::messages.resoucre_not_exists'), 404 );
            } catch ( ValidationException $exception ) {
                $response = $this->convertValidationExceptionToResponse ( $exception );
            } catch ( Exception $exception ) {
                $this->logger->error ( $exception->getMessage () );
                $response = $this->getErrorJsonResponse ( [ ], trans ( 'base::messages.unable_process_request') );
            }
        }
        if ($response === false) {
            throw new BadMethodCallException ( "Method [$method] does not exist." );
        }
        return $response;
    }
}