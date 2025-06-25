<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Http\Requests\CarInventory\StoreCarInventoryRequest;
use App\Http\Requests\CarInventory\UpdateCarInventoryRequest;
use App\Http\Resources\CarInventoryResource;
use App\Models\CarInventory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CarInventoryController extends Controller
{
    use AuthorizesRequests;
    /**
     * تهيئة المتحكم
     */
    public function __construct()
    {
        $this->authorizeResource(CarInventory::class, 'car_inventory');
    }
    /**
     * عرض قائمة مخزون السيارات.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $carInventories = CarInventory::all();
        return CarInventoryResource::collection($carInventories);
    }
    /**
     * تخزين مخزون سيارة جديد.
     *
     * @param  \App\Http\Requests\CarInventory\StoreCarInventoryRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreCarInventoryRequest $request)
    {
        // تم التحقق من البيانات تلقائياً بواسطة Form Request
        $carInventory = CarInventory::create($request->validated());
        return response()->json([
            'status' => 'success',
            'message' => 'تم إنشاء مخزون السيارة بنجاح',
            'data' => new CarInventoryResource($carInventory)
        ], Response::HTTP_CREATED);
    }
    /**
     * عرض مخزون سيارة محدد.
     *
     * @param  \App\Models\CarInventory  $carInventory
     * @return \App\Http\Resources\CarInventoryResource
     */
    public function show(CarInventory $carInventory)
    {
        return new CarInventoryResource($carInventory);
    }
    /**
     * تحديث مخزون سيارة محدد.
     *
     * @param  \App\Http\Requests\CarInventory\UpdateCarInventoryRequest  $request
     * @param  \App\Models\CarInventory  $carInventory
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateCarInventoryRequest $request, CarInventory $carInventory)
    {
        // تم التحقق من البيانات تلقائياً بواسطة Form Request
        $carInventory->update($request->validated());
        return response()->json([
            'status' => 'success',
            'message' => 'تم تحديث مخزون السيارة بنجاح',
            'data' => new CarInventoryResource($carInventory)
        ]);
    }
    /**
     * حذف مخزون سيارة محدد.
     *
     * @param  \App\Models\CarInventory  $carInventory
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(CarInventory $carInventory)
    {
        $carInventory->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'تم حذف مخزون السيارة بنجاح'
        ]);
    }
}
