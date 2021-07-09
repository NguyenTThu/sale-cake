<?php

namespace App\Http\Controllers;

use Validator;
use App\Exports\ProductsExport;
use Maatwebsite\Excel\Facades\Excel;
use Hash;
use App\Models\Slide;
use App\Models\Wishlist;
use App\Models\User;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\Cart;
use App\Http\Requests\AddProductRequest;
use App\Http\Requests\EditProductRequest;
use App\Jobs\SendEmail;
use App\Models\Customer;
use App\Models\BillDetail; 
use App\Models\Bill;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class sale_cake extends Controller
{
    public function getIndex()
    {
        $slide = Slide::all();
        //c1:
        // return view('page.home', ['slide'=> $slide]); tạo mảng lưu biến slide

        //print_r($slide) in ra 1 mang

        $new_product = Product::where('new', 1)->paginate(4);

        // dd($new_product); debug xuất ra mảng

        $sanpham_khuyenmai = Product::where('promotion_price', '<>', 0)->paginate(4);

        //c2
        return view('page.home', ['slide' => $slide, 'new_product' => $new_product, 'sanpham_khuyenmai' => $sanpham_khuyenmai]);
        //  compact('slide', 'new_product'));
    }
    public function getProduct($id)
    {
        $sp = Product::where('id', $id)->first();
        return view('page.product', compact('sp'));
    }
    public function shopping_cart()
    {
        return view('page.shopping_cart');
    }
    public function product_type($type)
    {
        $sp_theoloai = Product::where('id_type', $type)->paginate(3);



        $loai = ProductType::all();


        return view('page.product_type', compact('sp_theoloai', 'loai'));
    }

   

    public function login()
    {
        return view('page.login');
    }

    public function pricing()
    {
        return view('page.pricing');
    }
    public function contact()
    {
        return view('page.contact');
    }

    public function checkout()
    {
        return view('page.checkout');
    }

    public function about()
    {
        return view('page.about');
    }
//=================================WISHLIST==================================
public function getAddtoWishlist(Request $req, $id){
    
    $product = Wishlist::find($id);

}

/****Cart************************************ */
    public function getAddtoCart(Request $req, $id)
    {
        $product = Product::find($id);
        $oldCart = Session('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $id);
        $req->session()->put('cart', $cart);
        return redirect()->back();
    }

    public function getDelItemCart($id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }
        return redirect()->back();
    }

    /*****Đặt hàng******* */
    public function getCheckout(){
        return view('page.checkout');
    }
    public function postCheckout(Request $req){							
        $cart = Session::get('cart');							
      						
        $customer = new Customer();							
        $customer->name = $req->name;							
        $customer->gender = $req->gender;							
        $customer->email = $req->email;							
        $customer->address = $req->address;							
        $customer->phone_number = $req->phone;							
        $customer->note = $req->notes;							
        $customer->save();							
                            
        $bill = new Bill();							
        $bill->id_customer = $customer->id;							
        $bill->date_order = date('Y-m-d');							
        $bill->total = $cart->totalPrice;							
        $bill->payment = $req->payment_method;							
     						
        $bill->save();							
                            
        foreach($cart->items as $key=>$value){							
            $bill_detail = new BillDetail();							
            $bill_detail->id_bill = $bill->id;							
            $bill_detail->id_product = $key;//$value['item']['id'];							
            $bill_detail->quantity = $value['qty'];							
            $bill_detail->unit_price = $value['price']/$value['qty'];							
            $bill_detail->save();							
        }							
                                    
        Session::forget('cart');

        
        $message = [
         
            'user' =>  ' Cảm ơn bạn '.$req->name.' đã liên hệ shop.',
            'cart'=>$cart,
            'content' => 'Don dat hang cua ban thanh cong ',
        ];
        SendEmail::dispatch($message, $req->email)->delay(now()->addMinute(1));

        return redirect()->back()->with('thongbao','Đặt hàng thành công');							
    }							
                        

    /********Admin********/


    /***Read */

    public function getIndexAdmin()
    {
        $products = Product::all();
        return view('Admin.admin')->with(['products' => $products]);
    }

    public function getAdminAdd()
    {
        return view('Admin.formAdd');
    }

/**Add */
    public function postAddProduct(AddProductRequest $request)
    {
        $product = new Product();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = $file->getClientOriginalName('image');
            $file->move('image/product', $fileName);
        }

        $file_name = null;
        if ($request->file('image') != null) {
            $file_name = $request->file('image')->getClientOriginalName();
        }

        $product->name = $request->name;
        $product->id_type = $request->type;

        $product->description = $request->description;
        $product->unit_price = $request->unit_price;
        $product->promotion_price = $request->promotion_price;
        $product->image = $file_name;
        $product->unit = $request->unit;
        $product->new = $request->new;

        $product->save();
        return $this->getIndexAdmin();
    }
/**Edit***** */
    public function editProduct($id)
    {

        $product = Product::where('id', $id)->first();
        return view('Admin.formEdit', compact(('product')));
    }
    


    public function postEditProduct(EditProductRequest $request)
    {
        $id=$request->id;
        $product = Product::find($id);
        if ($request->hasFile('image')) {
            $file=$request->file('image');
            $fileName=$file->getClientOriginalName('image');
            $file->move('image/product', $fileName);
        }

        if ($request->file('image')!=null) {
            $product->image->$fileName;
        }

        $product->name = $request->name;
        $product->description = $request->description;
        $product->unit_price = $request->unit_price;
        $product->promotion_price = $request->promotion_price;
        $product->unit = $request->unit;
        $product->new = $request->new;
        $product->id_type = $request->type;
        $product->save();
        return $this->getIndexAdmin();
    }

    public function postDeleteProduct($id){
        $pro = Product::find($id);
       
        $pro->delete();
    
        return $this->getIndexAdmin();
    }
			
    /****Export */
    public function export()
    {
        return Excel::download(new ProductsExport, 'products.xlsx');
    }



    /*********************Đăng kí */
    public function signup()
    {
        return view('page.signup');
    }
    
    public function postSignup(Request $req){
        $user=new User();
     $req->validate([
        'email'=>'required|email|unique:users,email',
        'password'=>'required|alpha_num|min:6',
        'fullname'=>'required|string|max:20',
        'phone'=>'required|numeric|min:10',
        'address'=>'required|string',
        're_password'=>'required|same:password'
      ],
      [
        'email.required'=>'Vui long nhap email',
  
 
    'fullname.required'=>'Vui lòng nhập tên',
    'password.required'=>'vui lòng nhập password',
    're_password.required'=>'Vui lòng nhập  lại mật khẩu',
    'password.required'=>'Vui lòng nhập mật khẩu'
    ]
    
    );
          
           
    


$user->full_name=$req->fullname;
$user->phone=$req->phone;
$user->address=$req->address;
$user->email=$req->email;
$user->password=Hash::make($req->password);


$user->save();

return redirect()->back()->with('thanhcong', 'Tạo tài khoản thành công');



    }

    public function postLogin(Request $req){
        $req->validate([
            'email'=>'required|email',
            'password'=>'required|alpha_num|min:6'

        ],[
            'password.min'=>' password ít nhất 6 kí tự',
        ]
           
        );

        $credentials = array('email'=>$req->email, 'password'=>$req->password);
        if(Auth::attempt($credentials)){
            return redirect()->back()->with(['notify'=>'success', 'message'=>'Đăng nhập thành công']);

        }else{
            return redirect()->back()->with(['notify'=>'danger', 'message'=>'đăng nhập không thành công']);
        }
     

    }

    public function postLogout(){
        Auth::logout();
        $slide = Slide::all();
        //c1:
        // return view('page.home', ['slide'=> $slide]); tạo mảng lưu biến slide

        //print_r($slide) in ra 1 mang

        $new_product = Product::where('new', 1)->paginate(4);

        // dd($new_product); debug xuất ra mảng

        $sanpham_khuyenmai = Product::where('promotion_price', '<>', 0)->paginate(4);

        //c2
        return view('page.home', ['slide' => $slide, 'new_product' => $new_product, 'sanpham_khuyenmai' => $sanpham_khuyenmai]);
        
    }
   
}