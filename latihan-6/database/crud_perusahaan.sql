-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Nov 2023 pada 00.42
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crud_perusahaan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_konsumen`
--

CREATE TABLE `tb_konsumen` (
  `nik` varchar(16) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` varchar(1) NOT NULL,
  `telepon` varchar(13) NOT NULL,
  `foto` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_konsumen`
--

INSERT INTO `tb_konsumen` (`nik`, `nama`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `telepon`, `foto`) VALUES
('101010101', 'Abigel Fransisca', 'Denpasar', '2000-10-10', 'P', '1234567899', 'default.png'),
('111111110', 'Bambang Santoso', 'Makassar', '2000-11-11', 'L', '1234567800', 'default.png'),
('111111111', 'Budi Susanto', 'Jakarta', '2000-01-01', 'L', '1234567890', 'default.png'),
('121212121', 'Sari Puspita', 'Pontianak', '2000-12-12', 'P', '1234567801', 'default.png'),
('131313131', 'Adi Pratama', 'Palembang', '2000-01-13', 'L', '1234567802', 'default.png'),
('141414141', 'Rina Wulandari', 'Banjarmasin', '2000-02-14', 'P', '1234567803', 'default.png'),
('151515151', 'Diana Nurhayati', 'Manado', '2000-03-15', 'L', '1234567804', 'default.png'),
('161616161', 'Rudi Hidayat', 'Balikpapan', '2000-04-16', 'L', '1234567805', 'default.png'),
('171717171', 'Mega Susanti', 'Jambi', '2000-05-17', 'P', '1234567806', 'default.png'),
('181818181', 'Eka Putra', 'Lampung', '2000-06-18', 'L', '1234567807', 'default.png'),
('191919191', 'Rina Fitriani', 'Tangerang', '2000-07-19', 'P', '1234567808', 'default.png'),
('202020202', 'Anto Sutrisno', 'Cirebon', '2000-08-20', 'L', '1234567809', 'default.png'),
('222222222', 'Siti Rahayu', 'Bandung', '2000-02-02', 'P', '1234567891', 'default.png'),
('333333333', 'Ahmad Yani', 'Surabaya', '2000-03-03', 'L', '1234567892', 'default.png'),
('444444444', 'Dewi Fitriani', 'Yogyakarta', '2000-04-04', 'P', '1234567893', 'default.png'),
('555555555', 'Rini Handayani', 'Semarang', '2000-05-05', 'L', '1234567894', 'default.png'),
('666666666', 'Fajar Nugroho', 'Solo', '2000-06-06', 'L', '1234567895', 'default.png'),
('777777777', 'Siti Hartini', 'Malang', '2000-07-07', 'P', '1234567896', 'default.png'),
('888888888', 'Indra Wijaya', 'Medan', '2000-08-08', 'L', '1234567897', 'default.png'),
('999999999', 'Ratna Sari', 'Padang', '2000-09-09', 'P', '1234567898', 'default.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_order`
--

CREATE TABLE `tb_order` (
  `id_order` varchar(50) NOT NULL,
  `nik_konsumen` varchar(16) NOT NULL,
  `id_produk` varchar(50) NOT NULL,
  `jumlah_pesanan` int(11) NOT NULL,
  `tanggal_order` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_order`
--

INSERT INTO `tb_order` (`id_order`, `nik_konsumen`, `id_produk`, `jumlah_pesanan`, `tanggal_order`) VALUES
('ID11313', '111111111', 'M009', 10, '2023-11-19'),
('ID14534', '333333333', 'M008', 15, '2023-11-18'),
('ID27691', '202020202', 'M005', 5, '2023-11-18'),
('ID39755', '101010101', 'M004', 5, '2023-11-18'),
('ID48644', '444444444', 'M006', 5, '2023-11-18'),
('ID60442', '151515151', 'M007', 20, '2023-11-18'),
('ID65846', '181818181', 'M003', 5, '2023-11-18'),
('ID67201', '131313131', 'M004', 5, '2023-11-18'),
('ID71998', '666666666', 'M002', 5, '2023-11-18'),
('ID96317', '121212121', 'M001', 10, '2023-11-17');

--
-- Trigger `tb_order`
--
DELIMITER $$
CREATE TRIGGER `kembalikan_stok_setelah_delete` AFTER DELETE ON `tb_order` FOR EACH ROW BEGIN
    UPDATE tb_produk
    SET stok = stok + OLD.jumlah_pesanan
    WHERE id_produk = OLD.id_produk;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `kurangi_stok_produk` AFTER INSERT ON `tb_order` FOR EACH ROW BEGIN
    UPDATE tb_produk
    SET stok = stok - NEW.jumlah_pesanan
    WHERE id_produk = NEW.id_produk;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `perbarui_stok_setelah_update` AFTER UPDATE ON `tb_order` FOR EACH ROW BEGIN
    DECLARE selisih_pesanan INT;
    SET selisih_pesanan = NEW.jumlah_pesanan - OLD.jumlah_pesanan;

    IF selisih_pesanan >= 0 THEN
        UPDATE tb_produk
        SET stok = stok - selisih_pesanan
        WHERE id_produk = NEW.id_produk;
    ELSE
        UPDATE tb_produk
        SET stok = stok + ABS(selisih_pesanan)
        WHERE id_produk = NEW.id_produk;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pegawai`
--

CREATE TABLE `tb_pegawai` (
  `nip` varchar(16) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` varchar(1) NOT NULL,
  `telepon` varchar(13) NOT NULL,
  `status_pegawai` varchar(15) NOT NULL,
  `agama` varchar(25) NOT NULL,
  `foto` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_pegawai`
--

INSERT INTO `tb_pegawai` (`nip`, `nik`, `nama`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `telepon`, `status_pegawai`, `agama`, `foto`) VALUES
('101010101', '101010101', 'Ayu Dewi', 'Denpasar', '2000-10-10', 'P', '1234567899', 'Belum Menikah', 'Protestan', 'default.png'),
('111111110', '111111110', 'Bambang Santoso', 'Makassar', '2000-11-11', 'L', '1234567800', 'Menikah', 'Katolik', 'default.png'),
('111111111', '111111111', 'Budi Santoso', 'Jakarta', '2000-01-01', 'L', '1234567890', 'Menikah', 'Islam', 'default.png'),
('121212121', '121212121', 'Sari Puspita', 'Pontianak', '2000-12-12', 'P', '1234567801', 'Belum Menikah', 'Konghuchu', 'default.png'),
('131313131', '131313131', 'Adi Pratama', 'Palembang', '2000-01-13', 'L', '1234567802', 'Menikah', 'Islam', 'default.png'),
('141414141', '141414141', 'Rina Wulandari', 'Banjarmasin', '2000-02-14', 'P', '1234567803', 'Belum Menikah', 'Hindu', 'default.png'),
('151515151', '151515151', 'Diana Nurhayati', 'Manado', '2000-03-15', 'L', '1234567804', 'Menikah', 'Buddha', 'default.png'),
('161616161', '161616161', 'Rudi Hidayat', 'Balikpapan', '2000-04-16', 'L', '1234567805', 'Belum Menikah', 'Protestan', 'default.png'),
('171717171', '171717171', 'Mega Susanti', 'Jambi', '2000-05-17', 'P', '1234567806', 'Menikah', 'Katolik', 'default.png'),
('181818181', '181818181', 'Eka Putra', 'Lampung', '2000-06-18', 'L', '1234567807', 'Belum Menikah', 'Konghuchu', 'default.png'),
('191919191', '191919191', 'Rina Fitriani', 'Tangerang', '2000-07-19', 'P', '1234567808', 'Menikah', 'Islam', 'default.png'),
('202020202', '202020202', 'Anto Sutrisno', 'Cirebon', '2000-08-20', 'L', '1234567809', 'Belum Menikah', 'Hindu', 'default.png'),
('222222222', '222222222', 'Siti Rahayu', 'Bandung', '2000-02-02', 'P', '1234567891', 'Belum Menikah', 'Hindu', 'default.png'),
('333333333', '333333333', 'Ahmad Yani', 'Surabaya', '2000-03-03', 'L', '1234567892', 'Menikah', 'Buddha', 'default.png'),
('444444444', '444444444', 'Dewi Fitriani', 'Yogyakarta', '2000-04-04', 'P', '1234567893', 'Belum Menikah', 'Protestan', 'default.png'),
('555555555', '555555555', 'Rini Handayani', 'Semarang', '2000-05-05', 'L', '1234567894', 'Menikah', 'Katolik', 'default.png'),
('666666666', '666666666', 'Fajar Nugroho', 'Solo', '2000-06-06', 'L', '1234567895', 'Belum Menikah', 'Konghuchu', 'default.png'),
('777777777', '777777777', 'Siti Hartini', 'Malang', '2000-07-07', 'P', '1234567896', 'Menikah', 'Islam', 'default.png'),
('888888888', '888888888', 'Indra Wijaya', 'Medan', '2000-08-08', 'L', '1234567897', 'Belum Menikah', 'Hindu', 'default.png'),
('999999999', '999999999', 'Ratna Sari', 'Padang', '2000-09-09', 'P', '1234567898', 'Menikah', 'Buddha', 'default.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_produk`
--

CREATE TABLE `tb_produk` (
  `id_produk` varchar(50) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `merk` varchar(50) NOT NULL,
  `tipe` varchar(50) NOT NULL,
  `harga` bigint(20) NOT NULL,
  `stok` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_produk`
--

INSERT INTO `tb_produk` (`id_produk`, `nama_produk`, `merk`, `tipe`, `harga`, `stok`, `deskripsi`, `foto`) VALUES
('M001', 'Mercedes Benz AMG GT', 'Mercedes Benz', 'Sports', 3000000000, 90, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Reprehenderit inventore eaque corrupti laboriosam autem facere quibusdam alias excepturi illo fugiat sapiente quisquam, voluptas esse asperiores velit nulla ab ex delectus eligendi minima sit voluptatibus aspernatur, temporibus nobis. Commodi, optio iure quis accusantium ratione odit nulla tempora dolor expedita dignissimos perspiciatis unde molestias voluptate facere, officia ab at. Ad, delectus perspiciatis! Labore hic eligendi commodi iure aspernatur distinctio id, maiores beatae, esse quasi iste assumenda vel corrupti et consequuntur culpa vitae reprehenderit. Reiciendis eveniet labore, nostrum necessitatibus ut tempora, saepe perspiciatis maiores accusantium minima ducimus officiis voluptatem ipsam explicabo! Amet debitis tenetur ratione maiores eaque provident odit cumque accusamus eos et voluptates est vero quis delectus atque inventore distinctio modi facere ullam vel voluptate, dignissimos aut recusandae at! Corrupti quas laudantium earum quasi obcaecati molestias deserunt soluta accusantium, placeat culpa adipisci eos, voluptates veritatis fuga alias perferendis necessitatibus, voluptas vero reiciendis quae dicta ut. Itaque alias quia natus nisi iusto illum animi quos tenetur qui vitae sunt, eum delectus totam debitis. Laboriosam esse dolor nisi hic aliquid dicta ut cum perferendis mollitia? Atque itaque amet officiis quos sit illum? Minus veritatis labore natus cum tenetur eius iste. Fugiat tempore deserunt numquam et, dolore suscipit. Eos corrupti illo error vel sint tempore ad culpa. Provident assumenda asperiores eos labore rem, exercitationem autem nihil eum totam veritatis cum recusandae, repellat mollitia explicabo sint omnis laudantium nam facilis! Porro id sunt labore rerum neque explicabo consectetur mollitia et. Dolorem molestias inventore natus illo quo, unde, quam nulla reiciendis voluptatibus, nisi nihil et voluptate. Necessitatibus natus maxime dolorem quasi autem optio nulla in nisi sequi et eius architecto, reprehenderit distinctio ipsam enim quo aperiam alias commodi ratione perferendis soluta atque quod nemo! Cumque, sequi? Eveniet provident, rem quibusdam suscipit corporis illo laboriosam ducimus labore adipisci!', 'https://source.unsplash.com/random/300×300/?mercedes-benz-amg-gt'),
('M002', 'Toyota Supra', 'Toyota', 'Sports', 3000000000, 95, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Reprehenderit inventore eaque corrupti laboriosam autem facere quibusdam alias excepturi illo fugiat sapiente quisquam, voluptas esse asperiores velit nulla ab ex delectus eligendi minima sit voluptatibus aspernatur, temporibus nobis. Commodi, optio iure quis accusantium ratione odit nulla tempora dolor expedita dignissimos perspiciatis unde molestias voluptate facere, officia ab at. Ad, delectus perspiciatis! Labore hic eligendi commodi iure aspernatur distinctio id, maiores beatae, esse quasi iste assumenda vel corrupti et consequuntur culpa vitae reprehenderit. Reiciendis eveniet labore, nostrum necessitatibus ut tempora, saepe perspiciatis maiores accusantium minima ducimus officiis voluptatem ipsam explicabo! Amet debitis tenetur ratione maiores eaque provident odit cumque accusamus eos et voluptates est vero quis delectus atque inventore distinctio modi facere ullam vel voluptate, dignissimos aut recusandae at! Corrupti quas laudantium earum quasi obcaecati molestias deserunt soluta accusantium, placeat culpa adipisci eos, voluptates veritatis fuga alias perferendis necessitatibus, voluptas vero reiciendis quae dicta ut. Itaque alias quia natus nisi iusto illum animi quos tenetur qui vitae sunt, eum delectus totam debitis. Laboriosam esse dolor nisi hic aliquid dicta ut cum perferendis mollitia? Atque itaque amet officiis quos sit illum? Minus veritatis labore natus cum tenetur eius iste. Fugiat tempore deserunt numquam et, dolore suscipit. Eos corrupti illo error vel sint tempore ad culpa. Provident assumenda asperiores eos labore rem, exercitationem autem nihil eum totam veritatis cum recusandae, repellat mollitia explicabo sint omnis laudantium nam facilis! Porro id sunt labore rerum neque explicabo consectetur mollitia et. Dolorem molestias inventore natus illo quo, unde, quam nulla reiciendis voluptatibus, nisi nihil et voluptate. Necessitatibus natus maxime dolorem quasi autem optio nulla in nisi sequi et eius architecto, reprehenderit distinctio ipsam enim quo aperiam alias commodi ratione perferendis soluta atque quod nemo! Cumque, sequi? Eveniet provident, rem quibusdam suscipit corporis illo laboriosam ducimus labore adipisci!', 'https://source.unsplash.com/random/300×300/?toyota-supra'),
('M003', 'BMW M3', 'BMW', 'Sports', 3000000000, 95, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Reprehenderit inventore eaque corrupti laboriosam autem facere quibusdam alias excepturi illo fugiat sapiente quisquam, voluptas esse asperiores velit nulla ab ex delectus eligendi minima sit voluptatibus aspernatur, temporibus nobis. Commodi, optio iure quis accusantium ratione odit nulla tempora dolor expedita dignissimos perspiciatis unde molestias voluptate facere, officia ab at. Ad, delectus perspiciatis! Labore hic eligendi commodi iure aspernatur distinctio id, maiores beatae, esse quasi iste assumenda vel corrupti et consequuntur culpa vitae reprehenderit. Reiciendis eveniet labore, nostrum necessitatibus ut tempora, saepe perspiciatis maiores accusantium minima ducimus officiis voluptatem ipsam explicabo! Amet debitis tenetur ratione maiores eaque provident odit cumque accusamus eos et voluptates est vero quis delectus atque inventore distinctio modi facere ullam vel voluptate, dignissimos aut recusandae at! Corrupti quas laudantium earum quasi obcaecati molestias deserunt soluta accusantium, placeat culpa adipisci eos, voluptates veritatis fuga alias perferendis necessitatibus, voluptas vero reiciendis quae dicta ut. Itaque alias quia natus nisi iusto illum animi quos tenetur qui vitae sunt, eum delectus totam debitis. Laboriosam esse dolor nisi hic aliquid dicta ut cum perferendis mollitia? Atque itaque amet officiis quos sit illum? Minus veritatis labore natus cum tenetur eius iste. Fugiat tempore deserunt numquam et, dolore suscipit. Eos corrupti illo error vel sint tempore ad culpa. Provident assumenda asperiores eos labore rem, exercitationem autem nihil eum totam veritatis cum recusandae, repellat mollitia explicabo sint omnis laudantium nam facilis! Porro id sunt labore rerum neque explicabo consectetur mollitia et. Dolorem molestias inventore natus illo quo, unde, quam nulla reiciendis voluptatibus, nisi nihil et voluptate. Necessitatibus natus maxime dolorem quasi autem optio nulla in nisi sequi et eius architecto, reprehenderit distinctio ipsam enim quo aperiam alias commodi ratione perferendis soluta atque quod nemo! Cumque, sequi? Eveniet provident, rem quibusdam suscipit corporis illo laboriosam ducimus labore adipisci!', 'https://source.unsplash.com/random/300×300/?bmw-m3'),
('M004', 'Lamborghini Gallardo', 'Lamborghini', 'Sports', 3000000000, 90, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Reprehenderit inventore eaque corrupti laboriosam autem facere quibusdam alias excepturi illo fugiat sapiente quisquam, voluptas esse asperiores velit nulla ab ex delectus eligendi minima sit voluptatibus aspernatur, temporibus nobis. Commodi, optio iure quis accusantium ratione odit nulla tempora dolor expedita dignissimos perspiciatis unde molestias voluptate facere, officia ab at. Ad, delectus perspiciatis! Labore hic eligendi commodi iure aspernatur distinctio id, maiores beatae, esse quasi iste assumenda vel corrupti et consequuntur culpa vitae reprehenderit. Reiciendis eveniet labore, nostrum necessitatibus ut tempora, saepe perspiciatis maiores accusantium minima ducimus officiis voluptatem ipsam explicabo! Amet debitis tenetur ratione maiores eaque provident odit cumque accusamus eos et voluptates est vero quis delectus atque inventore distinctio modi facere ullam vel voluptate, dignissimos aut recusandae at! Corrupti quas laudantium earum quasi obcaecati molestias deserunt soluta accusantium, placeat culpa adipisci eos, voluptates veritatis fuga alias perferendis necessitatibus, voluptas vero reiciendis quae dicta ut. Itaque alias quia natus nisi iusto illum animi quos tenetur qui vitae sunt, eum delectus totam debitis. Laboriosam esse dolor nisi hic aliquid dicta ut cum perferendis mollitia? Atque itaque amet officiis quos sit illum? Minus veritatis labore natus cum tenetur eius iste. Fugiat tempore deserunt numquam et, dolore suscipit. Eos corrupti illo error vel sint tempore ad culpa. Provident assumenda asperiores eos labore rem, exercitationem autem nihil eum totam veritatis cum recusandae, repellat mollitia explicabo sint omnis laudantium nam facilis! Porro id sunt labore rerum neque explicabo consectetur mollitia et. Dolorem molestias inventore natus illo quo, unde, quam nulla reiciendis voluptatibus, nisi nihil et voluptate. Necessitatibus natus maxime dolorem quasi autem optio nulla in nisi sequi et eius architecto, reprehenderit distinctio ipsam enim quo aperiam alias commodi ratione perferendis soluta atque quod nemo! Cumque, sequi? Eveniet provident, rem quibusdam suscipit corporis illo laboriosam ducimus labore adipisci!', 'https://source.unsplash.com/random/300×300/?lamborghini-gallardo'),
('M005', 'Honda Civic', 'Honda', 'Sports', 3000000000, 85, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Reprehenderit inventore eaque corrupti laboriosam autem facere quibusdam alias excepturi illo fugiat sapiente quisquam, voluptas esse asperiores velit nulla ab ex delectus eligendi minima sit voluptatibus aspernatur, temporibus nobis. Commodi, optio iure quis accusantium ratione odit nulla tempora dolor expedita dignissimos perspiciatis unde molestias voluptate facere, officia ab at. Ad, delectus perspiciatis! Labore hic eligendi commodi iure aspernatur distinctio id, maiores beatae, esse quasi iste assumenda vel corrupti et consequuntur culpa vitae reprehenderit. Reiciendis eveniet labore, nostrum necessitatibus ut tempora, saepe perspiciatis maiores accusantium minima ducimus officiis voluptatem ipsam explicabo! Amet debitis tenetur ratione maiores eaque provident odit cumque accusamus eos et voluptates est vero quis delectus atque inventore distinctio modi facere ullam vel voluptate, dignissimos aut recusandae at! Corrupti quas laudantium earum quasi obcaecati molestias deserunt soluta accusantium, placeat culpa adipisci eos, voluptates veritatis fuga alias perferendis necessitatibus, voluptas vero reiciendis quae dicta ut. Itaque alias quia natus nisi iusto illum animi quos tenetur qui vitae sunt, eum delectus totam debitis. Laboriosam esse dolor nisi hic aliquid dicta ut cum perferendis mollitia? Atque itaque amet officiis quos sit illum? Minus veritatis labore natus cum tenetur eius iste. Fugiat tempore deserunt numquam et, dolore suscipit. Eos corrupti illo error vel sint tempore ad culpa. Provident assumenda asperiores eos labore rem, exercitationem autem nihil eum totam veritatis cum recusandae, repellat mollitia explicabo sint omnis laudantium nam facilis! Porro id sunt labore rerum neque explicabo consectetur mollitia et. Dolorem molestias inventore natus illo quo, unde, quam nulla reiciendis voluptatibus, nisi nihil et voluptate. Necessitatibus natus maxime dolorem quasi autem optio nulla in nisi sequi et eius architecto, reprehenderit distinctio ipsam enim quo aperiam alias commodi ratione perferendis soluta atque quod nemo! Cumque, sequi? Eveniet provident, rem quibusdam suscipit corporis illo laboriosam ducimus labore adipisci!', 'https://source.unsplash.com/random/300×300/?honda-civic'),
('M006', 'Chevrolet Camaro', 'Chevrolet', 'Sports', 3000000000, 85, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Reprehenderit inventore eaque corrupti laboriosam autem facere quibusdam alias excepturi illo fugiat sapiente quisquam, voluptas esse asperiores velit nulla ab ex delectus eligendi minima sit voluptatibus aspernatur, temporibus nobis. Commodi, optio iure quis accusantium ratione odit nulla tempora dolor expedita dignissimos perspiciatis unde molestias voluptate facere, officia ab at. Ad, delectus perspiciatis! Labore hic eligendi commodi iure aspernatur distinctio id, maiores beatae, esse quasi iste assumenda vel corrupti et consequuntur culpa vitae reprehenderit. Reiciendis eveniet labore, nostrum necessitatibus ut tempora, saepe perspiciatis maiores accusantium minima ducimus officiis voluptatem ipsam explicabo! Amet debitis tenetur ratione maiores eaque provident odit cumque accusamus eos et voluptates est vero quis delectus atque inventore distinctio modi facere ullam vel voluptate, dignissimos aut recusandae at! Corrupti quas laudantium earum quasi obcaecati molestias deserunt soluta accusantium, placeat culpa adipisci eos, voluptates veritatis fuga alias perferendis necessitatibus, voluptas vero reiciendis quae dicta ut. Itaque alias quia natus nisi iusto illum animi quos tenetur qui vitae sunt, eum delectus totam debitis. Laboriosam esse dolor nisi hic aliquid dicta ut cum perferendis mollitia? Atque itaque amet officiis quos sit illum? Minus veritatis labore natus cum tenetur eius iste. Fugiat tempore deserunt numquam et, dolore suscipit. Eos corrupti illo error vel sint tempore ad culpa. Provident assumenda asperiores eos labore rem, exercitationem autem nihil eum totam veritatis cum recusandae, repellat mollitia explicabo sint omnis laudantium nam facilis! Porro id sunt labore rerum neque explicabo consectetur mollitia et. Dolorem molestias inventore natus illo quo, unde, quam nulla reiciendis voluptatibus, nisi nihil et voluptate. Necessitatibus natus maxime dolorem quasi autem optio nulla in nisi sequi et eius architecto, reprehenderit distinctio ipsam enim quo aperiam alias commodi ratione perferendis soluta atque quod nemo! Cumque, sequi? Eveniet provident, rem quibusdam suscipit corporis illo laboriosam ducimus labore adipisci!', 'https://source.unsplash.com/random/300×300/?chevrolet-camaro'),
('M007', 'Ford GT', 'Ford', 'Sports', 3000000000, 80, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Reprehenderit inventore eaque corrupti laboriosam autem facere quibusdam alias excepturi illo fugiat sapiente quisquam, voluptas esse asperiores velit nulla ab ex delectus eligendi minima sit voluptatibus aspernatur, temporibus nobis. Commodi, optio iure quis accusantium ratione odit nulla tempora dolor expedita dignissimos perspiciatis unde molestias voluptate facere, officia ab at. Ad, delectus perspiciatis! Labore hic eligendi commodi iure aspernatur distinctio id, maiores beatae, esse quasi iste assumenda vel corrupti et consequuntur culpa vitae reprehenderit. Reiciendis eveniet labore, nostrum necessitatibus ut tempora, saepe perspiciatis maiores accusantium minima ducimus officiis voluptatem ipsam explicabo! Amet debitis tenetur ratione maiores eaque provident odit cumque accusamus eos et voluptates est vero quis delectus atque inventore distinctio modi facere ullam vel voluptate, dignissimos aut recusandae at! Corrupti quas laudantium earum quasi obcaecati molestias deserunt soluta accusantium, placeat culpa adipisci eos, voluptates veritatis fuga alias perferendis necessitatibus, voluptas vero reiciendis quae dicta ut. Itaque alias quia natus nisi iusto illum animi quos tenetur qui vitae sunt, eum delectus totam debitis. Laboriosam esse dolor nisi hic aliquid dicta ut cum perferendis mollitia? Atque itaque amet officiis quos sit illum? Minus veritatis labore natus cum tenetur eius iste. Fugiat tempore deserunt numquam et, dolore suscipit. Eos corrupti illo error vel sint tempore ad culpa. Provident assumenda asperiores eos labore rem, exercitationem autem nihil eum totam veritatis cum recusandae, repellat mollitia explicabo sint omnis laudantium nam facilis! Porro id sunt labore rerum neque explicabo consectetur mollitia et. Dolorem molestias inventore natus illo quo, unde, quam nulla reiciendis voluptatibus, nisi nihil et voluptate. Necessitatibus natus maxime dolorem quasi autem optio nulla in nisi sequi et eius architecto, reprehenderit distinctio ipsam enim quo aperiam alias commodi ratione perferendis soluta atque quod nemo! Cumque, sequi? Eveniet provident, rem quibusdam suscipit corporis illo laboriosam ducimus labore adipisci!', 'https://source.unsplash.com/random/300×300/?ford-gt'),
('M008', 'Ferrari SF90', 'Ferrari', 'Sports', 3000000000, 95, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Reprehenderit inventore eaque corrupti laboriosam autem facere quibusdam alias excepturi illo fugiat sapiente quisquam, voluptas esse asperiores velit nulla ab ex delectus eligendi minima sit voluptatibus aspernatur, temporibus nobis. Commodi, optio iure quis accusantium ratione odit nulla tempora dolor expedita dignissimos perspiciatis unde molestias voluptate facere, officia ab at. Ad, delectus perspiciatis! Labore hic eligendi commodi iure aspernatur distinctio id, maiores beatae, esse quasi iste assumenda vel corrupti et consequuntur culpa vitae reprehenderit. Reiciendis eveniet labore, nostrum necessitatibus ut tempora, saepe perspiciatis maiores accusantium minima ducimus officiis voluptatem ipsam explicabo! Amet debitis tenetur ratione maiores eaque provident odit cumque accusamus eos et voluptates est vero quis delectus atque inventore distinctio modi facere ullam vel voluptate, dignissimos aut recusandae at! Corrupti quas laudantium earum quasi obcaecati molestias deserunt soluta accusantium, placeat culpa adipisci eos, voluptates veritatis fuga alias perferendis necessitatibus, voluptas vero reiciendis quae dicta ut. Itaque alias quia natus nisi iusto illum animi quos tenetur qui vitae sunt, eum delectus totam debitis. Laboriosam esse dolor nisi hic aliquid dicta ut cum perferendis mollitia? Atque itaque amet officiis quos sit illum? Minus veritatis labore natus cum tenetur eius iste. Fugiat tempore deserunt numquam et, dolore suscipit. Eos corrupti illo error vel sint tempore ad culpa. Provident assumenda asperiores eos labore rem, exercitationem autem nihil eum totam veritatis cum recusandae, repellat mollitia explicabo sint omnis laudantium nam facilis! Porro id sunt labore rerum neque explicabo consectetur mollitia et. Dolorem molestias inventore natus illo quo, unde, quam nulla reiciendis voluptatibus, nisi nihil et voluptate. Necessitatibus natus maxime dolorem quasi autem optio nulla in nisi sequi et eius architecto, reprehenderit distinctio ipsam enim quo aperiam alias commodi ratione perferendis soluta atque quod nemo! Cumque, sequi? Eveniet provident, rem quibusdam suscipit corporis illo laboriosam ducimus labore adipisci!', 'https://source.unsplash.com/random/300×300/?ferrari-sf90'),
('M009', 'Mitsubishi Lancer Evo', 'Mitsubishi', 'Sports', 3000000000, 90, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Reprehenderit inventore eaque corrupti laboriosam autem facere quibusdam alias excepturi illo fugiat sapiente quisquam, voluptas esse asperiores velit nulla ab ex delectus eligendi minima sit voluptatibus aspernatur, temporibus nobis. Commodi, optio iure quis accusantium ratione odit nulla tempora dolor expedita dignissimos perspiciatis unde molestias voluptate facere, officia ab at. Ad, delectus perspiciatis! Labore hic eligendi commodi iure aspernatur distinctio id, maiores beatae, esse quasi iste assumenda vel corrupti et consequuntur culpa vitae reprehenderit. Reiciendis eveniet labore, nostrum necessitatibus ut tempora, saepe perspiciatis maiores accusantium minima ducimus officiis voluptatem ipsam explicabo! Amet debitis tenetur ratione maiores eaque provident odit cumque accusamus eos et voluptates est vero quis delectus atque inventore distinctio modi facere ullam vel voluptate, dignissimos aut recusandae at! Corrupti quas laudantium earum quasi obcaecati molestias deserunt soluta accusantium, placeat culpa adipisci eos, voluptates veritatis fuga alias perferendis necessitatibus, voluptas vero reiciendis quae dicta ut. Itaque alias quia natus nisi iusto illum animi quos tenetur qui vitae sunt, eum delectus totam debitis. Laboriosam esse dolor nisi hic aliquid dicta ut cum perferendis mollitia? Atque itaque amet officiis quos sit illum? Minus veritatis labore natus cum tenetur eius iste. Fugiat tempore deserunt numquam et, dolore suscipit. Eos corrupti illo error vel sint tempore ad culpa. Provident assumenda asperiores eos labore rem, exercitationem autem nihil eum totam veritatis cum recusandae, repellat mollitia explicabo sint omnis laudantium nam facilis! Porro id sunt labore rerum neque explicabo consectetur mollitia et. Dolorem molestias inventore natus illo quo, unde, quam nulla reiciendis voluptatibus, nisi nihil et voluptate. Necessitatibus natus maxime dolorem quasi autem optio nulla in nisi sequi et eius architecto, reprehenderit distinctio ipsam enim quo aperiam alias commodi ratione perferendis soluta atque quod nemo! Cumque, sequi? Eveniet provident, rem quibusdam suscipit corporis illo laboriosam ducimus labore adipisci!', 'https://source.unsplash.com/random/300×300/?mitsubishi-lancer-evo');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_konsumen`
--
ALTER TABLE `tb_konsumen`
  ADD PRIMARY KEY (`nik`);

--
-- Indeks untuk tabel `tb_order`
--
ALTER TABLE `tb_order`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `nik_konsumen` (`nik_konsumen`,`id_produk`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indeks untuk tabel `tb_pegawai`
--
ALTER TABLE `tb_pegawai`
  ADD PRIMARY KEY (`nip`);

--
-- Indeks untuk tabel `tb_produk`
--
ALTER TABLE `tb_produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_order`
--
ALTER TABLE `tb_order`
  ADD CONSTRAINT `tb_order_ibfk_1` FOREIGN KEY (`nik_konsumen`) REFERENCES `tb_konsumen` (`nik`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_order_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `tb_produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
