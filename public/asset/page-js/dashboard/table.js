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

    $('input[type=search]').keypress(function (e) {
		if (e.which == 13) {
			table.search( $(this).val() ).draw();
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

    $(document).on('change','.filter', function(){
        table.ajax.reload(null,false);
    })
});
