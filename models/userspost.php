<?php

    Class userspost extends Model{

        protected $table='users_post';
        protected $allowedFields=['up_us_id','up_content','up_date'];
        protected $primaryKey='up_id';

    }

?>