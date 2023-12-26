<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Auth\EmailVerificationService;



class EmailVerificationController extends Controller
{
    protected $emailService;
    public function __construct(EmailVerificationService $emailService)
        {
            $this->emailService = $emailService;
        }

    public function verify(Request $request)
        {
            $this->emailService->verifyEmail($request);
        }
 

 


}
