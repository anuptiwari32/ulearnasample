

<?= $this->extend('_layouts/_layouts') ?>
<?= $this->section('content') ?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Feedback</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Feedback</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit Details</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <form id="calcform" autocomplete="off" method="POST" action="<?=base_url('/feedback-update')?>">
                        <?php if(count($feedbacks)>0) { ?>
                            <input type="hidden" name="feedback_id" value="<?=$feedbacks[0]['feedback_id']?>">
                            <?php }?>    
                        <div class="form-group">
                                <table id="tbl" class="table table-bordered table-hover">
                                    <tbody>
                                        <tr>
                                            <td>Trainer<br>(optional)</td>
                                            <td style="display: table-cell;">Number (Out of 10)</td>
                                            <td>Weight</td>
                                        </tr>
                                        <?php
                                        foreach ($feedbacks as $feedback) {
                                        ?>

                                            <tr>
                                                <td><select name="trainer[]" class="form-control trainer">
                                                        <option value="0">Select Trainer</option>
                                                        <?php foreach ($trainers as $trainer) { ?>
                                                            <option value="<?= $trainer['id'] ?>" <?= $trainer['id'] == $feedback['trainer_id']?'selected':'' ?>><?= $trainer['fullname'] ?></option>
                                                        <?php } ?>
                                                    </select></td>
                                                <td style="display: table-cell;"><input type="number" name="grade[]" min="0" step="any" class="form-control number" value="<?= $feedback['number'] ?>" placeholder="Enter number out of ten e.g 8" required>
                                            <small class="text-muted">Please enter a number out of 10 </small></td>
                                                <td><input type="number" name="weight[]" min="0" step="0.1" max="1" class="form-control weight" value="<?= $feedback['weight'] ?>" required></td>
                                                <input type='hidden' name='fd_id[]' value="<?=$feedback['id']?>">

                                            </tr>
                                        <?php } ?>

                                    </tbody>
                                </table>
                            </div>
                            <div class="form-group">
                            <button type="button" id="addrow" title="Add row"  class="btn btn-light btn-sm btn-block addmore"><span>+</span> Add row</button>                                  <!--  onclick="AddRow()" -->
                            </div>
                            <!-- <input type="submit" value="Submit"> -->
                            <button type="button" id="submit_btn"   class="btn btn-success">Submit</button>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</section>
<input type="hidden" name="fd_id" value="0">
<?= $this->endSection() ?>

<?= $this->section('script') ?>

<script>
    function roundresult(x) {
        var y = parseFloat(x);
        y = roundnum(y, 10);
        return y;
    }
var rp=<?=count($feedbacks)?>;
function validate(){
    var $valid = true;
    var trainer=[]; var grade=[]; var weight =[];
            
    for(var i=0; i<rp; i++)
            {
                var k=i+2;
                var select = "#tbl>tbody>tr:nth-child("+k+")>td:nth-child(1)>select";
                trainer[i] = document.querySelector(select).value;
                grade[i] = document.querySelector("#tbl>tbody>tr:nth-child("+k+")>td:nth-child(2)>input").value;
                weight[i] = document.querySelector("#tbl>tbody>tr:nth-child("+k+")>td:nth-child(3)>input").value;
                
                 if(trainer[i]=='0')
                $valid = false;
                
                if(grade[i]==''||grade[i]=='0')
                $valid = false;
                if(weight[i]==''||weight[i]=='0')
                $valid = false;
               
            }
            return $valid;

        }
    $(function() {

       // 'use strict'


$(".addmore").on('click',function(){
	//count=$('table tr').length;
    var train_row = '';
        <?php foreach ($trainers as $trainer) { ?>
                                                          train_row+="\<option value='<?= $trainer['id'] ?>' <?= $trainer['id'] == $feedback['trainer_id'] ?>><?= $trainer['fullname'] ?></option>";
                                                        <?php } ?>
                                                        var data = "<tr>\<td><select name='trainer[]' class='form-control'><option value='0'>Select Trainer</option>"+train_row+"</select></td>\
         <td><input type='number' name='grade[]' min='0' step='1' max='10' class='form-control'><small class='text-muted'>Please enter a number out of 10 </small></td>\
         <td><input type='number' name='weight[]' min='0' step='0.1' max='1' class='form-control'></td>\<input type='hidden' name='fd_id[]' value='0'>\
      </tr>";
    $('table').append(data);
	rp++;
});
$('#submit_btn').on('click',function(evt){
    if(!validate()) {
        alert('please check your inputs');
        return false;
    }else 
    $('#calcform').submit();
});
    })
</script>
<?= $this->endSection() ?>