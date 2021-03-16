<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'Home';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['dang-ky.html'] = 'user/register';
$route['dang-nhap.html'] = 'user/login';
$route['trang-quan-tri.html'] = 'admin/login';
$route['gio-hang.html'] = 'cart';
$route['san-pham.html'] = 'product/showProduct';
$route['tin-tuc.html'] = 'news';
$route['gioi-thieu.html'] = 'introduce';
$route['lien-he.html'] = 'contact';
$route['thoat.html'] = 'user/logout';
$route['lay-lai-mat-khau.html'] = 'user/forgotPassword';
$route['don-hang-cua-toi.html'] = 'order/viewOrderUser';
$route['hoa-don.html'] = 'order/view_order';
$route['bank-payment.html'] = 'order/bankPayment';


$route['(:any)-u(:num)'] = 'user/member/$2';
$route['(:any)-c(:num)'] = 'product/catalog/$2';
$route['(:any)-sp(:num)'] = 'product/view/$2';
$route['(:any)-gh(:num)'] = 'cart/add/$2';
$route['(:any)-ps(:num)'] = 'user/reset_password/$2';
$route['(:any)-od(:num)'] = 'order/viewListOrder/$2';
$route['(:any)-bv(:num)'] = 'news/listNewCate/$2';



$route['default_controller'] = 'Home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
