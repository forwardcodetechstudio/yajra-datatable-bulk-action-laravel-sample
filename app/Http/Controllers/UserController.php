<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\DataTables\UserDatatable;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UserDatatable $dataTable)
    {
        return $dataTable->render('layout.table', ['title' => 'All Users']);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // Deleting The user.
        $user->delete();
        return response()->json(['message' => 'User Deleted Successfully', 'title' => 'Success']);
    }

    /**
     * Remove the selected specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function deletesSelectedUsers(Request $request)
    {
        $user_ids = $request->ids;
        if ($user_ids) {
            User::whereIn('id', explode(",", $user_ids))->delete();
            return response()->json(['message' => 'Selected users were deleted Successfully', 'title' => 'Success']);
        }
        return response()->json(['message' => 'Something went wrong', 'title' => 'Error']);
    }

    /**
     * Change the status of the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function changeStatusSelected(Request $request)
    {
        $status = $request->status == 'active' ? '1' : '0';
        $user_ids = $request->ids;
        if ($user_ids) {
            User::whereIn('id', explode(",", $user_ids))->update(['status' => $status]);
            return response()->json(['message' => 'Selected users Status were updated Successfully', 'title' => 'Success']);
        }
        return response()->json(['message' => 'Something went wrong', 'title' => 'Error']);
    }
}
