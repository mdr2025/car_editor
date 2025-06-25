<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Http\Requests\Visit\StoreVisitRequest;
use App\Http\Requests\Visit\UpdateVisitRequest;
use App\Http\Resources\VisitResource;
use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class VisitController extends Controller
{
    use AuthorizesRequests;
    /**
     * تهيئة المتحكم
     */
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(Visit::class, 'visit');
    }
    /**
     * عرض قائمة الزيارات.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $visits = Visit::with(['customer', 'showroom'])->get();
        return VisitResource::collection($visits);
    }
    /**
     * تخزين زيارة جديدة.
     *
     * @param  \App\Http\Requests\Visit\StoreVisitRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreVisitRequest $request)
    {
        // تم التحقق من البيانات تلقائياً بواسطة Form Request
        $visit = Visit::create($request->validated());
        return response()->json([
            'status' => 'success',
            'message' => 'تم تسجيل الزيارة بنجاح',
            'data' => new VisitResource($visit->load(['customer', 'showroom']))
        ], Response::HTTP_CREATED);
    }
    /**
     * عرض زيارة محددة.
     *
     * @param  \App\Models\Visit  $visit
     * @return \App\Http\Resources\VisitResource
     */
    public function show(Visit $visit)
    {
        return new VisitResource($visit->load(['customer', 'showroom']));
    }
    /**
     * تحديث زيارة محددة.
     *
     * @param  \App\Http\Requests\Visit\UpdateVisitRequest  $request
     * @param  \App\Models\Visit  $visit
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateVisitRequest $request, Visit $visit)
    {
        // تم التحقق من البيانات تلقائياً بواسطة Form Request
        $visit->update($request->validated());
        return response()->json([
            'status' => 'success',
            'message' => 'تم تحديث الزيارة بنجاح',
            'data' => new VisitResource($visit->load(['customer', 'showroom']))
        ]);
    }
    /**
     * حذف زيارة محددة.
     *
     * @param  \App\Models\Visit  $visit
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Visit $visit)
    {
        $visit->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'تم حذف الزيارة بنجاح'
        ]);
    }
}
