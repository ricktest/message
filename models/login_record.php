<?php

    Class login_record extends Model{

        protected $table='login_record';
        protected $allowedFields=['login_status','login_acount','login_pwd','login_date'];
        protected $primaryKey='login_id';

    }

?>