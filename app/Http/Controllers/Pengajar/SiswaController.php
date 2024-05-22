<?php

namespace App\Http\Controllers\Pengajar;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    public function index()
    {
        $studentList = Siswa::all();
        return view('pengajar.siswa', [
            'title' => 'List Siswa',
            'studentList'=> $studentList,
        ]);
    }

    public function create()
    {
        $jurusan = Jurusan::all();
        $kelas = Kelas::all();
        return view('pengajar.siswa-add', [
            'title'=> 'Tambah Siswa',
            'jurusans'=> $jurusan,
            'kelass'=> $kelas
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'nisn'              => 'required|unique:siswas',
            'nama_siswa'        => 'required|string',
            'jenis_kelamin'     => 'required|not_in:0',
            'tanggal_lahir'     => 'required|string',
            'tempat_lahir'      => 'required|string',
            'agama'             => 'required|string',
            'email'             => 'required|email',
            'kelas_id'             => 'required|exists:kelas,id',
            'jurusan_id'           => 'required|exists:jurusans,id',
            'alamat'            => 'required|string',
            'upload'            => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        DB::beginTransaction();
        try {
            $upload_file = rand() . '.' . $request->upload->extension();
            $request->upload->move(storage_path('app/public/foto-siswa/'), $upload_file);
            if (!empty($upload_file)) {
                $date = DateTime::createFromFormat('d-m-Y', $request->tanggal_lahir);
                $formattedDate = $date->format('Y-m-d');
                $user = User::create([
                    'username'=> $request->nama_siswa,
                    'email'=> $request->email,
                    'password'=> Hash::make('siswa123'),
                    'role'=> 'siswa',
                ]);
                Siswa::create([
                    'nisn'              => $request->nisn,
                    'user_id'           => $user->id,
                    'kelas_id'          => $request->kelas_id,
                    'jurusan_id'        => $request->jurusan_id,
                    'nama_siswa'        => $request->nama_siswa,
                    'alamat'            => $request->alamat,
                    'jenis_kelamin'     => $request->jenis_kelamin,
                    'tempat_lahir'      => $request->tempat_lahir,
                    'agama'             => $request->agama,
                    'tanggal_lahir'     => $formattedDate,
                    'foto'              => $upload_file,
                ]);
                Toastr::success('Has been add successfully :)','Success');
                DB::commit();
                return redirect()->route('pengajar/siswa/list');
            } else {
                Toastr::error('Tidak ada foto  :)','Error');
                return redirect()->back();
            }

        } catch (\Exception $e) {
            DB::rollBack();
            Toastr::error('fail, Add new student  :)','Error');
            return redirect()->back();
        }
    }
    public function show($nisn)
    {
        $siswa = Siswa::find($nisn);
        $user = User::find($siswa->user_id);
        return view('pengajar.siswa-show', [
            'title'     => 'Lihat Siswa',
            'siswa'     => $siswa,
            'user'      => $user,
        ]);
    }
    public function edit($nisn){
        $student = Siswa::find($nisn);
        $jurusan = Jurusan::all();
        $kelas = Kelas::all();
        return view('pengajar.siswa-edit', [
            'title'=> 'Edit Siswa',
            'student'=> $student,
            'jurusans'=> $jurusan,
            'kelass'=> $kelas
        ]);
    }
    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            if (!empty($request->upload)) {
                unlink(storage_path('app/public/foto-siswa/'.$request->image_hidden));
                $upload_file = rand() . '.' . $request->upload->extension();
                $request->upload->move(storage_path('app/public/foto-siswa/'), $upload_file);
            } else {
                $upload_file = $request->image_hidden;
            }
            $date = DateTime::createFromFormat('d-m-Y', $request->tanggal_lahir);
            $formattedDate = $date->format('Y-m-d');
            $updateRecord = [
                'nisn'              => $request->nisn,
                'kelas_id'          => $request->kelas_id,
                'jurusan_id'        => $request->jurusan_id,
                'nama_siswa'        => $request->nama_siswa,
                'alamat'            => $request->alamat,
                'jenis_kelamin'     => $request->jenis_kelamin,
                'tempat_lahir'      => $request->tempat_lahir,
                'agama'             => $request->agama,
                'tanggal_lahir'     => $formattedDate,
                'foto'              => $upload_file,
            ];
            Siswa::where('nisn',$request->nisn)->update($updateRecord);

            Toastr::success('Has been update successfully :)','Success');
            DB::commit();
            return redirect()->route('pengajar/siswa/list');
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('fail, update student  :)','Error');
            return redirect()->back();
        }
    }
    public function destroy($nisn)
    {
        try {
            $student = Siswa::findOrFail($nisn);
            $student->delete();

            Toastr::success('Student deleted successfully.', 'Success');
        } catch (\Exception $e) {
            Toastr::error('Failed to delete student.', 'Error');
        }

        return redirect()->back();
    }
}
