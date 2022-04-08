<?php



namespace App\Http\Controllers\Telegram;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DB;
use Telegram\Bot\Laravel\Facades\Telegram;
use Telegram\Bot\FileUpload\InputFile;
use Str;
use App\Models\UserModel;
// use App\Inbox;

class TelegramCont extends Controller
{
    public function getUpdates()
    {
        $activity = Telegram::getUpdates();
        dd($activity);
    }

    public function indexTelegram()
    {
        $bread = 'Home | Telegram Test';
        $tittle = 'E-Arsip | Telegram Test';
        return view(
            'telegram.index',
            [
                'bread' => $bread,
                'tittle' => $tittle
            ]
        );
    }

    public function storeMessage(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'message' => 'required'
        ]);

        $text = "A new contact us query\n"
            . "<b>Email Address: </b>\n"
            . "$request->email\n"
            . "<b>Message: </b>\n"
            . $request->message;

        Telegram::sendMessage([
            'chat_id' => env('TELEGRAM_CHANNEL_ID', ''),
            'parse_mode' => 'HTML',
            'text' => $text
        ]);

        return redirect()->back();
    }

    public function sendPhoto()
    {

        $bread = 'Home | Telegram Test';
        $tittle = 'E-Arsip | Telegram Test';
        return view(
            'telegram.photo',
            [
                'bread' => $bread,
                'tittle' => $tittle
            ]
        );
    }

    public function contactAdmin()
    {

        $bread = 'Home | Hubungi Admin';
        $tittle = 'E-Arsip | Contact Admin';
        return view(
            'telegram.contactAdmin',
            [
                'bread' => $bread,
                'tittle' => $tittle
            ]
        );
    }

    public function storePhoto(Request $request)
    {
        $request->validate([
            'file' => 'file|mimes:jpeg,png,gif'
        ]);

        $photo = $request->file('file');

        Telegram::sendPhoto([
            'chat_id' => env('TELEGRAM_CHANNEL_ID', ''),
            'photo' => InputFile::createFromContents(file_get_contents($photo->getRealPath()), Str::random(10) . '.' . $photo->getClientOriginalExtension())
        ]);

        return redirect()->back();
    }

    public function storeContactAdmin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'message' => 'required',
            'file' => 'file|mimes:jpeg,png,gif'
        ]);

        $text = "A new contact us query\n"
            . "<b>Email Address: </b>\n"
            . "$request->email\n"
            . "$request->nama\n"
            . "<b>Message: </b>\n"
            . $request->message;

        $user = UserModel::where('user_group', 1)->get();
        if ($user != '') {
            foreach ($user as $key => $value) {
                if ($value->tg) {
                    if ($request->hasFile('file')) {
                        $photo = $request->file('file');
                        Telegram::sendMessage([
                            // 'chat_id' => env('TELEGRAM_CHANNEL_ID', ''),
                            'chat_id' => $value->tg,
                            'parse_mode' => 'HTML',
                            'text' => $text
                        ]);
                        Telegram::sendPhoto([
                            // 'chat_id' => env('TELEGRAM_CHANNEL_ID', ''),
                            'chat_id' => $value->tg,
                            'photo' => InputFile::createFromContents(file_get_contents($photo->getRealPath()), Str::random(10) . '.' . $photo->getClientOriginalExtension())
                        ]);
                    } else {
                        Telegram::sendMessage([
                            // 'chat_id' => env('TELEGRAM_CHANNEL_ID', ''),
                            'chat_id' => $value->tg,
                            'parse_mode' => 'HTML',
                            'text' => $text
                        ]);
                    }
                    return redirect()->back()->with('success', 'Pesan berhasil dikirimkan.');
                }
            }
        } else {
            return redirect()->back()->with('error', 'Pesan gagal dikirim');
        }
    }
}
