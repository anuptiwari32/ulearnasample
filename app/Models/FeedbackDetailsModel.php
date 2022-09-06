<?php

namespace App\Models;

use CodeIgniter\Model;

class FeedbackDetailsModel extends Model
{
    protected $table = 'feedback_details';
    protected $allowedFields = [
        'feedback_id',
        'trainer_id',
        'number',
        'weight',
        'status',     
        'created_at',
        'updated_at',
    ];
    
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    //protected $returnType     = 'array';
    //protected $useSoftDeletes = true;

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
   // protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function getFeedbackDetails(int $id) {
		// $recordsTotal = $this->select('feedback_details.*');		
		// $recordsTotal = $recordsTotal->countAllResults();

		return $this->where('feedback_id',$id)
			->select('feedback_details.*,
            trainer.fullname AS trainer')
            ->join('users AS trainer', 'trainer.id = feedback_details.trainer_id', 'left')
			->orderBy('feedback_details.id')->findAll();

	}

}
