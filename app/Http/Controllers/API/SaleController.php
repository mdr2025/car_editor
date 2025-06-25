<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Http\Requests\Sale\StoreSaleRequest;
use App\Http\Requests\Sale\UpdateSaleRequest;
use App\Http\Resources\SaleResource;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SaleController extends Controller
{
    use AuthorizesRequests;
    /**
     * تهيئة المتحكم
     */
    public function __construct()
    {
        $this->authorizeResource(Sale::class, 'sale');
    }
    /**
     * عرض قائمة المبيعات.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $sales = Sale::all();
        return SaleResource::collection($sales);
    }
    /**
     * تخزين عملية بيع جديدة.
     *
     * @param  \App\Http\Requests\Sale\StoreSaleRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreSaleRequest $request)
    {
        // تم التحقق من البيانات تلقائياً بواسطة Form Request
        $sale = Sale::create($request->validated());
        return response()->json([
            'status' => 'success',
            'message' => 'تم إنشاء عملية البيع بنجاح',
            'data' => new SaleResource($sale)
        ], Response::HTTP_CREATED);
    }
    /**
     * عرض عملية بيع محددة.
     *
     * @param  \App\Models\Sale  $sale
     * @return \App\Http\Resources\SaleResource
     */
    public function show(Sale $sale)
    {
        return new SaleResource($sale->load(['customer', 'car', 'employee']));
    }
    /**
     * تحديث عملية بيع محددة.
     *
     * @param  \App\Http\Requests\Sale\UpdateSaleRequest  $request
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateSaleRequest $request, Sale $sale)
    {
        // تم التحقق من البيانات تلقائياً بواسطة Form Request
        $sale->update($request->validated());
        return response()->json([
            'status' => 'success',
            'message' => 'تم تحديث عملية البيع بنجاح',
            'data' => new SaleResource($sale)
        ]);
    }
    /**
     * حذف عملية بيع محددة.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Sale $sale)
    {
        $sale->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'تم حذف عملية البيع بنجاح'
        ]);
    }
}
