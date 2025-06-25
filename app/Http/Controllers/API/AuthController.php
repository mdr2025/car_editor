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
use Tymon\JWTAuth\JWTGuard;

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
            'full_name' => $request->full_name,
            'user_name' => $request->user_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'role' => $request->role ?? 'customer',
        ]);

        $token = $this->initJwtAuthGuard()->login($user);
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
        $credentials = $request->only('user_name', 'password');

        if (!$token = $this->initJwtAuthGuard()->attempt($credentials)) {
            return response()->json([
                'status' => 'error',
                'message' => 'بيانات الاعتماد غير صالحة'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $user = $this->initJwtAuthGuard()->user();
        return $this->respondWithToken($token, $user);
    }

    /**
     * تسجيل الخروج (إبطال الرمز الحالي)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $this->initJwtAuthGuard()->logout();
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
        $user = $this->initJwtAuthGuard()->user();
        $token = $this->initJwtAuthGuard()->refresh();

        return $this->respondWithToken($token, $user);
    }

    /**
     * الحصول على المستخدم الحالي
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        $user = $this->initJwtAuthGuard()->user();

        return response()->json([
            'status' => 'success',
            'data' => new UserResource($user)
        ]);
    }

    protected function initJwtAuthGuard()  :JWTGuard
    {
        /**
         * @var JwtGuard $guard
         */
        $guard = Auth::guard('api');
        return $guard;
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
            'expires_in' => $this->initJwtAuthGuard()->factory()->getTTL() * 60,
            'user' => new UserResource($user)
        ]);
    }
}
