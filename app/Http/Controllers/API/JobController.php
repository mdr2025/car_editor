<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Http\Requests\Job\StoreJobRequest;
use App\Http\Requests\Job\UpdateJobRequest;
use App\Http\Resources\JobResource;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class JobController extends Controller
{
    use AuthorizesRequests;
    /**
     * تهيئة المتحكم
     */
    public function __construct()
    {
        $this->authorizeResource(Job::class, 'job');
    }
    /**
     * عرض قائمة الوظائف.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $jobs = Job::all();
        return JobResource::collection($jobs);
    }
    /**
     * تخزين وظيفة جديدة.
     *
     * @param  \App\Http\Requests\Job\StoreJobRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreJobRequest $request)
    {
        // تم التحقق من البيانات تلقائياً بواسطة Form Request
        $job = Job::create($request->validated());
        return response()->json([
            'status' => 'success',
            'message' => 'تم إنشاء الوظيفة بنجاح',
            'data' => new JobResource($job)
        ], Response::HTTP_CREATED);
    }
    /**
     * عرض وظيفة محددة.
     *
     * @param  \App\Models\Job  $job
     * @return \App\Http\Resources\JobResource
     */
    public function show(Job $job)
    {
        return new JobResource($job);
    }
    /**
     * تحديث وظيفة محددة.
     *
     * @param  \App\Http\Requests\Job\UpdateJobRequest  $request
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateJobRequest $request, Job $job)
    {
        // تم التحقق من البيانات تلقائياً بواسطة Form Request
        $job->update($request->validated());
        return response()->json([
            'status' => 'success',
            'message' => 'تم تحديث الوظيفة بنجاح',
            'data' => new JobResource($job)
        ]);
    }
    /**
     * حذف وظيفة محددة.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Job $job)
    {
        $job->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'تم حذف الوظيفة بنجاح'
        ]);
    }
}
