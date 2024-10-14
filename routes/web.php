<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\RestaurantController;

use App\Http\Controllers\FoodController;
use App\Exports\FoodsExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\PickupRequestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\CharityController;
use App\Http\Controllers\FrontOfficeController;

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
		Route::get('profile', [FrontOfficeController::class, 'createProfile'])->name('profile');
        Route::post('profile', [FrontOfficeController::class, 'updateProfile'])->name('user-profile.update');

		// Define the events routes here
		Route::prefix('events')->name('events.')->group(function () {
			Route::get('/', [FrontOfficeController::class, 'EventsList'])->name('index'); // List of events
			Route::get('/{event}', [FrontOfficeController::class, 'showEvent'])->name('show'); // Event details

		});
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

	//Event routes
	Route::resource('events', EventController::class);
	Route::post('/events/{event}/publish', [EventController::class, 'publish'])->name('events.publish');
	
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
# restaurant routes rami :
Route::get('restaurants', [RestaurantController::class, 'index'])->name('restaurants');
Route::get('restaurants/create', [RestaurantController::class, 'create'])->name('restaurants.create');
Route::post('restaurants', [RestaurantController::class, 'store'])->name('restaurants.store');
Route::get('restaurants/{id}', [RestaurantController::class, 'show'])->name('restaurants.show');
Route::get('restaurants/{id}/edit', [RestaurantController::class, 'edit'])->name('restaurants.edit');
Route::put('restaurants/{id}', [RestaurantController::class, 'update'])->name('restaurants.update');
Route::delete('restaurants/{id}', [RestaurantController::class, 'destroy'])->name('restaurants.destroy');
Route::get('restaurants/dashboard', [RestaurantController::class, 'dashboard'])->name('restaurants.dashboard');
# events routes imen :
Route::get('/events-rescue', [EventController::class, 'all'])->name('events.all');
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');
// Donations routes Hanin : 
Route::get('/donations', [FoodController::class, 'donations'])->name('donations');
Route::get('/donations/{id}', [FoodController::class, 'showDonation'])->name('donations.show');
# review routes marwen :
Route::resource('reviews', ReviewController::class);

Route::get('reviews', [ReviewController::class, 'index'])->name('reviews');
Route::get('reviews/create', [ReviewController::class, 'create'])->name('reviews.create');
Route::post('reviews', [ReviewController::class, 'store'])->name('reviews.store');
Route::get('reviews/{id}', [ReviewController::class, 'show'])->name('reviews.show');
Route::get('reviews/{id}/edit', [ReviewController::class, 'edit'])->name('reviews.edit');
Route::put('reviews/{id}', [ReviewController::class, 'update'])->name('reviews.update');
Route::delete('reviews/{id}', [ReviewController::class, 'destroy'])->name('reviews.destroy');

// About Us route
Route::get('/about', function () {
    return view('about');
})->name('about');

// Contact Us route
Route::get('/contact', function () {
    return view('contact');
})->name('contact');


Route::get('/restaurants', [RestaurantController::class, 'index'])->name('restaurants');

// Reviews routes
Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews');

Route::get('/charities', [CharityController::class, 'index'])->name('charities');
#welcome page : 

