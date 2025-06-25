<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * إنشاء مستخدم جديد وإصدار رمز JWT
     *
     * @param  \App\Http\Requests\Auth\RegisterRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        // تم التحقق من البيانات تلقائياً بواسطة Form Request
        $user = User::create([
            'full_name' => $request->fullname,
            'user_name' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'role' => $request->role ?? 'customer',
        ]);

        $token = Auth::guard('api')->login($user);
        return $this->respondWithToken($token, $user);
    }

    /**
     * تسجيل الدخول وإصدار رمز JWT
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        // تم التحقق من البيانات تلقائياً بواسطة Form Request
        $credentials = $request->only('username', 'password');

        if (!$token = Auth::guard('api')->attempt($credentials)) {
            return response()->json([
                'status' => 'error',
                'message' => 'بيانات الاعتماد غير صالحة'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $user = Auth::guard('api')->user();
        return $this->respondWithToken($token, $user);
    }

    /**
     * تسجيل الخروج (إبطال الرمز الحالي)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        Auth::guard('api')->logout();
        return response()->json([
            'status' => 'success',
            'message' => 'تم تسجيل الخروج بنجاح'
        ]);
    }

    /**
     * تحديث رمز JWT
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        $user = Auth::guard('api')->user();
        $token = Auth::guard('api')->refresh();

        return $this->respondWithToken($token, $user);
    }

    /**
     * الحصول على المستخدم الحالي
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        $user = Auth::guard('api')->user();

        return response()->json([
            'status' => 'success',
            'data' => new UserResource($user)
        ]);
    }

    /**
     * الرد برمز JWT مع معلومات المستخدم
     *
     * @param  string $token
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token, $user)
    {
        return response()->json([
            'status' => 'success',
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::guard('api')->factory()->getTTL() * 60,
            'user' => new UserResource($user)
        ]);
    }
}
