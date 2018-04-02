/*query migrate album foto*/
INSERT INTO web_posting (id_old, wp_title, wp_date, wp_content, wm_id)
SELECT id, judul, tanggal, keterangan, CONCAT('3') AS wm_id FROM albumfoto

/*query migrate foto to attachment*/
INSERT INTO web_attachment (wp_id, wa_name, wa_description, wa_filename, wa_fullpath)
SELECT (SELECT wp_id FROM web_posting WHERE id_old=idtema)AS wp_id, judul, keterangan, path, 
CONCAT('uploaded/website/', path) AS fullpath 
FROM foto

/*query migrate artikel*/
INSERT INTO web_posting (wp_title, wp_date, wp_category, wp_subtitle, wp_content, wm_id)
SELECT judul, tanggal, kategori, ringkasan, isi, CONCAT('1') AS wm_id FROM artikel
/*
kategori artikel
1. static = 8
2. komisioner = 9
*/
UPDATE web_posting SET wp_category=8 WHERE wp_category=1 AND wm_id=1
UPDATE web_posting SET wp_category=8 WHERE wp_category IN(5,0) AND wm_id=1
UPDATE web_posting SET wp_category=9 WHERE wp_category=2 AND wm_id=1

/*migrate berita*/
INSERT INTO web_posting (wp_title, wp_date, wp_category, wp_subtitle, wp_content, wm_id)
SELECT judul, tanggal, kategori, ringkasan, isi, CONCAT('2') AS wm_id FROM berita

/*migrate video*/
INSERT INTO web_posting (wp_title, wp_content, wp_subtitle, wp_date, wp_source, wm_id)
SELECT judul, keterangan, deskripsi, tanggal, url, CONCAT('4') AS wm_id FROM video

/*migrate penerbitan/publikasi*/
INSERT INTO web_posting (wp_title, wp_date, wp_content, wp_category, wp_images, wm_id)
SELECT judul,tanggal, deskripsi, CONCAT('3') AS wp_category, filename , CONCAT('6') AS wm_id FROM publikasi 
WHERE jenis='newsletter'

INSERT INTO web_posting (wp_title, wp_date, wp_content, wp_category, wp_images, wm_id)
SELECT judul,tanggal, deskripsi, CONCAT('4') AS wp_category, filename , CONCAT('6') AS wm_id FROM publikasi 
WHERE jenis='jurnal'

INSERT INTO web_posting (wp_title, wp_date, wp_content, wp_category, wp_images, wm_id)
SELECT judul,tanggal, deskripsi, CONCAT('5') AS wp_category, filename , CONCAT('6') AS wm_id FROM publikasi 
WHERE jenis='klipping'

INSERT INTO web_posting (wp_title, wp_date, wp_content, wp_category, wp_images, wm_id)
SELECT judul,tanggal, deskripsi, CONCAT('6') AS wp_category, filename , CONCAT('6') AS wm_id FROM publikasi 
WHERE jenis='buku'

INSERT INTO web_posting (wp_title, wp_date, wp_content, wp_category, wp_images, wm_id)
SELECT judul,tanggal, deskripsi, CONCAT('7') AS wp_category, filename , CONCAT('6') AS wm_id FROM publikasi 
WHERE jenis='makalah'

/*query for update web_agenda_sidang*/
INSERT INTO web_agenda_sidang (was_no_perkara, was_pokok_perkara, was_pengadu, was_teradu, was_nama_agenda, was_tanggal_sidang)
SELECT noperkara, pokokperkara, pemohon, teradu, acara, tanggal FROM sidang
UPDATE web_agenda_sidang SET was_type=1, is_active='Y', is_publish='Y', is_deleted='N', created_by='migration'

/*query for update web_putusan*/
INSERT INTO web_putusan (wps_title, wps_subtitle, wps_tanggal, wps_size, wps_kategori, wps_deskripsi, wps_lampiran)
SELECT title, subtitle, date_upload, file_size, category, description, filename FROM putusan

UPDATE web_putusan SET is_active='Y', is_publish='Y', is_deleted='N', created_by='migration'

/*query for update web_pengaduan*/
INSERT INTO web_pengaduan (wpg_nomor, wpg_tanggal, wpg_teradu, wpg_pengadu, wpg_pokok_perkara, wpg_alat_bukti, wpg_hasil, wpg_keterangan)
SELECT nomor, tanggal, teradu, pengadu, pokokperkara, alatbukti, hasil, keterangan FROM pengaduan

UPDATE web_pengaduan SET is_active='Y', is_deleted='N', created_by='migration'

/*update status web_posting*/
UPDATE web_posting SET wp_author='DKPP', is_active='Y', is_publish='Y', is_deleted='N', created_by='migration'














