<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification\Notification;

class GiftsController extends Controller
{
    use Notification;
    public function getFormPage()
    {
    	return view('page.gifts.form.index');
    }
    public function getListPage()
    {
    	return view('page.gifts.list.index');
    }
}
