<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function getFormPage()
    {
    	return view('page.campaign.form.index');
    }
    public function getListPage()
    {
    	return view('page.campaign.list.index');
    }
}
