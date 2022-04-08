<?php

namespace App\Http\Controllers\Backup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Traits\LogsTrait;

class DatabaseCont extends Controller
{
      use LogsTrait;
      public function index()
      {
            $bread = 'Backup | Database';
            $tittle = 'Backup Database';
            $menu_home = true;

            $disk = Storage::disk(config('backup.backup.destination.disks')[0]);
            $files = $disk->files('/' . env("BACKUP_NAME") . '/');
            $backups = [];
            foreach ($files as $k => $f) {
                  if (substr($f, -4) == '.zip' && $disk->exists($f)) {
                        $backups[] = [
                              'file_path' => $f,
                              'file_name' => str_replace(config('laravel-backup.backup.name') . env("BACKUP_NAME") . '/', '', $f),
                              'file_size' => $disk->size($f),
                              'last_modified' => $disk->lastModified($f),
                        ];
                  }
            }

            // ini message terakhir backup
            // dd(end($backups)['last_modified']);

            $backups = array_reverse($backups);

            return view('backup.database_v', compact(
                  'backups',
                  'bread',
                  'tittle',
                  'menu_home'
            ));
      }

      public function create()
      {
            $tables = DB::select('SHOW TABLES');
            $bread = 'Backup | Database | Tambah';
            $tittle = 'Buat Cadangan Baru';
            $menu_home = true;

            return view('backup.database_a', compact(
                  'tables',
                  'bread',
                  'tittle',
                  'menu_home'
            ));
      }

      public function store(Request $request)
      {
            if ($request->ajax()) {
                  try {
                        if ($request->options == 'all') {
                              Artisan::call('backup:run');
                              $output = Artisan::output();

                              return response()->json(['message' => 'all_success', 'output' => $output], 200);
                        }
                        // Logs 
                        $keg = 'Melakukan Backup Database';
                        $this->simpanLogs(LOGS_LAINNYA, 99, $keg);
                        // .Logs
                  } catch (\Throwable $th) {
                        return response()->json($th, 500);
                  }
            }
      }

      public function delete($file_name)
      {
            try {
                  Storage::delete(config('backup.backup.name') . '/' . $file_name);

                  return response()->json(['message' => 'success'], 200);
            } catch (\Throwable $th) {
                  return response()->json($th, 500);
            }
      }

      public static function humanFileSize($size, $unit = "")
      {
            if ((!$unit && $size >= 1 << 30) || $unit == "GB") {
                  return number_format($size / (1 << 30), 2) . "GB";
            } else if ((!$unit && $size >= 1 << 20) || $unit == "MB") {
                  return number_format($size / (1 << 20), 2) . "MB";
            } else if ((!$unit && $size >= 1 << 10) || $unit == "KB") {
                  return number_format($size / (1 << 10), 2) . "KB";
            } else {
                  return number_format($size) . " bytes";
            }
      }
}
