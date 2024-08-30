<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification\Notification;

class CampaignController extends Controller
{
    use Notification;
    public function getFormPage()
    {
        $data = ['key' => 'value'];
    	return view('page.campaign.form.index')->with($data);
    }
    public function getListPage()
    {
    	return view('page.campaign.list.index');
    }
    public function getCreatePage()
    {
    	return view('page.campaign.add.index');
    }
}
