<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\StoreCustomerRequest;
use App\Http\Requests\Customer\UpdateCustomerRequest;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CustomerController extends Controller
{
    use AuthorizesRequests;
    /**
     * تهيئة المتحكم
     */
    public function __construct()
    {
        $this->authorizeResource(Customer::class, 'customer');
    }
    /**
     * عرض قائمة العملاء.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $customers = Customer::all();
        return CustomerResource::collection($customers);
    }
    /**
     * تخزين عميل جديد.
     *
     * @param  \App\Http\Requests\Customer\StoreCustomerRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreCustomerRequest $request)
    {
        // تم التحقق من البيانات تلقائياً بواسطة Form Request
        $customer = Customer::create($request->validated());
        return response()->json([
            'status' => 'success',
            'message' => 'تم إنشاء العميل بنجاح',
            'data' => new CustomerResource($customer)
        ], Response::HTTP_CREATED);
    }
    /**
     * عرض عميل محدد.
     *
     * @param  \App\Models\Customer  $customer
     * @return \App\Http\Resources\CustomerResource
     */
    public function show(Customer $customer)
    {
        return new CustomerResource($customer);
    }
    /**
     * تحديث عميل محدد.
     *
     * @param  \App\Http\Requests\Customer\UpdateCustomerRequest  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        // تم التحقق من البيانات تلقائياً بواسطة Form Request
        $customer->update($request->validated());
        return response()->json([
            'status' => 'success',
            'message' => 'تم تحديث العميل بنجاح',
            'data' => new CustomerResource($customer)
        ]);
    }
    /**
     * حذف عميل محدد.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'تم حذف العميل بنجاح'
        ]);
    }
}
