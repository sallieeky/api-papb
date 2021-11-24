<?php

namespace App\Http\Controllers;

use App\Models\CheckIn;
use App\Models\CheckOut;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $data = [
                "status" => "berhasil",
                "data" => Auth::user()
            ];
        } else {
            $data = [
                "status" => "gagal",
                "data" => null
            ];
        }
        return response()->json($data);
    }

    public function getUser(User $user)
    {
        return response()->json($user);
    }

    public function ubah(Request $request)
    {
        User::find($request->user_id)
            ->update([
                "alamat" => $request->alamat,
                "no_telp" => $request->no_telp,
            ]);
        $data = [
            "status" => "berhasil",
            "keterangan" => "Data user berhasil diubah"
        ];
        return response()->json($data);
    }

    public function checkin(Request $request)
    {
        // cek apakah user sudah pernah checkin hari ini
        $checkin = CheckIn::where("user_id", $request->user_id)
            ->where("tanggal", date("Y-m-d"))
            ->first();
        if ($checkin) {
            $data = [
                "status" => "gagal",
                "keterangan" => "User sudah melakukan checkin hari ini"
            ];
        } else {
            CheckIn::create([
                "user_id" => $request->user_id,
                "keterangan" => "On Time",
                "jam" => Carbon::now()->format("H:i:s"),
                "tanggal" => Carbon::now()->format("Y-m-d"),
            ]);
            $data = [
                "status" => "berhasil",
                "keterangan" => "User berhasil checkin"
            ];
        }
        return response()->json($data);
    }

    public function checkout(Request $request)
    {
        // cek apakah user sudah pernah checkout hari ini
        $checkout = CheckOut::where("user_id", $request->user_id)
            ->where("tanggal", date("Y-m-d"))
            ->first();
        if ($checkout) {
            $data = [
                "status" => "gagal",
                "keterangan" => "User sudah melakukan checkout hari ini"
            ];
        } else {
            CheckOut::create([
                "user_id" => $request->user_id,
                "keterangan" => "On Time",
                "jam" => Carbon::now()->format("H:i:s"),
                "tanggal" => Carbon::now()->format("Y-m-d"),
            ]);
            $data = [
                "status" => "berhasil",
                "keterangan" => "User berhasil checkout"
            ];
        }
        return response()->json($data);
    }

    public function getCekinCekout(User $user)
    {
        $cekin = CheckIn::where("user_id", $user->id)
            ->where("tanggal", Carbon::now()->format("Y-m-d"))
            ->pluck("jam")
            ->first();
        $cekout = CheckOut::where("user_id", $user->id)
            ->where("tanggal", Carbon::now()->format("Y-m-d"))
            ->pluck("jam")
            ->first();
        $data = [
            "cekin" => $cekin,
            "cekout" => $cekout
        ];
        return response()->json($data);
    }
}
