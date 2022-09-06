<?= $this->extend('_layouts/_layouts') ?>
<?= $this->section('content') ?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Dashboard</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Feedbacks</li>
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
                        <h3 class="card-title">DataTable with default features</h3>
                    </div>
                <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th> #</th>
                                <th>Candidate Name</th>
                                <th>Number</th>
                                <th>Feebacks</th>
                                <th>Final Score</th>
                                <th>Evaluate</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php $n = 0; 
                                foreach($feedbacks['data'] as $feedback) {?>
                                <tr>
                                    <td><?= ++$n ?></td>
                                    <td><?= $feedback['candidate'] ?></td>
                                    <td><?= $feedback['number'] ?></td>
                                    <td><a href='<?=base_url().'/feedback-edit/'.$feedback['id']?>' class="btn btn-sm btn-info"><i class="fas fa-eye" title="edit"></i></a></td>
                                    <td><?= $feedback['final_score'] ?></td>
                                    <td>
                                        <select name="" class="form-control" id="evaluate<?=$n?>" onchange="return handleChange(event,this,<?=$feedback['id']?>)">
                                    <option value="on hold" <?=$feedback['status']=='on hold'?'selected':''?>>On Hold</option>
                                    <option value="passed" <?=$feedback['status']=='passed'?'selected':''?>>Passed</option>
                                    <option value="failed" <?=$feedback['status']=='failed'?'selected':''?>>Failed</option>
                                    </select>
                                </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</section>
<?php if (session()->getFlashdata('msg')) : ?>
  <?= session()->getFlashdata('msg') ?>
<?php endif; ?>
<?= $this->endSection() ?>

<?= $this->section('script') ?>

<?= $this->include('feedback/script') ?>
<script>
  $(function() {
    toastr.options.timeOut = 0;
    toastr.options.extendedTimeOut = 0;
    toastr.options.onclick = null;
    var error = $('.errors').html();
    if (error) {
      toastr.error(error)
      $('.errors').hide();
      $('a.resend').click(function() {

      })
    }
    var success = $('.success').html();
    if (success) {
      toastr.success(success);
      $('.success').hide();
    }
    
  });
  const handleChange =(event,elem,id)=>{

    let reason='';
    if($(elem).val()=='on hold')
        {
             reason =prompt('Please confirm reason for keeping on hold','Having poor marks');
        }
    let data = {'status':$(elem).val(),'reason':reason};
    $.ajax({type:"POST",
            url:'<?=base_url()?>'+'/feedback-update-status/'+id,
            data:data,
            success:function(data){
                if(data.success)
                alert(data.message);
            }
            ,error:function(){
                alert('Operation failed');
            }
    });
}
</script>

<?= $this->endSection() ?>