<?php

use Illuminate\Support\Facades\Route;

// ============================================
// CONTENT MANAGEMENT DASHBOARD ROUTES
// Access: Super Admin (role_id=1) & Content Manager (role_id=2)
// ============================================
Route::middleware(['auth', 'admin'])->prefix('content-management')->name('content-management.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\ContentManagementController::class, 'dashboard'])->name('dashboard');
    
    // Hotel Contacts
    Route::get('/contacts', [App\Http\Controllers\ContentManagementController::class, 'contacts'])->name('contacts');
    Route::post('/contacts/update', [App\Http\Controllers\ContentManagementController::class, 'updateContacts'])->name('contacts.update');
    
    // About Us
    Route::get('/about', [App\Http\Controllers\ContentManagementController::class, 'about'])->name('about');
    Route::post('/about/update', [App\Http\Controllers\ContentManagementController::class, 'updateAbout'])->name('about.update');
    
    // Terms and Conditions
    Route::get('/terms-conditions', [App\Http\Controllers\ContentManagementController::class, 'termsConditions'])->name('terms');
    Route::post('/terms-conditions/update', [App\Http\Controllers\ContentManagementController::class, 'updateTermsConditions'])->name('terms.update');
    
    // SEO Data
    Route::get('/seo-data', [App\Http\Controllers\ContentManagementController::class, 'seoData'])->name('seo');
    Route::get('/seo-data/{id}', [App\Http\Controllers\ContentManagementController::class, 'showSeoData'])->name('seo.show');
    Route::post('/seo-data/update', [App\Http\Controllers\ContentManagementController::class, 'updateSeoData'])->name('seo.update');
    Route::post('/seo-data/store', [App\Http\Controllers\ContentManagementController::class, 'updateSeoData'])->name('seo.store');
    
    // System Users (Super Admin only - role_id=1) - Full CRUD with Email Verification
    Route::middleware('superadmin')->group(function () {
        Route::get('/users', [App\Http\Controllers\UserManagementController::class, 'index'])->name('users');
        Route::post('/users/store', [App\Http\Controllers\UserManagementController::class, 'store'])->name('users.store');
        Route::get('/users/{id}', [App\Http\Controllers\UserManagementController::class, 'show'])->name('users.show');
        Route::post('/users/{id}/update', [App\Http\Controllers\UserManagementController::class, 'update'])->name('users.update');
        Route::delete('/users/{id}', [App\Http\Controllers\UserManagementController::class, 'destroy'])->name('users.destroy');
        Route::post('/users/{id}/verify-email', [App\Http\Controllers\UserManagementController::class, 'verifyEmail'])->name('users.verify-email');
        Route::post('/users/{id}/resend-verification', [App\Http\Controllers\UserManagementController::class, 'resendVerification'])->name('users.resend-verification');
        Route::post('/users/{id}/reset-password', [App\Http\Controllers\UserManagementController::class, 'resetPassword'])->name('users.reset-password');
    });
    
    // Services - Full CRUD
    Route::get('/services', [App\Http\Controllers\ServiceManagementController::class, 'index'])->name('services');
    Route::post('/services/store', [App\Http\Controllers\ServiceManagementController::class, 'store'])->name('services.store');
    Route::get('/services/{id}', [App\Http\Controllers\ServiceManagementController::class, 'show'])->name('services.show');
    Route::post('/services/{id}/update', [App\Http\Controllers\ServiceManagementController::class, 'update'])->name('services.update');
    Route::delete('/services/{id}', [App\Http\Controllers\ServiceManagementController::class, 'destroy'])->name('services.destroy');
    Route::delete('/services/images/{id}', [App\Http\Controllers\ServiceManagementController::class, 'deleteImage'])->name('services.delete-image');
    
    // Rooms - Full CRUD
    Route::get('/rooms', [App\Http\Controllers\RoomManagementController::class, 'index'])->name('rooms');
    Route::post('/rooms/store', [App\Http\Controllers\RoomManagementController::class, 'store'])->name('rooms.store');
    Route::get('/rooms/{id}', [App\Http\Controllers\RoomManagementController::class, 'show'])->name('rooms.show');
    Route::post('/rooms/{id}/update', [App\Http\Controllers\RoomManagementController::class, 'update'])->name('rooms.update');
    Route::delete('/rooms/{id}', [App\Http\Controllers\RoomManagementController::class, 'destroy'])->name('rooms.destroy');
    Route::delete('/rooms/images/{id}', [App\Http\Controllers\RoomManagementController::class, 'deleteImage'])->name('rooms.delete-image');
    Route::post('/rooms/{id}/images', [App\Http\Controllers\RoomManagementController::class, 'addImages'])->name('rooms.add-images');
    
    // Facilities - Full CRUD
    Route::get('/facilities', [App\Http\Controllers\FacilityManagementController::class, 'index'])->name('facilities');
    Route::post('/facilities/store', [App\Http\Controllers\FacilityManagementController::class, 'store'])->name('facilities.store');
    Route::get('/facilities/{id}', [App\Http\Controllers\FacilityManagementController::class, 'show'])->name('facilities.show');
    Route::post('/facilities/{id}/update', [App\Http\Controllers\FacilityManagementController::class, 'update'])->name('facilities.update');
    Route::delete('/facilities/{id}', [App\Http\Controllers\FacilityManagementController::class, 'destroy'])->name('facilities.destroy');
    Route::delete('/facilities/images/{id}', [App\Http\Controllers\FacilityManagementController::class, 'deleteImage'])->name('facilities.delete-image');
    Route::post('/facilities/{id}/images', [App\Http\Controllers\FacilityManagementController::class, 'addImages'])->name('facilities.add-images');
    
    // Amenities - Full CRUD
    Route::get('/amenities', [App\Http\Controllers\AmenityController::class, 'index'])->name('amenities');
    Route::post('/amenities/store', [App\Http\Controllers\AmenityController::class, 'store'])->name('amenities.store');
    Route::get('/amenities/{id}', [App\Http\Controllers\AmenityController::class, 'show'])->name('amenities.show');
    Route::post('/amenities/{id}/update', [App\Http\Controllers\AmenityController::class, 'update'])->name('amenities.update');
    Route::delete('/amenities/{id}', [App\Http\Controllers\AmenityController::class, 'destroy'])->name('amenities.destroy');
    
    // Tour Activities - Full CRUD
    Route::get('/tour-activities', [App\Http\Controllers\TourActivityController::class, 'index'])->name('tour-activities');
    Route::post('/tour-activities/store', [App\Http\Controllers\TourActivityController::class, 'store'])->name('tour-activities.store');
    Route::get('/tour-activities/{id}', [App\Http\Controllers\TourActivityController::class, 'show'])->name('tour-activities.show');
    Route::post('/tour-activities/{id}/update', [App\Http\Controllers\TourActivityController::class, 'update'])->name('tour-activities.update');
    Route::delete('/tour-activities/{id}', [App\Http\Controllers\TourActivityController::class, 'destroy'])->name('tour-activities.destroy');
    Route::delete('/tour-activities/images/{id}', [App\Http\Controllers\TourActivityController::class, 'deleteImage'])->name('tour-activities.delete-image');
    
    // Gallery
    Route::get('/gallery', [App\Http\Controllers\ContentManagementController::class, 'gallery'])->name('gallery');
    Route::post('/gallery/store', [App\Http\Controllers\ContentManagementController::class, 'storeGallery'])->name('gallery.store');
    
    // Slideshow
    Route::get('/slideshow', [App\Http\Controllers\ContentManagementController::class, 'slideshow'])->name('slideshow');
    Route::post('/slideshow/store', [App\Http\Controllers\ContentManagementController::class, 'storeSlide'])->name('slideshow.store');
    
    // Page Heroes
    Route::get('/page-heroes', [App\Http\Controllers\ContentManagementController::class, 'pageHeroes'])->name('page-heroes');
    Route::post('/page-heroes/{id}/update', [App\Http\Controllers\ContentManagementController::class, 'updatePageHero'])->name('page-heroes.update');
});

// ============================================
// ACCOUNTANT DASHBOARD ROUTES
// Access: Super Admin (role_id=1) & Accountant (role_id=3)
// ============================================
Route::middleware(['auth', 'accountant'])->prefix('accountant')->name('accountant.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\AccountantController::class, 'dashboard'])->name('dashboard');
    
    // Expense Categories
    Route::get('/expense-categories', [App\Http\Controllers\AccountantController::class, 'expenseCategories'])->name('expense-categories');
    Route::post('/expense-categories/store', [App\Http\Controllers\AccountantController::class, 'storeExpenseCategory'])->name('expense-categories.store');
    Route::post('/expense-categories/{id}/update', [App\Http\Controllers\AccountantController::class, 'updateExpenseCategory'])->name('expense-categories.update');
    Route::delete('/expense-categories/{id}', [App\Http\Controllers\AccountantController::class, 'deleteExpenseCategory'])->name('expense-categories.delete');
    
    // Expenses
    Route::get('/expenses', [App\Http\Controllers\AccountantController::class, 'expenses'])->name('expenses');
    Route::post('/expenses/store', [App\Http\Controllers\AccountantController::class, 'storeExpense'])->name('expenses.store');
    
    // Sales Reports
    Route::get('/sales', [App\Http\Controllers\AccountantController::class, 'sales'])->name('sales');
    
    // Invoices
    Route::get('/invoices', [App\Http\Controllers\AccountantController::class, 'invoices'])->name('invoices');
    Route::post('/invoices/generate', [App\Http\Controllers\AccountantController::class, 'generateInvoice'])->name('invoices.generate');
    
    // Payments
    Route::get('/payments', [App\Http\Controllers\AccountantController::class, 'payments'])->name('payments');
    Route::post('/payments/{id}/confirm', [App\Http\Controllers\AccountantController::class, 'confirmPayment'])->name('payments.confirm');
});

// Front Office Dashboard Routes
Route::middleware(['auth', 'frontoffice'])->prefix('front-office')->name('front-office.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\FrontOfficeController::class, 'dashboard'])->name('dashboard');
    
    // Rooms Display
    Route::get('/rooms', [App\Http\Controllers\FrontOfficeController::class, 'roomsDisplay'])->name('rooms');
    Route::post('/rooms/{id}/update-status', [App\Http\Controllers\FrontOfficeController::class, 'updateRoomStatus'])->name('rooms.update-status');
    
    // Reservations Calendar
    Route::get('/reservations/calendar', [App\Http\Controllers\FrontOfficeController::class, 'reservationsCalendar'])->name('reservations.calendar');
    
    // In-House List
    Route::get('/inhouse', [App\Http\Controllers\FrontOfficeController::class, 'inHouseList'])->name('inhouse');
    
    // Check-in/Check-out
    Route::post('/bookings/{id}/checkin', [App\Http\Controllers\FrontOfficeController::class, 'checkIn'])->name('checkin');
    Route::post('/bookings/{id}/checkout', [App\Http\Controllers\FrontOfficeController::class, 'checkOut'])->name('checkout');
    
    // Walk-in Registration
    Route::post('/walkin/register', [App\Http\Controllers\FrontOfficeController::class, 'registerWalkIn'])->name('walkin.register');
    
    // Move Guest
    Route::post('/bookings/{id}/move', [App\Http\Controllers\FrontOfficeController::class, 'moveGuest'])->name('move-guest');
    
    // Reservations
    Route::get('/reservations', [App\Http\Controllers\FrontOfficeController::class, 'reservations'])->name('reservations');
    Route::post('/reservations/{id}/update-status', [App\Http\Controllers\FrontOfficeController::class, 'updateReservationStatus'])->name('reservations.update-status');
    
    // Sales Reports
    Route::get('/reports/sales', [App\Http\Controllers\FrontOfficeController::class, 'salesReport'])->name('reports.sales');
});

// Legacy Admin Routes (keeping for backward compatibility)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'index'])->name('dashboard');
    Route::get('/logouts', [App\Http\Controllers\AdminController::class, 'logouts'])->name('logouts');
    Route::get('/Users', [App\Http\Controllers\AdminController::class, 'users'])->name('users');
    Route::get('/Users/{id}', [App\Http\Controllers\AdminController::class, 'makeAdmin'])->name('makeAdmin');
    Route::get('/deleteUser/{id}', [App\Http\Controllers\AdminController::class, 'deleteUser'])->name('deleteUser');

 
    Route::get('/Comments', [App\Http\Controllers\AdminController::class, 'blogsComment'])->name('blogsComment');
    Route::post('/Comment/approve/{comment}', [App\Http\Controllers\AdminController::class, 'commentApprove'])->name('commentApprove');
    Route::get('/CommentDelete/{id}', [App\Http\Controllers\AdminController::class, 'destroyBlogComment'])->name('destroyBlogComment');

    Route::get('/Subscribers', [App\Http\Controllers\AdminController::class, 'subscribers'])->name('subscribers');
    Route::get('/Subscribers/{id}', [App\Http\Controllers\AdminController::class, 'destroySub'])->name('destroySub');
    Route::get('/delete-booking/{id}', [App\Http\Controllers\AdminController::class, 'destroyBooking'])->name('destroyBooking');
    Route::post('/reply-booking/{id}', [App\Http\Controllers\AdminController::class, 'replyBooking'])->name('replyBooking');

    Route::get('/getMessages', [App\Http\Controllers\AdminController::class, 'getMessages'])->name('getMessages');
    Route::get('/deleteMessages/{id}', [App\Http\Controllers\AdminController::class, 'deleteMessages'])->name('deleteMessages');

    
    Route::get('/setting',[App\Http\Controllers\SettingsController::class,'setting'])->name('setting');
    Route::post('/saveSetting',[App\Http\Controllers\SettingsController::class,'saveSetting'])->name('saveSetting');
    Route::post('/setting/keywords',[App\Http\Controllers\SettingsController::class,'updateKeywords'])->name('setting.keywords.update');
    
    Route::get('/homePage',[App\Http\Controllers\SettingsController::class,'homePage'])->name('homePage');
    Route::post('/saveHome',[App\Http\Controllers\SettingsController::class,'saveHome'])->name('saveHome');
    
    Route::get('/aboutPage',[App\Http\Controllers\SettingsController::class,'aboutPage'])->name('aboutPage');
    Route::post('/saveAbout',[App\Http\Controllers\SettingsController::class,'saveAbout'])->name('saveAbout');

    Route::get('/eventsPage',[App\Http\Controllers\PagesController::class,'eventsPage'])->name('eventsPage');
    Route::post('/saveEvent',[App\Http\Controllers\PagesController::class,'saveEvent'])->name('saveEvent');    
    Route::post('/addEventImage', [App\Http\Controllers\PagesController::class, 'addEventImage'])->name('addEventImage');
    Route::get('/deleteEventImage/{id}', [App\Http\Controllers\PagesController::class, 'deleteEventImage'])->name('deleteEventImage');    

        
    // Categories
    Route::get('/getCategories', [App\Http\Controllers\CategoriesController::class, 'index'])->name('getCategories');
    Route::post('/postCategory', [App\Http\Controllers\CategoriesController::class, 'store'])->name('postCategory');
    Route::get('/editCategory/{id}', [App\Http\Controllers\CategoriesController::class, 'edit'])->name('editCategory');
    Route::post('/updateCategory/{id}', [App\Http\Controllers\CategoriesController::class, 'update'])->name('updateCategory');
    Route::get('/deleteCategory/{id}', [App\Http\Controllers\CategoriesController::class, 'destroy'])->name('deleteCategory');
        
    // BLogs
    Route::get('/getBlogs', [App\Http\Controllers\BlogsController::class, 'index'])->name('getBlogs');
    Route::post('/saveBlog', [App\Http\Controllers\BlogsController::class, 'store'])->name('saveBlog');
    Route::get('/blog/{id}', [App\Http\Controllers\BlogsController::class, 'edit'])->name('editBlog');
    Route::get('/blogView/{id}', [App\Http\Controllers\BlogsController::class, 'view'])->name('viewBlog');
    Route::post('/updateBlog/{id}', [App\Http\Controllers\BlogsController::class, 'update'])->name('updateBlog');
    Route::get('/deleteBlog/{id}', [App\Http\Controllers\BlogsController::class, 'destroy'])->name('deleteBlog');
    Route::get('/Blog/{blog}/publish', [App\Http\Controllers\BlogsController::class, 'publish'])->name('publishBlog');


    // Services
    Route::get('/getServices', [App\Http\Controllers\ServicesController::class, 'index'])->name('getServices');
    Route::post('/storeService', [App\Http\Controllers\ServicesController::class, 'store'])->name('storeService');
    Route::get('/EditService/{id}', [App\Http\Controllers\ServicesController::class, 'edit'])->name('editService');
    Route::post('/UpdateService/{id}', [App\Http\Controllers\ServicesController::class, 'update'])->name('updateService');
    Route::get('/DeleteService/{id}', [App\Http\Controllers\ServicesController::class, 'destroy'])->name('deleteService');

    // Rooms
    Route::get('/getRooms', [App\Http\Controllers\RoomsController::class, 'index'])->name('getRooms');
    Route::post('/storeRoom', [App\Http\Controllers\RoomsController::class, 'store'])->name('storeRoom');
    Route::get('/editRoom/{id}', [App\Http\Controllers\RoomsController::class, 'edit'])->name('editRoom');
    Route::post('/updateRoom/{id}', [App\Http\Controllers\RoomsController::class, 'update'])->name('updateRoom');
    Route::get('/deleteRoom/{id}', [App\Http\Controllers\RoomsController::class, 'destroy'])->name('deleteRoom');

    Route::post('/addRoomImage', [App\Http\Controllers\RoomsController::class, 'addRoomImage'])->name('addRoomImage');
    Route::get('/deleteRoomImage/{id}', [App\Http\Controllers\RoomsController::class, 'deleteRoomImage'])->name('deleteRoomImage');

    // Facilities
    Route::get('/getFacilities', [App\Http\Controllers\FacilitiesController::class, 'index'])->name('getFacilities');
    Route::post('/storeFacility', [App\Http\Controllers\FacilitiesController::class, 'store'])->name('storeFacility');
    Route::get('/editFacility/{id}', [App\Http\Controllers\FacilitiesController::class, 'edit'])->name('editFacility');
    Route::post('/updateFacility/{id}', [App\Http\Controllers\FacilitiesController::class, 'update'])->name('updateFacility');
    Route::get('/deleteFacility/{id}', [App\Http\Controllers\FacilitiesController::class, 'destroy'])->name('deleteFacility');

    Route::post('/addFacilityImage', [App\Http\Controllers\FacilitiesController::class, 'addFacilityImage'])->name('addFacilityImage');
    Route::get('/deleteFacilityImage/{id}', [App\Http\Controllers\FacilitiesController::class, 'deleteFacilityImage'])->name('deleteFacilityImage');

    // Trips
    Route::get('/getTrips', [App\Http\Controllers\TripsController::class, 'index'])->name('getTrips');
    Route::post('/storeTrip', [App\Http\Controllers\TripsController::class, 'store'])->name('storeTrip');
    Route::get('/editTrip/{id}', [App\Http\Controllers\TripsController::class, 'edit'])->name('editTrip');
    Route::post('/updateTrip/{id}', [App\Http\Controllers\TripsController::class, 'update'])->name('updateTrip');
    Route::get('/deleteTrip/{id}', [App\Http\Controllers\TripsController::class, 'destroy'])->name('deleteTrip');

    Route::post('/addTripImage', [App\Http\Controllers\TripsController::class, 'addTripImage'])->name('addTripImage');
    Route::get('/deleteTripImage/{id}', [App\Http\Controllers\TripsController::class, 'deleteTripImage'])->name('deleteTripImage');

    // Tours
    Route::get('/getTours', [App\Http\Controllers\ToursController::class, 'index'])->name('getTours');
    Route::post('/storeTour', [App\Http\Controllers\ToursController::class, 'store'])->name('storeTour');
    Route::get('/editTour/{id}', [App\Http\Controllers\ToursController::class, 'edit'])->name('editTour');
    Route::post('/updateTour/{id}', [App\Http\Controllers\ToursController::class, 'update'])->name('updateTour');
    Route::get('/deleteTour/{id}', [App\Http\Controllers\ToursController::class, 'destroy'])->name('deleteTour');
    Route::post('/addTourImage', [App\Http\Controllers\ToursController::class, 'addTourImage'])->name('addTourImage');
    Route::get('/deleteTourImage/{id}', [App\Http\Controllers\ToursController::class, 'deleteTourImage'])->name('deleteTourImage');

    // Promotions
    Route::get('/getPromotions', [App\Http\Controllers\PromotionsController::class, 'index'])->name('getPromotions');
    Route::post('/storePromotion', [App\Http\Controllers\PromotionsController::class, 'store'])->name('storePromotion');
    Route::get('/editPromotion/{id}', [App\Http\Controllers\PromotionsController::class, 'edit'])->name('editPromotion');
    Route::post('/updatePromotion/{id}', [App\Http\Controllers\PromotionsController::class, 'update'])->name('updatePromotion');
    Route::get('/deletePromotion/{id}', [App\Http\Controllers\PromotionsController::class, 'destroy'])->name('deletePromotion');
    // Projects
    Route::get('/getPosts', [App\Http\Controllers\OpportunitiesController::class, 'index'])->name('getPosts');
    Route::post('/storePost', [App\Http\Controllers\OpportunitiesController::class, 'store'])->name('storePost');
    Route::get('/EditPost/{id}', [App\Http\Controllers\OpportunitiesController::class, 'edit'])->name('editPost');
    Route::post('/UpdatePost/{id}', [App\Http\Controllers\OpportunitiesController::class, 'update'])->name('updatePost');
    Route::get('/DeletePost/{id}', [App\Http\Controllers\OpportunitiesController::class, 'destroy'])->name('deletePost');
    // Route::get('/DeleteallProjects', [App\Http\Controllers\OpportunitiesController::class, 'deleteAllProjects'])->name('deleteAllProjects');


    // Gallery
    Route::get('/slides', [App\Http\Controllers\SlidesController::class, 'index'])->name('slides');
    Route::post('/saveSlide', [App\Http\Controllers\SlidesController::class, 'store'])->name('saveSlide');
    Route::get('/editSlide/{id}', [App\Http\Controllers\SlidesController::class, 'edit'])->name('editSlide');
    Route::post('/updateSlide/{id}', [App\Http\Controllers\SlidesController::class, 'update'])->name('updateSlide');
    Route::get('/destroySlide/{id}', [App\Http\Controllers\SlidesController::class, 'destroy'])->name('destroySlide');

    // Images
    Route::get('/images', [App\Http\Controllers\ImagesController::class, 'index'])->name('images');
    Route::post('/saveImage', [App\Http\Controllers\ImagesController::class, 'store'])->name('saveImage');
    Route::get('/editImage/{id}', [App\Http\Controllers\ImagesController::class, 'edit'])->name('editImage');
    Route::post('/updateImage/{id}', [App\Http\Controllers\ImagesController::class, 'update'])->name('updateImage');
    Route::get('/destroyImage/{id}', [App\Http\Controllers\ImagesController::class, 'destroy'])->name('destroyImage');
    // Gallery
    Route::get('/getPartners', [App\Http\Controllers\PartnersController::class, 'index'])->name('getPartners');
    Route::post('/savePartner', [App\Http\Controllers\PartnersController::class, 'store'])->name('savePartner');
    Route::get('/editPartner/{id}', [App\Http\Controllers\PartnersController::class, 'edit'])->name('editPartner');
    Route::post('/updatePartner/{id}', [App\Http\Controllers\PartnersController::class, 'update'])->name('updatePartner');
    Route::get('/destroyPartner/{id}', [App\Http\Controllers\PartnersController::class, 'destroy'])->name('destroyPartner');

    // Gallery
    Route::get('/getImages', [App\Http\Controllers\SlidesController::class, 'getImages'])->name('getImages');
    Route::post('/saveGallery', [App\Http\Controllers\SlidesController::class, 'saveGallery'])->name('saveGallery');
    Route::get('/editGallery/{id}', [App\Http\Controllers\SlidesController::class, 'editGallery'])->name('editGallery');
    Route::post('/updateGallery/{id}', [App\Http\Controllers\SlidesController::class, 'updateGallery'])->name('updateGallery');
    Route::get('/destroyImage/{id}', [App\Http\Controllers\SlidesController::class, 'destroyImage'])->name('destroyImage');
    

});

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/about-us', [App\Http\Controllers\HomeController::class, 'about'])->name('about');
Route::get('/our-rooms', [App\Http\Controllers\HomeController::class, 'rooms'])->name('rooms');
Route::get('/our-rooms/{slug}', [App\Http\Controllers\HomeController::class, 'room'])->name('room');
Route::get('/our-restaurant', [App\Http\Controllers\HomeController::class, 'restaurant'])->name('restaurant');
Route::get('/our-updates', [App\Http\Controllers\HomeController::class, 'updates'])->name('updates');
Route::get('/our-updates/{slug}', [App\Http\Controllers\HomeController::class, 'update'])->name('update');
Route::get('/tours', [App\Http\Controllers\HomeController::class, 'tours'])->name('tours');
Route::get('/tour/{slug}', [App\Http\Controllers\HomeController::class, 'tour'])->name('tour');
Route::get('/gallery', [App\Http\Controllers\HomeController::class, 'gallery'])->name('gallery');
Route::get('/contact', [App\Http\Controllers\HomeController::class, 'contact'])->name('contact');
Route::get('/promotions', [App\Http\Controllers\HomeController::class, 'promotions'])->name('promotions');
Route::post('/book', [App\Http\Controllers\HomeController::class, 'bookNow'])->name('bookNow');
Route::get('/apartment', [App\Http\Controllers\HomeController::class, 'apartment'])->name('apartment');
Route::get('/guesthouse', [App\Http\Controllers\HomeController::class, 'guesthouse'])->name('guesthouse');
Route::get('/facilities', [App\Http\Controllers\HomeController::class, 'facilities'])->name('facilities');
Route::get('/facilities/{slug}', [App\Http\Controllers\HomeController::class, 'facility'])->name('facility');
Route::get('/activities', [App\Http\Controllers\HomeController::class, 'activities'])->name('activities');
Route::get('/activities/{slug}', [App\Http\Controllers\HomeController::class, 'activity'])->name('activity');
Route::get('/terms-and-conditions', [App\Http\Controllers\HomeController::class, 'terms'])->name('terms');

// Reviews Routes
Route::get('/reviews', [App\Http\Controllers\HomeController::class, 'reviews'])->name('reviews');
Route::get('/reviews/{id}', [App\Http\Controllers\HomeController::class, 'review'])->name('review');
Route::post('/reviews', [App\Http\Controllers\HomeController::class, 'storeReview'])->name('reviews.store');

Route::get('/admin/login', [App\Http\Controllers\HomeController::class, 'adminLogin'])->name('adminLogin');
Route::get('/user/account', [App\Http\Controllers\HomeController::class, 'newAccount'])->name('newAccount');
Route::post('/createAccount', [App\Http\Controllers\HomeController::class, 'createAccount'])->name('createAccount');

Route::get('/book-now', [App\Http\Controllers\HomeController::class, 'connect'])->name('connect');




// user sign up

Route::get('/getSignup', [App\Http\Controllers\HomeController::class, 'getSignup'])->name('getSignup');
Route::post('/Signup', [App\Http\Controllers\HomeController::class, 'signup'])->name('signup');
Route::get('/Signin', [App\Http\Controllers\HomeController::class, 'signin'])->name('signin');
Route::get('/admin/login', [App\Http\Controllers\HomeController::class, 'adminLogin'])->name('adminLogin');
Route::get('/logouts', [App\Http\Controllers\HomeController::class, 'logouts'])->name('logouts');
Route::post('/subscribe', [App\Http\Controllers\HomeController::class, 'subscribe'])->name('subscribe');

Route::post('/sendMessage', [App\Http\Controllers\HomeController::class, 'sendMessage'])->name('sendMessage');
Route::post('/sendComment', [App\Http\Controllers\HomeController::class, 'sendComment'])->name('sendComment');
Route::post('/registerNow', [App\Http\Controllers\HomeController::class, 'registerNow'])->name('registerNow');
Route::post('/testimony', [App\Http\Controllers\HomeController::class, 'testimony'])->name('testimony');

// Email Verification Routes (Public)
Route::get('/verify-email/{token}', [App\Http\Controllers\Auth\EmailVerificationController::class, 'verify'])->name('verify.email');
Route::post('/resend-verification', [App\Http\Controllers\Auth\EmailVerificationController::class, 'resend'])->name('resend.verification');

// Password Reset Routes (using Fortify, but adding custom routes if needed)
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

Route::get('/reset-password/{token}', function ($token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');
