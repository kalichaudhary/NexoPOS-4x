<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardController;
use App\Services\FieldsService;
use Exception;
use Illuminate\Http\Request;
use TorMorten\Eventy\Facades\Events as Hook;

class FieldsController extends DashboardController
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function getFields( $resource, $identifier = null )
    {
        $instance      =       Hook::filter( 'ns.fields', $resource, $identifier );

        if ( ! $instance instanceof FieldsService ) {
            throw new Exception( sprintf( __( '"%s" is not an instance of "FieldsService"') ) );
        }
        
        return $instance->get( $identifier );
    }
}
