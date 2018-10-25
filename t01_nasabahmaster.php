<?php

// id
// Nama
// No_Telp_Hp
// Pekerjaan
// Pekerjaan_No_Telp_Hp

?>
<?php if ($t01_nasabah->Visible) { ?>
<!-- <h4 class="ewMasterCaption"><?php echo $t01_nasabah->TableCaption() ?></h4> -->
<table id="tbl_t01_nasabahmaster" class="table table-bordered table-striped ewViewTable">
<?php echo $t01_nasabah->TableCustomInnerHtml ?>
	<tbody>
<?php if ($t01_nasabah->id->Visible) { // id ?>
		<tr id="r_id">
			<td><?php echo $t01_nasabah->id->FldCaption() ?></td>
			<td<?php echo $t01_nasabah->id->CellAttributes() ?>>
<span id="el_t01_nasabah_id">
<span<?php echo $t01_nasabah->id->ViewAttributes() ?>>
<?php echo $t01_nasabah->id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t01_nasabah->Nama->Visible) { // Nama ?>
		<tr id="r_Nama">
			<td><?php echo $t01_nasabah->Nama->FldCaption() ?></td>
			<td<?php echo $t01_nasabah->Nama->CellAttributes() ?>>
<span id="el_t01_nasabah_Nama">
<span<?php echo $t01_nasabah->Nama->ViewAttributes() ?>>
<?php echo $t01_nasabah->Nama->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t01_nasabah->No_Telp_Hp->Visible) { // No_Telp_Hp ?>
		<tr id="r_No_Telp_Hp">
			<td><?php echo $t01_nasabah->No_Telp_Hp->FldCaption() ?></td>
			<td<?php echo $t01_nasabah->No_Telp_Hp->CellAttributes() ?>>
<span id="el_t01_nasabah_No_Telp_Hp">
<span<?php echo $t01_nasabah->No_Telp_Hp->ViewAttributes() ?>>
<?php echo $t01_nasabah->No_Telp_Hp->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t01_nasabah->Pekerjaan->Visible) { // Pekerjaan ?>
		<tr id="r_Pekerjaan">
			<td><?php echo $t01_nasabah->Pekerjaan->FldCaption() ?></td>
			<td<?php echo $t01_nasabah->Pekerjaan->CellAttributes() ?>>
<span id="el_t01_nasabah_Pekerjaan">
<span<?php echo $t01_nasabah->Pekerjaan->ViewAttributes() ?>>
<?php echo $t01_nasabah->Pekerjaan->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t01_nasabah->Pekerjaan_No_Telp_Hp->Visible) { // Pekerjaan_No_Telp_Hp ?>
		<tr id="r_Pekerjaan_No_Telp_Hp">
			<td><?php echo $t01_nasabah->Pekerjaan_No_Telp_Hp->FldCaption() ?></td>
			<td<?php echo $t01_nasabah->Pekerjaan_No_Telp_Hp->CellAttributes() ?>>
<span id="el_t01_nasabah_Pekerjaan_No_Telp_Hp">
<span<?php echo $t01_nasabah->Pekerjaan_No_Telp_Hp->ViewAttributes() ?>>
<?php echo $t01_nasabah->Pekerjaan_No_Telp_Hp->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
<?php } ?>
