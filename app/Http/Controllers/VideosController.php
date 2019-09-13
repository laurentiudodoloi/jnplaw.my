<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VideosController extends Controller
{
    public function index()
    {
        $mainMovies = [
            [
                'name' => 'test',
                'image' => 'https://occ-0-3467-3466.1.nflxso.net/dnm/api/v6/0DW6CdE4gYtYx8iy3aj8gs9WtXE/AAAABalR_O5MYVZBSQpjJwlCDh_03z_Zgt2-JHcuA9VBoDrFmbcLwlixv6feh013hTPYLaH0wmEiVH85k0tGVo-0mnU72vJsnElC9PGh10oJ6B18brW5NAYRH6nHNy30.jpg?r=74e',
            ],
            [
                'name' => 'test',
                'image' => 'https://occ-0-3467-3466.1.nflxso.net/dnm/api/v6/0DW6CdE4gYtYx8iy3aj8gs9WtXE/AAAABe4R29nj-vzYSnC7Q2NuOgaud2V_pqTdWMZgUddCKk5MAdTtpSYjBbV3i6AdK1H_f6fEQHwkS_SpUPkSyi-bDRcHxGF9zc6g.webp?r=ec2',
            ],
            [
                'name' => 'test',
                'image' => 'https://occ-0-3467-3466.1.nflxso.net/dnm/api/v6/0DW6CdE4gYtYx8iy3aj8gs9WtXE/AAAABVJHApXhybZ71Cc3BSFr-7yBEoomb4dSi3wjAqagL0Rxelcq5SjsY975hki6ZMVRZ1zd4PEsp7-N1_HzzU7etwtQqa7R8sEc.webp?r=2ad',
            ],
        ];

        $movies = [
            [
                'name' => 'test',
                'image' => 'https://occ-0-3467-3466.1.nflxso.net/dnm/api/v6/0DW6CdE4gYtYx8iy3aj8gs9WtXE/AAAABfHH-hq7BDPD136zXqxmZec7amSePzoiFydl6iAPXWlzxjU3mgS30K1Gq6OK1KPQOvx3OLGqiDtSE3vTZjW4HOG9Gkp-J03P95PDMGM9FCSm3OxAVimWFuwXMzgg.jpg?r=cbc',
                'url' => 'video',
            ],
            [
                'name' => 'test',
                'image' => 'https://occ-0-3467-3466.1.nflxso.net/dnm/api/v6/0DW6CdE4gYtYx8iy3aj8gs9WtXE/AAAABQf510N3NN2-X0xdKBV5-SkN8LJnDoWI9lDL31fFHGicxqr1uahvWcvVlwvZZyZC0-D4UVRIPZ6uOonfsM9SIgLa21m1y7tUIS3bsGMyeemZiV7T1PXJ5M9fsMFi.jpg?r=be5',
                'url' => 'video',
            ],
            [
                'name' => 'test',
                'image' => 'https://occ-0-3467-3466.1.nflxso.net/dnm/api/v6/0DW6CdE4gYtYx8iy3aj8gs9WtXE/AAAABbXKCNyj525IP-ChCDZGnCvfQe4xOgS3MI5TTq9IEOAbgqZrnEXzryl3cSo3l_b2mwsMyTmDLNTL1AI-j8mLu-QrDj--HJ2o.webp?r=e7d',
                'url' => 'video',
            ],
            [
                'name' => 'test',
                'image' => 'https://occ-0-3467-3466.1.nflxso.net/dnm/api/v6/0DW6CdE4gYtYx8iy3aj8gs9WtXE/AAAABUrXGUrxB6HD1dyYmvY69rJtyCD0zHqatp2yM-w4hkDainjSI4J6H40-kDy9YcsHPVKmpH-hk3XZQKGCvSQJ2MsxlMIqwnfR.webp?r=8fb',
                'url' => 'video',
            ],
            [
                'name' => 'test',
                'image' => 'https://occ-0-3467-3466.1.nflxso.net/dnm/api/v6/0DW6CdE4gYtYx8iy3aj8gs9WtXE/AAAABWRbiLKm3L2LI2xAvmk1CbYfkIu8g6MnZ1bcdYLNx7YyJh3Cmjz8O8YFWpaF3z0K_YwDqRB4l773W0MSJu-a2zT8MMipBHVk.webp?r=112',
                'url' => 'video',
            ],
            [
                'name' => 'test',
                'image' => 'https://occ-0-3467-3466.1.nflxso.net/dnm/api/v6/0DW6CdE4gYtYx8iy3aj8gs9WtXE/AAAABfba5bx9jbZTESwd4aPljcB3Un_Pu1jNu1eGWK-ak6cvl1UQGW4zZmfnramjqX6lP5yvM-pZFXaxGRCT2r8kKs-UDGJazNJ83DQj9lrddRPwnMDRj6J3hLJY6GjI.jpg?r=4de',
                'url' => 'video',
            ],
            [
                'name' => 'test',
                'image' => 'https://occ-0-3467-3466.1.nflxso.net/dnm/api/v6/0DW6CdE4gYtYx8iy3aj8gs9WtXE/AAAABVyagW9IH4DXIrWzb241kQGLr62srQbYq7FDUCo7_exQINtt0GdkSbB5u-yVpZP1j5JyfKRXRTZSf55AQI-kR1dD1Jdx-cby.webp?r=c61',
                'url' => 'video',
            ]
        ];

        return view('pages.netflixpage', compact('mainMovies', 'movies'));
    }

    public function video()
    {
      $mainMovies = [
        [
          'name' => 'test',
          'image' => 'https://picsum.photos/700/400?random=2',
        ],
        [
          'name' => 'test',
          'image' => 'https://picsum.photos/700/400?random=2',
        ],
        [
          'name' => 'test',
          'image' => 'https://picsum.photos/700/400?random=2',
        ],
      ];

      $movies = [
        [
          'name' => 'test',
          'image' => 'https://picsum.photos/700/400?random=2',
          'url' => 'video',
        ],
        [
          'name' => 'test',
          'image' => 'https://picsum.photos/700/400?random=2',
          'url' => 'video',
        ],
        [
          'name' => 'test',
          'image' => 'https://picsum.photos/700/400?random=2',
          'url' => 'video',
        ],
        [
          'name' => 'test',
          'image' => 'https://picsum.photos/700/400?random=2',
          'url' => 'video',
        ],
        [
          'name' => 'test',
          'image' => 'https://picsum.photos/700/400?random=2',
          'url' => 'video',
        ],
        [
          'name' => 'test',
          'image' => 'https://picsum.photos/700/400?random=2',
          'url' => 'video',
        ],
        [
          'name' => 'test',
          'image' => 'https://picsum.photos/700/400?random=2',
          'url' => 'video',
        ]
      ];

      return view('pages.videos', compact('mainMovies', 'movies'));
    }
}
