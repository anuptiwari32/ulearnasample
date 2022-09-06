<?php

namespace App\Controllers;
use CodeIgniter\I18n\Time;

class Home extends TamhorAuth
{
	/**
	 * method to load index
	*/
	public function index()
	{
		$feedbacks = $this->feedbacks->getAllFeedbacks();
		return view('feedback/index',['feedbacks'=>$feedbacks]);
	}

	/**
	 * method to render the view file for editing 
	*/
	public function edit($id)
	{
		$feedbacks = $this->feedbackDetails->getFeedbackDetails($id);
		$trainers = $this->users->where('role','3')->where('is_active',1)->findAll();

		return view('feedback/edit',['feedbacks'=>$feedbacks,'trainers'=>$trainers]);
	}

	/**
	 * method to update the given feedback details
	*/
	public function update()
	{
		$trainers = $this->request->getVar('trainer');
		$fds = $this->request->getVar('fd_id');
		$feedback_id = $this->request->getVar('feedback_id');
		$grade = $this->request->getVar('grade');
		$weight = $this->request->getVar('weight');
		$n=0;
		$gross_weight = 0;
		foreach($trainers as $trainer)
		{
			$feedback  = $this->feedbackDetails->find($fds[$n]);
			
			$data = ['trainer_id'=>$trainer,
			'number'=>$grade[$n],'weight'=>$weight[$n],'updated_at'=>Time::now()];
			if(isset($feedback) && count($feedback)>0)
			$this->feedbackDetails->update($fds[$n],$data);
			else
			{
				$data['feedback_id']=$feedback_id;
				$data['created_at']=Time::now();
				$this->feedbackDetails->save($data);
			}
			$gross_weight+= $grade[$n]*$weight[$n];
			$n++;
			
		}

		$final_score = round($gross_weight/array_sum($weight),2);
		$fdata = ['number'=> array_sum($grade),'final_score'=>$final_score,'updated_at'=>Time::now()];
		$update_ok = $this->feedbacks->update($feedback_id,$fdata);
		$this->session->setFlashdata('msg', $this->success(
			"Record updated.",
			"This record been updated."
		));
		return redirect()->to('/');

	}

	public function updateStatus($id)
	{
		$status = $this->request->getVar('status');
		$reason = $this->request->getVar('reason');
		
		$fdata = ['status'=>$status,'reason'=>$reason,'updated_at'=>Time::now()];
		$update_ok = $this->feedbacks->update($id,$fdata);
		$this->session->setFlashdata('msg', $this->success(
			"Record updated.",
			"This record been updated."
		));
		$data = [
			'success' => true,
			'id'      => $id,
			'message'=>'Record updated successfully'
		];
		
		return $this->response->setJSON($data);
	}

	//--------------------------------------------------------------------

}
