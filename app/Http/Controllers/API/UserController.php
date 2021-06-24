<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Traits\ImageTrait;
 use Intervention\Image\ImageManagerStatic as Image;
class UserController extends Controller
{

    use ImageTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $this->authorize('isAdmin');
        if (\Gate::allows('isAdmin') || \Gate::allows('isAuthor') )
        {
            return User::latest()->paginate(5);
        }

    }
    public function __construct()
    {
        $this->middleware('auth:api');
        // $this->authorize('isAdmin');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // return ['message' => 'I have your data'];
        $this->validate($request , [
                'name' => 'required | string | max:255',
                'email' =>'required| string | email | max:255 |unique:users',
                'password' => 'required | string| min:8',
                'image' => 'required',
                'bio' => 'required',
                'type' => 'required'

        ]);
        return User::create([
            'name'=>$request['name'],
            'email'=>$request['email'],
            'type'=>$request['type'],
            'bio'=>$request['bio'],
            // 'photo'=>$request['photo'],
            'password' =>Hash::make( $request['password'] ),

        ]);
        // return $request->all();
    }
    public function updateProfile(Request $request)
    {
        //
        // return Auth::user();
        $user=  auth('api')->user();
        // return $request->photo;
    //     $this->validate($request , [
    //         'name' => 'required | string | max:191',
    //         'email' =>'required| string | email | max:191 |unique:users,email,'.$user->id,
    //         'password' => 'sometimes | string| min:8',
    //         'bio' => 'required',
    //         'type' => 'required'

    // ]);
            $this->validate($request , [
                'name' => 'required | string | max:255',
                'email' =>'required| string | email | max:255 |unique:users,email,'.$user->id,
                'password' => 'sometimes | string| min:8',
                'bio' => 'required',
        'type' => 'required'

                                    ]);
       $currentPhoto= $user->photo;
        // if($request->photo != $currentPhoto)
        // {
        //     $name=time().'.'.explode('/',explode(':',substr($request->photo,0,strpos($request->photo,';')))[1])[1];
        //     Image::make($request->photo)->save(public_path('img/profile/').$name);
        //     // $request->$photo = $name;
        //      $request->merge(['photo'=>$name]);
        //      $userPhoto =public_path('img/profile/').$currentPhoto;
        //      if(file_exists($userPhoto)){
        //         @unlink($userPhoto);
        //      }
        // }
            try{
                if ($request->photo != $currentPhoto )
                {
                //    $feras= $request->merge(['photo'=>$name]);
                        $path = $this->storeImg($request->photo);
                         $request->merge(['photo'=>$path]);
                         $userPhoto =public_path('img/profile/').$currentPhoto;
                         if(file_exists($userPhoto)){
                                 @unlink($userPhoto);
                         }
                }
                    // $filePath= $this->UserImageUpload($user->photo,'profile/');
                    // $user->photo =$filePath;
                    // $user->save();


            }
            catch(Exception $e){

            }


        if (!empty($request->password))
        {
                $request->merge(['password'=> Hash::make($request['password'])]);

        }



    $user->update($request->all());
        return ['message'=> "Success"];
    }




    public function profile()
    {
        //
        // return Auth::user();
        return auth('api')->user();
    }




    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
                $user = User::findOrFail($id);
                $this->validate($request , [
                    'name' => 'required | string | max:255',
                    'email' =>'required| string | email | max:255 |unique:users,email,'.$user->id,
                    'password' => 'sometimes | string| min:8',
                    'bio' => 'required',
            'type' => 'required'

    ]);
        $user->update($request->all());

        return ['message' => 'User have been updated successfully'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    //    $this->authorize('isAdmin',$post);
         $this->authorize('isAdmin');
        $user = User::findOrFail($id);


        $user->delete();

        return ['message' => 'User Deleted Successfully' ];
    }
    public function search()
    {
        if ($search = \Request::get('q'))
        {
                $users=User::where(function($query) use ($search)
            {
                $query->where('name','LIKE',"%$search%")->orWhere('email','LIKE',"%$search%")
                ->orWhere('type','LIKE',"%$search%");
            })->paginate(20);

        }
        else{
            $users=  User::latest()->paginate(5);
        }
        return $users;
    }
}
