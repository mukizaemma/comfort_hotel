<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Booking;
use App\Models\Post;
use App\Models\Room;
use App\Models\Trip;
use App\Models\User;
use App\Models\About;
use App\Models\Slide;
use App\Models\Review;
use App\Models\Message;
use App\Models\Program;
use App\Models\Setting;
use App\Models\Category;
use App\Models\Facility;
use App\Models\Service;
use App\Models\Eventpage;
use App\Models\Promotion;
use App\Models\Roomimage;
use App\Models\Tourimage;
use App\Models\Tripimage;
use App\Models\Restaurant;
use App\Models\Subscriber;
use App\Models\BlogComment;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Facilityimage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\Gallery;
use App\Models\PageHero;
use App\Models\TourActivity;


class HomeController extends Controller
{
    public function index(Request $request)
    {
        $setting = Setting::first();
        $slides = Slide::latest()->get();
        $about = About::first();
        $rooms = Room::with('amenities')->where('status', 'Active')->oldest()->take(6)->get();
        $gallery = Gallery::latest()->take(9)->get();
        $homeFacilities = Facility::where('status', 'Active')->oldest()->take(4)->get();
        $services = Service::where('status', 'Active')->with('images')->latest()->take(4)->get();
        $blogs = Blog::where('status', 'Published')->latest()->take(3)->get() ?? collect();
        $reviews = Review::approved()->latest()->take(3)->get();
        $reviewCount = Review::approved()->count();
        
        return view('frontend.home', [
            'setting' => $setting,
            'slides' => $slides,
            'about' => $about,
            'rooms' => $rooms,
            'gallery' => $gallery,
            'homeFacilities' => $homeFacilities,
            'services' => $services,
            'blogs' => $blogs,
            'reviews' => $reviews,
            'reviewCount' => $reviewCount,
        ]);
    }

    public function about(){
        $facilities = Facility::where('status', 'Active')->oldest()->get();
        $setting = Setting::first();
        $about = About::first();
        $rooms = Room::where('status', 'Active')->oldest()->get(); // For booking form
        $allRooms = Room::where('status', 'Active')->oldest()->get(); // For booking form
        $pageHero = PageHero::getBySlug('about');
        return view('frontend.about',[
            'facilities'=>$facilities,
            'setting'=>$setting,
            'about'=>$about,
            'rooms'=>$rooms,
            'allRooms'=>$allRooms,
            'pageHero'=>$pageHero,
        ]);
    }

    public function rooms(Request $request){
        $rooms = Room::with(['amenities', 'images'])->where('status', 'Active')->oldest()->get();
        $setting = Setting::first();
        $about = About::first();
        $facilities = Facility::where('status', 'Active')->oldest()->get();
        $pageHero = PageHero::getBySlug('rooms');
        
        return view('frontend.rooms', [
            'rooms' => $rooms,
            'setting' => $setting,
            'about' => $about,
            'facilities' => $facilities,
            'pageHero' => $pageHero,
        ]);
    }

    public function room($slug){
        $room = Room::with(['amenities', 'images'])->where('slug', $slug)->firstOrFail();
        $amenities = $room->amenities;
        $images = $room->images;
        $allRooms = Room::where('id', '!=', $room->id)->where('status', 'Active')->oldest()->take(3)->get();
        $setting = Setting::first();
        $about = About::first();
        
        return view('frontend.room', [
            'room' => $room,
            'images' => $images,
            'amenities' => $amenities,
            'allRooms' => $allRooms,
            'setting' => $setting,
            'about' => $about,
        ]);
    }

    public function facilities(){
        $facilities = Facility::with('images')->oldest()->get();
        $setting = Setting::first();
        $about = About::first();
        $pageHero = PageHero::getBySlug('facilities');
        return view('frontend.facilities',[
            'facilities'=>$facilities,
            'setting'=>$setting,
            'about'=>$about,
            'pageHero'=>$pageHero,
        ]);
    }

    public function facility($slug){
        $facility = Facility::with('images')->where('slug', $slug)->firstOrFail();

        $images = $facility->images;
        $allFacilities = Facility::where('id','!=',$facility->id)->oldest()->get();
        $facilities = Facility::oldest()->get();
        $setting = Setting::first();
        $about = About::first();
        $gallery = Gallery::oldest()->paginate(9);
        return view('frontend.facility',[
            'facility'=>$facility,
            'images'=>$images,
            'allFacilities'=>$allFacilities,
            'facilities'=>$facilities,
            'setting'=>$setting,
            'about'=>$about,
            'gallery'=>$gallery,
        ]);
    }


    public function apartment(){
        $room = Room::with('amenities')->where('category', 'Apartment')->first();
        $amenities = $room->amenities ?? collect();
        $images = $room->images ?? collect();
        $allRooms = Room::where('id', '!=', $room->id)->oldest()->get();
        $setting = Setting::first();
        $about = About::first();
        return view('frontend.apartment',[
            'room'=>$room,
            'room'=>$room,
            'allRooms'=>$allRooms,
            'images'=>$images,
            'amenities'=>$amenities,
            'setting'=>$setting,
            'about'=>$about,
        ]);
    }

    public function guesthouse(){
        $room = Room::with('amenities')->where('category', 'Kinigi')->first();
        $amenities = $room->amenities ?? collect();
        $images = $room->images ?? collect();
        $allRooms = Room::where('id', '!=', $room->id)->oldest()->get();
        $about = About::first();
        $setting = Setting::first();
        return view('frontend.guesthouse',[
            'room'=>$room,
            'amenities'=>$amenities,
            'allRooms'=>$allRooms,
            'images'=>$images,
            'about'=>$about,
            'setting'=>$setting,
        ]);
    }

    public function restaurant(){
        $restaurant = Restaurant::with('images')->first();
        $images = $restaurant->images;
        return view('frontend.restaurant',[
            'restaurant'=>$restaurant,
            'images'=>$images,
        ]);
    }

    public function promotions(){
        $promotions = Promotion::oldest()->get();
        $setting = Setting::first();
        $about = About::first();
        return view('frontend.promotions',[
            'promotions'=>$promotions,
            'about'=>$about,
            'setting'=>$setting,
        ]);
    }

    public function events(){
        $event = Eventpage::with('images')->first();
        $images = $event->images;
        return view('frontend.events',[
            'event'=>$event,
            'images'=>$images,
        ]);
    }

    public function activities(){
        $activities = TourActivity::with('images')->where('status', 'Active')->oldest()->get();
        $setting = Setting::first();
        $about = About::first();
        $pageHero = PageHero::getBySlug('activities');
        return view('frontend.activities', [
            'activities' => $activities,
            'setting' => $setting,
            'about' => $about,
            'pageHero' => $pageHero,
        ]);
    }

    public function activity($slug){
        $activity = TourActivity::with('images')->where('slug', $slug)->where('status', 'Active')->firstOrFail();
        $images = $activity->images()->orderBy('order')->get();
        $allActivities = TourActivity::where('status', 'Active')->where('id', '!=', $activity->id)->oldest()->take(3)->get();
        $setting = Setting::first();
        $about = About::first();
        return view('frontend.activity', [
            'activity' => $activity,
            'images' => $images,
            'allActivities' => $allActivities,
            'setting' => $setting,
            'about' => $about,
        ]);
    }

    public function gallery(){
        $galleryImages = Gallery::where('media_type', 'image')
            ->whereNotNull('image')
            ->where('image', '!=', '')
            ->latest()
            ->paginate(12);
        $allGalleryImagesForLightbox = Gallery::where('media_type', 'image')
            ->whereNotNull('image')
            ->where('image', '!=', '')
            ->latest()
            ->get();
        $galleryVideos = Gallery::whereNotNull('youtube_link')
            ->where('youtube_link', '!=', '')
            ->latest()
            ->get();
        $setting = Setting::first();
        $about = About::first();
        $pageHero = PageHero::getBySlug('gallery');
        return view('frontend.gallery', [
            'galleryImages' => $galleryImages,
            'allGalleryImagesForLightbox' => $allGalleryImagesForLightbox,
            'galleryVideos' => $galleryVideos,
            'setting' => $setting,
            'about' => $about,
            'pageHero' => $pageHero,
        ]);
    }

    public function contact(){
        $setting = Setting::first();
        $about = About::first();
        $hotelContact = \App\Models\HotelContact::first();
        $pageHero = PageHero::getBySlug('contact');
        return view('frontend.contact', [
            'setting' => $setting,
            'about' => $about,
            'hotelContact' => $hotelContact,
            'pageHero' => $pageHero,
        ]);
    }

    public function reviews(){
        $reviews = Review::approved()->latest()->paginate(10);
        $reviewCount = Review::approved()->count();
        $setting = Setting::first();
        $about = About::first();
        
        return view('frontend.reviews', [
            'reviews' => $reviews,
            'reviewCount' => $reviewCount,
            'setting' => $setting,
            'about' => $about,
        ]);
    }

    public function review($id){
        $review = Review::approved()->findOrFail($id);
        $reviews = Review::approved()->where('id', '!=', $id)->latest()->take(5)->get();
        $setting = Setting::first();
        $about = About::first();
        
        return view('frontend.review', [
            'review' => $review,
            'reviews' => $reviews,
            'setting' => $setting,
            'about' => $about,
        ]);
    }

    public function storeReview(Request $request){
        $request->validate([
            'names' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'testimony' => 'required|string|min:10',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $review = new Review();
        $review->names = $request->names;
        $review->email = $request->email;
        $review->testimony = $request->testimony;
        $review->rating = $request->rating;
        $review->website = $request->website;
        $review->status = 'pending';
        $review->save();

        return redirect()->back()->with('success', 'Thank you for your review! It will be published after admin approval.');
    }

    public function terms(){
        $rooms = Room::where('status', 'Active')->oldest()->get();
        $setting = Setting::first();
        $about = About::first();
        $terms = \App\Models\TermsCondition::where('status', 'active')->first();
        $pageHero = PageHero::getBySlug('terms');
        return view('frontend.terms',[
            'setting'=>$setting,
            'about'=>$about,
            'rooms'=>$rooms,
            'terms'=>$terms,
            'pageHero'=>$pageHero,
        ]);
    }

    public function bookNow(Request $request){
        $isFacility = $request->filled('facility_id');
        $isTourActivity = $request->filled('tour_activity_id');
        $rules = [
            'names' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'checkin' => 'required|date|after_or_equal:today',
            'checkout' => 'required|date|after:checkin',
            'adults' => 'required|integer|min:1',
            'children' => 'nullable|integer|min:0',
            'message' => 'nullable|string|max:1000',
        ];
        if ($isTourActivity) {
            $rules['tour_activity_id'] = 'required|exists:tour_activities,id';
        } elseif ($isFacility) {
            $rules['facility_id'] = 'required|exists:facilities,id';
        } else {
            $rules['room_id'] = 'required|exists:rooms,id';
        }
        $request->validate($rules);

        $booking = new Booking();
        $booking->names = $request->input('names');
        $booking->email = $request->input('email');
        $booking->phone = $request->input('phone');
        $booking->checkin_date = $request->input('checkin');
        $booking->checkout_date = $request->input('checkout');
        $booking->message = $request->input('message');
        $booking->adults = $request->input('adults');
        $booking->children = $request->input('children') ?? 0;
        $booking->status = 'pending';
        $booking->booking_type = 'online';
        $booking->paid_amount = 0;

        if ($isTourActivity) {
            $booking->tour_activity_id = $request->input('tour_activity_id');
            $booking->reservation_type = 'tour_activity';
            $booking->room_id = null;
            $booking->facility_id = null;
            $booking->total_amount = 0;
            $booking->balance_amount = 0;
        } elseif ($isFacility) {
            $booking->facility_id = $request->input('facility_id');
            $booking->reservation_type = 'facility';
            $booking->room_id = null;
            $booking->tour_activity_id = null;
            $booking->total_amount = 0;
            $booking->balance_amount = 0;
        } else {
            $booking->room_id = $request->input('room_id');
            $booking->reservation_type = 'room';
            $booking->facility_id = null;
            $booking->tour_activity_id = null;
            $room = Room::findOrFail($request->input('room_id'));
            $checkin = new \DateTime($request->input('checkin'));
            $checkout = new \DateTime($request->input('checkout'));
            $nights = $checkin->diff($checkout)->days;
            $booking->total_amount = ($room->price ?? 0) * $nights;
            $booking->balance_amount = $booking->total_amount;
        }

        if ($booking->save()) {
            return redirect()->back()->with('success', 'Your reservation has been submitted successfully. We will get back to you soon.');
        }
        return redirect()->back()->with('error', 'Something went wrong. Please try again later.');
    }

    public function tours(){
        $tours = Trip::oldest()->get();
        $setting = Setting::first();
        $about = About::first();
        return view('frontend.tours',[
            'tours'=>$tours,
            'setting'=>$setting,
            'about'=>$about,
        ]);
    }

    public function tour($slug){
        $tour = Trip::with('images')->where('slug',$slug)->firstOrFail();
        $images = $tour->images ?? collect();
        $tours = Trip::where('id','!=',$tour->id)->oldest()->get();
        $allTrips = Trip::all();
        $setting = Setting::first();
        $about = About::first();
        return view('frontend.tour',[
            'tour'=>$tour,
            'images'=>$images,
            'tours'=>$tours,
            'allTrips'=>$allTrips,
            'setting'=>$setting,
            'about'=>$about,
        ]);
    }

    public function connect(){
        $setting = Setting::first();
        $about = About::first();
        $pageHero = PageHero::getBySlug('book-now');
        return view('frontend.contact',[
            'setting'=>$setting,
            'about'=>$about,
            'pageHero'=>$pageHero,
        ]);
    }

    public function adminLogin(){
        $programs = Program::with('posts')->oldest()->get();
        $setting = Setting::first();
        $about = About::first();
        return view('frontend.adminLogin',[
            'programs'=>$programs,
            'setting'=>$setting,
            'about'=>$about,
        ]);
    }

    
    public function signinNow() {
        $setting = Setting::first();
        $about = About::first();
        return view('auth.login', [
            'setting' => $setting, 
            'about' => $about, 
        ]);
    }



    public function update($slug) {
        $blog = Blog::where('slug', $slug)->firstOrFail();
        $latestBlogs = Blog::where('status', 'Published')->where('id', '!=',$blog->id)->latest()->paginate(10);

        $setting = Setting::first();
        $programs = Program::oldest()->get();
        $about = About::first();
        if ($blog) {
            $blog->increment('views');
            $comments = BlogComment::where('status','Published')->latest()->get();
            $commentsCount = $comments->count();

            $relatedBlogs = Blog::where('id', '!=', $blog->id)
                                    ->where('status', 'Published')
                                    ->take(5) 
                                    ->get();
        } else {

            return redirect()->route('blogs')->with('error', 'Article not found');
        }
    

        return view('frontend.blog', [
            'blog' => $blog, 
            'latestBlogs' => $latestBlogs, 
            'comments' => $comments, 
            'commentsCount' => $commentsCount, 
            'setting' => $setting, 
            'programs'=>$programs,
            'relatedBlogs'=>$relatedBlogs,
            'about'=>$about,
        ]);
    }
    public function updates() {
        $blogs = Blog::where('status', 'Published')->latest()->get();
        $rooms = Room::oldest()->get();
        $latestBlogs = Blog::where('status', 'Published')->latest()->paginate(10);
        $setting = Setting::first();
        $about = About::first();
        $categories = Category::with('blogs')->oldest()->get();
        $pageHero = PageHero::getBySlug('updates');
        return view('frontend.blogs', [
            'blogs' => $blogs, 
            'rooms' => $rooms, 
            'latestBlogs' => $latestBlogs, 
            'setting' => $setting, 
            'categories'=>$categories,
            'about'=>$about,
            'pageHero'=>$pageHero,
        ]);
    }

  
    public function signin(){
        $cart = session('cart', []);
        return view('web.login',[
            'cart'=>$cart,
        ]);
    }

    public function logouts()
    {
        Auth::logout();
        return redirect()->route('home');
    }

    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:4|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return redirect()->back()->with('success','User Created');
    }



    public function subscribe(Request $request) {
        $request->validate([
            'email' => [
                'required',
                'email',
                Rule::unique('subscribers', 'email'),
            ],
        ]);

        $email = $request->input('email');

        $subscribed = Subscriber::create([
            'email' => $email,
        ]);


        if($subscribed){
            //$subscriber = Subscriber::where('email', $email)->firstOrFail();
            //Mail::to("mukizaemma34@gmail.com")->send(new NewSubscriberNotification($subscriber));
    
            return redirect()->back()->with('success', 'Thank you for subscribing to Centre Saint Paul -Kigali, we will get back to you');
        }

        else{
            return redirect()->back()->with('error', 'Something Went Wrong. Try again later!');
        }        
    
    }
   

    public function sendMessage(Request $request) {
        $validatedData = $request->validate([
            'names' => 'required|string',
            'email' => 'required|email',
            'subject' => 'required|string',
            'message' => 'required|string',
        ]);
    
        // Now create the message with the validated data
        $message = Message::create($validatedData);  // Pass validated data
    
        // Mail::to("mukizaemma34@gmail.com")->send(new MessageNotification($message));
    
        return redirect()->back()->with('success', 'Thank you for reaching out... we will get back to you soon');
    }
    
    

    public function testimony(Request $request){

        $review = Review::create([
            'names' => $request->input('names'),
            'email' => $request->input('email'),
            'testimony' => $request->input('testimony'),
        ]);
    
        if (!$review) {
            return redirect()->back()->with('error', 'Failed to submit your testimony. Please try again.');
        }
    
        return redirect()->back()->with('success', 'Your testimony has submitted successfully!');
    }

    public function sendComment(Request $request) {
        $user = auth()->user();
    
        $comment = BlogComment::create([
            'blog_id' => $request->input('blog_id'),
            'names' => $request->input('names'),
            'email' => $request->input('email'),
            'comment' => $request->input('comment'),
            'user_id' => $user ? $user->id : null,
        ]);
    
        if ($comment) {
            // Mail::to('mukizaemma34@gmail.com')->send(new BlogCommentsNotofications($comment));
            return redirect()->back()->with('success', 'Comment added successfully');
        }
    
        else{
            return redirect()->back()->with('error', 'Failed to add the comment. Please try again.');
        }
    }


}
