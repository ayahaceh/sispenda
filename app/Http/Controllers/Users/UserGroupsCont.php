<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ValidateUserGroup;
use App\Models\UserGroup\UserGroupModel;
// use App\Models\User;
// use DB;

class UserGroupsCont extends Controller
{
    public function index()
    {
        $tittle     = 'Daftar User Groups';
        $bread      = 'Home | Setting | User Groups';
        $menu_setting       = true;
        $menu_setting_user_group  = true;
        /**
         * private function at bottom the code
         */
        $usersGroup = $this->getUsersGroup();
        // $sesss = session::all();

        return view(
            'users/user_group_l',
            compact(
                'bread',
                'tittle',
                'menu_setting',
                'menu_setting_user_group',
                'usersGroup',

            )
        );
    }

    public function create()
    {
        $tittle     = 'Daftar User Groups';
        $bread      = 'Home | Setting | User Groups';
        $menu_setting               = true;
        $menu_setting_user_group    = true;

        return view(
            'users/user_group_a',
            compact(
                'bread',
                'tittle',
                'menu_setting',
                'menu_setting_user_group',

            )
        );
    }

    public function edit($id)
    {
        $tittle     = 'Daftar User Groups';
        $bread      = 'Home | Setting | User Groups';
        $menu_setting               = true;
        $menu_setting_user_group    = true;

        $usersGroup = UserGroupModel::find($id);

        return view(
            'users/user_group_e',
            compact(
                'bread',
                'tittle',
                'menu_setting',
                'menu_setting_user_group',
                'usersGroup',

            )
        );
    }

    public function store(ValidateUserGroup $request)
    {
        try {

            $UG                     = new UserGroupModel;
            $UG->nama_group         = $request->group_name;
            $UG->deskripsi_group    = $request->group_description;
            $UG->save();

            return redirect()->route('user-groups')->with('success', 'Group Users Telah ditambahkan!');
        } catch (\Throwable $th) {
            dd("error", $th);
        }
    }

    public function update(ValidateUserGroup $request, $id)
    {
        try {

            $UG                     = UserGroupModel::find($id);
            $UG->nama_group         = $request->group_name;
            $UG->deskripsi_group    = $request->group_description;
            $UG->save();

            return redirect()->route('user-groups')->with('success', 'Id Group ' . $id . ' telah di update!');
        } catch (\Throwable $th) {
            dd("error", $th);
        }
    }

    public function hapus($id)
    {
        $UG = UserGroupModel::find($id);
        $UG->delete();

        return redirect()->route('user-groups')->with('success', 'Group User telah dihapus!');
    }

    private function getUsersGroup()
    {
        $usersGroup = UserGroupModel::paginate(10);
        return $usersGroup;
    }

    // Untuk User BPKK
    public function getRefUserGroup()
    {
        $refUserGroup = UserGroupModel::select('id', 'nama_group')->orderBy('nama_group', 'ASC')->get();
        return $refUserGroup;
    }
    // Untuk User SKPD
    public function getRefUserGroupBpkk()
    {
        $refUserGroup = UserGroupModel::select('id', 'nama_group')->orderBy('nama_group', 'ASC')
            ->where('id', '<', USER_SUPER_ADMIN)
            ->orderBy('id', 'DESC')
            ->get();
        return $refUserGroup;
    }
    // Untuk User SKPD
    public function getRefUserGroupSkpd()
    {
        $refUserGroup = UserGroupModel::select('id', 'nama_group')->orderBy('nama_group', 'ASC')
            ->where('id', '>', USER_SUPER_ADMIN)
            ->orderBy('id', 'ASC')
            ->get();
        return $refUserGroup;
    }
    //--
}
