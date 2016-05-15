<? $this->load->view('_head'); ?>
<? $this->load->view(active_module().'/_navbar'); ?>

<script>
var mID;
var oTable;

$(document).ready(function() {
	oTable = $('#table1').dataTable({
		/* "sScrollY": "380px", */
		"bScrollCollapse": true,
		"bPaginate": false,
		"bJQueryUI": true,
		"sDom": '<"toolbar">frtip',

		"aoColumnDefs": [
			{ "bSearchable": false, "bVisible": false, "aTargets": [ 0 ] }
		],
		"aoColumns": [
			null,
			{ "sWidth": "12%" },
			null,
			{ "sWidth": "16%" },
			{ "sWidth": "8%" , "sClass": "center"},
			{ "sWidth": "8%" },
		],
		"fnRowCallback": function (nRow, aData, iDisplayIndex) {
			$(nRow).on("click", function (event) {
				if ($(this).hasClass('row_selected')) {
					/* mID = '';
					$(this).removeClass('row_selected'); */
				} else {
					var data = oTable.fnGetData( this );
					mID = data[0];
					
					oTable.$('tr.row_selected').removeClass('row_selected');
					$(this).addClass('row_selected');
				}
			})
		},
		"bSort": true,
		"bInfo": false,
		"bProcessing": false,
		"sAjaxSource": "<?=active_module_url();?>users/grid"
	});

	$("div.toolbar").html('<div class="btn-group pull-left"><button id="btn_tambah" class="btn pull-left" type="button">Tambah</button><button id="btn_edit" class="btn pull-left" type="button">Edit</button> <button id="btn_delete" class="btn pull-left" type="button">Hapus</button></div>');

	$('#btn_tambah').click(function() {
		window.location = '<?=active_module_url();?>users/add/';
	});

	$('#btn_edit').click(function() {
		if(mID) {
			window.location = '<?=active_module_url();?>users/edit/'+mID;
		}else{
			alert('Silahkan pilih data yang akan diedit');
		}
	});

	$('#btn_delete').click(function() {
		if(mID) {
			var hapus = confirm('Hapus data ini?');
			if(hapus==true) {
				window.location = '<?=active_module_url();?>users/delete/'+mID;
			};
		}else{
			alert('Silahkan pilih data yang akan dihapus');
		}
	});
});

function update_unit(id, a) {
	var val = Number(a);
	$.ajax({
	  url: '<?php echo active_module_url()?>users/update_unit/' + id + '/' + val,
	  success: function(data) {
		/*  */
	  }
	});
}

function disable_user(id, a) {
	var val = Number(a);
	$.ajax({
	  url: '<?php echo active_module_url()?>users/disable_user/' + id + '/' + val,
	  success: function(data) {
		/*  */
	  }
	});
}
</script>

<div class="content">
    <div class="container-fluid">
		<ul class="nav nav-tabs">
			<li class="active">
				<a href="#"><strong>USERS</strong></a>
			</li>
		</ul>
		
		<?=msg_block();?>
		
		<table class="table" id="table1">
			<thead>
				<tr>
					<th>Index</th>
					<th>User ID</th>
					<th>Nama</th>
					<th>Jabatan</th>
					<th>Disabled</th>
					<th>Tgl. Input</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
</div>
<? $this->load->view('_foot'); ?>