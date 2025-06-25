<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Http\Requests\Showroom\StoreShowroomRequest;
use App\Http\Requests\Showroom\UpdateShowroomRequest;
use App\Http\Resources\ShowroomResource;
use App\Models\Showroom;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ShowroomController extends Controller
{
    use AuthorizesRequests;
    /**
     * تهيئة المتحكم
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index', 'show']]);
        $this->authorizeResource(Showroom::class, 'showroom');
    }
    /**
     * عرض قائمة المعارض.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $showrooms = Showroom::all();
        return ShowroomResource::collection($showrooms);
    }
    /**
     * تخزين معرض جديد.
     *
     * @param  \App\Http\Requests\Showroom\StoreShowroomRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreShowroomRequest $request)
    {
        // تم التحقق من البيانات تلقائياً بواسطة Form Request
        $showroom = Showroom::create($request->validated());
        return response()->json([
            'status' => 'success',
            'message' => 'تم إنشاء المعرض بنجاح',
            'data' => new ShowroomResource($showroom)
        ], Response::HTTP_CREATED);
    }
    /**
     * عرض معرض محدد.
     *
     * @param  \App\Models\Showroom  $showroom
     * @return \App\Http\Resources\ShowroomResource
     */
    public function show(Showroom $showroom)
    {
        return new ShowroomResource($showroom->load(['carInventories', 'employees']));
    }
    /**
     * تحديث معرض محدد.
     *
     * @param  \App\Http\Requests\Showroom\UpdateShowroomRequest  $request
     * @param  \App\Models\Showroom  $showroom
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateShowroomRequest $request, Showroom $showroom)
    {
        // تم التحقق من البيانات تلقائياً بواسطة Form Request
        $showroom->update($request->validated());
        return response()->json([
            'status' => 'success',
            'message' => 'تم تحديث المعرض بنجاح',
            'data' => new ShowroomResource($showroom)
        ]);
    }
    /**
     * حذف معرض محدد.
     *
     * @param  \App\Models\Showroom  $showroom
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Showroom $showroom)
    {
        $showroom->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'تم حذف المعرض بنجاح'
        ]);
    }
}
