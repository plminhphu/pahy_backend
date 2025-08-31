<?php
namespace App\Http\Controllers\Aquafiltr;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function __construct()
    {
        // Áp dụng middleware permission cho từng action
        $this->middleware(function ($request, $next) {
            $action = $request->route()->getActionMethod();
            switch ($action) {
                case 'index':   $this->authorizePermission('customer','getall'); break;
                case 'show':    $this->authorizePermission('customer','getone'); break;
                case 'create':
                case 'store':   $this->authorizePermission('customer','created'); break;
                case 'edit':
                case 'update':  $this->authorizePermission('customer','updated'); break;
                case 'destroy': $this->authorizePermission('customer','deleted'); break;
            }
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        if ($request->page) {
            // join với bảng roles để lấy tên vai trò
            // kèm tìm kiếm theo keywords và phân trang
            $keywords = $request->keywords ?? '';
            $page = $request->page ?? 1;
            $customers = Customer::where(function($query) use ($keywords) {
                    if ($keywords) {
                        $query->where('customers.code', 'like', "%$keywords%")
                              ->orWhere('customers.name', 'like', "%$keywords%")
                              ->orWhere('customers.phone', 'like', "%$keywords%");
                    }
                })->orderBy('customers.created_at', 'desc')->paginate(10, ['*'], 'page', $page);
            return view('aquafiltr.admin.customer.list', compact('customers'))->render();
        } else {
            $title = 'Danh sách khách hàng';
            return view('aquafiltr.admin.customer.index', compact('title'));
        }
    }

    public function create()
    {
        return view('aquafiltr.admin.customer.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'phone' => 'required|string|max:20|unique:customers,phone',
            'address' => 'required|string|max:255',
            'region' => 'required|string|max:100',
        ]);

        // Tạo code tự động bằng tiền tố "CM" và id sáu số +1
        $validated['code'] = 'CM' . str_pad(Customer::max('id') + 1, 6, '0', STR_PAD_LEFT);
        
        Customer::create($validated);

        return response()->json(['message' => 'Khách hàng đã được tạo thành công'], 201);
    }

    public function show(Customer $customer)
    {
        $customer=Customer::where('customers.id', $customer->id)->first();
        return view('aquafiltr.admin.customer.show', compact('customer'));
    }

    public function edit(Customer $customer)
    {
        $customer=Customer::where('customers.id', $customer->id)->first();
        return view('aquafiltr.admin.customer.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'phone' => 'required|string|max:20|unique:customers,phone',
            'address' => 'required|string|max:255',
            'region' => 'required|string|max:100',
        ]);

        $customer->update($validated);

        return response()->json(['message' => 'Khách hàng đã được cập nhật thành công'], 202);
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        
        return response()->json(['message' => 'Khách hàng đã được xóa thành công'], 202);
    }
}
