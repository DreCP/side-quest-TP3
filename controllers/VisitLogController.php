<?php

namespace App\Controllers;

use App\Models\VisitLog;
use App\Providers\View;
use App\Providers\Auth;

class VisitLogController {

    public function index() {
        Auth::session();        /*checks if someone is logged in */
        Auth::privilege(1);     /*access only to administrator */

        $visitLog = new VisitLog;
        $visits = (new VisitLog)->select('visit_date', 'DESC');      /*retrieves recorded visits */

        return View::render('visitlog/index', ['visits' => $visits]);     /*sends visits to Twig */
    }
}
