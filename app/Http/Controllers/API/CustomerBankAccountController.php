<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerBankAccount\StoreCustomerBankAccountRequest;
use App\Http\Requests\CustomerBankAccount\UpdateCustomerBankAccountRequest;
use App\Http\Resources\CustomerBankAccountResource;
use App\Models\CustomerBankAccount;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CustomerBankAccountController extends Controller
{
    use AuthorizesRequests;
    /**
     * تهيئة المتحكم
     */
    public function __construct()
    {
        $this->authorizeResource(CustomerBankAccount::class, 'customer_bank_account');
    }
    /**
     * عرض قائمة الحسابات البنكية للعملاء.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $customerBankAccounts = CustomerBankAccount::all();
        return CustomerBankAccountResource::collection($customerBankAccounts);
    }
    /**
     * تخزين حساب بنكي جديد للعميل.
     *
     * @param  \App\Http\Requests\CustomerBankAccount\StoreCustomerBankAccountRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreCustomerBankAccountRequest $request)
    {
        // تم التحقق من البيانات تلقائياً بواسطة Form Request
        $customerBankAccount = CustomerBankAccount::create($request->validated());
        return response()->json([
            'status' => 'success',
            'message' => 'تم إنشاء الحساب البنكي للعميل بنجاح',
            'data' => new CustomerBankAccountResource($customerBankAccount)
        ], Response::HTTP_CREATED);
    }
    /**
     * عرض حساب بنكي محدد للعميل.
     *
     * @param  \App\Models\CustomerBankAccount  $customerBankAccount
     * @return \App\Http\Resources\CustomerBankAccountResource
     */
    public function show(CustomerBankAccount $customerBankAccount)
    {
        return new CustomerBankAccountResource($customerBankAccount);
    }
    /**
     * تحديث حساب بنكي محدد للعميل.
     *
     * @param  \App\Http\Requests\CustomerBankAccount\UpdateCustomerBankAccountRequest  $request
     * @param  \App\Models\CustomerBankAccount  $customerBankAccount
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateCustomerBankAccountRequest $request, CustomerBankAccount $customerBankAccount)
    {
        // تم التحقق من البيانات تلقائياً بواسطة Form Request
        $customerBankAccount->update($request->validated());
        return response()->json([
            'status' => 'success',
            'message' => 'تم تحديث الحساب البنكي للعميل بنجاح',
            'data' => new CustomerBankAccountResource($customerBankAccount)
        ]);
    }
    /**
     * حذف حساب بنكي محدد للعميل.
     *
     * @param  \App\Models\CustomerBankAccount  $customerBankAccount
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(CustomerBankAccount $customerBankAccount)
    {
        $customerBankAccount->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'تم حذف الحساب البنكي للعميل بنجاح'
        ]);
    }
}
