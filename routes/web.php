<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

//首页
Route::any('/',"IndexController@index");
//所有商品
Route::any('allshops/{cate_id?}',"IndexController@allshops")->where('cate_id','[0-9]+');
//搜索 替换页面
Route::any('/allshops/{cate_id}/search','IndexController@search');
//商品详情
Route::any('shopcontent/{goods_id}',"IndexController@shopcontent");
//我的雪天
Route::any('userpage',"IndexController@userpage");
//登录
Route::any('login',"IndexController@login");
//忘记密码
Route::any('findpwd',"IndexController@findpwd");
//重置密码页面
Route::any('resetpassword',"IndexController@resetpassword");
//确认重置
Route::post('resetpwd',"IndexController@resetpwd");
//注册
Route::any('register',"IndexController@register");
//发送验证码
Route::any('/register/sendsms',"IndexController@sendsms");
//找回密码-发送验证码
Route::any('/findpwd/sendsms',"IndexController@sendsmspwd");
//图像验证码
Route::any('verify/create','CaptchaController@create');

//先判断是否登录
Route::group(['middleware'=>'login'],function(){
  //我的设置
  Route::any('/set',"IndexController@set");
  //安全设置
  Route::any('/set/safeset',"IndexController@safeset");
  //安全设置
  Route::any('/set/safeset/loginpwd',"IndexController@loginpwd");
  //退出登录
  Route::any('/logout',"IndexController@logout");
  //收货地址
  Route::any('address',"IndexController@address");
  //添加收货地址
  Route::any('/address/writeaddr',"IndexController@writeaddr");
  //添加收货地址
  Route::any('/address/writeaddr/set',"IndexController@setdefaultaddress");
  //删除收货地址
  Route::any('/address/writeaddr/del',"IndexController@deladdress");
  //编辑收货地址
  Route::any('/address/writeaddr/update/{id}',"IndexController@writeaddrupdate");
  //编辑个人资料
  Route::any('/edituser',"IndexController@edituser");
  //编辑个人资料
  Route::any('/edituser/namemodify',"IndexController@namemodify");
  //购物记录
  Route::any('buyrecord',"IndexController@buyrecord");
  //二维码分享
  Route::any('invite',"IndexController@invite");
  //我的钱包
  Route::any('mywallet',"IndexController@mywallet"); 
  //购物车
  Route::any('shopcart',"IndexController@shopcart");
  //加入购物车
  Route::any('cartadd',"IndexController@cartadd");
  //购物车商品数+1
  Route::any('/shopcart/add',"IndexController@shopcartadd");
  //购物车商品数-1
  Route::any('/shopcart/min',"IndexController@shopcartmin");
  //购物车商品数输入框
  Route::any('/shopcart/key',"IndexController@shopcartkey");
  //批量删除
  Route::any('/shopcart/remove',"IndexController@remove");
  //点击-立即购买
  Route::any('/shopcart/ordersupplyment/{id}',"IndexController@ordersupplyment");
  //点击-去结算
  Route::any('/shopcart/ordersum/{id}',"IndexController@ordersum");
  //点击-确认地址
  Route::any('/shopcart/payment/{id}',"IndexController@payment");
  //点击-立即支付
  Route::post('/nowpay',"IndexController@nowpay");
  //我的信息-我的订单
  Route::any('/recorddetail',"IndexController@recorddetail");

});

//条件：默认
Route::any('default/{id?}',"IndexController@default");
//条件：最新
Route::any('newest/{id?}',"IndexController@newest");
//条件：价值 由低到高
Route::any('up/{id?}',"IndexController@up");
//条件：价值 由高到低
Route::any('down/{id?}',"IndexController@down");

//支付宝沙箱
Route::group(['prefix'=>'alipay'],function(){
  Route::post('mobilepay',"AliPayController@mobilepay");
  Route::any('return',"AliPayController@re");
  Route::any('notify',"AliPayController@notify");
});