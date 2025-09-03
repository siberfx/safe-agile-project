<?php

namespace App\Http\Controllers\Admin;


class SystemController extends AdminBaseController
{
    public function index()
    {
        return view('admin.index');
    }
}
