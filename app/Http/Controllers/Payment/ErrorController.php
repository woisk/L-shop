<?php

namespace App\Http\Controllers\Payment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class ErrorController
 *
 * @author D3lph1 <d3lph1.contact@gmail.com>
 *
 * @package App\Http\Controllers\Payment
 */
class ErrorController extends Controller
{
    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function robokassa()
    {
        return $this->handle();
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function interkassa()
    {
        return $this->handle();
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle()
    {
        $this->msg->danger(__('messages.payments.error'));

        return response()->redirectToRoute('servers');
    }
}
