<?php
declare(strict_types = 1);

namespace App\Exceptions\Server;

use App\Exceptions\LogicException;

/**
 * Class AttemptToDeleteTheLastServerException
 * An exception is thrown if an attempt is made to delete the last server
 *
 * @author  D3lph1 <d3lph1.contact@gmail.com>
 * @package App\Exceptions\Server
 */
class AttemptToDeleteTheLastServerException extends LogicException
{
    //
}
