<?php

    Class action_record extends Model{

        protected $table='action_record';
        protected $allowedFields=['ar_us_id','ar_action_type','ar_date'];
        protected $primaryKey='ar_id ';

        public function GetMaxId($data){

            $ID=$this->DESC($data)
            ->Limit(1)
            ->SelectData();
            return $ID[0][$data];
        }

    }

?>