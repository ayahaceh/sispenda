<?php

namespace App\Http\Controllers\Pengumuman;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengumuman\PengumumanModel;
use Validator;
use File;

class PengumumanCont extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('cari')) {
            $keyword    = $request->cari;
            $pengumuman = PengumumanModel::where(function ($q) use ($keyword) {
                $q->where('judul', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('tgl', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('berkas', 'LIKE', '%' . $keyword . '%');
            })
                ->paginate(20);
        } else {
            $pengumuman = PengumumanModel::orderBy('id', 'DESC')->paginate(20);
        }
        // Ambil data lainya
        $route      = 'pengumuman';
        $bread      = 'Home | Pengumuman';
        $tittle     = 'Pengumuman';
        $menu_pengumuman   = true;

        return view('pengumuman.pengumuman_l', compact(
            'pengumuman',
            'route',
            'bread',
            'tittle',
            'menu_pengumuman'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Ambil data lainya
        $bread = 'Home | Pengumuman | Tambah';
        $tittle = 'Tambah Pengumuman';
        $menu_pengumuman = true;

        return view('pengumuman.pengumuman_a', compact(
            'bread',
            'tittle',
            'menu_pengumuman'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tgl'       => 'required',
            'judul'    => 'required|max:255',
            'isi'    => 'required',
            'berkas'    => 'nullable|mimes:pdf,jpg,jpeg,png|max:25500',
        ], [
            'tgl.required'          => 'Tanggal belum diisi',
            'judul.required'        => 'Judul belum diisi',
            'judul.max'            => 'Judul maksimal 255 karakter',
            'isi.required'        => 'Isi Pengumuman belum diisi',
            'berkas.mimes'          => 'Hanya dapat menerima file PDF, JPG, JPEG, dan PNG.',
            'berkas.max'            => 'Maksimal File 25 MB.',
        ]);

        if ($validator->passes()) {
            try {
                $pengumuman                = new PengumumanModel;
                $pengumuman->tgl           = $request->tgl;
                $pengumuman->judul         = $request->judul;
                $pengumuman->isi           = $request->isi;
                $pengumuman->created_by    = session()->get('datauser')->id; // Ambil Id User dari Session
                $pengumuman->created_at    = now();

                if ($request->hasFile('berkas')) {
                    $berkas = $request->file('berkas'); // Pindahin ke temporary folder
                    $tgl            = date('ymd_His');
                    $ekstensi       = $request->file('berkas')->getClientOriginalExtension();
                    $nama_berkas    = $tgl . '_pengumuman.' . $ekstensi;

                    $berkas->move('upload/pengumuman/', $nama_berkas); // Pindahin kedalam folder upload
                    $pengumuman->berkas    = $nama_berkas;
                } else {
                    $nama_berkas        = 'default.jpg';
                    $pengumuman->berkas    = $nama_berkas;
                }

                $pengumuman->save();

                return response()->json(['success' => 'Pengumuman berhasil ditambahkan']);
                // return redirect()->route('pengumuman')->with('success', 'Pengumuman telah ditambahkan!');
            } catch (\Throwable $th) {
                return response()->json(['error' => $th]);
            }
        }
        return response()->json(['error' => $validator->errors()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
        $pengumuman    = PengumumanModel::find($id);
        if (empty($pengumuman)) {
            return redirect()->route('notfound')->with('gagal', 'Data tidak ditemukan!');
        }
        // Ambil data lainya
        $bread = 'Home | Pengumuman';
        $tittle = 'Lihat Pengumuman';
        $menu_pengumuman = true;

        return view('pengumuman.pengumuman_v', compact(
            'pengumuman',
            'bread',
            'tittle',
            'menu_pengumuman'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pengumuman    = PengumumanModel::find($id);
        if (empty($pengumuman)) {
            return redirect()->route('notfound')->with('error', 'Data tidak ditemukan!');
        }
        // Ambil data lainya
        $bread = 'Home | Pengumuman | Edit';
        $tittle = 'Edit Pengumuman';
        $menu_pengumuman = true;

        return view('pengumuman.pengumuman_e', compact(
            'pengumuman',
            'bread',
            'tittle',
            'menu_pengumuman'
        ));
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
        $validator = Validator::make($request->all(), [
            'tgl'       => 'required',
            'judul'    => 'required|max:255',
            'isi'    => 'required',
            'berkas'    => 'nullable|mimes:pdf,jpg,jpeg,png|max:25500',
        ], [
            'tgl.required'          => 'Tanggal belum diisi',
            'judul.required'        => 'Judul belum diisi',
            'judul.max'            => 'Judul maksimal 255 karakter',
            'isi.required'        => 'Isi Pengumuman belum diisi',
            'berkas.mimes'          => 'Hanya dapat menerima file PDF, JPG, JPEG, dan PNG.',
            'berkas.max'            => 'Maksimal File 25 MB.',
        ]);

        if ($validator->passes()) {
            try {
                $pengumuman                = PengumumanModel::find($id);
                $pengumuman->tgl           = $request->tgl;
                $pengumuman->judul         = $request->judul;
                $pengumuman->isi           = $request->isi;
                $pengumuman->updated_by    = session()->get('datauser')->id; // Ambil Id User dari Session
                $pengumuman->updated_at    = now();

                if ($request->hasFile('berkas')) {
                    if ($pengumuman->berkas != 'default.jpg') {
                        // remove last berkas pengumuman
                        $filename = public_path() . '/upload/pengumuman/' . $pengumuman->berkas;
                        File::delete($filename);
                    }
                    $berkas = $request->file('berkas'); // Pindahin ke temporary folder
                    $tgl            = date('ymd_His');
                    $ekstensi       = $request->file('berkas')->getClientOriginalExtension();
                    $nama_berkas    = $tgl . '_pengumuman.' . $ekstensi;

                    $berkas->move('upload/pengumuman/', $nama_berkas); // Pindahin kedalam folder upload
                    $pengumuman->berkas    = $nama_berkas;
                }

                $pengumuman->save();
                $output = array(
                    'success' => 'Pengumuman berhasil diupdate',
                    'dataJudul' => '<input type="text" name="judul" class="form-control" id="judul" value="' . $pengumuman->judul . '"  autofocus>',
                    'dataTgl' => '<input type="date" name="tgl" class="form-control" id="tgl"
                    value="' . $pengumuman->tgl . '">',
                    'dataIsi' => $pengumuman->isi
                );
                return response()->json($output);
                // return redirect()->route('pengumuman')->with('success', 'Pengumuman telah ditambahkan!');
            } catch (\Throwable $th) {
                return response()->json(['error' => $th]);
            }
        }
        $output = array(
            'error' => $validator->errors(),
            'dataJudul' => '<input type="text" name="judul" class="form-control" id="judul" value="' . $request->judul . '"  autofocus>',
            'dataTgl' => '<input type="date" name="tgl" class="form-control" id="tgl"
            value="' . $request->tgl . '">',
            'dataIsi' => $request->isi
        );
        // return response()->json(['error' => $validator->errors()]);
        return response()->json($output);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pengumuman = PengumumanModel::find($id);
        if ($pengumuman->berkas != 'default.jpg') {
            // remove last berkas pengumuman
            $filename = public_path() . '/upload/pengumuman/' . $pengumuman->berkas;
            File::delete($filename);
        }
        $pengumuman->delete();

        return redirect()->route('pengumuman')->with('warning', 'Pengumuman telah dihapus!');
    }
}
