<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Populations Controller
 *
 * @property \App\Model\Table\PopulationsTable $Populations
 */
class PopulationsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
    	$conditions = [];
    	if ($this->request->is('ajax')) {
    		$this->viewBuilder()->layout('ajax');
    		// $this->autoRender = false;
    		$this->viewBuilder()->template('../element/ajaxtable');
    	}
    	if($this->request->data) {
    		$prefecture_id  = $this->request->data['prefecture_id'];
			$year			 = $this->request->data['year'];
			if($prefecture_id) {
				$conditions['prefecture_id'] = $prefecture_id;
			}
			if($year) {
				$conditions['year'] = $year;
			}
    	}		
        $this->paginate = [
            'contain' => ['Prefectures'],
            'conditions'   => $conditions
        ];
        $populations = $this->paginate($this->Populations);
		
		$prefectures = $this->Populations->Prefectures->find('list')->order('id');
		$years		 = $this->Populations->find('list', ['keyField' => 'year', 'valueField' => 'year'])->group('year');

        $this->set(compact('populations', 'prefectures', 'years'));
        $this->set('_serialize', ['populations']);
    }

    /**
     * Import method
     */
    public function import()
    {
    	if($this->request->is('post') && !empty($this->request->data['file']['name'])) {
			// upload file	
			$file = $this->request->data['file'];
			$allowed_type = array('text/csv');
			
			$filename = WWW_ROOT . 'uploads/' . $file['name'];
			if (in_array($file['type'], $allowed_type)) {
				move_uploaded_file($file['tmp_name'], $filename);
			}
			
			// read file
			$handle = fopen($filename, "r");
			
			//skip the 1st and 2nd row
			fgetcsv($handle);
			fgetcsv($handle);
			
			// read the years from 3rd row
			$years = fgetcsv($handle);
			
		    // read each data row in the file
		    // and prepare data for prefectures and populations table
		    $i = 0;
		    while ( ($row = fgetcsv($handle)) !== FALSE )
		    {
		        $i++;
		        foreach ($years as $key => $year) {
		
		            if ($key == 0) {
		                $prefectures[] = array('name' => (isset($row[$key])) ? $row[$key] : '' );
		                continue;
		            }
		
		            $populations[] = array(
		            	'prefecture_id' => $i,
		            	'year'			=> $year,
		            	'count'			=> $row[$key],
					);  
		        }   
		    }
		
		    // close the file
		    fclose($handle); 
	        try {
	        	$Prefectures = $this->Populations->Prefectures->newEntities($prefectures);
	            foreach ($Prefectures as $prefecture) {
					$this->Populations->Prefectures->save($prefecture);
	            }
	
	            $Populations = $this->Populations->newEntities($populations);
				foreach ($Populations as $population) {
					$this->Populations->save($population);
				}
				$this->Flash->success(__('CSV import completed.'));
	
	        } catch (PDOException $e) {
	            $this->Flash->erro(__('Error occured.'));
	        } 
			
			 			
    	}		
    }
}
