<?php $this->load->view( 'common/meta', array( 'title' => 'Jam Absensi' ) ); ?><body><?php $this->load->view( 'common/header'); ?><div class="content enlarged">	<?php $this->load->view( 'common/sidebar'); ?>	  	<div class="mainbar">	    <div class="page-head">			<h2 class="pull-left button-back">Jam Absensi</h2>			<div class="clearfix"></div>		</div>			    <div class="matter"><div class="container">            <div class="row"><div class="col-md-12">								<div class="widget grid-main">					<div class="widget-head">						<div class="pull-left">&nbsp;</div>						<div class="widget-icons pull-right">							<a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a>							<a href="#" class="wclose"><i class="fa fa-times"></i></a>						</div>						<div class="clearfix"></div>					</div>					<div class="widget-content">						<table id="datatable" class="table table-striped table-bordered table-hover">							<thead>								<tr>									<th class="center">Jam Ke</th>									<th class="center">Jam Awal</th>									<th class="center">Jam Akhir</th>									<th class="center">Control</th></tr>							</thead>							<tbody></tbody>						</table>						<div class="widget-foot">							<br /><br />							<div class="clearfix"></div> 						</div>					</div>				</div>								<div class="widget hide" id="form-jam">					<div class="widget-head">						<div class="pull-left">Form Jam Absensi</div>						<div class="widget-icons pull-right">							<a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a>							<a href="#" class="wclose"><i class="fa fa-times"></i></a>						</div>						<div class="clearfix"></div>					</div>										<div class="widget-content">						<div class="padd"><form class="form-horizontal">							<input type="hidden" name="action" value="update" />							<input type="hidden" name="id" value="0" />														<div class="form-group">								<label class="col-lg-2 control-label">Jam Ke</label>								<div class="col-lg-10">									<input type="text" name="jam_ke" class="form-control" placeholder="Jam Ke" disabled="disabled" />								</div>							</div>							<div class="form-group">								<label class="col-lg-2 control-label">Jam Awal</label>								<div class="col-lg-10">									<input type="text" name="jam_awal" class="form-control" placeholder="Jam Awal" />								</div>							</div>							<div class="form-group">								<label class="col-lg-2 control-label">Jam Akhir</label>								<div class="col-lg-10">									<input type="text" name="jam_akhir" class="form-control" placeholder="Jam Akhir" />								</div>							</div>														<hr />							<div class="form-group">								<div class="col-lg-offset-2 col-lg-9">									<button type="submit" class="btn btn-info">Save</button>									<button type="button" class="btn btn-info btn-show-grid">Cancel</button>								</div>							</div>						</form></div>					</div>				</div>  							</div></div>        </div></div>    </div>	<div class="clearfix"></div></div><?php $this->load->view( 'common/footer' ); ?><?php $this->load->view( 'common/library_js'); ?><script>$(document).ready(function() {	var dt = null;	var page = {		show_grid: function() {			$('.grid-main').show();			$('#form-jam').hide();		},		show_form: function() {			$('.grid-main').hide();			$('#form-jam').show();		}	}		// global	$('.btn-show-grid').click(function() {		page.show_grid();	});		// grid	var param = {		id: 'datatable',		source: web.host + 'kepegawaian/absensi/jam_absensi/grid',		column: [ { sClass: "center" }, { sClass: "center" }, { sClass: "center" }, { bSortable: false, sClass: "center" } ],		callback: function() {			$('#datatable .btn-edit').click(function() {				var raw_record = $(this).siblings('.hide').text();				eval('var record = ' + raw_record);								Func.ajax({ url: web.host + 'kepegawaian/absensi/jam_absensi/action', param: { action: 'get_by_id', id: record.id }, callback: function(result) {					Func.populate({ cnt: '#form-jam', record: result });					page.show_form();				} });			});		}	}	dt = Func.datatable(param);		// form jam	$('#form-jam form').validate({		rules: {			jam_ke: { required: true },			jam_awal: { required: true },			jam_akhir: { required: true }		}	});	$('#form-jam form').submit(function(e) {		e.preventDefault();		if (! $('#form-jam form').valid()) {			return false;		}				Func.form.submit({			url: web.host + 'kepegawaian/absensi/jam_absensi/action',			param: Func.form.get_value('form-jam'),			callback: function(result) {				dt.reload();				page.show_grid();				$('#form-jam form')[0].reset();			}		});	});});</script></body></html>