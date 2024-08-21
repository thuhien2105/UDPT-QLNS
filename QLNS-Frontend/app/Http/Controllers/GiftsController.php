<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GiftsController extends Controller
{
    public function getFormPage()
    {
    	return view('page.gifts.form.index');
    }
    public function getListPage()
    {
    	return view('page.gifts.list.index');
    }
}
