<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CartRequest;
use App\Http\Requests\ContactRequest;
use App\Models\Cart;
use App\Models\Category;
use App\Models\City;
use App\Models\Contact;
use App\Models\District;
use App\Models\Product;
use App\Models\Setting;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    private Setting $setting;
    private Product $product;
    private Category $category;
    private Cart $cart;

    public function __construct()
    {
        $this->setting = new Setting();
        $this->product = new Product();
        $this->category = new Category();
        $this->cart = new Cart();
    }

    public function index()
    {
        $data['setting'] = $this->setting->getActiveSetting();
        $data['categories'] = $this->category->getActiveCategories()->orderBy('name')->get();
        $data['popular-categories'] = $this->category->getActiveCategories()->orderBy('rank')->limit(5)->get();
//        dd($data);
        return view('frontend.index', compact('data'));
    }

    public function dashboard()
    {
        $data['setting'] = $this->setting->getActiveSetting();
        $data['states'] = State::all();
        $data['districts'] = District::all();
        $data['cities'] = City::all();
        return view('frontend.dashboard', compact('data'));
    }

    public function categoryProducts(string $id)
    {
        $data['category'] = Category::getActiveCategories()->where('id', $id)->first();
        if ($data['category'] == null) {
            \request()->session()->flash('error', 'Category Not Found');
            return redirect(route('index'));
        }
        $data['records'] = Product::getActiveProducts()->where('category_id', $id)->get();
        $data['setting'] = Setting::where('status', 1)->first();
//        dd($data['records']);
        return view('frontend.category_product', compact('data'));
    }

    public function product(string $slug)
    {
        $data['product'] = Product::getActiveProducts()->where('slug', $slug)->first();
        if ($data['product'] == null) {
            \request()->session()->flash('error', 'Product Not Found');
            return redirect(route('index'));
        }
        $data['setting'] = $this->setting->getActiveSetting();
//        dd($data['records']);
        return view('frontend.product', compact('data'));
    }

    public function cart()
    {
//        $user = Auth::user();
        $data['carts'] = Auth::user()->carts;
//        dd($data['carts'][0]);
        $data['setting'] = $this->setting->getActiveSetting();
//        dd($data);
        return view('frontend.cart', compact('data'));
    }

    public function addToCart(CartRequest $request)
    {
        $cart = $this->cart->where('product_id', $request->product_id)->where('user_id', Auth::id())->first();
        if ($cart !== null) {
            $result = $cart->update($request->all());
            if ($result) {
                \request()->session()->flash('success', 'Product updated to cart successfully');
            } else {
                \request()->session()->flash('error', 'Cart update failed');
            }
        } else {
            $request->request->add(['user_id' => Auth::id()]);
            $result = $this->cart->create($request->all());
            if ($result) {
                \request()->session()->flash('success', 'Product added to cart successfully');
            } else {
                \request()->session()->flash('error', 'Add to cart Failed');
            }
        }
        return redirect()->back();
    }

    public function deleteCart(string $id)
    {
        $cart = $this->cart->find($id);
        if ($cart == null) {
            \request()->session()->flash('error', 'Cart Not Found');
        } else {
            if ($cart->delete()) {
                \request()->session()->flash('success', 'Cart Deleted Successfully');
            } else {
                request()->session()->flash('error', 'Cart Deletion Failed');
            }
        }
        return redirect()->back();
    }

    public function order(Request $request)
    {

    }

    public function contact()
    {
        $data['setting'] = $this->setting->getActiveSetting();
        return view('frontend.contact', compact('data'));
    }

    public function contactStore(ContactRequest $request)
    {
        if (Auth::check()) {
            $request->request->add(['user_id' => Auth::id()]);
        }
        $result = Contact::create($request->all());
        if ($result) {
            \request()->session()->flash('success', 'Message Sent Successfully');
        } else {
            \request()->session()->flash('error', 'Message Sent Failed');
        }
        return redirect()->back();
    }

    public function userUpdate(Request $request, $id)
    {

        $data['record'] = User::find($id);
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        if ($data['record']->update($request->all())) {
            $request->session()->flash('success', 'User Updated Successfully');
            return redirect()->back();
        } else {
            $request->session()->flash('error', 'User Update Failed');
            return redirect()->back();
        }
    }

    public function products()
    {
        $data['products'] = Product::getActiveProducts()->get();
        $data['setting'] = Setting::where('status', 1)->first();
        return view('frontend.products', compact('data'));
    }
}
