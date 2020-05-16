<?php

namespace App\Http\Controllers;

use App\Repository\front\PresentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class PresentController extends FrontController
{
    private $present;

    /**
     * PresentController constructor.
     * @param PresentRepository $present
     */
    public function __construct(PresentRepository $present)
    {
        parent::__construct();
        $url = explode('/', URL::current());
        $this->middleware("present:" . end($url));
        $this->present = $present;
    }

    /**
     * @param $token
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($token)
    {
        return $this->present->index($token);
    }

    /**
     * @param $token
     * @return \Illuminate\Http\JsonResponse
     */
    public function colors($token)
    {
        return $this->present->colors($token);
    }
}
