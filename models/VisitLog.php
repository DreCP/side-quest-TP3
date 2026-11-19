<?php

namespace App\Models;

use App\Models\CRUD;

class VisitLog extends CRUD {
    protected $table = 'visit_log';
    protected $primaryKey = 'id';
    protected $fillable = ['ip_address', 'visit_date', 'username', 'page'];
}
