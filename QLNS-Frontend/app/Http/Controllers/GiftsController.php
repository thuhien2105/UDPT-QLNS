<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification\Notification;

class GiftsController extends Controller
{
    use Notification;
    public function getProductPage()
    {
    	return view('page.gifts.products_products.form');
    }
    public function getProductsPage()
    {
    	return view('page.gifts.products_products.index');
    }
    public function getBrandPage()
    {
    	return view('page.gifts.brands.form');
    }
    public function getBrandsPage()
    {
    	return view('page.gifts.brands.index');
    }
    public function getCategoryPage()
    {
    	return view('page.gifts.categories.index');
    }
    public function getGiftsPage()
    {
    	return view('page.gifts.gifts_gifts.index');
    }
    public function getGiftPage()
    {
    	return view('page.gifts.gifts_gifts.form');
    }
    public function getSubItemPage()
    {
    	return view('page.gifts.gifts_gifts.subitem_form');
    }
    public function getManagerPage()
    {
    	return view('page.gifts.manager.index');
    }
    public function getManagerFormPage()
    {
    	return view('page.gifts.manager.form');
    }
}
