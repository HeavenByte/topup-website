<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Data game dummy bertema populer untuk QuasarTopUp
        $games = [
            [
                'name' => 'Mobile Legends',
                'slug' => 'mobile-legends',
                'developer' => 'Moonton',
                'image' => 'https://downloadr2.apkmirror.com/wp-content/uploads/2024/01/45/65ba54423faa3_com.mobile.legends-384x384.png', // Gambar placeholder game
            ],
            [
                'name' => 'Free Fire',
                'slug' => 'free-fire',
                'developer' => 'Garena',
                'image' => 'https://cdn2.steamgriddb.com/icon_thumb/5a5431eae1ec51aca746e023ed05c97f.png',
            ],
            [
                'name' => 'PUBG Mobile',
                'slug' => 'pubg-mobile',
                'developer' => 'Tencent Games',
                'image' => 'https://cdn2.steamgriddb.com/icon/cf76184c6e3c74405cc7016920e53004/32/256x256.png',
            ],
            [
                'name' => 'Genshin Impact',
                'slug' => 'genshin-impact',
                'developer' => 'HoYoverse',
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSUdM7DmkUHg9hHzE9CcpeVn0mXC6tI4pJRtWsaVtu1rw&s=10',
            ],
        ];

        return view('welcome', compact('games'));
    }
}
