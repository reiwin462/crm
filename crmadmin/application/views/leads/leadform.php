<div class="row">
   <?php foreach($structure as $field => $val): ?>
   <input type="hidden" name="id"></input>
   <?php if($val['field_type'] == "TEXT"): ?>
   <div class="col-md-3" >
      <div class="form-group">
         <label for="<?php echo $val['field_name']; ?>"><?php echo strtoupper(str_replace("_", " ", $val['field_name'])); ?></label>
         <input type="text" class="form-control" id="<?php echo $val['field_name']; ?>" placeholder="<?php echo $val['field_name']; ?>" name="<?php echo $val['field_name']; ?>" value="<?php echo $val['field_default']; ?>"  <?php if($val['field_required'] == 1){echo "required"; }?> ></input>
      </div>
   </div>
   <?php elseif($val['field_type'] == "DROPDOWN"): ?>
   <div class="col-md-3">
      <div class="form-group">
         <label for="<?php echo $val['field_name']; ?>"><?php echo strtoupper(str_replace("_", " ", $val['field_name'])); ?></label>
         <select class="form-control" id="<?php echo $val['field_name']; ?>" name="<?php echo $val['field_name']; ?>" >
            <?php foreach($val['field_subitems'] as $item): ?>
            <option value="<?php echo $item['description']; ?>"><?php echo $item['description']; ?></option>
            <?php endforeach; ?>
         </select>
         <div class="text-right addnew">
            <a href="#" onclick="shwmodal('<?php echo $val['field_name']; ?>');" ><i class="fa fa-plus" aria-hidden="true"></i> Add Item!</a>
         </div>
      </div>
   </div>
   <?php elseif($val['field_type'] == "TEXTAREA"): ?>
   <div class="col-md-12">
      <div class="form-group">
         <label for="<?php echo $val['field_name']; ?>"><?php echo strtoupper(str_replace("_", " ", $val['field_name'])); ?></label>
         <textarea class="form-control" id="<?php echo $val['field_name']; ?>" placeholder="<?php echo $val['field_name']; ?>" name="<?php echo $val['field_name']; ?>"  <?php if($val['field_required'] == 1){echo "required"; }?>><?php echo $val['field_default']; ?> </textarea>
      </div>
   </div>
   <?php elseif($val['field_type'] == "DATE "): ?>
   <div class="col-md-3">
   </div>
   <?php endif;  ?>
   <?php endforeach; ?>
</div>