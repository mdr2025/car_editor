<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Http\Requests\CarEngine\StoreCarEngineRequest;
use App\Http\Requests\CarEngine\UpdateCarEngineRequest;
use App\Http\Resources\CarEngineResource;
use App\Models\CarEngine;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CarEngineController extends Controller
{
    use AuthorizesRequests;
    /**
     * تهيئة المتحكم
     */
    public function __construct()
    {
        $this->authorizeResource(CarEngine::class, 'car_engine');
    }
    /**
     * عرض قائمة محركات السيارات.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $carEngines = CarEngine::all();
        return CarEngineResource::collection($carEngines);
    }
    /**
     * تخزين محرك سيارة جديد.
     *
     * @param  \App\Http\Requests\CarEngine\StoreCarEngineRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreCarEngineRequest $request)
    {
        // تم التحقق من البيانات تلقائياً بواسطة Form Request
        $carEngine = CarEngine::create($request->validated());
        return response()->json([
            'status' => 'success',
            'message' => 'تم إنشاء محرك السيارة بنجاح',
            'data' => new CarEngineResource($carEngine)
        ], Response::HTTP_CREATED);
    }
    /**
     * عرض محرك سيارة محدد.
     *
     * @param  \App\Models\CarEngine  $carEngine
     * @return \App\Http\Resources\CarEngineResource
     */
    public function show(CarEngine $carEngine)
    {
        return new CarEngineResource($carEngine);
    }
    /**
     * تحديث محرك سيارة محدد.
     *
     * @param  \App\Http\Requests\CarEngine\UpdateCarEngineRequest  $request
     * @param  \App\Models\CarEngine  $carEngine
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateCarEngineRequest $request, CarEngine $carEngine)
    {
        // تم التحقق من البيانات تلقائياً بواسطة Form Request
        $carEngine->update($request->validated());
        return response()->json([
            'status' => 'success',
            'message' => 'تم تحديث محرك السيارة بنجاح',
            'data' => new CarEngineResource($carEngine)
        ]);
    }
    /**
     * حذف محرك سيارة محدد.
     *
     * @param  \App\Models\CarEngine  $carEngine
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(CarEngine $carEngine)
    {
        $carEngine->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'تم حذف محرك السيارة بنجاح'
        ]);
    }
}
