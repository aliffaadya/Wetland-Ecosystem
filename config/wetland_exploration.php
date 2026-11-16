<?php

return [
    'photo_credits' => [
        'rawa.jpeg' => ['title' => 'Ternak Itik di Rawa', 'photographer' => 'Hendry Hamim', 'source' => 'https://commons.wikimedia.org/wiki/File:Ternak_Itik_di_Rawa.jpg', 'license' => 'CC BY-SA 4.0'],
        'lahan_gambut.jpeg' => ['title' => 'Peat Forest Swamp', 'photographer' => 'Ruanda Agung Sugardiman/AusAID', 'source' => 'https://commons.wikimedia.org/wiki/File:Peat_Forest_Swamp_(10712654875).jpg', 'license' => 'CC BY 2.0'],
        'mangrove.jpeg' => ['title' => 'Mangrove Forest', 'photographer' => 'Basundhara Chowdhury', 'source' => 'https://commons.wikimedia.org/wiki/File:Mangrove_Forest.jpg', 'license' => 'CC BY-SA 4.0'],
        'bekantan.jpeg' => ['title' => 'Bekantan at Pulau Bakut', 'photographer' => 'Gazagazasanid', 'source' => 'https://commons.wikimedia.org/wiki/File:Bekantan_at_Pulau_Bakut.jpg', 'license' => 'CC BY-SA 4.0'],
        'danau dan sungai.jpeg' => ['title' => 'Sungai Saka Permai 1', 'photographer' => 'Wadaihangit', 'source' => 'https://commons.wikimedia.org/wiki/File:Sungai_Saka_Permai_1.jpg', 'license' => 'CC BY-SA 4.0'],
        'embung_bakar.jpeg' => ['title' => 'Embung Bakar 001', 'photographer' => 'Ilham Mufti Laksono', 'source' => 'https://commons.wikimedia.org/wiki/File:Embung_Bakar_001.jpg', 'license' => 'CC BY-SA 4.0'],
    ],
    'ecosystems' => [
        'rawa' => [
            'title' => 'Rawa',
            'image' => 'rawa.jpeg',
            'summary' => 'Wilayah rendah yang tergenang air dan menjadi habitat tumbuhan serta hewan lahan basah.',
            'introduction' => 'Amati air, tumbuhan, dan satwa yang terlihat di rawa. Pilih penanda untuk mengenal perannya.',
            'hotspots' => [
                'air-rawa' => ['label' => 'Air rawa', 'x' => 27, 'y' => 52, 'image' => 'pop_rawa.jpeg', 'title' => 'Air rawa', 'description' => 'Rawa adalah wilayah rendah yang sering tergenang air, baik sepanjang tahun maupun pada musim tertentu.', 'traits' => 'Air tampak dangkal dan bercampur dengan tanah serta tumbuhan air.', 'role' => 'Air menyediakan ruang hidup dan sumber kebutuhan bagi berbagai organisme rawa.'],
                'tumbuhan-rawa' => ['label' => 'Tumbuhan rawa', 'x' => 76, 'y' => 68, 'image' => 'tumbuhan_rawa.jpeg', 'title' => 'Tumbuhan rawa', 'description' => 'Tumbuhan rawa hidup pada tanah yang basah atau tergenang.', 'traits' => 'Sebagian tumbuhan memiliki batang atau daun yang dapat tumbuh di sekitar permukaan air.', 'role' => 'Tumbuhan menyediakan makanan, tempat berlindung, dan membantu menjaga kondisi habitat.'],
                'burung-air' => ['label' => 'Burung air', 'x' => 56, 'y' => 81, 'image' => 'pop_rawa.jpeg', 'title' => 'Satwa rawa', 'description' => 'Rawa pada foto ini menjadi tempat hidup dan mencari makan bagi burung air.', 'traits' => 'Burung terlihat berada di air dangkal dan di antara tumbuhan rawa.', 'role' => 'Satwa menjadi bagian dari rantai makanan dan membantu menunjukkan kesehatan habitat rawa.'],
            ],
        ],
        'mangrove' => [
            'title' => 'Hutan Mangrove',
            'image' => 'mangrove.jpeg',
            'summary' => 'Ekosistem pesisir berlumpur yang dipengaruhi pasang surut dan ditumbuhi mangrove.',
            'introduction' => 'Lihat bagian akar, batang, dan air di hutan mangrove. Foto ini menampilkan rapatnya akar mangrove di pesisir.',
            'extra' => [
                'title' => 'Bekantan (Nasalis larvatus)',
                'image' => 'bekantan.jpeg',
                'description' => 'Bekantan adalah primata endemik Kalimantan yang hidup di hutan mangrove, hutan rawa, dan hutan tepi sungai. Bekantan pandai berenang dan sering berpindah di antara pepohonan dekat perairan. Makanannya terutama berupa daun muda, buah, dan biji.',
                'traits' => 'Bekantan jantan memiliki hidung besar yang khas. Jari-jari kakinya berselaput, membantu saat berenang. Satwa ini hidup berkelompok dan bergantung pada hutan yang sehat di sepanjang sungai dan pesisir.',
                'role' => 'Sebagai pemakan buah dan biji, bekantan turut membantu penyebaran biji tumbuhan. Keberadaannya juga menjadi penanda pentingnya menjaga hutan mangrove dan hutan riparian Kalimantan.',
            ],
            'hotspots' => [
                'akar-mangrove' => ['label' => 'Akar mangrove', 'x' => 42, 'y' => 69, 'image' => 'pop_mangrove.jpeg', 'title' => 'Akar mangrove', 'description' => 'Akar mangrove tumbuh rapat di tanah berlumpur dan sebagian tampak di atas permukaan air.', 'traits' => 'Pada foto, akar tunjang terlihat menyebar dari batang dan menopang pohon di lumpur.', 'role' => 'Akar membantu menahan sedimen dan mengurangi pengikisan pantai.'],
                'pohon-mangrove' => ['label' => 'Pohon mangrove', 'x' => 70, 'y' => 34, 'image' => 'mangrovee.jpeg', 'title' => 'Pohon mangrove', 'description' => 'Mangrove tumbuh di pesisir yang berlumpur dan dipengaruhi pasang surut.', 'traits' => 'Batang-batang pohon tumbuh rapat di atas jaringan akar yang kuat.', 'role' => 'Hutan mangrove menjadi tempat berlindung, mencari makan, dan berkembang biak bagi banyak organisme.'],
                'perairan-pesisir' => ['label' => 'Perairan pesisir', 'x' => 83, 'y' => 89, 'image' => 'pop_mangrove.jpeg', 'title' => 'Perairan mangrove', 'description' => 'Air di hutan mangrove naik dan turun mengikuti pasang surut.', 'traits' => 'Air berdekatan dengan akar dan tanah berlumpur di kawasan pesisir.', 'role' => 'Perairan menjadi habitat organisme air dan menghubungkan kehidupan darat dengan laut.'],
            ],
        ],
        'gambut' => [
            'title' => 'Lahan Gambut',
            'image' => 'lahan_gambut.jpeg',
            'summary' => 'Bentang alam berhutan dan basah dengan lapisan tanah kaya bahan organik.',
            'introduction' => 'Foto utama memperlihatkan hamparan hutan gambut dan aliran air. Lapisan tanah gambut tersedia sebagai gambar pendukung popup.',
            'extra' => ['title' => 'Lapisan tanah gambut', 'image' => 'tanah_gambut.jpeg', 'description' => 'Lapisan tanah kaya bahan organik ini tidak terlihat pada foto utama yang diambil dari udara. Foto ini ditampilkan sebagai pendukung informasi, bukan sebagai hotspot pada gambar utama.'],
            'hotspots' => [
                'vegetasi-gambut' => ['label' => 'Vegetasi gambut', 'x' => 35, 'y' => 53, 'image' => 'vegetasi_gambut.jpeg', 'title' => 'Vegetasi gambut', 'description' => 'Beragam tumbuhan tumbuh di kawasan gambut yang basah.', 'traits' => 'Foto utama memperlihatkan tutupan hutan yang luas; gambar pendukung menunjukkan tumbuhan bawah di lahan gambut.', 'role' => 'Vegetasi menyediakan habitat dan menyimpan karbon dalam ekosistem gambut.'],
                'aliran-air' => ['label' => 'Aliran air gambut', 'x' => 75, 'y' => 45, 'image' => 'pop_gambut.jpeg', 'title' => 'Air di lahan gambut', 'description' => 'Air mengalir melalui kawasan hutan gambut yang selalu lembap.', 'traits' => 'Sungai kecil tampak membelah tutupan hutan pada foto utama.', 'role' => 'Kondisi basah membantu memperlambat penguraian bahan organik dan menjaga lapisan gambut.'],
            ],
        ],
        'danau-sungai' => [
            'title' => 'Danau dan Kawasan Sekitar Sungai',
            'image' => 'danau dan sungai.jpeg',
            'summary' => 'Perairan dan kawasan tepinya yang basah mendukung kehidupan serta aktivitas masyarakat.',
            'introduction' => 'Gambar utama menunjukkan alur sungai dan kawasan tepi sungai. Pilih penanda untuk menjelajahi hubungan air dengan daratan.',
            'hotspots' => [
                'alur-sungai' => ['label' => 'Alur sungai', 'x' => 54, 'y' => 77, 'image' => 'pop_sungai.jpeg', 'title' => 'Alur sungai', 'description' => 'Sungai mengalir melalui daratan dan dapat meluap ke kawasan sekitarnya.', 'traits' => 'Alur sungai terlihat jelas membelah permukiman pada foto utama.', 'role' => 'Sungai menyediakan air dan habitat; luapan dapat membentuk lahan basah di tepinya.'],
                'tepi-sungai' => ['label' => 'Tepi sungai', 'x' => 24, 'y' => 79, 'image' => 'embung_bakar.jpeg', 'title' => 'Kawasan tepi perairan', 'description' => 'Area di dekat sungai atau tampungan air dapat menjadi basah dan mendukung kehidupan lahan basah.', 'traits' => 'Permukiman dan daratan tampak berdampingan dengan sungai pada foto utama. Gambar pendukung memperlihatkan embung, yaitu tampungan air buatan.', 'role' => 'Kawasan tepi perairan menjadi penghubung antara habitat air dan darat. Embung dapat membantu menampung air, tetapi bukan danau alami.'],
                'habitat-perairan' => ['label' => 'Habitat perairan', 'x' => 75, 'y' => 73, 'image' => 'pop_sungai.jpeg', 'title' => 'Habitat perairan', 'description' => 'Perairan dan kawasan tepinya mendukung berbagai tumbuhan, hewan air, dan kegiatan manusia.', 'traits' => 'Permukaan sungai yang luas dan tepian yang dihuni tampak pada foto.', 'role' => 'Kawasan ini menyediakan habitat dan sumber air bagi makhluk hidup di sekitarnya.'],
            ],
        ],
    ],
    'banner' => 'pemandangan_lahan_basah.jpeg',
];
