<?php

    Class content_record extends Model{

        protected $table='content_record';
        protected $allowedFields=['cr_content','cr_date','cr_ar_id'];
        protected $primaryKey='cr_id ';

    }

?>