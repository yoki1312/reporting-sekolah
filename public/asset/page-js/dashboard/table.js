$(document).ready(function () {
	$('.id_jabatan').select2({})
   let table = $('#dt-hasil').DataTable({
        "autoWidth": false,
		"responsive": false,
		"scrollCollapse": true,
		"processing": true,
		"serverSide": true,
		"displayLength": 10,
		"paginate": false,
		"lengthChange": false,
		"filter": true,
		"dom": 'lrtip',
		"sort": true,
		"info": false,
        ajax: {
            url :  baseurl + 'dashboard/hasil_ujian',
            data: function (d) {
                d.id_kecamatan = $('.id_kecamatan').val();
                d.id_sekolah = $('.id_sekolah').val();
                d.id_kategori_ujian = $('.id_bidang_all').val();
                d.id_jabatan = $('.id_jabatan').val();
                d.id_jenjang = $('.id_jenjang').val();
                return d;
            }
        },
        columns: [{
                data: 'id_user',
                orderable: false,
                searchable: false,
                className:'text-center',
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {
                data: 'nama_sekolahan',
                className:'text-left'
            },
            {
                data: 'nama_jenjang',
                className:'text-center'
            },
            {
                data: 'nama_kecamatan',
                className:'text-center'
            },
            {
                data: 'nilai_rata_rata',
                className:'text-center'
            },

        ],
        order: [[4, 'desc']],

    });
   let tableGuru = $('#dt-hasil-guru').DataTable({
        "autoWidth": false,
		"responsive": false,
		"scrollCollapse": true,
		"processing": true,
		"serverSide": true,
		"displayLength": 10,
		"paginate": false,
		"lengthChange": false,
		"filter": true,
		"dom": 'lrtip',
		"sort": true,
		"info": false,
        ajax: {
            url :  baseurl + 'dashboard/hasil_ujian_guru',
            data: function (d) {
                d.id_kecamatan = $('.sec-guru').find('.id_kecamatan').val();
                d.id_sekolah = $('.sec-guru').find('.id_sekolah').val();
                d.id_jabatan = 1;
                d.id_kategori_ujian =  $('.sec-guru').find('.id_bidang_guru').val();
                d.id_jenjang = $('.sec-guru').find('.id_jenjang').val();
                return d;
            }
        },
        columns: [{
                data: 'id_user',
                orderable: false,
                searchable: false,
                className:'text-center',
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {
                data: 'nama_user',
                className:'text-left'
            },
            {
                data: 'nama_sekolahan',
                className:'text-left'
            },
            {
                data: 'nama_jenjang',
                className:'text-center'
            },
            {
                data: 'nama_kecamatan',
                className:'text-center'
            },
            {
                data: 'nilai_rata_rata',
                className:'text-center'
            },

        ],
        order: [[4, 'desc']],

    });
   let tableKepsek = $('#dt-hasil-kepsek').DataTable({
        "autoWidth": false,
		"responsive": false,
		"scrollCollapse": true,
		"processing": true,
		"serverSide": true,
		"displayLength": 10,
		"paginate": false,
		"lengthChange": false,
		"filter": true,
		"dom": 'lrtip',
		"sort": true,
		"info": false,
        ajax: {
            url :  baseurl + 'dashboard/hasil_ujian_guru',
            data: function (d) {
                d.id_kecamatan = $('.sec-kepsek').find('.id_kecamatan').val();
                d.id_sekolah = $('.sec-kepsek').find('.id_sekolah').val();
                d.id_jabatan = 2;
                d.id_kategori_ujian = $('.sec-kepsek').find('.id_bidang_kepsek').val();
                d.id_jenjang = $('.sec-kepsek').find('.id_jenjang').val();
                return d;
            }
        },
        columns: [{
                data: 'id_user',
                orderable: false,
                searchable: false,
                className:'text-center',
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {
                data: 'nama_user',
                className:'text-left'
            },
            {
                data: 'nama_sekolahan',
                className:'text-left'
            },
            {
                data: 'nama_jenjang',
                className:'text-center'
            },
            {
                data: 'nama_kecamatan',
                className:'text-center'
            },
            {
                data: 'nilai_rata_rata',
                className:'text-center'
            },

        ],
        order: [[4, 'desc']],

    });

    let tableRata2 = $('#dt-hasil-nilai-rata2').DataTable({
        "autoWidth": false,
		"responsive": false,
		"scrollCollapse": true,
		"processing": true,
		"serverSide": true,
		"displayLength": 10,
		"paginate": true,
		"lengthChange": true,
		"filter": true,
		"dom": 'lrtip',
		"sort": true,
		"info": true,
        ajax: {
            url :  baseurl + 'dashboard/hasil_ujian_rata2',
            data: function (d) {
                d.id_kecamatan = $('.sec-nilai-rata2').find('.id_kecamatan').val();
                d.id_sekolah = $('.sec-nilai-rata2').find('.id_sekolah').val();
                d.id_jabatan = $('.sec-nilai-rata2').find('.id_jabatan').val();
                d.id_jenjang = $('.sec-nilai-rata2').find('.id_jenjang').val();
                d.id_kategori_ujian = $('.sec-nilai-rata2').find('.id_bidang_all').val();
                return d;
            }
        },
        columns: [{
                data: 'id_user',
                orderable: false,
                searchable: false,
                className:'text-center',
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {
                data: 'nama_sekolahan',
                className:'text-left'
            },
            {
                data: 'nama_jenjang',
                className:'text-center'
            },
            {
                data: 'nama_kecamatan',
                className:'text-center'
            },
            {
                data: 'nilai_rata_rata',
                className:'text-center'
            },

        ],
        order: [[4, 'desc']],

    });

    $('input[name=search-guru]').keypress(function (e) {
		if (e.which == 13) {
			tableGuru.search( $(this).val() ).draw();
		}
	});
    $('input[name=search-kepsek]').keypress(function (e) {
		if (e.which == 13) {
			tableKepsek.search( $(this).val() ).draw();
		}
	});
    $('input[name=search-peringkat]').keypress(function (e) {
		if (e.which == 13) {
			table.search( $(this).val() ).draw();
		}
	});
    $('.sec-nilai-rata2').find('input[type=search]').keypress(function (e) {
		if (e.which == 13) {
			tableRata2.search( $(this).val() ).draw();
		}
	});
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
	$('.id_jenjang').select2({
		placeholder: 'Pilih Jenjang',
		allowClear: true,
		ajax: {
			dataType: "json",
			method: 'POST',
			url: baseurl + "referensi/jenjangSelect2",
			delay: 300,
			processResults: function (data) {
				return {
					results: data.map(function (item) {
						item.id = item.id_jenjang;
						item.text = item.nama_jenjang;
						return item;
					})
				};
			},
		},
		escapeMarkup: function (m) {
			return m;
		}
	});

    $('.id_kecamatan').select2({
		placeholder: 'Pilih Kecamatan',
		allowClear: true,
		ajax: {
			dataType: "json",
			method: 'POST',
			url: baseurl + "referensi/kecamatanSelect2",
			delay: 300,
			processResults: function (data) {
				return {
					results: data.map(function (item) {
						item.id = item.id_kecamatan;
						item.text = item.nama_kecamatan;
						return item;
					})
				};
			},
		},
		escapeMarkup: function (m) {
			return m;
		}
	});
    $('.id_sekolah').select2({
		placeholder: 'Pilih Sekolah',
		allowClear: true,
		ajax: {
			dataType: "json",
			method: 'POST',
			url: baseurl + "referensi/sekolahSelect2",
			delay: 300,
			processResults: function (data) {
				return {
					results: data.map(function (item) {
						item.id = item.id_sekolahan;
						item.text = item.nama_sekolahan;
						return item;
					})
				};
			},
		},
		escapeMarkup: function (m) {
			return m;
		}
	});

    $('.id_bidang_guru').select2({
		placeholder: 'Pilih Bidang',
		allowClear: true,
		ajax: {
			dataType: "json",
			method: 'POST',
            data : {
                id_jabatan : 1
            },
			url: baseurl + "referensi/bidangSelect2",
			delay: 300,
			processResults: function (data) {
				return {
					results: data.map(function (item) {
						item.id = item.id_kategori_ujian;
						item.text = item.nama_kategori_ujian;
						return item;
					})
				};
			},
		},
		escapeMarkup: function (m) {
			return m;
		}
	});

    $('.id_bidang_kepsek').select2({
		placeholder: 'Pilih Bidang',
		allowClear: true,
		ajax: {
			dataType: "json",
			method: 'POST',
            data : {
                id_jabatan : 2
            },
			url: baseurl + "referensi/bidangSelect2",
			delay: 300,
			processResults: function (data) {
				return {
					results: data.map(function (item) {
						item.id = item.id_kategori_ujian;
						item.text = item.nama_kategori_ujian;
						return item;
					})
				};
			},
		},
		escapeMarkup: function (m) {
			return m;
		}
	});
    $('.id_bidang_all').select2({
		placeholder: 'Pilih Bidang',
		allowClear: true,
		ajax: {
			dataType: "json",
			method: 'POST',
			url: baseurl + "referensi/bidangSelect2",
			delay: 300,
			processResults: function (data) {
				return {
					results: data.map(function (item) {
						item.id = item.id_kategori_ujian;
						item.text = item.nama_kategori_ujian;
						return item;
					})
				};
			},
		},
		escapeMarkup: function (m) {
			return m;
		}
	});

    $(document).on('change','.filter', function(){
        table.ajax.reload(null,false);
    })
    $(document).on('change','.filter-guru', function(){
        tableGuru.ajax.reload(null,false);
    })
    $(document).on('change','.filter-kepsek', function(){
        tableKepsek.ajax.reload(null,false);
    })
    $(document).on('change','.filter-nilai-rata2', function(){
        tableRata2.ajax.reload(null,false);
    })
});
