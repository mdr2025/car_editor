<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Car\StoreCarRequest;
use App\Http\Requests\Car\UpdateCarRequest;
use App\Http\Resources\CarResource;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CarController extends Controller
{
    use AuthorizesRequests;
    /**
     * تهيئة المتحكم
     */
    public function __construct()
    {
        $this->authorizeResource(Car::class, 'car');
    }
    /**
     * عرض قائمة السيارات.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $cars = Car::all();
        return CarResource::collection($cars);
    }
    /**
     * تخزين سيارة جديدة.
     *
     * @param  \App\Http\Requests\Car\StoreCarRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreCarRequest $request)
    {
        // تم التحقق من البيانات تلقائياً بواسطة Form Request
        $car = Car::create($request->validated());
        return response()->json([
            'status' => 'success',
            'message' => 'تم إنشاء السيارة بنجاح',
            'data' => new CarResource($car)
        ], Response::HTTP_CREATED);
    }
    /**
     * عرض سيارة محددة.
     *
     * @param  \App\Models\Car  $car
     * @return \App\Http\Resources\CarResource
     */
    public function show(Car $car)
    {
        return new CarResource($car);
    }
    /**
     * تحديث سيارة محددة.
     *
     * @param  \App\Http\Requests\Car\UpdateCarRequest  $request
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateCarRequest $request, Car $car)
    {
        // تم التحقق من البيانات تلقائياً بواسطة Form Request
        $car->update($request->validated());
        return response()->json([
            'status' => 'success',
            'message' => 'تم تحديث السيارة بنجاح',
            'data' => new CarResource($car)
        ]);
    }
    /**
     * حذف سيارة محددة.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Car $car)
    {
        $car->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'تم حذف السيارة بنجاح'
        ]);
    }
}
