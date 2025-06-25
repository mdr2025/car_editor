<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Http\Requests\Login\StoreLoginRequest;
use App\Http\Requests\Login\UpdateLoginRequest;
use App\Http\Resources\LoginResource;
use App\Models\Login;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class LoginController extends Controller
{
    use AuthorizesRequests;
    /**
     * تهيئة المتحكم
     */
    public function __construct()
    {
        $this->authorizeResource(Login::class, 'login');
    }
    /**
     * عرض قائمة بيانات تسجيل الدخول.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $logins = Login::all();
        return LoginResource::collection($logins);
    }
    /**
     * تخزين بيانات تسجيل دخول جديدة.
     *
     * @param  \App\Http\Requests\Login\StoreLoginRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreLoginRequest $request)
    {
        // تم التحقق من البيانات تلقائياً بواسطة Form Request
        $login = Login::create([
            'user_id' => $request->user_id,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);
        
        return response()->json([
            'status' => 'success',
            'message' => 'تم إنشاء بيانات تسجيل الدخول بنجاح',
            'data' => new LoginResource($login)
        ], Response::HTTP_CREATED);
    }
    /**
     * عرض بيانات تسجيل دخول محددة.
     *
     * @param  \App\Models\Login  $login
     * @return \App\Http\Resources\LoginResource
     */
    public function show(Login $login)
    {
        return new LoginResource($login->load('user'));
    }
    /**
     * تحديث بيانات تسجيل دخول محددة.
     *
     * @param  \App\Http\Requests\Login\UpdateLoginRequest  $request
     * @param  \App\Models\Login  $login
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateLoginRequest $request, Login $login)
    {
        // تم التحقق من البيانات تلقائياً بواسطة Form Request
        $data = $request->except('password');
        
        if ($request->has('password')) {
            $data['password'] = Hash::make($request->password);
        }
        
        $login->update($data);
        
        return response()->json([
            'status' => 'success',
            'message' => 'تم تحديث بيانات تسجيل الدخول بنجاح',
            'data' => new LoginResource($login)
        ]);
    }
    /**
     * حذف بيانات تسجيل دخول محددة.
     *
     * @param  \App\Models\Login  $login
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Login $login)
    {
        $login->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'تم حذف بيانات تسجيل الدخول بنجاح'
        ]);
    }
}
