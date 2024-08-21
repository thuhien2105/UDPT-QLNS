<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApprovalsController extends Controller
{
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

}
