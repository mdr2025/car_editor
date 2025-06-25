<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserController extends Controller
{
    use AuthorizesRequests;
    /**
     * تهيئة المتحكم
     */
    public function __construct()
    {
    }
    /**
     * عرض قائمة المستخدمين.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $users = User::all();
        return UserResource::collection($users);
    }
    /**
     * تخزين مستخدم جديد.
     *
     * @param  \App\Http\Requests\User\StoreUserRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreUserRequest $request)
    {
        // تم التحقق من البيانات تلقائياً بواسطة Form Request
        $user = User::create([
            'full_name' => $request->fullname,
            'user_name' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'role' => $request->role,
            'profile_image_url' => $request->profile_image_url,
        ]);
        
        return response()->json([
            'status' => 'success',
            'message' => 'تم إنشاء المستخدم بنجاح',
            'data' => new UserResource($user)
        ], Response::HTTP_CREATED);
    }
    /**
     * عرض مستخدم محدد.
     *
     * @param  \App\Models\User  $user
     * @return \App\Http\Resources\UserResource
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }
    /**
     * تحديث مستخدم محدد.
     *
     * @param  \App\Http\Requests\User\UpdateUserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        // تم التحقق من البيانات تلقائياً بواسطة Form Request
        $data = $request->except('password');
        
        if ($request->has('password')) {
            $data['password'] = Hash::make($request->password);
        }
        
        $user->update($data);
        
        return response()->json([
            'status' => 'success',
            'message' => 'تم تحديث المستخدم بنجاح',
            'data' => new UserResource($user)
        ]);
    }
    /**
     * حذف مستخدم محدد.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'تم حذف المستخدم بنجاح'
        ]);
    }
}


