<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $user = User::all();
        return view('admin.users', [
            'title' => "List Pengguna",
            'user' => $user,
        ]);
    }

    public function getUsersData(Request $request)
    {
        $draw            = $request->get('draw');
        $start           = $request->get("start");
        $rowPerPage      = $request->get("length"); // total number of rows per page
        $columnIndex_arr = $request->get('order');
        $columnName_arr  = $request->get('columns');
        $order_arr       = $request->get('order');
        $search_arr      = $request->get('search');

        $columnIndex     = $columnIndex_arr[0]['column']; // Column index
        $columnName      = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue     = $search_arr['value']; // Search value

        $users =  DB::table('users');
        $totalRecords = $users->count();

        $totalRecordsWithFilter = $users->where(function ($query) use ($searchValue) {
            $query->where('username', 'like', '%' . $searchValue . '%');
            $query->orWhere('email', 'like', '%' . $searchValue . '%');
            $query->orWhere('role', 'like', '%' . $searchValue . '%');
        })->count();

        if ($columnName == 'username') {
            $columnName = 'username';
        }
        $records = $users->orderBy($columnName, $columnSortOrder)
            ->where(function ($query) use ($searchValue) {
                $query->where('username', 'like', '%' . $searchValue . '%');
                $query->orWhere('email', 'like', '%' . $searchValue . '%');
                $query->orWhere('role', 'like', '%' . $searchValue . '%');
            })
            ->skip($start)
            ->take($rowPerPage)
            ->get();
        $data_arr = [];

        foreach ($records as $key => $record) {
            // $modify = '
            //     <td class="text-right">
            //         <div class="dropdown dropdown-action">
            //             <a href="" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            //                 <i class="fas fa-ellipsis-v ellipse_color"></i>
            //             </a>
            //             <div class="dropdown-menu dropdown-menu-right">
            //                 <a class="dropdown-item" href="'.url('users/add/edit/'.$record->id).'">
            //                     <i class="far fa-edit me-2"></i> Edit
            //                 </a>
            //                 <a class="dropdown-item" href="'.url('users/delete/'.$record->id).'">
            //                 <i class="fas fa-trash-alt m-r-5"></i> Delete
            //             </a>
            //             </div>
            //         </div>
            //     </td>
            // ';

            $modify = '
                <td class="text-end">
                    <div class="actions">
                        <a href="'.url('view/user/edit/'.$record->id).'" class="btn btn-sm bg-danger-light">
                            <i class="far fa-edit me-2"></i>
                        </a>
                        <a class="btn btn-sm bg-danger-light delete user_id" data-bs-toggle="modal" data-user_id="'.$record->id.'" data-bs-target="#delete">
                        <i class="fe fe-trash-2"></i>
                        </a>
                    </div>
                </td>
            ';

            $data_arr [] = [
                "id"                => $record->id,
                "username"          => $record->username,
                "email"             => $record->email,
                "role"              => $record->role,
                "modify"            => $modify,
            ];
        }

        $response = [
            "draw"                 => intval($draw),
            "iTotalRecords"        => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordsWithFilter,
            "aaData"               => $data_arr
        ];
        return response()->json($response);
    }
}
