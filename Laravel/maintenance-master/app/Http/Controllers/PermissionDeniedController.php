<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;

class PermissionDeniedController extends Controller
{
    public function getIndex()
    {
        if (Session::get('message')) {
            if ($this->isAjax()) {
                $this->message = 'You do not have access to perform this function';
                $this->messageType = 'danger';

                return $this->response();
            } else {
                return view('permission-denied', [
                    'title' => 'Permission Denied',
                ]);
            }
        } else {
            $this->redirect = route('maintenance.dashboard.index');

            return $this->response();
        }
    }
}
