<table class="table bordered striped hovered" align="center">
    <thead>
        <tr>
            <th>No.</th>
            <th>Cabang</th>
            <th>PR</th>
            <th>Barcode</th>
            <th>Nama Buku</th>
            <th>Status</th>
            <th>NoVA Siswa</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody  align="center">
        <?php 
        if($result != null){
            $i=1;
            foreach ($result as $row) { ?>

            <tr>
                <td><?php echo $i.'.';?></td><?php $i++;?>
                <td><?php echo $row->KodeAreaCabang .' - '. $row->NamaAreaCabang ?></td>
                <td><?php echo $row->PR ?></td>
                <td><?php echo $row->Barcode ?></td>
                <td><?php echo $row->NamaItem ?></td>
                <?php if($row->Status=='1') { ?>
            	<td>Sudah Digunakan</td>
                <?php } else { ?>
            	<td>Belum Digunakan</td>
                <?php } ?>
                <?php if($row->NoVA!='' AND $row->Status=='1') { ?>
            	<td><?php echo $row->NoVA ?></td>
                <?php } else { ?>
            	<td>-</td>
                <?php } ?>
                <td>
                    <?php if ($leveluser != '30') { ?>

                    <?php } else { ?>
                    <?php echo $this->tag->linkTo(array("barcodeinvalid/detail/" . $row->Barcode, "Detail", "target" => "_blank")); ?>
                    <?php } ?></td>
            </tr>

        <?php } 
        }
        else 
        {
        ?>
            <tr style="text-align:center;">
                <td colspan="7">- No Data -</td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>