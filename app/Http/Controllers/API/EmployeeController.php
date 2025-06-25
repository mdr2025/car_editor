<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\StoreEmployeeRequest;
use App\Http\Requests\Employee\UpdateEmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class EmployeeController extends Controller
{
    use AuthorizesRequests;
    /**
     * تهيئة المتحكم
     */
    public function __construct()
    {
        $this->authorizeResource(Employee::class, 'employee');
    }
    /**
     * عرض قائمة الموظفين.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $employees = Employee::all();
        return EmployeeResource::collection($employees);
    }
    /**
     * تخزين موظف جديد.
     *
     * @param  \App\Http\Requests\Employee\StoreEmployeeRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreEmployeeRequest $request)
    {
        // تم التحقق من البيانات تلقائياً بواسطة Form Request
        $employee = Employee::create($request->validated());
        return response()->json([
            'status' => 'success',
            'message' => 'تم إنشاء الموظف بنجاح',
            'data' => new EmployeeResource($employee)
        ], Response::HTTP_CREATED);
    }
    /**
     * عرض موظف محدد.
     *
     * @param  \App\Models\Employee  $employee
     * @return \App\Http\Resources\EmployeeResource
     */
    public function show(Employee $employee)
    {
        return new EmployeeResource($employee);
    }
    /**
     * تحديث موظف محدد.
     *
     * @param  \App\Http\Requests\Employee\UpdateEmployeeRequest  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        // تم التحقق من البيانات تلقائياً بواسطة Form Request
        $employee->update($request->validated());
        return response()->json([
            'status' => 'success',
            'message' => 'تم تحديث الموظف بنجاح',
            'data' => new EmployeeResource($employee)
        ]);
    }
    /**
     * حذف موظف محدد.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'تم حذف الموظف بنجاح'
        ]);
    }
}
