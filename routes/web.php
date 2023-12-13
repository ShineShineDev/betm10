<?php



use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\SlideController;
use App\Http\Controllers\TwodBetSlipController;
use App\Http\Controllers\admin\ServiceController;
use App\Http\Controllers\admin\SettingController;
use App\Http\Controllers\admin\CalendarController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\TwodBetLogController;
use App\Http\Controllers\TwodDefaultSettingController;
use App\Http\Controllers\admin\agents\AgentsController;
use App\Http\Controllers\admin\twod\TwodTypeController;
use App\Http\Controllers\admin\payment\PaymentController;
use App\Http\Controllers\admin\tran\TransactionController;
use App\Http\Controllers\admin\twod\TwodSectionController;
use App\Http\Controllers\admin\customers\CustomersController;
use App\Http\Controllers\admin\threed\ThreedSectionController;
use App\Http\Controllers\admin\customers\TransactionsController;
use App\Http\Controllers\admin\agents\AgentsCommissionController;
use App\Http\Controllers\admin\twod_manager\TwoDDetailsController;
use App\Http\Controllers\admin\twod_manager\TwoDHistoryController;
use App\Http\Controllers\admin\twod_manager\TwoDManagerController;
use App\Http\Controllers\admin\agents\AgentsTransactionsController;
use App\Http\Controllers\admin\thai_lottery_manager\WinnerController;
use App\Http\Controllers\admin\threed_manager\ThreeDetailsController;
use App\Http\Controllers\admin\threed_manager\ThreeDHistoryController;
use App\Http\Controllers\admin\threed_manager\ThreeDManagerController;
use App\Http\Controllers\admin\twod_manager\TwoDConfirmPageController;
use App\Http\Controllers\admin\twod_manager\TwoDNumberDetailController;
use App\Http\Controllers\admin\twod_manager\TwoDNumberSettingController;
use App\Http\Controllers\admin\thai_lottery_manager\ThaidpriceController;
use App\Http\Controllers\admin\threed_manager\ThreeDConfirmPageController;
use App\Http\Controllers\admin\thai_lottery_manager\ThaidSectionController;
use App\Http\Controllers\admin\threed_manager\ThreeDNumberDetailController;
use App\Http\Controllers\admin\threed_manager\ThreeDNumberSettingController;
use App\Http\Controllers\admin\thai_lottery_manager\ThaiLotteryDetailsController;
use App\Http\Controllers\admin\thai_lottery_manager\ThaiLotteryHistoryController;
use App\Http\Controllers\admin\thai_lottery_manager\ThaiLotteryManagerController;
use App\Http\Controllers\admin\transactions_manager\TransactionsManagerController;
use App\Http\Controllers\admin\thai_lottery_manager\ThaiLotteryConfirmPageController;
use App\Http\Controllers\admin\thai_lottery_manager\ThaiLotteryNumberDetailController;
use App\Http\Controllers\admin\thai_lottery_manager\ThaiLotteryNumberSettingController;
use App\Http\Controllers\admin\twod\TwodNumberInfoController;
use App\Http\Controllers\admin\twod\TwodScheduleController;
use App\Http\Controllers\Other\ApplicationController;
use App\Http\Controllers\admin\support\SupportController;
use App\Http\Controllers\admin\ClosingDayController;
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
Auth::routes(['register' => true]);

// 'middleware' => 'auth'
Route::group(['prefix' => 'admin', 'namspace' => 'admin', 'as' => 'admin.','middleware' => 'auth'], function () {

    Route::post('/agent/create', [AgentsController::class, 'storeAgent'])->name('agent.create');
    Route::get('/agent/pending', [AgentsController::class, 'showPendings'])->name('agent.pendings');
    Route::get('customer/{customer}/show', [CustomersController::class, 'show'])->name('customer.show');
    Route::get('customer/{customer}/balance', [CustomersController::class, 'showManageBalance'])->name('customer.balance');
    Route::get('/customer/{customer}/2d_betting_list', [CustomersController::class, 'show2DBettingLists'])->name('customer.2d.list');
    Route::get('/customer/{customer}/3d_betting_list', [CustomersController::class, 'show3DBettingLists'])->name('customer.3d.list');
    Route::get('/customer/{customer}/thaid_betting_list', [CustomersController::class, 'showThaidBettingLists'])->name('customer.thaid.list');
    Route::get('/customer/{customer}/transaction', [CustomersController::class, 'showTransactions'])->name('customer.transactions');
    Route::post('/customer/balance/add', [CustomersController::class, 'addAmount'])->name('customer.addbalance');
    Route::post('/customer/balance/minus', [CustomersController::class, 'minusAmount'])->name('customer.minusAmount');


    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
  	Route::resource('closing-days',ClosingDayController::class);

    // 2D Manager
    Route::group(['namepsace' => 'twod_manager'], function () {

        //default setting
        Route::get('twod_default_settings/edit', [TwodDefaultSettingController::class,'edit'])->name('twod_default_settings.edit');
        Route::post('twod_default_settings/edit', [TwodDefaultSettingController::class,'update'])->name('twod_default_settings.update');

        //twod types
        Route::resource('twod_types',TwodTypeController::class);

        //twod_shedules
        Route::resource('twod_schedules',TwodScheduleController::class)->except('update');
        Route::post('twod_schedules/{id}/edit',[TwodScheduleController::class,'update'])->name('twod_schedules.update');

        //twod section
        Route::resource('twod_sections', TwodSectionController::class);
        Route::post('twod_sections/add_winning_number',[TwodSectionController::class,'add_winning_number'])->name('twod_section.add_winning_number');
        Route::resource('twod_sections/{section_id}/numbers', TwodNumberInfoController::class);
        Route::get('/twod_sections/{section_id}/ajax',[TwodSectionController::class,'get_section_data']);

        Route::post('/twod_sections/confirm_winning_number',[TwodSectionController::class,'confirmWinningNumber'])->name('twod_section.confirm_winning_number');
        //bet logs
        Route::resource('twod_bet_slips', TwodBetSlipController::class);
        Route::post('twod_bet_slips/{id}/reject',[TwodBetSlipController::class,'reject'])->name('twod_bet_slips.reject');
        
        Route::resource('twod_manager', TwoDManagerController::class);
        Route::resource('twod_number_detail', TwoDNumberDetailController::class);
        Route::resource('twod_confirm_page', TwoDConfirmPageController::class);
        Route::resource('twod_details', TwoDDetailsController::class);
        Route::resource('twod_number_setting', TwoDNumberSettingController::class);
        Route::resource('twod_history', TwoDHistoryController::class);
    });

    // 3D Manager
    Route::group(['namepsace' => 'threed_manager'], function () {
        Route::resource('threed_manager', ThreeDManagerController::class);
        Route::resource('threed_number_detail', ThreeDNumberDetailController::class);
        Route::resource('threed_confirm_page', ThreeDConfirmPageController::class);
        Route::resource('threed_details', ThreeDetailsController::class);
        Route::resource('threed_number_setting', ThreeDNumberSettingController::class);
        Route::resource('threed_history', ThreeDHistoryController::class);
    });

    //Thai Lottery Manager
    Route::group(['namepsace' => 'thai_lottery_manager'], function () {
        Route::resource('thai_lottery_manager', ThaiLotteryManagerController::class);
        Route::resource('thai_lottery_number_detail', ThaiLotteryNumberDetailController::class);
        Route::resource('thai_lottery_confirm_page', ThaiLotteryConfirmPageController::class);
        Route::resource('thai_lottery_details', ThaiLotteryDetailsController::class);
        Route::resource('thai_lottery_number_setting', ThaiLotteryNumberSettingController::class);
        Route::resource('thai_lottery_history', ThaiLotteryHistoryController::class);

        Route::get('thai_lottery_popup', function () {
            return view('admin.thai_lottery_manager.lottery_popup');
        });
    });

    //Manage Customers
    Route::group(['namepsace' => 'customers'], function () {
        Route::resource('customers', CustomersController::class);
        Route::get('customers/transactions/{id}', [TransactionsController::class, 'show'])->name('customers.transactions');
    });

    //Manage Agents
    Route::group(['namepsace' => 'agents'], function () {
        Route::resource('agents', AgentsController::class);
        Route::get('agents/transactions/{id}', [AgentsTransactionsController::class, 'show'])->name('agents.transactions');
        Route::get('agents/commissions/{id}', [AgentsCommissionController::class, 'show'])->name('agents.commissions');
    });

    //Transactions Manager
    Route::group(['namepsace' => 'transactions_manager'], function () {
        Route::resource('transactions', TransactionsManagerController::class);
    });

    Route::resource('slide', SlideController::class);



    Route::post('/slide/home-banner-text/update', [SlideController::class, 'updateHomeBannerText'])->name('home-banner-text.update');
    Route::get('/slidetext', [SlideController::class, 'slideText'])->name('slidetext.index');
    Route::post('/slidetext/create', [SlideController::class, 'slideTextStore'])->name('slidetext.create');
    Route::get('/slidetext/edit/{id}', [SlideController::class, 'slideTextEdit'])->name('slidetext.edit');
    Route::post('/slidetext/update', [SlideController::class, 'slideTextUpdate'])->name('slidetext.update');
    Route::get('/slidetext/destory/{id}', [SlideController::class, 'destorySlideText'])->name('slidetext.destory');


    // Service
    Route::resource('service', ServiceController::class);

    // setting
    Route::get('/setting', [SettingController::class, 'index'])->name('setting.index');
    Route::post('/setting/update', [SettingController::class, 'update'])->name('setting.update');

    //ThaidPrice
    Route::post('thaidprice', [ThaidpriceController::class,'store'])->name('thaid.price');
    Route::get('thaid_comfrim',[ThaiLotteryManagerController::class,'thaidcomfrim'])->name('thaid.comfirm');
    Route::post('thaid_comfrim_list', [ThaiLotteryManagerController::class, 'thaidcomfrimlist'])->name('thaidcomfirm.list');
    Route::post('thaid/option',[ThaiLotteryManagerController::class,'thaidoption'])->name('thaid.option');
    Route::post('thaid/winningnumber/section', [ThaiLotteryManagerController::class, 'thaidwinningnumbersection'])->name('thaid.winningnumber.section');
    Route::post('thaidsearch/list',[ThaiLotteryManagerController::class,'searchthaid'])->name('thaidsearch.list');
    Route::post('thaidbetslip/search',[ThaiLotteryManagerController::class,'searchthaidbet'])->name('thaidbetslip.search');
    Route::get('thaidsection/create',[ThaidSectionController::class, 'thaidsection'])->name('thaidsection.list');
    Route::post('thaidsection/create/createlist',[ThaidSectionController::class,'thaidsectioncreate'])->name('thaidsection.create');
    Route::get('thaidsection/delete/{id}',[ThaidSectionController::class,'delete'])->name('thaidsection.delete');
    Route::get('thaidprice/list',[ThaidpriceController::class,'thaidpricelist'])->name('thaidprice.list');
    Route::post('thaidprice/create',[ThaidpriceController::class,'thaidpricecreate'])->name('thaidprice.create');
    Route::get('thaidprice/delete/{id}', [ThaidpriceController::class, 'thaidpricedelete'])->name('thaidprice.delete');
    Route::get('thaidwinningNumber/edit',[ThaiLotteryManagerController::class,'editthaidwinningnumber'])->name('editthaidwinning.number');
    Route::get('thaidList/reject/{id}', [ThaiLotteryManagerController::class, 'reject'])->name('thiadlist.reject');



    //ThreeD
    Route::get('threed/section',[ThreedSectionController::class,'sectionList'])->name('threedsection.list');
    Route::post('threed/section/create',[ThreedSectionController::class,'create'])->name('threedsection.create');
    Route::get('threed/section/delete/{id}',[ThreedSectionController::class,'delete'])->name('threedsection.delete');

    Route::post('transaction/date/filter', [TransactionController::class, 'filterDate'])->name('tran.filter');

    // Payment
    Route::post('payment/create',[PaymentController::class,'store'])->name('payment.create');
    Route::get('payment/deposit/list', [PaymentController::class, 'deposit'])->name('payment.deposit');
    Route::get('payment/dandw/list', [PaymentController::class, 'listdandw'])->name('payment.listdandw');
    Route::get('payment/dandw/list/{id}', [PaymentController::class, 'listdandwfilter'])->name('payment.listdandw.filter');

    //No Need
    Route::get('payment/deposit/list', [PaymentController::class, 'deposit'])->name('payment.deposit');
    Route::get('deposit/status/comfirm/{id}',[PaymentController::class,'comfirm'])->name('payment.status');
    Route::get('payment/withdraw/list', [PaymentController::class, 'withdraw'])->name('payment.withdraw');
    Route::get('withdraw/status/comfirm/{id}', [PaymentController::class, 'Withdrawcomfirm'])->name('withdraw.payment.status');

    //WithDraw
    Route::get('payment/withdraw/list', [PaymentController::class, 'withdraw'])->name('payment.withdraw');
    Route::get('withdraw/status/comfirm/{id}', [PaymentController::class, 'Withdrawcomfirm'])->name('withdraw.payment.status');
    Route::get('winner/list',[WinnerController::class,'index'])->name('thaid.winner');
    Route::post('winner/comfirm', [WinnerController::class, 'comfirm'])->name('thaid.winner.comfirm');
    Route::get('winner/thaid/list', [WinnerController::class, 'list'])->name('winner.list');
    Route::post('winner/thaid/list/filter', [WinnerController::class, 'filter'])->name('winner.filter');

    //Calendar
    //2D
    Route::get('calendar',[CalendarController::class,'index'])->name('calendar.index');
    Route::post('calendar/twodcalendar', [CalendarController::class, 'store'])->name('twodcalendar.store');
    Route::get('calendar/twodcalendar/delete/{id}', [CalendarController::class, 'destory'])->name('twodcalendar.delete');
    //3D
    Route::post('calendar/threedcalendar', [CalendarController::class, 'storeThreed'])->name('threedcalendar.store');
    Route::get('calendar/threedcalendar/delete/{id}', [CalendarController::class, 'destoryThreed'])->name('threedcalendar.delete');
    //ThaiD
    Route::post('calendar/thaidcalendar', [CalendarController::class, 'storeThaid'])->name('thaidcalendar.store');
    Route::get('thaidwinningNumberCalendar/edit', [CalendarController::class, 'editthaidwinningnumberCalendar'])->name('editthaidwinningcalendar.number');
    Route::get('calendar/thaidcalendar/delete/{id}', [CalendarController::class, 'destoryThaid'])->name('thaidcalendar.delete');

    Route::get('support',[SupportController::class,'index'])->name('support.index');
    Route::post('support/create',[SupportController::class,'store'])->name('support.create');
    
    
});

Route::get('test',function(){
    $monthName = 'July'; 
    $year = 2023;
        $date = Carbon\Carbon::parse("1 $monthName");
        $monthNumber = $date->format('m');

        $data = App\Models\TwodSection::select('id','winning_number','opening_datetime')
                            ->whereMonth('opening_datetime',$monthNumber)
                            ->whereYear('opening_datetime',$year)
                            ->get();
        dd($data->toArray());
    dd(now()->format('Y'));
    $monthName = 'July'; 
    $date = Carbon\Carbon::parse("1 $monthName");
    $monthNumber = $date->format('n');
    dd($monthNumber);
    dd(now()->format('m'));
    App\Models\TwodSection::get();
});
Route::get('image/{filename}', [ApplicationController::class, 'file'])->where('filename', '.*');
