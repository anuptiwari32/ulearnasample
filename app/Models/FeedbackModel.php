<?php

namespace App\Models;

use CodeIgniter\Model;

class FeedbackModel extends Model
{
    protected $table = 'feedbacks';
    protected $allowedFields = [
        'candidate_id',
        'trainer_id',
        'number',
        'final_score',
        'status',
        'reason',
        'created_at',     
        'updated_at' ,     
        'deleted_at'  ];
    
    
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    //protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;



    public function getAllFeedbacks() {
		// $recordsTotal = $this->select('feedbacks.*');
		// $recordsTotal = $recordsTotal->countAllResults();
		$feedbacks = $this
			->select('feedbacks.*,
            candidate.fullname AS candidate,
            trainer.fullname AS trainer')
			// ->groupStart()
			// ->orLike('_warehouse.name', $this->dtSearch)
			// ->groupEnd()
			->join('users AS candidate', 'candidate.id = feedbacks.candidate_id', 'left')
            ->join('users AS trainer', 'trainer.id = feedbacks.trainer_id', 'left')

			// ->orderBy($this->dtOrderBy, $this->dtOrderDir)
			// ->limit($this->dtLength, $this->dtStart)
			->orderBy('feedbacks.id');

		// Should we limit by warehouse?
		// if($limitByWarehouses)
		// 	$adjustments = $this->restrictQueryByIds($adjustments, 'inventov2_adjustments.warehouse_id', $warehouseIds);

		$recordsFiltered = $feedbacks->countAllResults(false);
		$data = $feedbacks->findAll();

		return [
			'recordsFiltered' => $recordsFiltered,
			'data' => $data
		];
	}
    

    
    

    

/**
	 * This function will restrict a query, so that $column only has
	 * the values provided in the $ids array
	 */
	private function restrictQueryByIds($query, string $column, array $ids) {
		if(count($ids) == 0)
			$query->where('1=0', null, false);
		else{
			$query->groupStart();
			foreach($ids as $id)
				$query->orWhere($column, $id);
			$query->groupEnd();
		}

		return $query;
	}
}


