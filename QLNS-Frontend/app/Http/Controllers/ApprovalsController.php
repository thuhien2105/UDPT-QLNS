<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification\Notification;

class ApprovalsController extends Controller
{
    use Notification;
    public function getCategoryPage()
    {
        return view('page.approvals.category.index');
    }
    public function getFormPage()
    {
        return view('page.approvals.form.index');
    }
    public function getListPage()
    {
        return view('page.approvals.list.index');
    }
    public function getAddPage()
    {
        return view('page.approvals.add.index');
    }
    public function getRequestListPage()
    {
        return view('page.approvals.request_list.index');
    }
}
