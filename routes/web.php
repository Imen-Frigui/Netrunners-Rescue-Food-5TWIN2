<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\BeneficiaryController;
use Illuminate\Http\Request;
use App\Models\Food;
use App\Models\Restaurant;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\DonationController;
use App\Exports\FoodsExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\PickupRequestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\CharityController;
use App\Http\Controllers\FrontOfficeController;
use App\Http\Controllers\ReportController;

use App\Http\Controllers\DriverController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\SponsorController;

Route::get('/', function () {
	return redirect('sign-in');
})->middleware('guest');
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
Route::get('sign-up', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('sign-up', [RegisterController::class, 'store'])->middleware('guest');
Route::get('sign-in', [SessionsController::class, 'create'])->middleware('guest')->name('login');
Route::post('sign-in', [SessionsController::class, 'store'])->middleware('guest');
Route::post('verify', [SessionsController::class, 'show'])->middleware('guest');
Route::post('reset-password', [SessionsController::class, 'update'])->middleware('guest')->name('password.update');
Route::get('verify', function () {
	return view('sessions.password.verify');
})->middleware('guest')->name('verify');
Route::get('/reset-password/{token}', function ($token) {
	return view('sessions.password.reset', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('sign-out', [SessionsController::class, 'destroy'])->middleware('auth')->name('logout');
Route::get('profile', [ProfileController::class, 'create'])->middleware('auth')->name('profile');
Route::post('user-profile', [ProfileController::class, 'update'])->middleware('auth');
Route::group(['middleware' => 'auth'], function () {
	
	Route::prefix('front-office')->name('front-office.')->group(function () {
		Route::get('/', [FrontOfficeController::class, 'index'])->name('index');
		Route::get('about', [FrontOfficeController::class, 'aboutUs'])->name('about');

		Route::get('profile', [FrontOfficeController::class, 'createProfile'])->name('profile');
        Route::post('profile', [FrontOfficeController::class, 'updateProfile'])->name('user-profile.update');
	// routes/web.php
	
	});
	Route::get('billing', function () {
		return view('pages.billing');
	})->name('billing');
	Route::get('tables', function () {
		return view('pages.tables');
	})->name('tables');
	Route::get('rtl', function () {
		return view('pages.rtl');
	})->name('rtl');
	Route::get('virtual-reality', function () {
		return view('pages.virtual-reality');
	})->name('virtual-reality');
	Route::get('notifications', function () {
		return view('pages.notifications');
	})->name('notifications');
	Route::get('static-sign-in', function () {
		return view('pages.static-sign-in');
	})->name('static-sign-in');
	Route::get('static-sign-up', function () {
		return view('pages.static-sign-up');
	})->name('static-sign-up');
	Route::get('user-management', function () {
		return view('pages.laravel-examples.user-management');
	})->name('user-management');
	Route::get('user-profile', function () {
		return view('pages.laravel-examples.user-profile');
	})->name('user-profile');

	// Event routes
	Route::resource('events', EventController::class);
	Route::post('/events/{event}/publish', [EventController::class, 'publish'])->name('events.publish');

	# Sponsor  routes imen :
	Route::resource('sponsors', SponsorController::class);
	Route::get('sponsors/{sponsor}/export/pdf', [SponsorController::class, 'exportPdf'])->name('sponsors.export.pdf');
	Route::get('sponsors/{sponsor}/export/csv', [SponsorController::class, 'exportCsv'])->name('sponsors.export.csv');
	Route::get('sponsors/{sponsor}/invoice', [SponsorController::class, 'generateInvoice'])->name('sponsors.invoice');
	Route::get('sponsors/{sponsor}/report', [SponsorController::class, 'report'])->name('sponsors.report');
	
	// Route for listing charities (index)
	Route::get('charities', [CharityController::class, 'index'])->name('charities');

	// Route for searching charities
	Route::get('charities/search', [CharityController::class, 'search'])->name('charities.search');

	// Route for showing charity details
	Route::get('/charities/{id}/details', [CharityController::class, 'showdetails'])->name('charities.details');

	// Route for showing the form to create a charity
	Route::get('/charities/create', [CharityController::class, 'create'])->name('charities.create');

	// Route for storing a new charity
	Route::post('/charities', [CharityController::class, 'store'])->name('charities.store');
	
	// Route for showing a charity (optional if you have a charity show page)
	Route::get('/charities/{charity}', [CharityController::class, 'show'])->name('charities.show');

	// Route for editing a charity
	Route::get('/charities/{charity}/edit', [CharityController::class, 'edit'])->name('charities.edit');

	// Route for updating a charity
	Route::put('/charities/{charity}', [CharityController::class, 'update'])->name('charities.update');

	// Route for deleting a charity
	Route::delete('/charities/{charity}', [CharityController::class, 'destroy'])->name('charities.destroy');
	// Show the form for editing a charity
	Route::get('/charities/{charity}/edit', [CharityController::class, 'edit'])->name('charities.edit');

	// Update the charity in the database
	Route::put('/charities/{charity}', [CharityController::class, 'update'])->name('charities.update');

	Route::get('/foods/export', function () {
		return Excel::download(new FoodsExport, 'foods.xlsx');
	})->name('foods.export');
	Route::resource('foods', FoodController::class);

	Route::get('pickup-management', function () {
		return view('pickups.index');
	})->name('pickup-management');
	Route::get('pickup-management', [PickupRequestController::class, 'index'])->name('pickup-management');
	Route::get('/pickup/accept/{id}', [PickupRequestController::class, 'accept'])->name('pickup.accept');
	Route::get('/pickup/reject/{id}', [PickupRequestController::class, 'reject'])->name('pickup.reject');
	Route::get('/pickup/create', [PickupRequestController::class, 'create'])->name('pickup.create');
	Route::post('/pickup', action: [PickupRequestController::class, 'store'])->name('pickup.store');
	Route::get('/pickup/edit/{id}', [PickupRequestController::class, 'edit'])->name('pickup.edit');
	Route::put('/pickup/{id}', [PickupRequestController::class, 'update'])->name('pickup.update');
});

Route::get('driver-management', function () {
	return view('drivers.index');
})->name('driver-management');

Route::get('driver-management', action: [DriverController::class, 'index'])->name('driver-management');
// Route::get('/driver/create', [DriverController::class, 'create'])->name('drivers.create');
// Route::get('/driver/edit/{id}', [DriverController::class, 'edit'])->name('drivers.edit');
// Route::put('/driver/{id}', [DriverController::class, 'update'])->name('drivers.update');
Route::middleware(['auth'])->group(function () {
    Route::get('/my-pickups', [DriverController::class, 'myPickups'])->name('my-pickups');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/my-pickups', [DriverController::class, 'myPickups'])->name('my-pickups');
});


// Route::post('/driver', action: [DriverController::class, 'store'])->name('drivers.store');
Route::get('/api/available-drivers', [PickupRequestController::class, 'getAvailableDrivers']);
Route::post('/pickup/{pickupRequest}/assign-driver', [PickupRequestController::class, 'assignDriver'])
    ->name('pickup.assign-driver');
	Route::post('/pickup/remove-driver/{pickupRequest}', [PickupRequestController::class, 'removeDriver'])->name('removeDriver');
Route::get('/pickup-locations/{id}', [PickupRequestController::class, 'getLocations']);




Route::middleware(['auth'])->group(function () {
    Route::get('/my-pickups', [DriverController::class, 'myPickups'])->name('my-pickups');
});


Route::get('/api/available-drivers', [PickupRequestController::class, 'getAvailableDrivers']);
Route::post('/pickup/{pickupRequest}/assign-driver', [PickupRequestController::class, 'assignDriver'])
    ->name('pickup.assign-driver');
	Route::post('/pickup/remove-driver/{pickupRequest}', [PickupRequestController::class, 'removeDriver'])->name('removeDriver');
Route::get('/pickup-locations/{id}', [PickupRequestController::class, 'getLocations']);

# restaurant routes rami :
Route::resource('restaurants', RestaurantController::class);
Route::get('restaurants', [RestaurantController::class, 'index'])->name('restaurants');
Route::get('restaurants/create', [RestaurantController::class, 'create'])->name('restaurants.create');
Route::post('restaurants', [RestaurantController::class, 'store'])->name('restaurants.store');
// Route::get('restaurants/{id}', [RestaurantController::class, 'show'])->name('restaurants.show');
// Route::get('restaurants/{id}/edit', [RestaurantController::class, 'edit'])->name('restaurants.edit');
// Route::put('restaurants/{id}', [RestaurantController::class, 'update'])->name('restaurants.update');
// Route::delete('restaurants/{id}', [RestaurantController::class, 'destroy'])->name('restaurants.destroy');
Route::get('restaurants/dashboard', [RestaurantController::class, 'dashboard'])->name('restaurants.dashboard');

# events routes imen :
Route::get('/events-rescue', [EventController::class, 'all'])->name('events.all');
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');

# sponsors routes imen :
Route::get('/sponsors/{sponsor}', [SponsorController::class, 'show'])->name('sponsors.show');
Route::get('sponsors/{sponsor}/scan/{eventId?}', [SponsorController::class, 'trackScan'])->name('sponsors.scan');
Route::get('sponsors/{sponsor}/qr-code/{eventId}', [SponsorController::class, 'generateQrCode'])->name('sponsors.qr_code');


// Donations routes Hanin :
Route::get('/donations', [FoodController::class, 'donations'])->name('donations');
Route::get('/donations/{id}', [FoodController::class, 'showDonation'])->name('donations.show');
Route::get('/donate', [DonationController::class, 'frontendCreate'])->name('donations.create');
Route::post('/donate', [DonationController::class, 'frontendStore'])->name('donations.store');
// New Donation CRUD routes with unique names
Route::prefix('donation-management')->name('donation-management.')->middleware('auth')->group(function () {
    Route::get('/donations', [DonationController::class, 'index'])->name('index');
    Route::get('/donations/create', [DonationController::class, 'create'])->name('create');
    Route::post('/donations', [DonationController::class, 'store'])->name('store');
    Route::get('/donations/{id}', [DonationController::class, 'show'])->name('show');
    Route::get('/donations/{id}/edit', [DonationController::class, 'edit'])->name('edit');
    Route::put('/donations/{id}', [DonationController::class, 'update'])->name('update');
    Route::delete('/donations/{id}', [DonationController::class, 'destroy'])->name('destroy');
});

// Beneficiary CRUD routes Hanin
Route::get('beneficiaries', [BeneficiaryController::class, 'index'])->name('beneficiaries.index');
Route::get('beneficiaries/create', [BeneficiaryController::class, 'create'])->name('beneficiaries.create');
Route::post('beneficiaries', [BeneficiaryController::class, 'store'])->name('beneficiaries.store');
Route::get('beneficiaries/{id}', [BeneficiaryController::class, 'show'])->name('beneficiaries.show');
Route::get('beneficiaries/{id}/edit', [BeneficiaryController::class, 'edit'])->name('beneficiaries.edit');
Route::put('beneficiaries/{id}', [BeneficiaryController::class, 'update'])->name('beneficiaries.update');
Route::delete('beneficiaries/{id}', [BeneficiaryController::class, 'destroy'])->name('beneficiaries.destroy');


# review routes marwen :
Route::resource('reviews', ReviewController::class);
Route::get('reviews', [ReviewController::class, 'index'])->name('reviews');
Route::get('reviews/create', [ReviewController::class, 'create'])->name('reviews.create');
Route::post('reviews', [ReviewController::class, 'store'])->name('reviews.store');
// Route::get('reviews/{id}', [ReviewController::class, 'show'])->name('reviews.show');
// Route::get('reviews/{id}/edit', [ReviewController::class, 'edit'])->name('reviews.edit');
// Route::put('reviews/{id}', [ReviewController::class, 'update'])->name('reviews.update');
// Route::delete('reviews/{id}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
// About Us route
Route::get('/about', function () {
    return view('about');
})->name('about');

// Contact Us route
Route::get('/contact', function () {
    return view('contact');
})->name('contact');


Route::get('/restaurants', [RestaurantController::class, 'index'])->name('restaurants');
Route::get('/resturant-all', [RestaurantController::class, 'all'])->name('restaurants.all');
Route::get('/front/restaurants/{restaurant}', [RestaurantController::class, 'showInventory'])->name('restaurants.front.show');



Route::get('/charities', [CharityController::class, 'index'])->name('charities');
Route::get('/frontcharities', [CharityController::class, 'frontindex'])->name('frontcharities');
Route::get('/frontdetails/{id}/details', [CharityController::class, 'frontdetails'])->name('charities.frontdetails');


Route::resource('drivers', DriverController::class);
Route::get('drivers/{driver}/deliveries', [DriverController::class, 'currentDeliveries']);
Route::put('drivers/{driver}/location', [DriverController::class, 'updateLocation']);
Route::put('drivers/{driver}/availability', [DriverController::class, 'updateAvailability']);
Route::post('/pickup-request/{restaurant_id}/{food_id}', [PickupRequestController::class, 'quickAdd'])->name('pickup.quick-add');

Route::get('/pickup-requests', [PickupRequestController::class, 'indexfront'])->name('pickup.requests');

//Reports routes
Route::resource('/reports', ReportController::class);
// Route::get('/reports/{id}', [ReportController::class, 'show'])->name('reports.show');
Route::delete('/reports/{id}', [ReportController::class, 'destroy'])->name('reports.delete');
Route::get('/charities/{charity}/reports/create', [ReportController::class, 'create'])->name('charities.reports.create');
Route::post('/reports/{id}/solve', [ReportController::class, 'markAsSolved'])->name('reports.solve');
Route::patch('/reports/{id}/reject', [ReportController::class, 'markAsRejected'])->name('reports.reject');
Route::get('/reports/{id}/download', [ReportController::class, 'downloadPdf'])->name('reports.download');



Route::resource('inventories', InventoryController::class);

// Additional routes for custom functionalities
Route::get('api/inventories/low-stock', [InventoryController::class, 'lowStock'])->name('api.inventories.lowStock');
Route::get('/inventories/reorder-suggestions', [InventoryController::class, 'reorderSuggestions'])->name('inventories.reorderSuggestions');

Route::get('restaurants/{restaurant}/inventories', [InventoryController::class, 'indexResto'])->name('inventories.indexResto');
Route::get('restaurants/{restaurant}/inventories/create', [InventoryController::class, 'createResto'])->name('inventories.createResto');
Route::post('restaurants/{restaurant}/inventories', [InventoryController::class, 'storeResto'])->name('inventories.storeResto');
Route::delete('restaurants/{restaurant}/inventories/{inventory}', [InventoryController::class, 'destroyResto'])->name('inventories.destroyResto');
Route::get('restaurants/{restaurant}/inventories/{inventory}/edit', [InventoryController::class, 'editResto'])
    ->name('inventories.editResto');
Route::put('restaurants/{restaurant}/inventories/{inventory}', [InventoryController::class, 'updateResto'])
    ->name('inventories.updateResto');

Route::get('api/get-details', function (Request $request) {
    $food = Food::find($request->input('food_id'));
    $restaurant = Restaurant::find($request->input('restaurant_id'));

    return response()->json([
        'food_name' => $food ? $food->food_name : 'Unknown',
        'restaurant_name' => $restaurant ? $restaurant->name : 'Unknown',
    ]);
});


#welcome page :
Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
Route::get('/comments/{id}/edit', [CommentController::class, 'edit'])->name('comments.edit');
Route::put('/comments/{id}', [CommentController::class, 'update'])->name('comments.update');
Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');
Route::get('/mycomments/{id}/edit', [CommentController::class, 'editFront'])->name('editfront');
Route::put('/mcomments/{id}', [CommentController::class, 'updateFront'])->name('updatefront');


// Reviews routes
Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews');

Route::get('/myreviews', [ReviewController::class, 'indexFront'])->name('myreviews');
Route::get('/myreviewedit/{id}', [ReviewController::class, 'editFront'])->name('myreviewedit');

Route::post('/updatemyreviews/{id}', [ReviewController::class, 'updateFront'])->name('updatemyreviews');
Route::get('myreviews/create', [ReviewController::class, 'createFront'])->name('myreviewcreate');
Route::post('myreviews', [ReviewController::class, 'storeFront'])->name('myreviewstore');
Route::delete('myreviews/{id}', [ReviewController::class, 'destroyFront'])->name('myreviewdelete');
Route::get('/myreviews/{id}', [ReviewController::class, 'showFront'])->name('myreview');

Route::get('myreviews/createResto/{restaurantId}', [ReviewController::class, 'createFrontResto'])->name('myreviewcreateResto');
Route::post('myreviewsResto/{restaurantId}', [ReviewController::class, 'storeFrontResto'])->name('myreviewstoreResto');